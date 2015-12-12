<?php
/*
 * Scrobbls - A Last.fm Display plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
class scrobblArtist extends Scrobbls
{
	public $artist;

	function __construct($artist, $apiKey)
	{
		$this->artist = $artist;
		parent::setKey($apiKey);
	}

	function getInfo($options='')
	{
		//
	}
}
