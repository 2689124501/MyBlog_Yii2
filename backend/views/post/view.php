<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '文章管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">
    <!-- 文章标题 -->
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <!-- 两个按钮 -->
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定删除这篇文章吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>
            <!-- detailView部件-->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content:ntext',        //属性：展示格式
            'tags:ntext',
            [
                'label'=>'状态',       //设定标签
                'value'=>$model->status0->name,     //设定值
            ],
            [
                'attribute'=>'create_time',
                'value'=>date('Y-m-d H:i:s', $model->create_time),
            ],
            [
                'attribute'=>'update_time',
                'value'=>date('Y-m-d H:i:s', $model->update_time),
            ],
            [
                'attribute'=>'author_id',      //指定属性
                'value'=>$model->author->nickname,      //指定值
            ],
        ],
        'template' => '<tr><th style="width:120px;">{label}</th><td>{value}</td></tr>',
        'options' => ['class' => 'table table-striped table-bordered detail-view'],     //修改表格标签的属性
    ]) ?>

</div>
