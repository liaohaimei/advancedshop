<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use backend\models\Product;
use backend\models\CateGory;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Json;
class ProductController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Product;
        $cate = new Category;
        $list = $cate->getOptions();
        unset($list[0]);
        /*if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $pics = $this->upload();
            if(!$pics){
                $model->addError('cover','封面不能为空');
            }else{
                $post['Product']['cover'] = $pics['cover'];
                $post['Product']['pics'] = $pics['pics'];
            }
            if ($pics && $model->create($post)){
                Yii::$app->session->setFlash('info','添加成功');
            }else{
                Yii::$app->session->setFlash('info','添加失败');
            }
        }
        return $this->render('create',['opts' => $list,'model' => $model]);*/
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->create($post)){
                Yii::$app->session->setFlash('info','添加成功');
                return $this->redirect(['product/index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'opts' => $list,
            'upload' => new UploadForm()
        ]);
    }

    public function actionUpdate()
    {

    }
    public function actionDelete()
    {

    }

    public function actionUpload()
    {
        $uploadForm = new UploadForm();

        if(Yii::$app->request->isPost){
            $uploadForm->imageFile = UploadedFile::getInstance($uploadForm, 'imageFile');

            if($imageUrl = $uploadForm->upload()){
                echo Json::encode([
                    'imageUrl'    => $imageUrl,
                    'error'   => ''		//上传的error字段，如果没有错误就返回空字符串，否则返回错误信息，客户端会自动判定该字段来认定是否有错
                ]);
            }else{
                echo Json::encode([
                    'imageUrl'    => '',
                    'error'   => '文件上传失败'
                ]);
            }
        }
    }
}