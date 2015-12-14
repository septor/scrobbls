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
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('artist.getInfo&artist='.$this->artist);
		$artist = $data->artist;

		$output = array(
			'name' => $artist->name,
			'mbid' => $artist->mbid,
			'url' => $artist->url,
			'image' => array(
				'small' => $artist->image['small'],
				'medium' => $artist->image['medium'],
				'large' => $artist->image['large'],
			),
			'streamable' => $artist->streamable,
			'listeners' => $artist->stats->listeners,
			'plays' => $artist->stats->plays,
			'bio' => array(
				'summary' => $artist->bio->summary,
				'content' => $artist->bio->content,
				'published' => strtotime($artist->bio->published),
			),
		);

		return $output;
	}
}
