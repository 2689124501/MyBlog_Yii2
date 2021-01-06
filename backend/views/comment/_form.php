<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Commentstatus;
use common\models\Comment;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
        'options'=>[
            'initialFrameWidth' => 1200,
        ],
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(
        Commentstatus::find()
            ->select(['name', 'id'])
            ->orderBy('position')
            ->indexBy('id')
            ->column(),
        ['prompt' => '请选择状态']
    ); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>