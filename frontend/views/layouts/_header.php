<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

use yii\helpers\Url;

?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-light bg-light shadow-sm',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup'],'linkOptions' => ['class'=>'m-1'] ];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login'],'linkOptions' => ['class'=>'m-1'] ];
    } else {
        // $menuItems[] = '<li>'
        //     . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
        //     . Html::submitButton(
        //         'Logout (' . Yii::$app->user->identity->username . ')',
        //         ['class' => 'btn btn-link logout']
        //     )
        //     . Html::endForm()
        //     . '</li>';
        $menuItems[] = ['label' => 'Logout('.Yii::$app->user->identity->username.')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method'=>'post','class'=>'m-1']
                        ];
    }?>
    <form class="d-flex" action="<?php echo Url::to(['video/search']) ?>">
        <input class="form-control me-2" type="search" placeholder="Search" 
            name="keyword" value="<?php echo Yii::$app->request->get('keyword'); ?>">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>
