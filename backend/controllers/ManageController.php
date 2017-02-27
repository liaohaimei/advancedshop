<?php
namespace backend\controllers;
use yii\web\Controller;
use backend\models\Admin;
use Yii;
use yii\data\Pagination;

class ManageController extends Controller
{
    public function actionMailchangepass()
    {
        $this->layout = false;
        $time = Yii::$app->request->get("timestamp");
        $adminuser = Yii::$app->request->get("adminuser");
        $token = Yii::$app->request->get("token");
        $model = new Admin;
        $myToken = $model->createToken($adminuser,$time);
        if ($token != $myToken){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if (time() - $time >300){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->changePass($post)){
                Yii::$app->session->setFlash('info','密码修改成功');
            }
        }
        $model->adminuser = $adminuser;
        return $this->render("mailchangepass",['model' => $model]);
    }

    public function actionManagers()
    {
        $model = Admin::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['manage'];
        $pager = new Pagination(['totalCount' => $count,'pageSize' => $pageSize]);
        $managers = $model->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('managers',['managers' => $managers,'pager' => $pager]);
    }

    /**
     * 添加
     * @return string
     */
    public function actionCreate()
    {
        $model = new Admin;
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->create($post)){
                Yii::$app->session->setFlash('info','添加成功');
            }else{
                Yii::$app->session->setFlash('info','添加失败');
            }
        }
        $model->adminpass = '';
        $model->repass = '';
        return $this->render('create',['model' => $model]);
    }

    /**
     * 删除
     */
    public function actionDelete()
    {
        $adminid = (int)Yii::$app->request->get('adminid');
        if (empty($adminid)){
            $this->redirect(['manage/managers']);
        }
        $model = new Admin;
        if ($model->deleteAll('adminid = :id',[':id' => $adminid])){
            Yii::$app->session->setFlash('info','删除成功');
            $this->redirect(['manage/managers']);
        }
    }

    /**
     * 修改邮箱
     * @return string
     */
    public function actionChangeemail()
    {
        $model = Admin::find()->where('adminuser = :user',[':user' => Yii::$app->session['admin']['adminuser']])->one();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->changeemail($post)){
                Yii::$app->session->setFlash('info','修改成功');
            }
        }
        $model->adminpass = '';
        return $this->render('changeemail',['model' => $model]);
    }


    public function actionChangepass()
    {
        $model = Admin::find()->where('adminuser = :user',[':user' => Yii::$app->session['admin']['adminuser']])->one();
        if (Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if ($model->changepass($post)){
                Yii::$app->session->setFlash('info','修改成功');
            }
        }
        $model->adminpass = '';
        $model->repass = '';
        return $this->render('changepass',['model' => $model]);
    }

}