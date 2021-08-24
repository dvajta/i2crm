<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "exam".
 *
 * @property int $id
 * @property string|null $title
 * @property string $exam_date
 * @property int $quantity
 * @property string|null $date_create
 * @property string|null $date_update
 * @property string|null $deadline
 * @property int $status
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exam';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exam_date', 'quantity'], 'required'],
            [['exam_date', 'date_create', 'date_update', 'deadline'], 'safe'],
            [['quantity', 'status'], 'integer'],
            [['title'], 'string', 'max' => 10],
            ['exam_date', function() {
                if ((strtotime($this->exam_date) - (strtotime("now") + $this->quantity*24*60*60)) < 0) {
                    return $this->addError('exam_date', 'Экзамен слишком близко, Вы не успеете!'); 
                }
            }],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название экзамена',
            'exam_date' => 'Дата экзамена',
            'quantity' => 'Количество дней для подготовки',
            'date_create' => 'Дата создания',
            'date_update' => 'Дата обновления',
            'deadline' => 'Дата дедлайна',
            'status' => 'Статус',
        ];
    }

    
}
