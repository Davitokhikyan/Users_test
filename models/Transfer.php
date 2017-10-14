<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Transfer is the model behind the transfer.
 */
class Transfer extends ActiveRecord
{
    /**
     * @return array the validation rules.
     */

    public static function tableName()
    {
      return 'transfer';
    }

    public function rules()
    {
        return [
            [['sender_id', 'reciever_id'], 'integer'],
            [['amount'] ,  'double']
        ];
    }

    public function getSender(){
        return $this->hasOne(User::className() , ['id' => 'sender_id']);
    }

    public function getReciever(){
        return $this->hasOne(User::className() , ['id' => 'reciever_id']);
    }

    public static function createTransfer($sender , $reciever , $amount){

        $model = new Transfer();

        $model->setAttributes([
            'sender_id' => $sender,
            'reciever_id' => $reciever,
            'amount' => $amount,
        ]);

        return $model->save() ? $model : false;
    }

    public static function getTransfersByUser($id){
        return static::find()
                    ->with(['sender' , 'reciever'])
                    ->where(['sender_id' => $id])
                    ->orWhere(['reciever_id' => $id])
                    ->all();
    }
}
