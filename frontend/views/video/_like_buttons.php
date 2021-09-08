<?php
use yii\helpers\Url;

?>


<a href="<?php echo Url::to(['video/like-dislike','id'=>$model->video_id,'type'=>1]) ?>" 
class="btn btn-sm btn-outline-primary <?php if($model->likedBy(Yii::$app->user->id)) echo "active";?>" data-method="post" data-pjax="1">
    <i class="far fa-thumbs-up"></i> <?php echo $model->likesCounter() ?>
</a>
<a href="<?php echo Url::to(['video/like-dislike','id'=>$model->video_id,'type'=>0]) ?>" 
class="btn btn-sm btn-outline-secondary <?php if($model->dislikedBy(Yii::$app->user->id)) echo "active";?>" data-method="post" data-pjax="1">
    <i class="far fa-thumbs-down"></i> <?php echo $model->dislikesCounter() ?>
</a>