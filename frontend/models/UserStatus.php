<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "userstatus".
 *
 * @property int $entry
 * @property int $user_id
 * @property string $date
 * @property int $status
 * @property string $subject
 */
class UserStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'date', 'status', 'subject'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['subject'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'entry' => 'Entry',
            'user_id' => 'User ID',
            'date' => 'Date',
            'status' => 'Status',
            'subject' => 'Subject',
        ];
    }
}
