<?php
/*
* tries to get the content of the given field if it exists;
* moves the page tree up until it finds a parent page where the field exists
*/
page::$methods['getContent'] = function($page, $field) {
  if($page->$field()->exists() && $page->$field()->isNotEmpty()) {
    return $page->$field()->kt();
  } else {
    foreach($page->parents() as $page) {
      if($page->$field()->isNotEmpty()) {
        return $page->$field()->kt();
        exit;
      }
    }
  }
};
