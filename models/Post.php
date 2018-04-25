<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $create_time
 * @property string $update_time
 * @property int $author_id
 * @property int $tag_id
 *
 * @property Comment[] $comments
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['title','content','description','status'], 'required'],
            [['content'], 'string'],
            [['create_time'], 'date', 'format'=>'php: Y-m-d'],
            [['create_time'],'default','value' => date('Y-m-d')],
            [['status'], 'in', 'range'=>[1,2,3]],
            [['title'], 'string', 'max' => 30],
            [['author_id'],'default','value' => User::UserId()],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'author_id' => 'Author ID',
            'tag_id' => 'Tag ID',
        ];
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['ID' => 'tag_id']);
    }
}
