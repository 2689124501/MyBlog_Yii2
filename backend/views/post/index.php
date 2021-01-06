<?php

use common\models\Poststatus;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('创建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php //echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,        //传过来的参数
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],   //序号列，从1开始的序号列
            // 'id',
            [
                'attribute' => 'id',
                'contentOptions' => ['width' => '20px'],
            ],
            'title',
            [
                'attribute' => 'authorName',
                'label' => '作者',
                'value' => 'author.nickname',
            ],
            // 'content:ntext',
            'tags:ntext',
            [
                'attribute' => 'status',
                'value' => 'status0.name',
                'filter' => Poststatus::find()
                    ->select(['name', 'id'])
                    ->orderBy('position')
                    ->indexBy('id')
                    ->column(),
                'contentOptions' => ['width' => '50px'],
            ],

            //'create_time:datetime',
            // 'update_time:datetime',            
            [
                'attribute' => 'update_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],


            ['class' => 'yii\grid\ActionColumn'],   //动作列，显示动作按钮，如查看，更新，删除操作
            //还有一个复选框列
        ],
    ]); ?>


</div>