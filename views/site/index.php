<?php
use yii\widgets\LinkPager;
use \yii\helpers\Url;
?>

<div class="layout">
    <div class="rows">
        <? foreach ($posts as $post): ?>

            <article class="post">
                <div class="post-content">
                    <header class="title">
                        <h1 class="title"><a href="#"><?=$post->title?></a></h1>
                    </header>
                    <div class="title">
                        <p>
                            <?=$post->description?>
                        </p>
                        <a href="<?=Url::toRoute(['site/view','id'=>$post->id,'title'=>$post->title])?>" class="more-link">Читать</a>

                    </div>
                    <div class="social-share">
                        <span class="social-share-title"><a href="#">Admin</a> <?=$post->update_time?></span>
                    </div>
                </div>
            </article>
        <? endforeach;?>
        <? echo LinkPager::widget(['pagination' => $page])?>
    </div>
    </div>