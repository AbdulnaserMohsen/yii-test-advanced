<?php

/**@var $model /common/models/Video */

use yii\helpers\StringHelper;

use \yii\helpers\Url;

?>

<div class="col">
    <div class="card" style="width: 18rem;">
        <a href="<?php echo Url::to(['video/view','id'=>$model->video_id]) ?>">
            <div class="ratio ratio-16x9 ">
                <video poster="<?php echo $model->getThumbnailLink(); ?>"
                    src="<?php echo $model->getVideoLink(); ?>" title="YouTube video">
                </video>
            </div>
        </a>
        <div class="card-body p-2">
            <h6 class="card-title m-0"> <?php echo $model->title ?> </h6>
            <p class="text-muted card-text m-0"> <?php  echo $model->createdBy->username ?> </p>
            <p class="text-muted card-text m-0">
                <small> 
                    <?php echo $model->getViews()->count() ?> views . <?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?>  
                </small>
            </p>
        </div>
    </div>
</div>