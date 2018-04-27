<?php

namespace app\models;


use yii\base\Model;

class CommentForm extends Model {
    public $content;
    public $author;
    public $email;

    public function rules() {
        return [
            [['content', 'author'], 'required'],
            [['content'], 'string', 'max' => 200],
            [['author'], 'string', 'max' => 20],
            [['email'], 'email'],
        ];
    }

    public function saveComment($post_id) {
        $commentModel = new Comment();

        $commentModel->author = $this->author;
        $commentModel->content = $this->content;
        $commentModel->email = $this->email;
        $commentModel->post_id = $post_id;
        $commentModel->status = 0;

        return $commentModel->save();
    }

}