<?php

/**
* Groups pages by a date period with a custom sort order
* Usage:
* <?php
* $groups = page('blog')->children()->groupByDatePeriod();
* foreach($groups as $key => $items):?>
*  <h1><?=  $key ?></h1>
*  <ul>
*    <?php foreach($items as $item): ?>
*      <li><?= $item->title() . '--' . $item->date('Y-m-d') ?></li>
*    <?php endforeach ?>
*  </ul>
*<?php endforeach ?>
*/
pages::$methods['groupByDatePeriod'] = function($pages) {
  return $pages
    ->map(function($p) {
        if($p->date() > time()) { $p->order = 1; $p->group = 'future';}
        else if($p->date('Y-m-d') == date('Y-m-d')) {$p->order = 2; $p->group = 'today';}
        else if($p->date() >= strtotime('-7 day'))   {$p->order = 3; $p->group = 'this week';}
        else if($p->date() >= strtotime('-1 month')) {$p->order = 4; $p->group = 'this month';}
        else {$p->order = 5; $p->group = 'older';}
        return $p;
      })
    ->sortBy('order')
    ->group(function($p){
        return $p->group();
      });
};
