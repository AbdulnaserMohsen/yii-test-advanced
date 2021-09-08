<?php

    use backend\assets\AppAsset;
    use common\widgets\Alert;
    use yii\bootstrap5\Breadcrumbs;
    use yii\bootstrap5\Html;
    use yii\bootstrap5\Nav;
    use yii\bootstrap5\NavBar;

    AppAsset::register($this);

    $this->beginContent('@frontend/views/layouts/default.php')
?>

      <div class="content-wrapper p-3">
          <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ]) ?>
          <?= Alert::widget() ?>
          <?= $content ?>
      </div>

<?php
    $this->endContent()
?>
