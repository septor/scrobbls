<?php

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
		$tracks = $data->recenttracks;

		//TODO: Parse the tracks, and their info, into an array.
		foreach($tracks as $track)
		{
			//
		}
	}
}

class scrobblArtist extends Scrobbls
{
	public $artist;

	function __construct($artist, $apiKey)
	{
		$this->artist = $artist;
		parent::setKey() = $apiKey;
	}

	function getInfo($options='')
	{
		//
	}
}
