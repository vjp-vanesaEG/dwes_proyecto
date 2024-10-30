<?php
shuffle($imagenes);
foreach ($imagenes as $imagen) {
  echo <<<HTML
      <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="sol">
          <img class="img-responsive" src="{$imagen->getUrlPortfolio()}" alt="{$imagen->getDescripcion()}">
          <div class="behind">
            <div class="head text-center">
              <ul class="list-inline">
                <li>
                  <a class="gallery" href="{$imagen->getUrlGallery()}" data-toggle="tooltip" data-original-title="Quick View">
                    <i class="fa fa-eye"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    HTML;
}
