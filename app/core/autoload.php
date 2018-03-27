<?php


function ApplicationStart($class)
{
	require_once '/'.$class.'.php';
}

spl_autoload_register('ApplicationStart');


?>