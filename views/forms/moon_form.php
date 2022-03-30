<?php


require_once ("../../classes/Template.php");
require_once ("../../includes/database.php");
require_once ("../../repositories/MoonRepository.php");
$args = array();

$template = new Template('Moon_form.html');
$sunRepo = new MoonRepository($conn);
$data = $sunRepo->findExistingMoon();

if($data) {
    $args = array(
        'stolen_true' => $data['stolen'] == 1 ? 'checked' : '',
        'stolen_false' => $data['stolen'] == 0 ? 'checked' : '',
        'saved_true' => $data['saved'] == 1 ? 'checked' : '',
        'saved_false' => $data['saved'] == 0 ? 'checked' : ''
    );
} else {
    $args = array (
        'stolen_true' => 'checked',
        'saved_true' => 'checked'
    );
}

//var_dump($args);



$template->set($args);
$template->renderHTML();

