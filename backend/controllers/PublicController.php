<?php
namespace backend\controllers;
use yii\web\Controller;
use backend\models\Admin;
use Yii;
class PublicController extends Controller
{
	public function actionLogin()
	{
		$this->layout = false;
		$model = new Admin;
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            if($model->login($post)){
                $this->redirect(['site/index']);
                Yii::$app->end();
            }
        }
		return $this->render('login',['model' => $model]);
	}

    /**
     * 退出登录
     */
	public function actionLogout()
    {
        Yii::$app->session->removeAll();
        if (!isset(Yii::$app->session['admin']['isLogin'])){
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        $this->goBack();
    }

    /**
     * 找回密码
     */
    public function actionSeekpassword()
    {
        $this->layout=false;
        $model = new Admin;
        if (Yii::$app->request->isPost){
            $post=Yii::$app->request->post();
            if ($model->seekPass($post)){
                Yii::$app->session->setFlash('info','电子邮件已发送成功，请查收');
            }
        }
        return $this->render('seekpassword',['model' => $model]);
    }
}	