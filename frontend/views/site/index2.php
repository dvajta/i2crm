<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */
/* @var $form ActiveForm */
?>
<div class="site-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'exam_date') ?>
        <?= $form->field($model, 'quantity') ?>
        <?= $form->field($model, 'date_create') ?>
        <?= $form->field($model, 'date_update') ?>
        <?= $form->field($model, 'deadline') ?>
        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'title') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-index -->
