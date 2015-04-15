<?php
require 'index.class.php';

//creates a new Object by using the easier class which instatiates the original application / framework class(-es)
// constructor: helper($debug, $trackTime) type = {boolean, boolean} defaults = {false,false} returns: void
// params: $1: Debug ; $2 track execution time
$app = new helper(true,true);
if ($app->config->vars->site['trackTime']) {
    $app->config->vars->placeholders['%execTime%'] = microtime(true);
}
/* render a new webpage by name => this uses the filename und searches for it under "/views/$filename$.snip" 
 * $app->render("index");
 * 
 * if the given filename doesnt exist or can't be found, the view tries to render the file "/views/error.snip"
 */
$page = $_GET['page'];
if (!empty($page)) {
        $render = $app->render($page);
} else  $render = $app->render('index');