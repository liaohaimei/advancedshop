<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '修改管理员密码';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <div class="col-md-12">
            <?php if (Yii::$app->session->hasFlash('info')){
                //echo Yii::$app->session->getFlash('info');
            }?>
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                    <?php
                    $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => '<div class="form-group">{label}{input}</div>{error}'
                        ],
                    ]);
                    ?>
                    <div class="box-body">
                        <?php echo $form->field($model,'adminuser')->textInput(['class' => 'form-control','disabled' => true])?>
                        <?php echo $form->field($model,'adminpass')->passwordInput(['class' => 'form-control'])?>
                        <?php echo $form->field($model,'repass')->passwordInput(['class' => 'form-control'])?>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <?php echo Html::submitButton('修改',['class' => 'btn btn-primary'])?>
                        <?php echo Html::resetButton('取消',['class' => 'btn btn-primary'])?>
                    </div>
                <?php ActiveForm::end();?>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->

