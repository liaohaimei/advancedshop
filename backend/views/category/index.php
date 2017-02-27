<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = '分类列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- DataTables -->
<?= Html::cssFile('@web/assets/plugins/datatables/dataTables.bootstrap.css') ?>

<!-- Main content -->
<p><?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?></p>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>分类ID</th>
                            <th>分类名称</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($cates as $cate): ?>
                        <tr>
                            <td><?php echo $cate['cateid'] ?></td>
                            <td><?php echo $cate['title'] ; ?></td>
                            <td>
                                <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update','cateid' => $cate['cateid']]) ?>
                                <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete','cateid' => $cate['cateid']], ['onclick' => 'return confirm(\'确定删除该记录吗?\')']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
<!-- /.content -->