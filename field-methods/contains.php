<?php

/* Checks if a list of values in a field (tags, checkboxes) contains a given value
 * Usage example:
 * <?php
 * if($page->tags()->contains('green')) {
 *     //do stuff
 * }
 * ?>
*/
field::$methods['contains'] = function($field, $needle, $separator = ',') {
    return in_array($needle, $field->split($separator));
};
