<?php

use backend\models\SubCategorySearch;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'pjax' => true,
        'showPageSummary' => true,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="fas fa-layer-group"></i> Categories </h3>',
            'type'=>'success',
            'before'=>Html::a('<i class="fas fa-plus"></i> Create Category', ['create'], ['class' => 'btn btn-success']),
            'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer'=>false
        ],
        'columns' => 
        [
            [
                'class' => '\kartik\grid\ExpandRowColumn',
                'value' => function($model,$key,$index,$column)
                {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=> function($model,$key,$index,$column)
                {
                    $searchModel = new SubCategorySearch();
                    $searchModel->category_id = $model->id;
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    return Yii::$app->controller->renderPartial('_sub_category_item',[
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],     
            'id',
            'name',
            'created_at',
            'updated_at',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
        

    ]); ?>
    <?php Pjax::end(); ?>


</div>
