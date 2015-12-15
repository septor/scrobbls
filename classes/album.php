<?php
/*
 * Scrobbls - A Last.fm Display plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
class scrobblAlbum extends Scrobbls
{
	public $artist;
	public $album;

	function __construct($artist, $album, $apiKey)
	{
		$this->artist = $artist;
		$this->album = $album;
		parent::setKey($apiKey);
	}

	function getInfo($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('album.getInfo&artist='.$this->artist.'&album='$this->album);
		$album = $data->album;

		$output[] = array(
			'name' => $album->name,
			'artist' => $album->artist,
			'id' => $album->id,
			'mbid' => $album->mbid,
			'url' => $album->url,
			'released' => strtotime($album->released),
			'listeners' => $album->listeners,
			'playcount' => $album->playcount,
			'image' => array(
				'small' => $album->image['small'],
				'medium' => $album->image['medium'],
				'large' => $album->image['large'],
			),
		);

		return $output;
	}

	// for $options, refer to the getInfo API call.
	function getTopTracks($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('album.getInfo&artist='.$this->artist.'&album='$this->album);
		$topTracks = $data->album->tracks;

		foreach($topTracks as $track)
		{
			$output[$track['rank']] = array(
				'name' => $track->name,
				'duration' => $track->duration,
				'mbid' => $track->mbid,
				'url' => $track->url,
				'streamable' => $track->streamable['fultrack'],
				'artist' => array(
					'name' => $track->artist->name,
					'mbid' => $track->artist->mbid,
					'url' => $track->artist->url,
				),
			);
		}

		return $output;
	}

	function getTags($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('album.getTags&artist='.$this->artist.'&album='$this->album);
		$tags = $data->tags->tag;

		foreach($tags as $tag)
		{
			$output[] = array(
				'name' => $tag->name,
				'url' => $tag->url,
			);
		}

		return $output;
	}

	function getTopTags($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('album.getTopTags&artist='.$this->artist.'&album='$this->album);
		$topTags = $data->toptags->tag;

		foreach($topTags as $tag)
		{
			$output[] = array(
				'name' => $tag->name,
				'count' => $tag->count,
				'url' => $tag->url,
			);
		}

		return $output;
	}
}
