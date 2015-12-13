<?php namespace Life\Tracker\Utils; defined('ABSPATH') or die;

use Symfony\Component\Yaml\Yaml;

/**
 * The base class for all the test cases.
 *
 * @author Jack
 * @date Sun Dec 13 20:14:49 2015
 * @version 1.0
 */
class TestCase extends \PHPUnit_Framework_TestCase {
    public function setUp() {
        $mute = (getenv('MUTE_PHPUNIT'));
        $ref = new \ReflectionClass($this);
        $func = $this->getName();
        if(!$mute && $func != 'testStub')
            echo "\n----------".$ref->name." | ".$func."----------\n";

		$this->doSetUp();
    }

	public function data($name) {
		$file = TEST_PATH."/data/$name.yml";
		if(file_exists($file)) {
			return Yaml::parse(file_get_contents($file));
		}
		return array();
	}

	protected function doSetUp() {
	}

	protected function doTearDown() {
	}

	public function tearDown() {
		$this->doTearDown();
        $ref = new \ReflectionClass($this);
        $func = $this->getName();
        $mute = (getenv('MUTE_PHPUNIT'));
        if(!$mute && $func != 'testStub')
            echo "\n==========".$ref->name." | ".$func."==========\n";
        if (ob_get_length() == 0 ) {
            ob_start();
		}
    }
}

