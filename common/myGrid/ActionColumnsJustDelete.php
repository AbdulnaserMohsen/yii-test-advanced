<?php

namespace common\myGrid;

use yii\grid\ActionColumn;


class ActionColumnsJustDelete extends ActionColumn
{

  public $template = '{delete}';

  public $buttons = [];

  public $icons = [
      'trash' => '<i class="fas fa-trash"></i>'
  ];

}

 ?>
