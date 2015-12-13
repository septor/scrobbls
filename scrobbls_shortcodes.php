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
	function sc_scrobbls_username($parm='')
	{
		return e107::pref('scrobbls', 'username');
	}

	function sc_scrobbls_playcount($parm='')
	{
		return $this->var['playcount'];
	}
}
