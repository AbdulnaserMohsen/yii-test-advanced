<?php

  use \yii\helpers\StringHelper;
  use \yii\helpers\Url;
?>


<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">

    <div class="col-md-4">
      <a href="<?php echo Url::to(['video/update','id'=>$model->video_id]) ?>">
        <div class="ratio ratio-16x9 ">
          <video poster="<?php echo $model->getThumbnailLink(); ?>"
                 src="<?php echo $model->getVideoLink(); ?>" title="YouTube video"></video>
        </div>
      </a>
    </div>

    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $model->title; ?></h5>
        <p class="card-text"><?php  echo StringHelper::truncate($model->describtion,10);?></p>
        <p class="card-text"><small class="text-muted">
            Last updated <?php echo Yii::$app->formatter->asRelativetime($model->updated_at); ?>
        </small></p>
      </div>
    </div>

  </div>
</div>
