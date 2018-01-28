<?php

// quick way to loop through a pages collection; usage: echo $pages->each('<p>Title: {title}</p>');
pages::$methods['each'] = function($pages, $string) {
  preg_match_all('/\{(.+?)\}/', $string, $matches);
  if(isset($matches[1])) {
    $matches = array_flip($matches[1]);
    $html = '';
    foreach($pages as $p) {
      $allowed = array_keys($p->content()->toArray());
      array_walk($matches, function (&$value, $key) use ($p, $allowed) {
        if(in_array($key, $allowed)){
          return $value = $p->{$key}()->value();
        }
      }, $p);
      $html .=  str::template($string, $matches);
    }
    return $html;
  }
};
