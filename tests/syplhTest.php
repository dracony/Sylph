<?php
require_once(dirname(__DIR__).'/classes/PHPixie/sylph.php');
class Sylph_Test extends PHPUnit_Framework_TestCase {

	protected function setUp() {
		$this->sylph = new \PHPixie\Sylph();
	}
	
	public function test_cast() {
		$flowers = 7;
		$fairy = $this->sylph->cast(array(
			'name' => 'Tinkerbell',
			'likes' => array(
				'flying'  => true,
				'dancing' => true
			),
			'pick_flowers' => function($picked) use($flowers){
				return $picked + $flowers;
			},
			'friend' => $this->sylph->cast(array(
				'name' => 'Trixie'
			))
		));
		
		$this->assertEquals('Tinkerbell', $fairy->name);
		$this->assertEquals(true, $fairy->likes['flying']);
		$this->assertEquals(true, $fairy->likes['dancing']);
		$this->assertEquals(10, $fairy->pick_flowers(3));
		$this->assertEquals('Trixie', $fairy->friend->name);
	}
}