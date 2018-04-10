<?php

/* converts a field value to slug
 * Usage example:
 * <h1 id="<?= $page->title()->toSlug() ?>"><?= $page->title() ?></h1>
 */
field::$methods['toSlug'] = function($field) {
  return str::slug(str::unhtml($field->value()));
};
