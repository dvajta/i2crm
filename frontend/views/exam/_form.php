<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exam-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation'=>true,
    ]); ?>

    <?//= $form->field($model, 'status')->dropDownList(['Не сдан', 'Сдан']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_date')->widget(\kartik\datetime\DateTimePicker::className(),[
          'options' => ['placeholder' => 'Выберите дату экзамена ...'],
          'pluginOptions' => [
            'language' => 'ru',
            'autoclose' => true
          ]
      ]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'date_create')->textInput(['disabled' => 'disabled']) ?>

    <?//= $form->field($model, 'date_update')->textInput() ?>

    <?//= $form->field($model, 'deadline')->textInput(['disabled' => 'disabled']) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Вернуться к списку', Url::to(['exam/index']), ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
