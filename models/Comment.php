<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $content
 * @property int $status
 * @property string $create_time
 * @property string $author
 * @property string $email
 * @property int $post_id
 *
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'author'], 'required'],
            [['status', 'post_id'], 'integer'],
            [['status'],'in','range' => [0,1]],
            [['create_time'], 'date', 'format'=>'php: Y-m-d'],
            [['create_time'],'default','value' => date('Y-m-d')],
            [['content'], 'string', 'max' => 200],
            [['author', 'email'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'author' => 'Author',
            'email' => 'Email',
            'post_id' => 'Post ID',
        ];
    }
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if($this->isNewRecord){
            $this->update_time=date('Y-m-d');
        } else
            $this->update_time=date('Y-m-d');
        return true;
    }
    public function afterDelete()
    {
        parent::afterDelete();
        Comment::deleteAll('post_id'.$this->ID);
        //Tag::updateFrequency()
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
