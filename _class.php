<?php

class Scrobbls
{
	private $key;
	private $secret;
	var $user;

	function __construct($username, $apiKey, $secret)
	{
		$this->key = $apiKey;
		$this->secret = $secret;
		$this->user = $username;
	}

	function retrieve($data)
	{
		//
	}
}

class scrobblUser extends Scrobbls
{
	function __construct()
	{
		//
	}

	function getInfo()
	{
		$user = parent::retrieve('user.getInfo');

		$output = array(
			'id' => $user->id,
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
}

class scrobblArtist extends Scrobbls
{
	function __construct()
	{
		//
	}
}

class scrobblAlbum extends Scrobbls
{
	function __construct()
	{
		//
	}
}

class scrobblTrack extends Scrobbls
{
	function __construct()
	{
		//
	}

	function getInfo()
	{
		//
	}
}

class scrobblChart extends Scrobbls
{
	function __construct()
	{
		//
	}
}
