<?php

// get prev page of a given children collection (e.g. filtered collection)
page::$methods['getPrev'] = function($page, Children $siblings, $sort = array(), $visibility = false) {
  if($sort) $siblings = call(array($siblings, 'sortBy'), $sort);
  $index = $siblings->indexOf($page);
  if($index === false or $index === 0) return null;
  if($visibility) {
    $siblings = $siblings->limit($index);
    $siblings = $siblings->{$visibility}();
    return $siblings->last();
  } else {
    return $siblings->nth($index - 1);
  }
};
