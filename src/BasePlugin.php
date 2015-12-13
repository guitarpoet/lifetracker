<?php namespace Life\Tracker; defined('ABSPATH') or die;

use Symfony\Component\Yaml\Yaml;
use Life\Tracker\Utils\SafeAccessor;
/**
 * The base class for all the plugins.
 *
 * @author Jack
 * @date Sun Dec 13 19:04:20 2015
 */
class BasePlugin {

	/**
	 * Add the handler for wordpress state
	 *
	 * @version 1.0
	 */
	public function addHandler($state, $action = null) {
		if(is_string($state)) {
			add_action($state, array($this, $action));
		}
		else if(is_array($state)){
			foreach($state as $k => $v) {
				$this->addHandler($k, $v);
			}
		}
	}

	public function defaults($name = 'plugin') {
		if(!isset($this->_defaults)) {
			$this->_defaults = new SafeAccessor();
		}

		if(!isset($this->_defaults[$name])) {
			$file = WP_PLUGIN_DIR."/lifetracker/defaults/$name.yml";
			if(file_exists($file)) {
				$this->_defaults[$name] = new SafeAccessor(Yaml::parse(file_get_contents($file)));
			}
		}

		return $this->_defaults[$name];
	}
}
