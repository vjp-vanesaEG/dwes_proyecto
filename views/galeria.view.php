<?php include __DIR__ . '/partials/inicio-doc.part.php' ?>

<!-- Navigation Bar -->
<?php include __DIR__ . '/partials/nav.part.php' ?>
<!-- End of Navigation Bar -->

<!-- Principal Content Start -->
<div id="galeria">
    <div class="container">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <h1>GALLERY</h1>
            <hr>

            <!-- Envío del formulario, en este caso subida del archivo. Si se manda correctamente se mostrará "x" mensaje y si no se selecciona nada se mostrarán los mensajes correspondientes  -->
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <div class="alert alert-<?= empty($errores) ? 'info' : 'danger'; ?>alert-dismissibre" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                    <?php if (empty($errores)) : ?>
                        <p><?= $mensaje ?></p>
                    <?php else : ?>
                        <ul>
                            <?php foreach ($errores as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- enctype es un atributo necesario cuando el formulario contiene campos que permiten cargar archivos, relacionado con type="file" -->
            <form class="form-horizontal" method="post"  enctype="multipart/form-data" action="imagenes_galeriaNueva">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Image</label>
                        <input class="form-control-file" type="file" name="imagen">
                    </div>
                </div>

                <!-- Aquí se despliega el select de categorías para la elección de una de ellas  -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Category</label>
                        <select class="form-control" name="categoria">
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?= $categoria->getId() ?>">
                                    <?= $categoria->getNombre() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Description</label>
                        <textarea class="form-control" name="descripcion"><?= $descripcion ?></textarea>
                        <button class="pull-right btn btn-lg sr-button">SEND</button>
                    </div>
                </div>
            </form>
            <hr class="divider">

            <!-- Creación de una tabla que guardará las características de la imágenes que aparecerán en modo tabla justo debajo del formulario -->
            <div class="imagenes_galeria">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Visualizaciones</th>
                            <th scope="col">Likes</th>
                            <th scope="col">Descargas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($imagenes as $img): ?>
                            <tr>
                                <th scope="row"><?= $img->getId() ?></th>
                                <td>
                                    <img src="<?= $img->getUrlGallery() ?>"
                                        alt="<?= $img->getDescripcion() ?>"
                                        title="<?= $img->getDescripcion() ?>"
                                        width="100px">
                                </td>
                                <td><?= $categorias[$img->getCategoria() - 1]->getNombre() ?></td>
                                <td><?= $img->getNumVisualizaciones() ?></td>
                                <td><?= $img->getNumLikes() ?></td>
                                <td><?= $img->getNumDescargas() ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Principal Content Start -->

<?php include __DIR__ . '/partials/fin-doc.part.php' ?>