<?php

file::$methods['permanentURL'] = function($file) {
  $site = $file->site();
  $lang = $site->multilang() ? $site->language()->code() . '/' : '';
  return $site->url() . '/' . $lang . $file->page()->id() . '/' . $file->filename();
};
