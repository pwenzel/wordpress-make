<?php

class ApplicationTest extends PHPUnit_Framework_TestCase
{
    
    public function test_home_page_should_have_anchors()
    {
        $html = file_get_html(get_option('siteurl'));
        $this->assertGreaterThanOrEqual(1, count($html->find('a')) );
    }

    public function test_theme_activated() 
    {
    	$theme = wp_get_theme();
    	$this->assertEquals('example', $theme->template, "The Example theme should be active.");
    }

}