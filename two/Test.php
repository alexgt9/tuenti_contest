<?php

require 'two.php';

/**
* 
*/
class RaceTest extends PHPUnit_FrameWork_TestCase
{
	public function testSimpleRace()
	{
		$race_text = '#----\-----/-----\-----/';

		$obj = new RaceDrawer;

		$expected = <<<RACE
/#----\
|     |
|     |
|     |
|     |
|     |
\-----/
RACE;
		
		$this->assertEquals( $expected, $obj->drawCircuit( $race_text ) );
	}
}