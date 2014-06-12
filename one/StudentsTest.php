<?php

require 'one.php';

/**
* Students test
*/
class StudentsTest extends PHPUnit_FrameWork_TestCase
{
	public function testParser()
	{
		$obj = new Students( 'students' );

		$expected = array(
			'Sophia Wright Torres',
			'Libby Morales Reyes',
		);

		var_export( $obj );

		$this->assertEquals( $expected, $obj['F23Radiologic Technology1'] );
	}
}