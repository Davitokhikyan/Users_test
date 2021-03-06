<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Transfer';

?>
<div class="site-login">
    <h1><?= $this->title ?></h1>

    <p>Please enter your Username and Amount to transfer</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <?= Yii::$app->session->getFlash('error'); ?>
    
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'amount')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Transfer', ['class' => 'btn btn-primary', 'name' => 'transfer-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
