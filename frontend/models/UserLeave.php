<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "userleave".
 *
 * @property int $id
 * @property string $sub
 * @property string $brief
 */
class UserLeave extends ActiveRecord
//class UserLeave extends Model
{
   
    //public $email;
    
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
            [['id', 'sub', 'brief'], 'required'],
            [['id'], 'integer'],
            [['sub'], 'string', 'max' => 50],
            [['brief'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sub' => 'Sub',
            'brief' => 'Brief',
        ];
    }

    public function leave()
    {
        
        $leave = new UserLeave();
        $leave->id=$this->id;
        $leave->sub = $this->sub;
        $leave->brief = $this->brief;
       // $leave->email = 'ayush@bgi.com';
        //echo $leave->save(); 
       return $leave->save();// && $this->sendEmail($user);
    }
}
