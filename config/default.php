<?php
/** default config file
 *  mvc3 - A new Framework
 */

require 'variables.php';

class config {
    public $vars, $loadermsg, $placeholders;

    public function __construct($debug, $trackTime) {
        $this->vars = new vars();      
        $this->vars->site['debug'] = $debug;
        $this->vars->site['trackTime'] = $trackTime;
        if ($debug){
            $this->vars->placeholders['{%framework_log%}'] .= "Config loaded.<br />\r\n";
        }               
    }
}