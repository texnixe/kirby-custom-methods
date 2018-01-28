<?php

/* Usage:
* foreach($page->filteredChildren(['modules', 'container']) as $child) {
*  echo $child->title();
* }
*/
page::$methods['filteredChildren'] = function($page, $excludedTemplates = []) {
  return $page->children()->filterBy('intendedTemplate', 'not in', $excludedTemplates);
};
