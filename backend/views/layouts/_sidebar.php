<?php

use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;

?>

<aside class="shadow">

    <?php echo \yii\bootstrap5\Nav::widget([
        'options'=>['class' =>' d-flex flex-column nav-pills'],
        'items'=>
        [
            ['label'=>'Dashboard', 'url'=>['/site/index'], ''=>''],
            ['label'=>'Videos', 'url'=>['/video/index'], ''=>''],
        ],
    ])

    ?>
</aside>
