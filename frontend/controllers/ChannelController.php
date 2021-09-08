<?php

namespace frontend\controllers;

use common\models\Subscriber;
use common\models\User;
use yii\web\Controller;
use common\models\Video;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class ChannelController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['subscribe'],
                'rules' => [
                    [
                        'actions' => ['subscribe'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'subscribe' => ['post'],
                ],
            ],
        ];
    }
    public function actionView($user_name)
    {
        $data['channel'] = User::findByUsername($user_name);
        if(!$data['channel'])
        {
            throw new NotFoundHttpException("This channel does not exists");
        }
        
        $data['dataProvider'] = new ActiveDataProvider([
            'query' => Video::find()->creator($data['channel']->id)->published()
        ]);
        
        return $this->render('view',$data);

    }

    public function actionSubscribe($user_name)
    {
        $channel = User::findByUsername($user_name);
        if(!$channel)
        {
            throw new NotFoundHttpException("This channel does not exists");
        }
        $subscriber = $channel->isSubscribed(Yii::$app->user->id);
        
        if(!$subscriber)
        {
            $subscriber = new Subscriber();
            $subscriber->channel_id = $channel->id;
            $subscriber->user_id = \Yii::$app->user->id;
            $subscriber->created_at = time();
            $subscriber->save();
            Yii::$app->mailer->compose(
                'subscribtionMail',['channel'=>$channel,'user'=>Yii::$app->user->identity]
                )->setFrom(Yii::$app->params['senderEmail'])
                ->setTo($channel->email)
                ->setSubject('New Subscribtion')
                ->send();
        }
        else
        {
            $subscriber->delete();
        }
        return $this->renderAjax('_subscribe',['channel'=>$channel]);
    }

}


?>