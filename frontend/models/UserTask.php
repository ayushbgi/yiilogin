<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usertask".
 *
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property string $task
 * @property int $status
 */
class UserTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usertask';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'date', 'task', 'status'], 'required'],
            [['id', 'user_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['task'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'date' => 'Date',
            'task' => 'Task',
            'status' => 'Status',
        ];
    }
}
