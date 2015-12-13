<?php in_array(__FILE__, get_included_files()) or die;

use Life\Tracker\Utils\TestCase;
use Life\Tracker\Utils\SafeAccessor;

class SafeAccessorTest extends TestCase {

	protected function doSetUp() {
		$this->sample = $this->data('sample');
		$this->arr = $this->sample['arr'];
		$this->map = $this->sample['map'];
	}

	public function testArray() {
		$arr = new SafeAccessor($this->arr);
		// Use as normal array
		$this->assertEquals($arr[0], 1);
		$this->assertEquals($arr[2], 3);

		// Won't cause php notice even the key is not exists
		$this->assertEquals($arr[10], null);

		// Can use get method to support hte default value
		$this->assertEquals($arr->get(10, 5), 5);

		$map = new SafeAccessor($this->map);

		// Use as normal array
		$this->assertEquals($map['key'], 'value');
		$this->assertEquals($map['key1'], 'value1');

		// Won't cause php notice even the key is not exists
		$this->assertEquals($arr['key10'], null);

		// Can use get method to support hte default value
		$this->assertEquals($arr->get('key10', 5), 5);
	}

	public function testObject() {
		$map = new SafeAccessor((object) $this->map);

		// Use as normal object
		$this->assertEquals($map->key, 'value');
		$this->assertEquals($map->key1, 'value1');

		// Won't cause php notice even the key is not exists
		$this->assertEquals($map->key10, null);

		// Can use get method to support hte default value
		$this->assertEquals($map->get('key10', 5), 5);
	}
}
