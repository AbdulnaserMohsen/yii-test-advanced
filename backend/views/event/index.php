<?php

use backend\models\Event;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        // echo GridView::widget([
        //     'dataProvider' => $dataProvider,
        //     'filterModel' => $searchModel,
        //     'columns' => [
        //         ['class' => 'yii\grid\SerialColumn'],

        //         'id',
        //         'title',
        //         'description',
        //         'date',
        //         'created_at',
        //         //'updated_at',

        //         ['class' => 'yii\grid\ActionColumn'],
        //     ],
        // ]); 
    ?>

    <?php 
        // echo edofre\fullcalendar\Fullcalendar::widget([
        //   'events' => $events,  
        // ]);

        echo \yii2fullcalendar\yii2fullcalendar::widget(array(
            'events'=> $events,
        ));
    ?>


    
    <?php Modal::begin([ 'id'=>'create-modal', ]); ?>
        <div>
            <div class="company-create">
                <?php $model = new Event(); ?>
                <h1> Create Company </h1>
                    <?php Pjax::begin(['enablePushState' => false]); ?>
                        <?= $this->render('_form', [
                            'model' => $model,
                            'form_action'=>'create',
                        ]) ?>
                    <?php Pjax::end(); ?>
            </div>
        </div>
    <?php   Modal::end(); ?>

</div>

<?php

$this->registerJs(
    "
      $(document).on('click','[data-date]',function(){
            console.log($(this).attr('data-date'));
            $('#create-modal').modal('show');
            $('#event-date').val($(this).attr('data-date'));

      }); 
    ",
);

?>