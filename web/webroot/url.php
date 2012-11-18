<?php
require dirname(__DIR__) . '/app/bootstrap.php';

$m = new Mongo();
$db = $m->xhprof;
$collection = $db->results;

$res = $collection->find(array('meta.url' => '/'));


$template = load_template('runs/list.twig');
echo $template->render(array(
    'runs' => $res
));