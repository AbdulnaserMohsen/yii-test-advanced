<?php

namespace common\models\query;

use common\models\Video;

/**
 * This is the ActiveQuery class for [[\common\models\Video]].
 *
 * @see \common\models\Video
 */
class VideoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Video[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Video|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function creator($user_id)
    {
      return $this->andWhere(['created_by'=> $user_id]);
    }

    public function latest()
    {
      return $this->orderBy(['created_by' => SORT_DESC]);
    }

    public function published()
    {
      return $this->andWhere(['status'=> Video::STATUS_PUBLISHED]);
    }

    public function byKeyWord($keyword)
    {
        return $this->andWhere("MATCH(title,describtion,tags) AGAINST (:keyword)",
                ['keyword' => $keyword]);
    }

}
