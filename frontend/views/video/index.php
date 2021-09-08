<?php

/**@var $dataProvider \yii\data\AtiveDataProvider */

use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'itemOptions' => ['tag'=>false,],
    'layout' => '<div class="row row-cols-md-3">{items}</div>{pager}',
]);

?>