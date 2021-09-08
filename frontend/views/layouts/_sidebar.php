<?php

use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;

?>

<aside class="shadow">

    <?php echo \yii\bootstrap5\Nav::widget([
        'options'=>['class' =>' d-flex flex-column nav-pills'],
        'items'=>
        [
            ['label'=>'Home', 'url'=>['/video/index'], ''=>''],
            ['label'=>'History', 'url'=>['/video/history'], ''=>''],
        ],
    ])

    ?>
</aside>
