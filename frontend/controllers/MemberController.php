<?php
namespace frontend\controllers;
use yii\web\Controller;

class MemberController extends Controller
{
	 public function actionAuth()
	 {
	 	$this->layout = 'layout2';
	    return $this->render('auth');
	 }
}
