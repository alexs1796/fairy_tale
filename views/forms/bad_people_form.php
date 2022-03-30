<?php


require_once ("../../classes/Template.php");
require_once ("../../includes/database.php");
require_once ("../../repositories/BadPeopleRepository.php");

$args = array();

$template = new Template('bad_people_form.html');
$badPeopleRepo = new BadPeopleRepository($conn);
$data = $badPeopleRepo->findBadPeople();


if($data) {
    $args = array(
        'name' => $data['name'],
        'age' => $data['age'],
        'height' => $data['height']
    );
} else {
    $args = array (
        'name' => '',
        'age' => '',
        'height' => ''
    );
}

$template->set($args);
$template->renderHTML();

