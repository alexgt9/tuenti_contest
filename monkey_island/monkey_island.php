<?php

/**
* 
*/
class Gamblers
{
	public function getPassword( $x, $y )
	{
		return round( sqrt( $x * $x + $y * $y  ), 2 );
	}
}

function run()
{
	$gambler = new Gamblers;

	fscanf(STDIN, "%d\n", $cases );

	$i = 0;
	while ( $i++ < $cases ) 
	{
		fscanf(STDIN, "%d %d\n", $x, $y );

		echo $gambler->getPassword( $x, $y ) . PHP_EOL;
	}
}

run();