<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title="添加产品";
$this->params['breadcrumbs'][]=$this->title;
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
                <?php echo $form->field($model, 'cateid')->dropDownList($opts, ['id' => 'cates']);?>
                <?php echo $form->field($model, 'title')->textInput(['class' => 'form-control']);?>
                <?php echo $form->field($model, 'descr')->textarea(['id' => "wysi", 'class' => 'form-control']);?>
                <?php echo $form->field($model, 'price')->textInput(['class' => 'form-control']);?>
                <?php echo $form->field($model, 'ishot')->radioList([0 => '不热卖', 1 => '热卖']);?>
                <?php echo $form->field($model, 'issale')->radioList(['不促销', '促销']);?>
                <?php echo $form->field($model, 'saleprice')->textInput(['class' => 'form-control']);?>
                <?php echo $form->field($model, 'num')->textInput(['class' => 'form-control']);?>
                <?php echo $form->field($model, 'ison')->radioList(['下架', '上架']);?>
                <?php echo $form->field($model, 'istui')->radioList(['不推荐', '推荐']);?>
                <?php echo $form->field($model, 'cover')->fileInput(['class' => 'span9']);?>
                <?php
                if (!empty($model->cover)):
                ?>
                <img src="http://<?php echo $model->cover;?>-covermiddle">
                <hr>
                <?php
                endif;
                echo $form->field($model, 'pics[]')->fileInput(['class' => 'form-control', 'multiple' => true,]);
                ?>
                <?php
                foreach((array)json_decode($model->pics, true) as $k=>$pic) {
                    ?>
                    <img src="http://<?php echo $pic ?>-coversmall">
                    <a href="<?php echo yii\helpers\Url::to(['product/removepic', 'key' => $k, 'productid' => $model->productid]) ?>">删除</a>
                    <?php
                }
                ?>
                <hr>
                <input type='button' id="addpic" value='增加一个'>
                <?php echo $form->field($upload , 'imageFile')->widget(\kartik\file\FileInput::className(),[
                    'options'   => [
                        'multiple' => true,//多图上传
                        'accept'  => 'images/*',
                        'module'  => 'Rotatain'
                    ],
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['upload']),
                        'uploadExtraData' => [
                            'model' => 'rotatain'	//这个参数可以省略，额外的POST数据，我这里用来保存图片的属性到数据库中方便管理图片资源rotatain为Rotatain AR模型
                        ]
                    ],
                    //网上很多地方都没详细说明回调触发事件，其实fileupload为上传成功后触发的，三个参数，主要是第二个，有formData，jqXHR以及response参数，上传成功后返回的ajax数据可以在response获取
                    'pluginEvents'  => [
                        'fileuploaded'  => "function (object,data){
                            $('.field-rotatain-image').show().find('input').val(data.response.imageUrl);
                         }",
                        //错误的冗余机制
                        'error' => "function (){
                            alert('图片上传失败');
                        }"
                    ]
                ]);?>

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
