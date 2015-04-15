<?php

require 'config/default.php';
require 'class/view.php';

class app {
    public $view;
    public function __construct($config) {
        if ($config->vars->site['debug']) {
            $config->vars->placeholders['%framework_log%'] .= "The class \"".__CLASS__."\" was successfully initiated!<br />\r\n";
            $this->view = new view($config);
        } else {
            $this->view = new view($config);
        }
    }
    
    public function render($template) {
        $this->view->render($template);
    }
}

// easier "interface" for oop with ease (objects can be created also by the longer way -> look at class above)
class helper {
    public $config, $app;
    public function __construct($debug, $trackTime) {
        
        // constructor: config($debug, $trackTime) type = {boolean, boolean} returns: void
        $this->config = new config($debug, $trackTime);
        
        // constructor: app($config) type = {object} returns: void
        $this->app = new app($this->config);
    }
    public function render($pagename) {
        $this->app->render($pagename);
    }
}