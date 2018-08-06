<?php
/**
 *	Remote data for Select2 plugin
 *	
 *	Laborator.co
 *	www.laborator.co 
 */

// Data to parse
$data = array(
	array('id' => 1,	'name' => 'John Arnold'),
	array('id' => 2,	'name' => 'Max Aamadani'),
	array('id' => 3,	'name' => 'Nilli Conor'),
	array('id' => 4,	'name' => 'Gaoll Maxhuni'),
	array('id' => 5,	'name' => 'Gent Uka'),
	array('id' => 6,	'name' => 'Nirjan Halili'),
	array('id' => 7,	'name' => 'Jason Bourne'),
	array('id' => 8,	'name' => 'Sean Paul'),
	array('id' => 9,	'name' => 'John Doe'),
);

$q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';

// Searching
if(trim($q))
{
	$data = array_filter($data, 'filter_by_name');
}

$data = array_values($data);

function filter_by_name($el)
{
	global $q;
	
	return stristr($el['name'], $q) ? true : false;
}


echo json_encode($data);