<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property string $id
 * @property string $name
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'],'required'],
            [['name'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
    public function getPost()
    {
        return $this->hasMany(Post::className(), ['tag_id' => 'ID']);
    }
}
