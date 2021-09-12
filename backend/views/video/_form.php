<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

\backend\assets\TagsInputAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-8">

            <?php echo $form->errorSummary($model);  ?>
            <?php //echo print_r($model->getErrors());  ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'describtion')->textarea(['rows' => 6]) ?>

            <div class="mb-3">
              <label for="formFile" class="form-label">Thumbnail</label>
              <input class="form-control" type="file" id="formFile" name="thumbnail">
            </div>

            <?= $form->field($model, 'tags',[
              'inputOptions' => ['data-role'=>'tagsinput']
              ])->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-4">
          <div class="ratio ratio-16x9 mb-3">
            <video poster="<?php echo $model->getThumbnailLink(); ?>"
                   src="<?php echo $model->getVideoLink(); ?>" title="YouTube video"
                   controls></video>
          </div>
            <div class="mb-3">
              <p class="text-muted">Video Link</p>
              <img class="img-fluid" src=<?php echo $model->getVideoLink(); ?>>
              <a href="<?php echo $model->getVideoLink(); ?>">Click</a>
            </div>
            <div class="mb-3">
              <p class="text-muted">Video Name</p>
              <p ><?php echo $model->video_name; ?> </p>
            </div>
            <?= $form->field($model, 'status')->dropDownList($model->getStatusLabels()) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
