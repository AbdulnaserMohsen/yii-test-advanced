<?php

namespace backend\controllers;

use backend\models\Branch;
use backend\models\Company;
use backend\models\CompanySearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

use yii\imagine\Image;
use Imagine\Image\Box;
/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();
        if($this->request->isAjax){return $this->asJson(['aa'=>'aa']);}
        if ($this->request->isPost) 
        {
            //echo UploadedFile::getInstanceByName('logo_file')->getExtension();
            //$model->logo_file = UploadedFile::getInstance($model,'logo_file');
            // $ext = $model->logo_file[0]->extension;
            // echo $ext;
            
            if ($model->load($this->request->post()) ) 
            {
                $model->logo_file = UploadedFile::getInstance($model,'logo_file');
                if( $model->validate())
                {
                    $logoPath = 'logos/' . $model->logo_file->baseName. 
                    Yii::$app->security->generateRandomString(8) . '.' . $model->logo_file->extension;
                    if(!is_dir(dirname($logoPath)))
                    {
                        \yii\helpers\FileHelper::createDirectory(dirname($logoPath));
                    }
                    $model->logo = $logoPath;
                    //$model->load($this->request->post());
                    if($model->save())
                    {
                        $model->logo_file->saveAs($logoPath);
                        Image::getImagine()->open($logoPath)
                                        ->thumbnail(new Box(1280,1280))
                                        ->save();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
            
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }
        if ($this->request->isPost) 
        {
            if ($model->load($this->request->post()) ) 
            {
                $model->logo_file = UploadedFile::getInstance($model,'logo_file');
                if(!$model->logo_file){$model->save();}
                else
                {
                    if( $model->validate())
                    {
                        $logoPath = 'logos/' . $model->logo_file->baseName.
                        Yii::$app->security->generateRandomString(8) . '.' . $model->logo_file->extension;
                        if(!is_dir(dirname($logoPath)))
                        {
                            \yii\helpers\FileHelper::createDirectory(dirname($logoPath));
                        }
                        $model->logo = $logoPath;
                        //$model->load($this->request->post());
                        if($model->save())
                        {
                            $model->logo_file->saveAs($logoPath);
                            Image::getImagine()->open($logoPath)
                                            ->thumbnail(new Box(1280,1280))
                                            ->save();
                        }
                        
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Company model.
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
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetBranches($id)
    {

        $branches = Branch::find()->andWhere(['company_id'=>$id])->all();
        $options = '';
        //echo($branches);
        //exit;
        foreach($branches as $branch)
        {
            //print_r($branch)."<br>";
            $options .= "<option value='".$branch->id."'>".$branch->name."</option>";
        }
        //echo($options);
        //exit;

        return $options;
    }
}
