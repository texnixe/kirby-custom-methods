<?php

field::$methods['split'] = function($field) {
  $string = $field->value();
  $matches = preg_split('/([:!?.])/', $string, 2, PREG_SPLIT_DELIM_CAPTURE);
  if(isset($matches[2]) && $matches[2] !== '') {
    $title = '<strong>' . $matches[0] . $matches[1] . '</strong>' . $matches[2];
  } else {
    $title = '<strong>' . explode(' ', $string, 2)[0] . '</strong>' . ' ' . explode(' ', $string, 2)[1];
  }
  return  $title;
};
