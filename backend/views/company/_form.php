<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

        <?php 
        if($model->isNewRecord())
        { 
            $form = ActiveForm::begin([
                'action' => Url::to('create'),
                'options' => 
                [
                    'enctype' => 'multipart/form-data',
                    'data-pjax'=>true,
                ]
            ]); 
        }
        else
        {
            $form = ActiveForm::begin(); 
        }
        ?>

            <?= $form->field($model, 'name')->textInput(['autofocus' => true,'maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'logo_file')->fileInput() ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        
            <?php 
                echo $form->field($model, 'start_date')->widget(
                    DatePicker::className(),[ 
                        'options' => ['placeholder' => 'Select Date', 
                                        'class' => 'form-control'],
                        'pluginOptions' => [
                            'format' => 'yyyy-m-d',
                            'todayHighlight' => true
                        ]
                    ]
                );
            ?>
            <?= Html::error($model, 'start_date');?>

            <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'status']) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success','name' => 'save-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>

</div>
