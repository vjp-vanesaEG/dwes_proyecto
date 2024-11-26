    <div class="row popup-gallery">
        <?php foreach ($imagenes as $imagen): ?>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="sol">
              <?php  shuffle($imagenes); ?> <!-- Para que las imágenes se pongan aleatorias en cada categoría -->

        <!-- Aquí se recogerán los métodos que devuelves las rutas de la imágenes que deben mostrarse, numVisualizaciones,numLikes y numDescargas -->
                    <img class="img-responsive" src="<?= $imagen->getUrlPortfolio() ?>" alt="<?= $imagen->getDescripcion() ?>">
                    <div class="behind">
                        <div class="head text-center">
                            <ul class="list-inline">
                                <li>
                                    <a class="gallery" href="<?= $imagen->getUrlGallery() ?>" data-toggle="tooltip" data-original-title="Quick View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="tooltip" data-original-title="Click if you like it">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="tooltip" data-original-title="Download">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="tooltip" data-original-title="More information">
                                        <i class="fa fa-info"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="row box-content">
                            <ul class="list-inline text-center">
                                <li><i class="fa fa-eye"></i><?= $imagen->getNumVisualizaciones() ?></li>
                                <li><i class="fa fa-heart"></i><?= $imagen->getNumLikes() ?></li>
                                <li><i class="fa fa-download"></i><?= $imagen->getNumDescargas() ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <nav class="text-center">
            <ul class="pagination">
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#" aria-label="suivant">
                        <span aria-hidden="true">&raquo;</span>
                    </a></li>
            </ul>
        </nav>
    </div>
