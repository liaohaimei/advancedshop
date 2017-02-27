<?php
namespace backend\controllers;
use Yii;
use backend\models\Category;
use yii\web\Controller;
class CategoryController extends Controller
{
    public function actionIndex(){
        $model = new Category();
        $cates = $model->getTreeList();
        return $this->render("index",['cates' => $cates]);
    }

    public function actionCreate(){
        $list = [];
        $model = new Category();
        $list = $model->getOptions();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->create($post)){
                Yii::$app->session->setFlash('info','添加成功');
                return $this->redirect(['category/index']);
            }
        }
        return $this->render("create",['list' => $list,'model' => $model]);
    }

    public function actionUpdate()
    {
        $cateid = Yii::$app->request->get("cateid");
        $model = Category::find()->where('cateid = :id',[':id' => $cateid])->one();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->load($post) && $model->save()){
                Yii::$app->session->setFlash('info','修改成功');
                return $this->redirect(['category/index']);
            }
        }
        $list = $model->getOptions();
        return $this->render("create",['model' => $model,'list' => $list]);
    }

    public function actionDelete()
    {
        try {
            $cateid = Yii::$app->request->get("cateid");
            if (empty($cateid)) {
                throw new \Exception('参数错误');
            }
            $data = Category::find()->where('parentid = :pid', [':pid' => $cateid])->one();
            if ($data) {
                throw new \Exception('该分类下有子类，不允许删除');
            }
            if(!Category::deleteAll('cateid = :id',[':id' => $cateid])){
                throw new \Exception('删除失败');
            }
        }catch (\Exception $e){
            Yii::$app->session->setFlash('info',$e->getMessage());
        }
        return $this->redirect(['category/index']);
    }
}