<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

        <?php  
            if(isset($form_action) ) { $url = Url::to('company/'.$form_action,true); }
            else { $url = '';};
            //echo $url;
            $form = ActiveForm::begin(['action' => $url,'id'=>'form-id',
            'options' => 
            [
                
                'enctype' => 'multipart/form-data',
                'data' => ['pjax' => true]
            ]]); 
        
        ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true,'maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'logo_file')->fileInput() ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        
            <?php 
                echo $form->field($model, 'start_date',)->widget(
                    DatePicker::className(),[ 
                        'options' => ['placeholder' => 'Select Date', 
                                        'class' => 'form-control'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true
                        ]
                    ]
                );
            ?>
            <?= Html::error($model, 'start_date');?>
            
            <?php echo $form->field($model, 'colors[]')->inline(true)->checkboxList(ArrayHelper::map($colors,'id','name')); ?>
            <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'status']) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success','name' => 'save-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>

</div>

