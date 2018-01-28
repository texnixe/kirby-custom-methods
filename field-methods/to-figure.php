<?php

field::$methods['toFigure'] = function($field, $class='') {
  $image = $field()->toFile();
  if($image) {
    $img = new Brick('img');
    $img->attr('src', $image->url());
    $img->attr('alt', $image->alt());
    $figure = new Brick('figure');
    $figure->addClass($class);
    $figure->append($image);
    return $figure;
  } else {
    return '';
  }
};
