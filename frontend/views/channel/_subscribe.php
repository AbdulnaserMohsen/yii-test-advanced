<?php

use yii\helpers\Url;
?>


        <a class="btn btn-danger btn-lg" 
            href="<?php echo Url::to(['channel/subscribe', 'user_name'=>$channel->username]) ?>" 
             data-method="post" data-pjax="1">
            <?php if($channel->isSubscribed(Yii::$app->user->id) ): ?>
                Subscribed <i class="fas fa-bell"></i> 
                <label class="">
                    <?php echo $channel->getSubscribers()->count(); ?>
                </label>
            <?php else: ?>
                Subscribe <i class="far fa-bell"></i>
                <label class="">
                    <?php echo $channel->getSubscribers()->count(); ?>
                </label>
            <?php endif ?>
            
        </a>