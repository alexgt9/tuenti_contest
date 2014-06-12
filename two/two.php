<?php

/**
* Race Drawer
*/
class RaceDrawer
{
	private $directions = array(
		'r' => array(
			'x' => 1,
			'y' => 0, 
		),
		'd' => array(
			'x' => 0,
			'y' => 1, 
		),
		'l' => array(
			'x' => -1,
			'y' => 0, 
		),
		'u' => array(
			'x' => 0,
			'y' => -1, 
		),
	);

	private $new_direction = array(
		'/' => array(
			'r' => 'u',
			'd' => 'l',
			'l' => 'd',
			'u' => 'r',
		),
		'\\' => array(
			'r' => 'd',
			'd' => 'r',
			'l' => 'u',
			'u' => 'l',
		),
	);

	private $parts_to_draw = array(
		'-' => array(
			'u' => '|',
			'd' => '|',
		),
	);

	public function drawCircuit( $race_text )
	{
		$parts = str_split( $race_text );
		$result = array();

		$x = 0;
		$y = 0;
		$min_x = 0;
		$direction = 'r';

		foreach ( $parts as $part ) 
		{
			$result[$y][$x] = $this->getPartToDraw( $part, $direction );

			$direction = $this->getNewDirection( $direction, $part );
			$x += $this->directions[$direction]['x'];
			$y += $this->directions[$direction]['y'];
			$min_x = min( $min_x, $x );
		}

		array_walk( $result, function( &$value, $key ){ ksort( $value, SORT_NUMERIC ); } );
		ksort( $result );

		return $this->draw( $result, $min_x );
	}

	private function getPartToDraw( $part, $direction )
	{
		if ( isset( $this->parts_to_draw[$part][$direction] ) ) 
		{
			return $this->parts_to_draw[$part][$direction];
		}

		return $part;
	}

	private function getNewDirection( $actual_direction, $part )
	{
		if ( isset( $this->new_direction[$part][$actual_direction] ) )  
		{
			return $this->new_direction[$part][$actual_direction];
		}

		return $actual_direction;
	}

	private function draw( $race_array, $min_horizontal )
	{
		$x = 0;
		$y = 0;
		$last = null;

		$result = '';

		foreach ( $race_array as $vertical_index => $line ) 
		{
			foreach ($line as $horizontal_index => $piece ) 
			{
				if ( is_null( $last ) ) 
				{
					$result .= str_repeat( ' ', $horizontal_index - $min_horizontal );
				}

				if ( !is_null( $last ) && ( ($last + 1) < $horizontal_index ) )
				{
					$result .= str_repeat( ' ', $horizontal_index - $last - 1 );
				}
				$last = $horizontal_index;
				$result .= $piece;
			}
			$last = null;
			$result .= "\n";
		}

		return $result;
	}
}

$race_text = trim(fgets(STDIN) );

$race_driver = new RaceDrawer();

echo $race_driver->drawCircuit( $race_text );