<?php
/*
 * Scrobbls - A Last.fm Display plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
require_once('../../class2.php');
if (!getperms('P'))
{
	header('location:'.e_BASE.'index.php');
	exit;
}

class scrobbls_adminArea extends e_admin_dispatcher
{
	protected $modes = array(
		'main'	=> array(
			'controller' 	=> 'scrobbls_ui',
			'path' 			=> null,
			'ui' 			=> 'scrobbls_form_ui',
			'uipath' 		=> null
		),
	);

	protected $adminMenu = array(
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),
		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'
	);

	protected $menuTitle = 'scrobbls';
}

class scrobbls_ui extends e_admin_ui
{
	protected $pluginTitle		= 'Scrobbls';
	protected $pluginName		= 'scrobbls';
	protected $table			= '';
	protected $pid				= '';
	protected $perPage			= 10;
	protected $batchDelete		= true;
	protected $listOrder		= ' DESC';
	protected $fields 		= NULL;
	protected $fieldpref = array();

	protected $prefs = array(
		'apiKey' => array(
			'title' => 'API Key',
			'type' => 'text',
			'data' => 'str',
			'help' => ''
		),
		'displayLimit' => array(
			'title' => 'Default Limit Amount',
			'type' => 'number',
			'data' => 'str',
			'help' => ''
		),
	);

	public function init()
	{
	}

	public function beforeCreate($new_data)
	{
		return $new_data;
	}

	public function afterCreate($new_data, $old_data, $id)
	{
	}

	public function onCreateError($new_data, $old_data)
	{
	}

	public function beforeUpdate($new_data, $old_data, $id)
	{
		return $new_data;
	}

	public function afterUpdate($new_data, $old_data, $id)
	{
	}

	public function onUpdateError($new_data, $old_data, $id)
	{
	}

	/*
		// optional - a custom page.
		public function customPage()
		{
			$text = 'Hello World!';
			return $text;

		}
	 */
}

class scrobbls_form_ui extends e_admin_form_ui
{
}

new scrobbls_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;
