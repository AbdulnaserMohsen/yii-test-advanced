<?php

use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Department */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <?php $getBranchesUrl = Url::to('advanced/backend/web/company/get-branches',true); ?>
    <?php 
        echo $form->field($model, 'company_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($companies,'id','name'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select Department','id'=>'company_change'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    
    <?php 
        // $form->field($model, 'company_id')->dropDownList(
        // ArrayHelper::map($companies,'id','name'), 
        // [
        //     'prompt' => 'company',
        //     'onChange'=>' 
        //         //console.log($(this).val());
        //         $.get("'.$getBranchesUrl.'?id="+ $(this).val() , function(data){
        //             console.log(data);
        //             $("#department-branch_id").children("option:not(option:first)").remove();
        //             $("#department-branch_id").append(data);
        //         });',
        // ]); 
    ?>
    
    <?php 
        echo $form->field($model, 'branch_id')->widget(Select2::classname(), [
            'options' => ['placeholder' => 'Select Branch','id'=>'branch_select'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?php 
            // $form->field($model, 'branch_id')->dropDownList(
            //     [], 
            //     [
            //         'prompt' => 'Selcet Branche',
            //     ]
            // ); 
    ?>

    <?php //$form->field($model, 'branch_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
    $this->registerJs(
        "//console.log('yamo3lm');
        $(document).on('change','#company_change',function(){
            //console.log($(this).val());
            $.get('".$getBranchesUrl."?id='+ $(this).val() ,function(data)
            {
                //console.log(data);
                $('#branch_select').children('option:not(option:first)').remove();
                $.each( data, function( key,branch ) 
                {   
                    //console.log(branch);
                    $('#branch_select').append('<option value='+branch.id+'>'+branch.name+'</option>');    
                });
                
            });

        });
        ",
    );
?>