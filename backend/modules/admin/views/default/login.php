<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<!-- /.login-logo -->
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            
        <?= $form->field($model, 'username',[
                                              'options'=>
                                              ['tag'=>'div',
                                                'class'=>'input-group mb-3',
                                              ],
                                              'template'=>'{input} <div class="input-group-append">
                                                  <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                  </div>
                                                </div> <div class="d-block w-100">{error}{hint}</div>'
                                            ])
                  ->textInput(['autofocus' => true,'placeholder'=>'Username']) ?>
        
        <?= $form->field($model, 'password',[
                                              'options'=>
                                              ['tag'=>'div',
                                                'class'=>'input-group mb-3',
                                              ],
                                              'template'=>'{input} <div class="input-group-append">
                                                  <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                  </div>
                                                </div> <div class="d-block w-100">{error}{hint}</div>'
                                            ])->passwordInput(['placeholder'=>'Password']) ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        
        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

      <?php ActiveForm::end(); ?>

      <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->