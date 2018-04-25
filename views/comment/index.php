<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;


$this->title = 'Управление комментариями';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?if(!empty($comments)):?>
        <table>
            <thead>
            <tr>
                <td>Автор</td>
                <td>Email</td>
                <td>Содержание</td>
                <td>Удалить</td>
                <td>Одобрить</td>
                <td>Заблокировать</td>
            </tr>
            </thead>
            <?foreach ($comments as $comment):?>
                <tr>
                    <td><?=$comment->author?></td>
                    <td><?=$comment->email?></td>
                    <td><?=$comment->content?></td>
                    <td><a class="btn-delete" href="<?=Url::toRoute(['comment/delete','id'=>$comment->id])?>">Удалить</a></td>
                    <td><a class="btn-allow" href="<?=Url::toRoute(['comment/allow','id'=>$comment->id])?>">Одобрить</a></td>
                    <td><a class="btn-block" href="<?=Url::toRoute(['comment/block','id'=>$comment->id])?>">Заблокировать</a></td>
                </tr>
            <?endforeach;?>
        </table>

    <?endif;?>
</div>
