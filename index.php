<?php
declare(strict_types=1);
session_start();


function __autoload(string $classname) : void
{
	require_once('class/' . $classname . '.php');
}

$controller = new Controller();
$controller->run();
