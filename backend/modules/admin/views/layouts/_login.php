<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\modules\admin\assets\AdminAsset;
use common\widgets\Alert;

use yii\helpers\Html;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="hold-transition login-page">
    <?php $this->beginBody() ?>
    
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
    
    <div class="login-box">
            
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="container">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
        </section>
        
        <footer class="footer mt-auto py-3 text-muted">
            <div class="container">
                <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
                <p class="float-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </div>

</body>
</html>
<?php $this->endPage();
