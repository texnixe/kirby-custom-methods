<?php

//method to create a custom url
page::$methods['customUrl'] = function($page) {
    return site()->url() . '/something/' . $page->uid();
};
