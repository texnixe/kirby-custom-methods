<?php

/**
* Filters a pages collection by values within in structure field
* See forum request: https://forum.getkirby.com/t/new-kirby-related-pages-plugin/6014/4?u=texnixe
* @param string $field Name of the structure field
* @param array $options Options array with key/value pairs of structure field subfields/value
* Usage:
* $filteredPages = page('projects')
*                  ->children()
*                  ->filterByStructure('nameOfStructureField', ['occupation' => 'Webdesign', 'department' => 'Design']));
* foreach($filteredPages as $p) {
*  echo $p->title();
* }
**/

pages::$methods['filterByStructure'] = function($pages, $field, $options) {
  $filteredPages = $pages->filter(function($p) use($field, $options) {
    $structureField =  $p->{$field}()->yaml();
    foreach($structureField as $item) {
      if(!array_diff($options, $item)) return $p;
    }
  });
  return $filteredPages;
};
