<?php

// Get the first image of a manually sorted image collection if available,
// otherwise return first image
page::$methods['getFirstImage'] = function($page) {
  if($page->hasImages()) {
   if($page->images()->sortBy('sort', 'asc')) {
     $image = $page->images()->sortBy('sort', 'asc')->first()->url();
   } else {
     $image = $page->images()->first()->url();
   }
}
 return $image;
};
