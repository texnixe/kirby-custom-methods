<?php

page::$methods['rootParent'] = function($page) {
  if($page->depth() == 1 && !$page->isHomePage()) {
    return $page;
  }
  return $page->parents()->last();
};
