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

	function getTopAlbums($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('artist.getTopAlbums&artist='.$this->artist);
		$topAlbums = $data->topalbums->album;

		foreach($topAlbums as $album)
		{
			$output[$album['rank']] = array(
				'name' => $album->name,
				'mbid' => $album->mbid,
				'listeners' => $album->listners,
				'url' => $album->url,
				'image' => array(
					'small' => $album->image['small'],
					'medium' => $album->image['medium'],
					'large' => $album->image['large'],
				),
			);
		}

		return $output;
	}

	function getTopFans($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('artist.getTopFans&artist='.$this->artist);
		$topFans = $data->topfans->user;

		foreach($topFans as $fan)
		{
			$output[] = array(
				'name' => $fan->name,
				'weight' => $fan->weight,
				'url' => $fan->url,
				'image' => array(
					'small' => $fan->image['small'],
					'medium' => $fan->image['medium'],
					'large' => $fan->image['large'],
				),
			);
		}

		return $output;
	}

	function getTopTags($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('artist.getTopTags&artist='.$this->artist);
		$topTags = $data->toptags->tag;

		foreach($topTags as $tag)
		{
			$output[] = array(
				'name' => $tag->name,
				'url' => $tag->url,
			);
		}

		return $output;
	}

	function getTopTracks($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('artist.getTopTracks&artist='.$this->artist);
		$topTracks = $data->toptracks->track;

		foreach($topTracks as $track)
		{
			$output[$track['rank']] = array(
				'name' => $track->name,
				'mbid' => $track->mbid,
				'playcount' => $track->playcount,
				'listeners' => $track->listners,
				'url' => $track->url,
				'image' => array(
					'small' => $track->image['small'],
					'medium' => $track->image['medium'],
					'large' => $track->image['large'],
				),
			);
		}

		return $output;
	}
}
