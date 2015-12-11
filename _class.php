<?php
/*
 * Scrobbls - A Last.fm Display plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
class Scrobbls
{
	public $key;

	function __construct()
	{
	}

	function setKey($key)
	{
		$this->key = $key;
	}

	function getKey()
	{
		return $this->key;
	}

	function retrieve($data)
	{
		$url = 'http://ws.audioscrobbler.com/2.0/?method='.$data.'&api_key='.$this->key;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		$result = curl_exec($ch);

		return simplexml_load_string($result);
	}
}

class scrobblUser extends Scrobbls
{
	public $user;
	function __construct($user, $apiKey)
	{
		$this->user = $user;
		parent::setKey($apiKey);
	}

	function getInfo()
	{
		$data = parent::retrieve('user.getInfo&user='.$this->user);
		$user = $data->user;

		$output = array(
			'name' => $user->name,
			'url' => $user->url,
			'image' => $user->image,
			'country' => $user->country,
			'age' => $user->age,
			'gender' => $user->gender,
			'subscriber' => $user->subscriber,
			'playcount' => $user->playcount,
			'playlists' => $user->playlists,
			'registered' => $user->registered['unixtime'],
		);

		return $output;
	}

	// $options can be any optional params located here: http://www.last.fm/api/show/user.getRecentTracks
	function getRecentTracks($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('user.getRecentTracks&user='.$this->user.$options);
		$tracks = $data->recenttracks->track;
		
		$i = 1;
		foreach($tracks as $track)
		{
			$output[$i] = array(
				'artist' => $track->artist,
				'name' => $track->name,
				'album' => $track->album,
				'url' => $track->url,
				'date' => $track->date['uts'],
				'streamable' => $track->streamable,
			);
			$i++;
		}

		return $output;
	}

	function getLovedTracks($options='')
	{
		$options = (empty($options_) ? '' : '&'.$options);
		$data = parent::retrieve('user.getLovedTracks&user='.$this->user.$options);
		$tracks = $data->lovedtracks->track;
		
		$i = 1;
		foreach($tracks as $track)
		{
			$output[$i] = array(
				'artist' => $track->artist['name'],
				'artistUrl' => $track->artist['url'],
				'name' => $track->name,
				'url' => $track->url,
				'date' => $track->date['uts'],
			);
			$i++;
		}

		return $output;
	}

	function getTopArtists($options='')
	{
		$options = (empty($options_) ? '' : '&'.$options);
		//
	}

	function getTopTracks($options='')
	{
		$options = (empty($options_) ? '' : '&'.$options);
		//
	}

	function getTopAlbums($options='')
	{
		$options = (empty($options_) ? '' : '&'.$options);
		//
	}
}

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
