<?php

require 'monkey_island.php';

/**
* Gamblers Test
*/
class GamblersTest extends PHPUnit_FrameWork_TestCase
{
	private $obj;

	public function setUp()
	{
		$this->obj = new Gamblers;
	}

	public function gamblersResultsProvider()
	{
		return array(
			array(
				'x' => 1,
				'y' => 1,
				'result' => 1.41
			),
			array(
				'x' => 1,
				'y' => 2,
				'result' => 2.24
			),
			array(
				'x' => 2,
				'y' => 2,
				'result' => 2.83
			),
			array(
				'x' => 5,
				'y' => 2,
				'result' => 5.39
			),
			array(
				'x' => 30,
				'y' => 2,
				'result' => 30.07
			),
			array(
				'x' => 30,
				'y' => 30,
				'result' => 42.43
			),
		);
	}

	/**
	 * @dataProvider gamblersResultsProvider
	 */
	public function testGamblers( $x, $y, $expected )
	{
		$this->assertEquals( $expected, $this->obj->getPassword( $x, $y ) );
	}
}