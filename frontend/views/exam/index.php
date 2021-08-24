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
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'exam_date',
            'quantity',

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
                        showResult(res);
                        
                    },
                    error: function(){
                        alert('Error');
                    }
            });
        })

        function showResult(res){
            $('#view-result .res-mess').html(res);
            $('#view-result').modal();
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

<?=$this->render('modal'); ?>
