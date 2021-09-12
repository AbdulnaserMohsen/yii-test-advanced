<?php

namespace backend\controllers;

use backend\models\Category;
use backend\models\CategorySearch;
use backend\models\Model;
use backend\models\SubCategory;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $sub_categories = [new SubCategory];

        if ($this->request->isPost) 
        {
            if ($model->load($this->request->post())) 
            {
                $sub_categories = Model::createMultiple(SubCategory::classname());
                Model::loadMultiple($sub_categories, Yii::$app->request->post());
                // ajax validation
                

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($sub_categories) && $valid;

                if ($valid) 
                {
                    $transaction = \Yii::$app->db->beginTransaction();
                    
                    try 
                    {
                        if ($flag = $model->save(false)) 
                        {
                            foreach ($sub_categories as $sub_category) 
                            {
                                $sub_category->category_id = $model->id;
                                if (! ($flag = $sub_category->save(false))) 
                                {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        
                        if ($flag) 
                        {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    } 
                    catch (Exception $e) 
                    {
                        $transaction->rollBack();
                        
                    }
                }
                else{
                    echo"error";
                    $model->loadDefaultValues();
                }
            }
        } 
        else 
        {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'sub_categories' => (empty($sub_categories)) ? [new SubCategory()] : $sub_categories,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $sub_categories = $model->subCategories;

        if ($this->request->isPost && $model->load($this->request->post()) ) 
        {
            $oldIDs = ArrayHelper::map($sub_categories, 'id', 'id');
            $sub_categories = Model::createMultiple(SubCategory::classname(), $sub_categories);
            Model::loadMultiple($sub_categories, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($sub_categories, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) 
            {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($sub_categories),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($sub_categories) && $valid;

            if ($valid) 
            {
                $transaction = \Yii::$app->db->beginTransaction();
                try 
                {
                    if ($flag = $model->save(false)) 
                    {
                        if (! empty($deletedIDs)) 
                        {
                            SubCategory::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($sub_categories as $sub_category) 
                        {
                            $sub_category->category_id = $model->id;
                            if (! ($flag = $sub_category->save(false))) 
                            {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) 
                    {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } 
                catch (Exception $e) 
                {
                    $transaction->rollBack();
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'sub_categories' => (empty($sub_categories)) ? [new SubCategory()] : $sub_categories,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
