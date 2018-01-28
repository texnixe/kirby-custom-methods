<?php

// get max nesting level of page tree
page::$methods['maxDepth'] = function($page) {
  foreach($page->index() as $p) {
    $depth[] = $p->depth();
  }
  return max($depth);
};
