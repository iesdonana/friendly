<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'friendly';
?>

<?php
$js = <<<EOT

$(document).on('ready', function () {
    $(".galeria").galeriaImg();
});
EOT;
$this->registerJs($js);
?>

<?php

$url = Url::to(['amigos/solicitud']);
$url2 = Url::to(['amigos/cancelar']);


$js = <<<EOT

$(document).on('ready', function () {



    $(".boton_solicitud").on("click", refrescarIndex);

    var id;
    var variable;
    function refrescarIndex(e){
        variable = $(this);
        id = $(this).attr("name");

        $.ajax({
            data: "id="+id,
            type:"GET",
            url: '$url',
            success:refrescar
        });


    }
    function refrescar(r){

        $(".boton_solicitud[name='"+id+"']").toggle();
        $(".cancelar_peticion[name='"+id+"']").toggle();

    }

    $(".cancelar_peticion").on("click", cancelarPeticion);

var variableCancelar;
var idCancelar;

    function cancelarPeticion(e)
    {

        variable = $(this);
        id = $(this).attr("name");

        $.ajax({
            data: "id="+id,
            type:"GET",
            success:cancelar,

            url: '$url2'
        });


    }

    function cancelar(r){


        $(".cancelar_peticion[name='"+id+"']").toggle();
        $(".boton_solicitud[name='"+id+"']").toggle();
    }


    ocultos();

    function ocultos() {
        $(".oculto").hide();
    }
});
EOT;
$this->registerJs($js);


?>
<div class="site-index">
    <div class="galeria">
        <div class="foto">

        </div>
    </div>
    <div class="text-center">
        <h1>Personas cerca</h1>
    </div>
    <?php
    if (!empty($model)) { ?>

        <?php

        foreach ($model as $usuario) {

            $esAmigo = Yii::$app->user->getEsMiAmigo($usuario->id);
            $soyYo = Yii::$app->user->id == $usuario->id;
            $meHaEnviadoAmistad = Yii::$app->user->meHaEnviadoAmistad($usuario->id);

            if (!$esAmigo && !$soyYo && !$usuario->esAdmin() && $meHaEnviadoAmistad){
                ?>

                <div class="row caja_principal">

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad">

                        <div class="panel panel-info caja_perfil">
                            <div class="panel-heading">

                                <h1 class="panel-title"><?= $usuario->nombre?></h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="No imagen" src="<?= $usuario->imageUrl ?>" class="img-circle img-responsive imagen"> </div>

                                    <div class=" col-md-9 col-lg-9 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <td>Nombre</td>
                                                    <td><?= $usuario->nombre?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?= $usuario->email?></td>
                                                </tr>
                                                <tr>
                                                    <td>Población</td>
                                                    <td><?= $usuario->poblacion?></td>
                                                </tr>
                                                <tr>
                                                    <td>Provincia</td>
                                                    <td><?= $usuario->provincia?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">

                                <?php $peticion = Yii::$app->user->estaPeticionEnviada($usuario->id)==true;

                                ?>

                                <?php if(!Yii::$app->user->estaPeticionEnviada($usuario->id)) { ?>
                                    <input type="button" name="<?=$usuario->id?>" value="Solicitud Amistad" class='btn btn-primary boton_solicitud'>
                                    <input type="button" name="<?=$usuario->id?>" value="Cancelar Petición" class='btn btn-danger cancelar_peticion oculto'>

                                    <?php
                                } else {
                                    ?>
                                    <input type="button" name="<?=$usuario->id?>" value="Solicitud Amistad" class='btn btn-primary boton_solicitud oculto'>
                                    <input type="button" name="<?=$usuario->id?>" value="Cancelar Solicitud" class='btn btn-danger cancelar_peticion'>

                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>


                <?php
            }
        }
    }
    ?>
</div>
