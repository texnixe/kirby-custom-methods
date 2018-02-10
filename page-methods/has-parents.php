<?php

// checks if a page has parents
page::$methods['hasParents'] = function($page) {
  return $page->parents()->count();
};
