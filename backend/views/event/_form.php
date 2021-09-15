<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

        <?php  
            if(isset($form_action) ) { $url = Url::to('event/'.$form_action,true); }
            else { $url = '';};
            //echo $url;
            $form = ActiveForm::begin(['action' => $url,'id'=>'form-id',
            'options' => 
            [
                
                'enctype' => 'multipart/form-data',
                'data' => ['pjax' => true]
            ]]); 
        
        ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
