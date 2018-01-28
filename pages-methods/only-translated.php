<?php

pages::$methods['onlyTranslated'] = function($pages) {
  return $pages->filter(function($page) {
    return $page->content(site()->language()->code())->exists();
  });
};
