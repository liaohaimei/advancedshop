<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '添加分类';
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
                <?php echo $form->field($model,'parentid')->dropDownList($list)?>
                <?php echo $form->field($model,'title')->textInput(['class' => 'form-control'])?>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <?php echo Html::submitButton('保存',['class' => 'btn btn-primary'])?>
                <?php echo Html::resetButton('取消',['class' => 'btn btn-primary'])?>
            </div>
            <?php ActiveForm::end();?>
        </div>
        <!-- /.box -->
    </div>
</div>
<!-- /.row -->

