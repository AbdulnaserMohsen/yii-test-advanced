<?php

namespace common\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property string $video_id
 * @property string $title
 * @property string|null $describtion
 * @property string|null $tags
 * @property string|null $video_name
 * @property int|null $has_thumbnail
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Video extends \yii\db\ActiveRecord
{

   const STATUS_UNLISTED =0;
   const STATUS_PUBLISHED =1;

   /**
   * @var \yii\web\UploadedFile
   */
   public $video;
   public $thumbnail;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    public function behaviors()
    {
        return
        [
            TimestampBehavior::class,
            [
              'class' => BlameableBehavior::class,
              'updatedByAttribute' => false,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'title'], 'required'],
            [['describtion'], 'string'],
            [['has_thumbnail', 'status', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            [['title', 'tags', 'video_name'], 'string', 'max' => 512],
            [['video_id'], 'unique'],
            [['has_thumbnail'],'default','value' => 0],
            [['status'], 'default', 'value' => self::STATUS_UNLISTED],
            [['video'],'file','skipOnEmpty' => false, 'extensions' => 'mp4'],
            [['thumbnail'],'image', 'extensions' => 'png, jpg'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'video_id' => 'Video ID',
            'title' => 'Title',
            'describtion' => 'Describtion',
            'tags' => 'Tags',
            'video_name' => 'Video Name',
            'has_thumbnail' => 'Has Thumbnail',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }



    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[VideoView]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getViews()
    {
        return $this->hasMany(VideoView::className(), ['video_id' => 'video_id']);
    }
    
    /**
     * {@inheritdoc}
     * @return \common\models\query\VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoQuery(get_called_class());
    }

    public function save($runValidation=true , $attributeNames=null)
    {
        if($this->isNewRecord)
        {
            $this->video_id = Yii::$app->security->generateRandomString(8);
            $this->title = $this->video->name;
            $this->video_name = $this->video->name;
        }


        $saved = parent::save($runValidation,$attributeNames);
        if($saved)
        {
            //upload video to server just in create
            if($this->video)
            {
                $videoPath = Yii::getAlias('@frontend/web/storage/videos/'. $this->video_id . substr($this->video_name,-4), $mode = 0775, $recursive = true);
                if(!is_dir(dirname($videoPath)))
                {
                    \yii\helpers\FileHelper::createDirectory(dirname($videoPath));
                }
                $this->video->saveAs($videoPath);
            }

            //upload thumbnail just in update
            if($this->thumbnail)
            {
                $thumbnailPath = Yii::getAlias('@frontend/web/storage/thumbnails/'. $this->video_id .'.jpg');

                if(!is_dir(dirname($thumbnailPath)))
                {
                    \yii\helpers\FileHelper::createDirectory(dirname($thumbnailPath));
                }
                $this->thumbnail->saveAs($thumbnailPath);
                Image::getImagine()->open($thumbnailPath)
                        ->thumbnail(new Box(1280,1280))
                        ->save();
                $this->has_thumbnail = 1;

            }
            return true;
        }


        return false;
    }

    public function getVideoLink()
    {
        return Yii::$app->params['frontendUrl'].'storage/videos/'.$this->video_id.substr($this->video_name,-4);
    }
    public function getThumbnailLink()
    {
        return Yii::$app->params['frontendUrl'].'storage/thumbnails/'.$this->video_id.'.jpg';
    }

    public function getStatusLabels()
    {
        return [
            self::STATUS_UNLISTED => 'Unlisted',
            self::STATUS_PUBLISHED => 'Published'
        ];
    }

    public function likedBy($user_id)
    {
        $liked = VideoLike::find()->andWhere(['user_id'=>$user_id,
                                               'video_id' => $this->video_id,
                                                'type' => VideoLike::TYPE_LIKE])->one();
        if($liked)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function dislikedBy($user_id)
    {
        $disliked = VideoLike::find()->andWhere(['user_id'=>$user_id,
                                               'video_id' => $this->video_id,
                                                'type' => VideoLike::TYPE_DISLIKE])->one();
        if($disliked)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function likesCounter()
    {
        return VideoLike::find()->andWhere(['video_id' => $this->video_id,
                                            'type' => VideoLike::TYPE_LIKE])->count();

    }
    public function dislikesCounter( )
    {
        return VideoLike::find()->andWhere(['video_id' => $this->video_id,
                                            'type' => VideoLike::TYPE_DISLIKE])->count();
    }


}
