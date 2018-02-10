<?php

// quick way to loop through images and create a figure tag for each, usage: $files->each('test');
// mainly for testing purposes, otherwise better use a snippet instead of hiding away presentation in code
files::$methods['each'] = function($files, $class=null, $alt=null, $caption=null) {
  $html = '';
  foreach($files as $file) {
    $html .= kirbytag([
      'image' => $file->url(),
      'class' => $class,
      'alt' => !is_null($alt)? $file->{$alt}()->value(): null,
      'caption' => !is_null($caption)? $file->{$caption}()->value(): null,
    ]);
  }
  return $html;
};
