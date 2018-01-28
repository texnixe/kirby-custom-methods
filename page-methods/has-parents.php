<?php

page::$methods['hasParents'] = function($page) {
  return $page->parents()->count();
};
