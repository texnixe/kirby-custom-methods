<?php

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
