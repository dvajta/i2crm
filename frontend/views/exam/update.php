<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Exam */

$this->title = 'Обновить запись: ' . $model->title;
?>
<div class="exam-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
