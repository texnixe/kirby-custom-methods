<?php

// This method finds the first parent page where a given field returns true
page::$methods['getRootPage'] = function($page, $field) {
  if($page->parents()->count()) {

    foreach($page->parents() as $p) {
      if ($p->{$field}()->bool()) {
        return $p;
        exit();
      } else {
        return $page;
      }
    }
  } else {
    return $page;
  }
};
