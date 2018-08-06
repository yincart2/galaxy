<?php
/**
 *	Example for custom autosuggestion templating
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


	$oscar_movies = array(
		array('value' => 'The Lord of the Rings: The Return of the King', 	'year' => 2001, 		'cover' => 'movies/1.jpg',		'desc' => 'The Lord of the Rings: The Return of the King" presents the final confrontation between the forces of good and evil fighting for control of the future of Middle-earth'),
		array('value' => '12 Years of Slave', 	'year' => 2002, 		'cover' => 'movies/2.jpg',		'desc' => 'In the years before the Civil War, Solomon Northup (Chiwetel Ejiofor), a free black man from upstate New York, is kidnapped and sold into slavery in the South'),
		array('value' => 'A Beautiful Mind', 	'year' => 2004,			'cover' => 'movies/3.jpg',		'desc' => 'From the heights of notoriety to the depths of depravity, John Forbes Nash Jr. experienced it all. A mathematical genius, he made an astonishing discovery'),
		array('value' => 'Titanic', 		'year' => 2005, 		'cover' => 'movies/4.jpg',		'desc' => 'Titanic - the pride and joy of the White Star Line and, at the time, the largest moving object ever built. She was the most luxurious liner of her era -- the \'ship of dreams\''),
		array('value' => 'The Silence of the Lambs', 	'year' => 2007, 		'cover' => 'movies/5.jpg',		'desc' => ''),
		array('value' => 'Gladiator', 		'year' => 2009, 		'cover' => 'movies/6.jpg',		'desc' => 'Commodus (Joaquin Phoenix) takes power and strips rank from Maximus (Russell Crowe), one of the favored generals of his predecessor and father, Emperor Marcus Aurelius, the great stoical philosopher. Maximus is then relegated to fighting to the death in the gladiator arenas.'),
		array('value' => 'No Country for Old Men', 		'year' => "2010, 2011", 'cover' => 'movies/7.jpg',		'desc' => 'While out hunting, Llewelyn Moss (Josh Brolin) finds the grisly aftermath of a drug deal. Though he knows better, he cannot resist the cash left behind and takes it with him. The hunter becomes the hunted.'),
	);
	
	shuffle($oscar_movies);
	
	if(isset($_REQUEST['q']) && strlen($_REQUEST['q']) > 6)
		$oscar_movies = array();
	
	echo json_encode($oscar_movies);
	
	
	