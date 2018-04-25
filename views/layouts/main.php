<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\PublicAsset;
use \yii\helpers\Url;

PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <nav class="navbar main-menu navbar-default nav-and-article">

        <div class="navbar-collapse">
            <ul class="nav navbar-nav navhome">
                <li><a  href="<?=Url::toRoute(['site/index'])?>">Главная страница</a></li>
                <?if(Yii::$app->user->isGuest):?>
                    <li><a href="<?=Url::toRoute(['site/login'])?>">Войти</a></li>
                <?endif;?>
                <?if(!Yii::$app->user->isGuest):?>
                    <li class="i_con"><a href="<?=Url::toRoute(['site/logout'])?>">Выйти</a></li>
                    <li class="i_con"><a href="<?=Url::toRoute(['admin/post'])?>">Статьи</a></li>
                    <li class="i_con"><a href="<?=Url::toRoute(['comment/index'])?>">Комментарии</a></li>
                <?endif;?>
            </ul>
        </div>
    </nav>

    <?=$content;?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
