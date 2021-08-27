<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Экзамены';
?>
<div class="exam-index">
    <p>
        <?= Html::a('Добавить экзамен', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Полный расчёт', ['#'], ['id' => 'calculate', 'class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'exam_date',
                'label' => 'Дата экзамена',
                'value' => function($model){
                    return date('d.m.Y H:i', strtotime($model->exam_date));
                }
            ],
            'quantity',
            [
                'attribute' => 'deadline',
                'label' => 'Дата дедлайна',
                'value' => 'deadline',
                'contentOptions' => function($model){
                    if($model->deadline !== null){
                        return ['id' => 'deadline'.$model->id,'class' => 'add-result'];
                    }else{
                        return ['id' => 'deadline'.$model->id,'class' => 'not-result'];
                    }
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{grab}{update}{delete}',
                'buttons' => [
                    'grab' => function ($url, $model, $key) {
                            $title = $model->title;
                            $id = 'calculate-'.$key;
                            $options = [
                                'title' => $title,
                                'data-id' => $key,
                                'id' => $id,
                                'class' => 'btn btn-success'
                            ];
                            
            
//Обработка клика на кнопку
$js = <<<JS
            $('#{$id}').on('click',function(event){  
            event.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                    url: '/exam/calculate',
                    data: {id: id},
                    type: 'GET',
                    success: function(res){
                        if(!res) alert('Ошибка');
                        showResult(res,id);
                        
                    },
                    error: function(){
                        alert('Error');
                    }
            });
        });

        function showResult(res, id){
            $('#deadline'+id).html(res).removeClass('not-result').addClass('add-result');
        }
    
JS;


                            //Регистрируем скрипты
                            $this->registerJs($js, \yii\web\View::POS_READY, $id);

                            return Html::a('Расcчитать', '#', $options);
                        },
                        
                    ],
            ],

        ],

    ]); ?>


<?php
$this->registerJs("
$('#calculate').on('click',function(event){  
    event.preventDefault();
    $.ajax({
            url: '/exam/all-calculate',
            type: 'GET',
            success: function(res){
                if(!res) alert('Ошибка');
                location.reload();
                return false;
                
            },
            error: function(){
                alert('Error');
            }
    });
});

")
?>

