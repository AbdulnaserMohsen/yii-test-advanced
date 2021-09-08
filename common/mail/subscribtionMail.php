<?php
/**var $channel  \common\models\User*/
/**var $user  \common\models\User*/
use yii\helpers\Url;

?>

<p>Hello <?php echo $channel->username ?>,</p>
<p>
    User <a href="<?php echo Url::to(['channel/view', 'user_name'=>$user->username],true) ?>" >
            <?php echo $user->username ?>
         </a> 
    has subscribed you.
</p>

<p>Best Wishes,</p>
<p>test</p>