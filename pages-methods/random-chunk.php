<?php
/**
 * Creates chunks of random size
 *
 * @param int $min Minimum number of items in chunk
 * @param int $max Maximum number of items in chunk
 * @return object A new collection with an item for each chunk and a subcollection in each chunk
 * Usage:
 * $projects = page('projects')->children()->shuffle();
 * $max = mt_rand(1,$projects->count());
 * $min = mt_rand(1, $max);
 * $chunks = $projects->randomChunk($min,$max);
 */
pages::$methods['randomChunk'] = function($pages, $min, $max) {
$temp = clone $pages;
$chunks = [];
$size=1;
$min = (1 >= $min && $min <= $max) ? $min:1;
$max = $max <= $pages->count()? $max: $pages->count();
while ($temp->count() > 0) {
  $size = mt_rand($min,$max);
  array_push($chunks, array_splice($temp->data,0, $size));
}
$chunkCollections = [];
foreach($chunks as $items) {
  $collection = clone $pages;
  $collection->data = $items;
  $chunkCollections[] = $collection;
}
// convert the array of chunks to a collection object
return new Collection($chunkCollections);
};
