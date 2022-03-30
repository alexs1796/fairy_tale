<?php

require_once ("../../classes/Template.php");
require_once ("../../classes/Hero.php");
require_once("../../repositories/HeroRepository.php");
require_once ("../../includes/database.php");


$args = array();
$template = new Template('hero_form.html');
$hero = Hero::getInstance();
$heroRepo = new HeroRepository($conn);
$data = $heroRepo->findExistingHero();

if($data) {
    $args = array(
        'name' => !empty($data['name']) ? $data['name'] : '',
        'weapon' => !empty($data['weapon']) ? $data['weapon'] : '',
        'gender_male' => !empty($data['gender']) && $data['gender'] == 'male' ? 'checked' : '',
        'gender_female' => !empty($data['gender']) && $data['gender'] == 'female' ? 'checked' : '',
        'action_fight' => !empty($data['action']) && $data['action'] == 'fight' ? 'checked' : '',
        'action_run' => !empty($data['action']) && $data['action'] == 'run' ? 'checked' : '',
    );
} else {
    $args = array(
        'name' => '',
        'weapon' => '',
        'gender_male' => 'checked', //default value checked
        'gender_female' => '',
        'action_fight' => 'checked',
        'action_run' => ''
    );
}


$template->set($args);
$template->renderHTML();


