<?php

/**
* @param string $field Name of the structure field
* Usage:
* $authors = page('projects')->children()->createNewStructure('authors');
*/
pages::$methods['createNewStructure'] = function($pages, $field) {
  $structure = new Structure();
  $key = 0;
  foreach($pages as $p) {
      foreach($p->$field()->toStructure() as $item) {
          $structure->append($key, $item);
          $key++;
      }
  }
  return $structure;
};
