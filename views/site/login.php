<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Inicio Sesión';

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;



?>
<div class="site-login container">
    <div id="login" class="signin-card">
        <div class="logo-image">
            <img src="/logo.png" alt="Logo" title="Logo" width="80">
            <h1 class="display1">Friendly</h1>
        </div>
        <br><br>
        <?php $form = ActiveForm::begin(['id' => 'login-form','layout' => 'horizontal',]); ?>

        <div id="form-login-username" class="form-group">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class'=>'usuario']) ?>
        </div>
        <div id="form-login-password" class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['class' => 'clave']) ?>
        </div>
        <div>
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn btn-block btn-info ripple-effect boton_login', 'name' => 'login-button']) ?>
        </div>
        <br>
        <div>
            <button type="button" name="button" class="btn btn-primary btn btn-block btn-info ripple-effect registrate">Registrate</button>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
