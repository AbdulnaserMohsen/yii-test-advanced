<?php


use yii\widgets\Pjax;

?>

    <div class="container-fluid bg-light p-5">
        <h1 class="display-4"><?php echo $channel->username ?></h1>
        <hr class="my-4">
        <?php Pjax::begin() ?>
           <?php echo $this->render('_subscribe',['channel'=>$channel]); ?>     
        <?php Pjax::end() ?>
        
    </div>
    
    <?php

        /**@var $dataProvider \yii\data\AtiveDataProvider */

        use yii\widgets\ListView;

        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '@frontend/views/video/_video_item',
            'itemOptions' => ['tag'=>false,],
            'layout' => '<div class="row row-cols-md-3">{items}</div>{pager}',
        ]);

    ?>