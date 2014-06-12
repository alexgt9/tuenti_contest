<?php

require 'one.php';

/**
* StudentMatcher
*/
class StudentMatcherTest extends PHPUnit_FrameWork_TestCase
{
	public function testMatch()
	{
		$student_list = array(
			'M26Plant Science3' => array (
		    	'David Perez Richardson',
		    ),
		    'F18Architectural Engineering4' => array (
		     	'Evie Scott Hill',
		    ),
		    'M21Agriculture2' => array (
		      'Bradley Ward Lopez',
		    ),
		);

		$obj = new StudentMatcher( $student_list );

		$expected = array (
		    	'David Perez Richardson',
		);

		$this->assertEquals( $expected, $obj->getMatches( 'M', '26', 'Plant Science', '3' ) );
	}
}