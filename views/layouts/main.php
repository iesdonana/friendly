<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'Friendly',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        $items = [

            Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->nombre . ')',
                        ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                        )
                    ];
                    if (Yii::$app->user->isGuest) {
                        //Añadir aqui apartados de usuarios invitados
                        array_unshift($items,  ['label' => 'Registrarse', 'url' => ['usuarios/create']]);
                    }


                    if (!Yii::$app->user->isGuest && !Yii::$app->user->esAdmin) {

                        //Añadir aqui apartados de usuarios registrados
                        array_unshift($items, ['label' => 'Mi perfil', 'url' => ['usuarios/view/' . Yii::$app->user->id]]);
                        array_unshift($items, ['label' => 'Amigos', 'url' => ['usuarios/index']]);
                        array_unshift($items, ['label' => 'Chat', 'url' => ['usuarios/index']]);
                        array_unshift($items, ['label' => 'Foro', 'url' => ['usuarios/index']]);
                        array_unshift($items, ['label' => 'Chat', 'url' => ['usuarios/index']]);
                    }

                    if (Yii::$app->user->esAdmin) {
                        //Añadir aqui apartados de usuarios administrador
                        array_unshift($items, ['label' => 'Mensajes foro', 'url' => ['publicos/index']]);
                        array_unshift($items, ['label' => 'Mensajes Chat', 'url' => ['privados/index']]);
                        array_unshift($items, ['label' => 'Amistad', 'url' => ['amigos/index']]);
                        array_unshift($items, ['label' => 'Conectados', 'url' => ['conectados/index']]);
                        array_unshift($items, ['label' => 'Usuarios', 'url' => ['usuarios/index']]);

                    }

                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => $items,
                    ]);
                    NavBar::end();
                    ?>

                    <div class="container">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]) ?>
                            <?= $content ?>
                        </div>
                    </div>

                    <footer class="footer">
                        <div class="container">
                            <p class="pull-left">&copy; Friendly <?= date('Y') ?></p>


                        </div>
                    </footer>

                    <?php $this->endBody() ?>
                </body>
                </html>
                <?php $this->endPage() ?>
