<?php

use backend\models\Company;
use yii\helpers\Html;
use yii\grid\GridView;

use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\bootstrap5\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Create Company', ['#'], ['class' => 'btn btn-success',
                                               'data-bs-toggle'=>'modal',
                                               'data-bs-target'=>'#create-modal',
                                             ]) ?>
    </p>
    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div id="main-section">
        <div id="main-content">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pager' => [
                    'class' => 'yii\bootstrap5\LinkPager'
                ],
                'rowOptions' => function($model){
                    if($model->status == 'inactive'){
                        return ['class'=>'table-danger'];
                    }
                },
                'layout' => "{summary}\n{items}\n<div class='d-flex justify-content-center'>{pager}</div>",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    
                    [
                        'attribute' => 'logo',
                        'format'=>'raw',
                        'value' => function($data)
                                {
                                    $url = \yii\helpers\Url::to('advanced/backend/web/'.$data->logo,true);
                                    return Html::img($url, ['alt'=>'myImage','width'=>'70','height'=>'50']);
                                    //return Html::img(Yii::getAlias('@backend/web/').$data['logo']);
                                }
                    ],
                    'name',
                    'email:email',
                    'address',
                    [
                        'attribute' => 'start_date',
                        'value' => 'start_date',
                        'label'=>'Start Date',
                        'format' => 'raw',
                        'filter' => DatePicker::widget
                                ([
                                    'model'=>$searchModel,
                                    'attribute' => 'start_date',
                                    'value' => '',
                                    'options' => ['placeholder' => 'Date'],
                                    'pluginOptions' => 
                                    [
                                        'format' => 'yyyy-m-d',
                                        'todayHighlight' => true,
                                    ],
                                ]),
                    ],
                    'status',
                    //'created_at',
                    //'updated_at',
                    //'created_by',
                    //'updated_by',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>

            <?php Modal::begin([ 'id'=>'create-modal', ]); ?>
                <div>
                    <div class="company-create">
                        <?php $model = new Company(); ?>
                        <h1> Create Company </h1>
                            <?php Pjax::begin(['enablePushState' => false]); ?>
                                <?= $this->render('_form', [
                                    'model' => $model,
                                    'form_action'=>'create',
                                    'colors' => $colors
                                ]) ?>
                            <?php Pjax::end(); ?>
                    </div>
                </div>
            <?php   Modal::end(); ?>
        </div>
    </div>

</div>
