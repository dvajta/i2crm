<?php

use yii\db\Migration;

/**
 * Class m210825_110852_create_table_exam
 */
class m210825_110852_create_table_exam extends Migration
{

    public function up()
    {
        $this->createTable('exam', [
            'id' => $this->primaryKey(),
            'title' => $this->string(10)->notNull(),
            'exam_date' => $this->datetime()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'date_create' => $this->datetime(),
            'date_update' => $this->datetime(),
            'deadline' => $this->string(50),
            'status' => $this->boolean(),
        ]);
    }

    public function down()
    {
        $this->dropTable('exam');
    }

}
