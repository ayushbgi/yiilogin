<?php

//namespace app\models;
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "userleave".
 *
 * @property int $leave_id
 * @property string $sub
 * @property string $brief
 */
class UserLeave extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userleave';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['leave_id', 'sub', 'brief'], 'required'],
           [['sub', 'brief'], 'required'],
           // [['leave_id'], 'integer'],
            [['sub'], 'string', 'max' => 50],
            [['brief'], 'string', 'max' => 100],
           // [['leave_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            //'leave_id' => 'leave_id',
            'sub' => 'Sub',
            'brief' => 'Brief',
        ];
    }
}
