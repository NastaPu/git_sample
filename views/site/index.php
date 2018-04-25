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
    <aside class="widget sidebar">
        <h3 class="widget-title">Теги</h3>
        <div class="sidebar-all">
            <div class="p-content">
                <?foreach ($tags as $tag):?>
                    <div class="last-comment">
                        <a href="<?=Url::toRoute(['site/tag','id'=>$tag->id])?>"><?=$tag->name?></a><?=$tag->getPost()->count()?>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </aside>
    <aside class="widget sidebar " style="top:400px;">
        <h3 class="widget-title">Последние комментарии</h3>
        <div class="sidebar-all">
            <div class="p-content">
                <?foreach ($lastComments as $lastComment):?>
                    <div class="last-comment">
                        <a href="#"><?=$lastComment->author?></a>
                        <a href="#"><?=$lastComment->content?></a>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </aside>
    </div>