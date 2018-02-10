<?php

/**
* Method to remove structure items with a date field value in the past
* @param string $field: Name of the structure field
* @param string $datefield: Name of the date field within structure field
* Example usage:
* $page->cleanupStructure('events', 'date');
*/

page::$methods['cleanStructure'] = function($page, $field, $datefield) {
  if(in_array($field, $page->content()->fields())) {
    $data = $page->{$field}()->yaml();
    $callback = function($value) use($datefield){
      return isset($value[$datefield])? $value[$datefield] >= date('Y-m-d'): $value;
    };
    $result = array_filter($data, $callback);
    $result = yaml::encode($result);
    try {
        $page->update([$field => $result]);
        return true;
      } catch(Exception $e) {
        return $e->getMessage();
      }
  }
};
