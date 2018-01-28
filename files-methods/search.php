<?php
/**
* @param string $query The query string
* @param mixed $params Options for the search
* search in files
* only works with Files object, i.e. $page->files(), not $page->children()->files() etc.
*/
files::$methods['search'] = function($files, $query, $params = array()) {
  if(is_string($params)) {
    $params = array('fields' => str::split($params, '|'));
  }
  $defaults = array(
    'minlength' => 2,
    'fields'    => array(),
    'words'     => false,
    'score'     => array()
  );
  $options     = array_merge($defaults, $params);
  $collection  = clone $files;
  $searchwords = preg_replace('/(\s)/u',',', $query);
  $searchwords = str::split($searchwords, ',', $options['minlength']);
  if(!empty($options['stopwords'])) {
    $searchwords = array_diff($searchwords, $options['stopwords']);
  }
  if(empty($searchwords)) return $collection->limit(0);
  $searchwords = array_map(function($value) use($options) {
    return $options['words'] ? '\b' . preg_quote($value) . '\b' : preg_quote($value);
  }, $searchwords);
  $preg    = '!(' . implode('|', $searchwords) . ')!i';
  $results = $collection->filter(function($file) use($query, $searchwords, $preg, $options) {
    $data = $file->meta()->toArray();
    $keys = array_keys($data);
    if(!empty($options['fields'])) {
      $keys = array_intersect($keys, $options['fields']);
    }
    $file->searchHits  = 0;
    $file->searchScore = 0;
    foreach($keys as $key) {
      $score = a::get($options['score'], $key, 1);
      // check for a match
      if($matches = preg_match_all($preg, $data[$key], $r)) {
        $file->searchHits  += $matches;
        $file->searchScore += $matches * $score;
        // check for full matches
        if($matches = preg_match_all('!' . preg_quote($query) . '!i', $data[$key], $r)) {
          $file->searchScore += $matches * $score;
        }
      }
    }
    return $file->searchHits > 0 ? true : false;
  });
  $results = $results->sortBy('searchScore', SORT_DESC);
  return $results;
};
