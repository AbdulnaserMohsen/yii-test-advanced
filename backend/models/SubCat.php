<?php

namespace backend\models;

use Yii;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "sub_cat".
 *
 * @property int $id
 * @property string $name
 * @property int $cat_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Cat $cat
 */
class SubCat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_cat';
    }

    public function behaviors()
    {
        return
        [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name',], 'required'],
            [['cat_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cat::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cat_id' => 'Cat ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Cat::className(), ['id' => 'cat_id']);
    }
}
