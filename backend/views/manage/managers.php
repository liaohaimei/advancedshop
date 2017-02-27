<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = '管理员列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- DataTables -->
<?= Html::cssFile('@web/assets/plugins/datatables/dataTables.bootstrap.css') ?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加新管理员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box-body">
        <div class="row">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>管理员ID</th>
                    <th>管理员账号</th>
                    <th>管理员邮箱</th>
                    <th>最后登录时间</th>
                    <th>最后登录IP</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($managers as $manager): ?>
                    <tr>
                        <td><?php echo $manager->adminid; ?></td>
                        <td><?php echo $manager->adminuser; ?></td>
                        <td><?php echo $manager->adminemail; ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $manager->logintime); ?></td>
                        <td><?php echo long2ip($manager->loginip); ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $manager->createtime); ?></td>
                        <td><!--<a href="<?/*=Url::to(['manage/view','adminid' => $manager->adminid])*/?>" title="View" aria-label="View"
                               data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a> <a
                                href="<?/*=Url::to(['manage/update','adminid' => $manager->adminid])*/?>" title="Update"
                                aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>-->
                            <a href="<?=Url::to(['manage/delete','adminid' => $manager->adminid])?>" title="Delete"
                               aria-label="Delete" data-confirm="您确定要删除吗?"
                               data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57
                    entries
                </div>
            </div>
            <div class="col-sm-7">
                <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                    <?=LinkPager::widget([
                        'pagination'=>$pager,
                        'prevPageLabel' => '«',
                        'nextPageLabel' => '»',
                    ])?>
                </div>
            </div>
        </div>
    </div>
</div>
