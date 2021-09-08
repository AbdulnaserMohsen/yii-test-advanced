<?php

/**@video  one video from common/models/Video */

use \yii\helpers\HTML;
use \yii\helpers\Url;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="col-sm-8">
        <div class="ratio ratio-16x9 ">
            <video poster="<?php echo $model->getThumbnailLink(); ?>"
                src="<?php echo $model->getVideoLink(); ?>" title="YouTube video"
                controls>
            </video>
        </div>
        <h6 class="mt-2"> <?php echo $model->title ?> </h6>
        <div class="d-flex justify-content-between">
            <p class="text-muted mt-2">
                
                <?php //echo $count_view ?>
                <small> 
                    <?php echo $model->getViews()->count() ?> views . <?php echo Yii::$app->formatter->asDate($model->created_at) ?>  
                </small>
            </p>
            <div>
                <?php Pjax::begin() ?>
                    <?php echo $this->render('_like_buttons',['model'=>$model]) ?>
                <?php Pjax::end() ?>
            </div>
        </div>
        <div class="">
            <a href="<?php echo Url::to(['channel/view','user_name'=>$model->createdBy->username]);   ?>" class=""> <?php echo HTML::encode($model->createdBy->username) ?> </a>
            <p class="mt-1"> <?php echo HTML::encode($model->describtion) ?> </p>
        </div>
    </div>

    <div class="col-sm-4">

    </div>
</div>