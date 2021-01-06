<?php

use common\models\Adminuser;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $model common\models\Poststatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
        'options'=>[
            'initialFrameWidth' => 1200,
        ],
    ]) ?>
    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'status')
        ->dropDownList(
            Poststatus::find()
                ->select(['name', 'id'])
                ->orderBy("position")
                ->indexBy('id')
                ->column(),
            ['prompt' => '请选择状态']
        ); ?>

    <?= $form->field($model, 'author_id')->dropDownList(
            Adminuser::find()
            ->select(['nickname', 'id'])
            ->indexBy('id')
            ->column(),
        ['prompt' => '请选择作者']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>