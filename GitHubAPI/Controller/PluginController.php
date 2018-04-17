<?php

require 'ApiController.php';
require 'WidgetController.php';

class PluginController {

    public function __construct() {
        add_action('widgets_init', function() {
            register_widget('WidgetController');
        });
    }

}
