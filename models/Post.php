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
 * @property int $status
 * @property int $author_id
 * @property int $tag_id
 *
 * @property Comment[] $comments
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT=1;
    const STATUS_PUBLISHED=2;
    const STATUS_ARCHIVED=3;

    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','content','description','status'], 'required'],
            [['content'], 'string'],
            [['create_time'], 'date', 'format' => 'php: Y-m-d'],
            [['create_time'],'default','value' => date('Y-m-d')],
            [['status'], 'in', 'range' => [1,2,3]],
            [['title'], 'string', 'max' => 30],
            [['author_id'],'default','value' => User::UserId()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
            'author_id' => 'Author ID',
            'tag_id' => 'Tag ID',
        ];
    }
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if($this->isNewRecord){
            $this->update_time = date('Y-m-d');
        } else
            $this->update_time = date('Y-m-d');
        return true;
    }
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        Comment::deleteAll('post_id'.$this->id);
        //Tag::updateFrequency()
    }
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }
    public function getPostComments()
    {
        return $this->getComments()->where('status=1')->all();
    }


}
