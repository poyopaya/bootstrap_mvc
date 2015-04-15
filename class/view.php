<?php
    class view {
        public $config;
        
        private $header, $body, $footer;
        
        public function render($file){
            $this->header = $this->template('header');            
            
            if(!(file_exists($this->config->vars->site['viewFolder'].$file.'.snip'))) {
                
                $this->body = $this->template('error');
            } else {
                $this->body = $this->template($file);
            }
            
            if ($this->config->vars->site['debug']){
                $this->body = $this->template('debug');
            }
            
            $this->footer = $this->template('footer');
            
            $this->stopTimer();
            
            if ($this->config->vars->site['trackTime']){
                $this->config->vars->placeholders['{%framework_log%}'] .= "This Site was rendered in ~".number_format($this->config->vars->placeholders['{%execTime%}']/100000/1000, 3, '.', '')." <a href=\"javascript:Fade('#aboutTime',150);\">Milliseconds*</a>.</pre>";
            }
            $finalTemp = $this->header.$this->body.$this->footer;
            
            
            // Replaces "magic words" (those which are surrounded by percent-signs to their equal replacements
            $finalTemp = str_replace(array_keys($this->config->vars->placeholders), array_values($this->config->vars->placeholders), $finalTemp);
            
            // print out page
            echo $finalTemp;
            
        }
        public function __construct($config) {
            $this->config = $config;
            if ($this->config->vars->site['debug']) {
                $this->config->vars->placeholders['{%framework_log%}'] = "The class \"".__CLASS__."\" was success initiated!<br />\r\n";
            }
        }
        private function stopTimer(){
            $this->config->vars->placeholders['{%execTime%}'] = (microtime(true) - $this->config->vars->placeholders['{%execTime%}']);
        }

        public function template($template) {
            ob_start();
            require $this->config->vars->site['viewFolder'].$template.'.snip';
            $r = ob_get_clean();
            ob_end_clean();
            return $r;
            
        }
    }