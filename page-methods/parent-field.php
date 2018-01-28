<?php

// return content from the last parent
page::$methods['parentField'] = function($page, $field) {
  if($page->parents()->count()) {
    return $page->parents()->last()->{$field}();
  } else {
    return $page->{$field}();
  }
};
