<?php namespace Life\Tracker; defined('ABSPATH') or die;

/**
 * The main entry point for the life tracker plugin
 *
 * @author Jack
 * @date Sun Dec 13 18:49:39 2015
 */
class Plugin extends BasePlugin {

	private static $_instance;

	private function __construct() {
		$this->addHandler(array(
			'init' => 'init',
			'admin_notices' => 'hello'
		));
	}

	public static function instance() {
		if(!Plugin::$_instance) {
			Plugin::$_instance = new Plugin();
		}
		return Plugin::$_instance;
	}

	public function init() {
		// Register the post type
		$defaults = $this->defaults();
		$config = $defaults->get('post_type_config', array());
		$labels = array();
		foreach($defaults->get('post_type_admin_labels', array()) as $k => $v) {
			$labels [$k] = call_user_func_array('_x', $v);
		}

		foreach($defaults->get('post_type_labels', array()) as $k => $v) {
			$labels [$k] = call_user_func_array('__', $v);
		}

		$config['description'] = call_user_func_array('__', $defaults->get('post_type_description'));
		$config['labels'] = $labels;
		register_post_type($defaults['post_type'], $config);
		register_taxonomy('record_tag', 'track_record',
			array( 
				'hierarchical' => false,
				'query_var' => 'tag',
				'rewrite' => array(
					'hierarchical' => false,
					'slug' => get_option('tag_base') ? get_option('tag_base') : 'tag',
					'ep_mask' => EP_TAGS
				),
				'public' => true,
				'show_ui' => true,
				'show_admin_column' => true,
				'_builtin' => true,
			)
		);
	}

	public function hello() {
	}

	public function destroy() {
	}
}
