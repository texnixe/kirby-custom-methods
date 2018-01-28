<?php

// get next page of a given children collection (e.g. filtered collection)
page::$methods['getNext'] = function($page, Children $siblings, $sort = array(), $visibility = false) {
  if($sort) $siblings = call(array($siblings, 'sortBy'), $sort);
  $index = $siblings->indexOf($page);
  if($index === false) return null;
  if($visibility) {
    $siblings = $siblings->offset($index+1);
    $siblings = $siblings->{$visibility}();
    return $siblings->first();
  } else {
    return $siblings->nth($index + 1);
  }
};
