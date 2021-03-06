<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <?=Html::cssFile('@web/assets/bootstrap/css/bootstrap.min.css')?>
  <?=Html::cssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css')?>
  <?=Html::cssFile('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css')?>	
  <?=Html::cssFile('@web/assets/dist/css/AdminLTE.min.css')?>
  <?=Html::cssFile('@web/assets/plugins/iCheck/square/blue.css')?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="###"><b>Ioow</b>Manage</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">修改密码</p>
	<?php $form = ActiveForm::begin([
	'fieldConfig' =>[
	'template' => '{input}{error}',
	],
	]);?>
    <?php
      if (Yii::$app->session->hasFlash('info')){
      echo Yii::$app->session->getFlash('info');
      }
    ?>
      <div class="form-group has-feedback">
      	<?php echo $form->field($model,'adminuser')->hiddenInput();?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      	<?php echo $form->field($model,'adminpass')->passwordInput(["class" => "form-control","placeholder" =>"新密码"]);?>
      	<?php echo $form->field($model,'repass')->passwordInput(["class" => "form-control","placeholder" =>"确认密码"]);?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
        	<?php echo Html::submitButton('修改', ["class" => "btn btn-primary btn-block btn-flat"])?>
        </div>
        <!-- /.col -->
      </div>
    <?php $form = ActiveForm::end();?>

    <!-- /.social-auth-links -->

    <a href="<?php echo yii\helpers\Url::to(['public/login'])?>">返回登录</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
<?=Html::jsFile('@web/assets/plugins/jQuery/jQuery-2.2.0.min.js')?>
<?=Html::jsFile('@web/assets/bootstrap/js/bootstrap.min.js')?>
<?=Html::jsFile('@web/assets/plugins/iCheck/icheck.min.js')?>
<script>
	$(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  	});
</script>
</body>
</html>
