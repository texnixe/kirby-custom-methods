<?php

page::$methods['canonicalURL'] = function($page) {
  return $page->url() . r(params(), '/') . kirby()->request()->params();
};
