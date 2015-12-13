<?php namespace Life\Tracker\Utils; defined('ABSPATH') or die;
/**
 * This is the safe accessor for wrapping array or object
 *
 * @author Jack
 * @version 1.0
 */
class SafeAccessor implements \ArrayAccess {

	private $_wrap;

	public function __construct($wrap = array()) {
		$this->_wrap = $wrap;
	}

	public function get($name, $default = null) {
		if(isset($this->_wrap) && is_object($this->_wrap)) {
			if(!$this->$name) {
				return $default;
			}
			return $this->$name;
		}
		else {
			if(is_array($this->_wrap) && isset($this->_wrap[$name])) {
				return $this->_wrap[$name];
			}
		}
		return $default;
	}

	public function offsetExists($offset) {
		if(isset($this->_wrap) && is_array($this->_wrap)) {
			return isset($this->_wrap[$offset]);
		}
		return false;
	}

	public function offsetGet($offset) {
		if(isset($this->_wrap) && is_array($this->_wrap)
			&& isset($this->_wrap[$offset])) {
			return $this->_wrap[$offset];
		}
		return null;
	}
	public function offsetSet($offset, $value) {
		if(isset($this->_wrap) && is_array($this->_wrap)) {
			return $this->_wrap[$offset] = $value;
		}
	}

	public function offsetUnset($offset) {
		if(isset($this->_wrap) && is_array($this->_wrap)
			&& isset($this->_wrap[$offset])) {
			unset($this->_wrap[$offset]);
		}
	}

	public function __get($name) {
		if(isset($this->_wrap) && isset($this->_wrap->$name))
			return $this->_wrap->$name;
		return null;
	}

	public function __set($name, $value) {
		if(isset($this->_wrap))
			$this->_wrap->$name = $value;
	}
}
