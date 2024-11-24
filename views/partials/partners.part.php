<?php
include __DIR__ . '/partials/inicio-doc.part.php';
include __DIR__ . '/partials/nav.part.php';
?>

<div>
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>PARTNER</h1>

            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                <!-- Si he recibido el post, meteré una alerta de tipo info, y en caso-->
                <!-- contrario muestro una alerta de tipo danger con clases de bootstrap-->
                <div class="alert alert-<?php echo empty($errores) ? 'info' : 'danger'; ?> alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php if (empty($errores)) : ?>
                        <p><?= $mensaje ?></p>
                    <?php else : ?>
                        <ul>
                            <?php foreach ($errores as $error) : ?>
                                <li><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Logo</label>
                        <input class="form-control-file" type="file" id="logo" name="logo">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                        <button class="pull-right btn btn-lg btn-info">ENVIAR</button>
                    </div>
                </div>
            </form>
            <hr class="divider">

            <div class="parter">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Logo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($partners as $partner): ?>
                            <tr>
                                <th scope="row"><?= $partner->getId() ?></th>
                                <td><?= $partner->getNombre() ?></td>
                                <td>
                                    <img src="<?= $partner->getUrlLogo() ?>"
                                        alt="<?= $partner->getDescripcion() ?>"
                                        title="<?= $partner->getDescripcion() ?>"
                                        width="100px">
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/partials/fin-doc.part.php';
?>