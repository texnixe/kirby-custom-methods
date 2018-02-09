<?php

/**
* Alternative to $page->increment() with language option
* @param string $field: Name of the increment field
* @param int $step: Increment number by given value
* @param int $max: If given, increment will stop when max number is reached
* @param string $lang: In a multilang environment, pass a language code if only one language should be updated
* @return Page
*
*/
page::$methods['plusOne'] = function($page, $field, $by = 1, $max = null, $lang = null) {
  $page->update([
    $field => function($value) use($by, $max) {
      $new = (int)$value + $by;
      return ($max and $new >= $max) ? $max : $new;
    }
  ], $lang);
  return $page;
};
