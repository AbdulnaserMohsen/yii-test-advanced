<?php

namespace frontend\controllers;

use common\models\VideoView;
use yii\web\Controller;
use common\models\Video;
use common\models\VideoLike;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\NotFoundHttpException;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class VideoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['like-dislike','history'],
                'rules' => [
                    [
                        'actions' => ['like-dislike','history'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'like-dislike' => ['post'],
                ],
            ],

        ];
    }
    public function actionIndex()
    {
      $dataProvider = new ActiveDataProvider([
        'query' =>  Video::find()->published()->latest()
      ]);

      return $this->render('index',['dataProvider'=>$dataProvider]);
    }

    public function actionView($id)
    {
        $this->layout = 'auth';
        $data['model'] = Video::findOne($id);
        if(!$data['model'])
        {
          throw new NotFoundHttpException("Video Not Found");
        }

        $view = new VideoView();
        $view->video_id = $id;
        $view->user_id = Yii::$app->user->id;
        $view->created_at = time();
        $view->save();
        
        //$data['count_view'] = VideoView::find()->andWhere(['video_id'=>$id])->count();

        return $this->render('view',$data);

    }

    public function actionLikeDislike($id,$type)
    {
      $data['model'] = Video::findOne($id);
      if(!$data['model'])
      {
        throw new NotFoundHttpException("Video Not Found");
      }
      $likedOrDisliked = VideoLike::find()->andWhere(['user_id'=>Yii::$app->user->id,
                                            'video_id' => $id])->one();
      if(!$likedOrDisliked) //new
      {
        $this->likeDislikeVideo($id,Yii::$app->user->id,$type);
      }
      else if($type != $likedOrDisliked->type) //exists but has new emoji
      {
        $likedOrDisliked->delete();
        $this->likeDislikeVideo($id,Yii::$app->user->id,$type);
      }
      else //undo emoji
      {
        $likedOrDisliked->delete();
      }
      return $this->renderAjax('_like_buttons',$data);
    }

    protected function likeDislikeVideo($video_id,$user_id,$type)
    {
      $like = new VideoLike();
      $like->video_id = $video_id;
      $like->user_id = $user_id;
      $like->type = $type;
      $like->created_at = time();
      $like->save();
    }

    public function actionSearch($keyword)
    {
      $query = Video::find()->published()->latest();
      if($keyword)
      {
        $query->byKeyWord($keyword);
      }
      $dataProvider = new ActiveDataProvider([
        'query' => $query
      ]);

      return $this->render('index',['dataProvider'=>$dataProvider]);
    }

    public function actionHistory()
    {
      // $data['video'] = Yii::$app->db->createCommand('
      //   SELECT MAX(created_at) as created_at ,video_id,user_id 
      //   FROM video_view 
      //   WHERE user_id = :userId 
      //   GROUP BY video_id
      //   ORDER By created_at DESC')->bindValue(":userId", Yii::$app->user->id)
      // ->queryAll();
      $data['videos'] = Video::find()
                              ->select('*')
                              ->innerJoinWith('getViews');

      foreach($data['videos'] as $v)
      {
        print_r($v); echo"<br>";
      }
    }
}


?>
