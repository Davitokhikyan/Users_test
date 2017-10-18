<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Transfer is the model behind the transfer.
 */
class MakeTransfer extends Model
{
    public $username;
    public $amount;


    /**
     * @return array the validation rules.
     */

    public function rules()
    {
        return [
            [['username', 'amount'], 'required'],
            ['amount' ,  'number' , 'min' => 0]
        ];
    }

}
