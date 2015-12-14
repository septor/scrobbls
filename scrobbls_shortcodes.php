<?php
/*
 * Scrobbls - A Last.fm Display plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
class scrobbls_shortcodes extends e_shortcode
{
	function sc_scrobbls_user_name($parm='')
	{
		return e107::pref('scrobbls', 'username');
	}

	function sc_scrobbls_user_url($parm='')
	{
		return $this->var['url'];
	}

	function sc_scrobbls_user_avatar($parm='')
	{
		return $this->var['image'];
	}

	function sc_scrobbls_user_country($parm='')
	{
		return $this->var['country'];
	}

	function sc_scrobbls_user_age($parm='')
	{
		$this->var['age'];
	}

	function sc_scrobbls_user_gender($parm='')
	{
		$this->var['gender'];
	}

	function sc_scrobbls_user_registered($parm)
	{
		return e107::getRender()->toDate($this->var['registered'], 'relative');
	}

	function sc_scrobbls_user_playcount($parm='')
	{
		return $this->var['playcount'];
	}
}
