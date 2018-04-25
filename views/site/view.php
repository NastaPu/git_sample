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

    </div>
</div>
