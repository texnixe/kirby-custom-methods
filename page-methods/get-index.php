<?php

// get index of page in collection
page::$methods['getIndex'] = function($page, $collection) {
  $index  = $collection->indexOf($page);
  return $index;
};
