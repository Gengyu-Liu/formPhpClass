<?php

require 'classes/Formular.php';

$formular = new Formular();
$formstart = $formular->formstart();
$formular->setAttributes($formstart, ['action'=>'index.php','method'=>'post',]);

$username = $formular->text();
$formular->setAttributes($username, ['placeholder'=>'username','maxlength'=>'20',]);

$password = $formular->password();
$formular->setAttributes($password, ['placeholder'=>'password','maxlength'=>'8',]);

$radio1 = $formular->radio('Apfel');
$formular->setAttribute($radio1, 'name', 'Obst');
$radio2 = $formular->radio('Orange');
$formular->setAttribute($radio2, 'name', 'Obst');
$radio3 = $formular->radio('Kirsche');
$formular->setAttribute($radio3, 'name', 'Obst');
$radio4 = $formular->radio('Erdbeere');
$formular->setAttributes($radio4, ['name'=>'Obst', 'checked'=>'']);

$radio=$radio1.$radio2.$radio3.$radio4;

$checkbox = $formular->checkbox('Ich habe die AGB gelesen und zur Kenntnis genommen');
$formular->setAttribute($checkbox, 'name', 'agb');

$select = $formular->select(['rot','orange','blau'],'orange');
$formular->setAttribute($select, 'name','farbe');

$select1 = $formular->select(['red'=>'rot','black'=>'schwarz','blue'=>'blau'],'blau');
$formular->setAttribute($select1, 'name','farbe1');

$textarea = $formular->textarea('Please write your message here');
$formular->setAttributes($textarea, ['rows'=>'10','cols'=>'100']);

$submit = $formular->submit('login');

$formende = $formular->formende();

$elements = [$formstart,$username,$password,$radio,$checkbox,$select,$select1,$textarea,$submit,$formende];
$formular->display($elements);