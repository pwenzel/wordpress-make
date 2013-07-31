<?php

global $wp_rewrite;

$file = ".htaccess";
$rules = $wp_rewrite->mod_rewrite_rules();

$output = "# BEGIN WordPress
".$rules."
# END WordPress

";

file_put_contents($file, $output);