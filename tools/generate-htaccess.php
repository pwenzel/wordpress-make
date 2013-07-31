<?php
global $wp_rewrite;

$file = ".htaccess";

$rules = "# BEGIN WordPress
$wp_rewrite->mod_rewrite_rules();
# END WordPress";

file_put_contents($file, $rules);