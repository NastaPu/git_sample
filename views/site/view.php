<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<!--main content start-->
<div class="main-content">
    <div class="article-full">
        <article class="post">
            <div class="post-content">
                <header class="title">
                    <h1 class="title"><a href="#"><?= $post->title?></a></h1>
                </header>
                <div class="title">
                    <?= $post->content;?>
                </div>
                <p>#<?=$post->tag->name?></p>

            </div>
        </article>
        <?if(!(empty($comments))):?>

            <?foreach ($comments as $comment):?>
                <div class="bottom-comment">
                    <div class="comment-text">
                        <h5><?=$comment->author?></h5>
                        <h6><?=$comment->email?></h6>

                        <p class="comment-date">
                            <?=$comment->create_time?>
                        </p>

                        <p class="para"><?=$comment->content?></p>
                    </div>
                </div>
            <?endforeach;?>
        <?endif;?>

        <div class="leave-comment">
            <h4>Добавить комментарий</h4>
            <?php $form = ActiveForm::begin(['action' =>['site/comment', 'id'=>$post->id],
                'options'=>['role'=>'form']]);?>
            <div class="form-comment">
                <?= $form->field($commentForm, 'author')->textInput(['placeholder'=>"Name"])->label(false) ?>
                <?= $form->field($commentForm, 'email')->textInput(['placeholder'=>"Eamil"])->label(false)  ?>
                <?= $form->field($commentForm, 'content')->textarea([ 'placeholder'=>"Write Massage"])->label(false)  ?>
            </div>
            <button type="submit" class="btn send-btn">Отправить</button>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
