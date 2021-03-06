<?php
/*
 * Scrobbls - A Last.fm Display plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
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

	function getShouts($type='shouts', $options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('user.getShouts&user='.$this->user.$options);

		if($type == 'shouts')
		{
			$shouts = $data->shouts->shout;

			foreach($shouts as $shout)
			{
				$output[] = array(
					'author' => $shout->author,
					'body' => $shout->body,
					'date' => strtotime($shout->date),
				);
			}
		}
		elseif($type == 'count')
		{
			$output = $data->shouts['count'];
		}

		return $output;
	}

	function getRecentTracks($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('user.getRecentTracks&user='.$this->user.$options);
		$tracks = $data->recenttracks->track;

		foreach($tracks as $track)
		{
			$output[] = array(
				'artist' => $track->artist,
				'name' => $track->name,
				'album' => $track->album,
				'url' => $track->url,
				'date' => $track->date['uts'],
				'streamable' => $track->streamable,
			);
		}

		return $output;
	}

	function getLovedTracks($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('user.getLovedTracks&user='.$this->user.$options);
		$tracks = $data->lovedtracks->track;

		foreach($tracks as $track)
		{
			$output[] = array(
				'mbid' => $track->mbid,
				'artist' => array(
					'name' => $track->artist['name'],
					'mbid' => $track->artist['mbid'],
					'url' => $track->artist['url'],
				),
				'name' => $track->name,
				'url' => $track->url,
				'date' => $track->date['uts'],
				'image' => array(
					'small' => $artist->image['small'],
					'medium' => $artist->image['medium'],
					'large' => $artist->image['large'],
				),
			);
		}

		return $output;
	}

	function getArtistTracks($artist, $options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		if(!empty($artist))
		{
			$data = parent::retrieve('user.getArtistTracks&user='.$this->user.'&artist='.$artist);
			$artistTracks = $data->artisttracks->track;

			foreach($artistTracks as $track)
			{
				$output[] = array(
					'artist' => array(
						'mbid' => $track->artist['mbid'],
						'name' => $track->artist,
						'url' => 'http://www.last.fm/music/'.urlencode($track->artist),
					),
					'name' => $track->name,
					'streamable' => $track->streamable,
					'mbid' => $track->mbid,
					'album' => array(
						'mbid' => $track->album['mbid'],
						'name' => $track->album,
					),
					'url' => $track->url,
					'image' => array(
						'small' => $track->image['small'],
						'medium' => $track->image['medium'],
						'large' => $track->image['large'],
						'extralarge' => $track->image['extralarge'],
					),
					'date' => $track->date['uts'],
				);
			}
		}
		else
		{
			$output = null;
		}

		return $output;
	}

	function getBannedTracks($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('user.getBannedTracks&user='.$this->user);
		$bannedTracks = $data->bannedtracks->track;

		foreach($bannedTracks as $track)
		{
			$output[] = array(
				'name' => $track->name,
				'mbid' => $track->mbid,
				'url' => $track->url,
				'date' => $track->date['uts'],
				'artist' => array(
					'name' => $track->artist['name'],
					'mbid' => $track->artist['mbid'],
					'url' => $track->artist['url'],
				),
				'image' => array(
					'small' => $track->image['small'],
					'medium' => $track->image['medium'],
					'large' => $track->image['large'],
					'extralarge' => $track->image['extralarge'],
				),
				'streamable' => $track->streamable['fulltrack'],
			);
		}

		return $output;
	}

	function getTopArtists($options='')
	{
		$options = (empty($options) ? '' : '&'.$options);
		$data = parent::retrieve('user.getTopArtists&user='.$this->user);
		$topArtists = $data->topartists->artist;

		foreach($topArtists as $artist)
		{
			$output[$artist['rank']] = array(
				'name' => $artist->name,
				'playcount' => $artist->playcount,
				'mbid' => $artist->mbid,
				'url' => $artist->url,
				'streamable' => $artist->streamable,
				'image' => array(
					'small' => $artist->image['small'],
					'medium' => $artist->image['medium'],
					'large' => $artist->image['large'],
				),
			);
		}

		return $output;
	}

	function getTopTracks($options='')
	{
		$options = (empty($options_) ? '' : '&'.$options);
		$data = parent::retrieve('user.getTopTracks&user='.$this->user);
		$topTracks = $data->toptracks->track;

		foreach($topTracks as $track)
		{
			$output[$track['rank']] = array(
				'name' => $track->name,
				'playcount' => $track->playcount,
				'mbid' => $track->mbid,
				'url' => $track->url,
				'artist' => array(
					'name' => $track->artist['name'],
					'mbid' => $track->artist['mbid'],
					'url' => $track->artist['url'],
				),
				'image' => array(
					'small' => $track->image['small'],
					'medium' => $track->image['medium'],
					'large' => $track->image['large'],
				),
			);
		}

		return $output;
	}

	function getTopAlbums($options='')
	{
		$options = (empty($options_) ? '' : '&'.$options);
		$data = parent::retrieve('user.getTopAlbums&user='.$this->user);
		$topAlbums = $data->topalbums->album;

		foreach($topAlbums as $album)
		{
			$output[$album['rank']] = array(
				'name' => $album->name,
				'playcount' => $album->playcount,
				'mbid' => $album->mbid,
				'url' => $album->url,
				'artist' => array(
					'name' => $album->artist['name'],
					'mbid' => $album->artist['mbid'],
					'url' => $album->artist['url'],
				),
				'image' => array(
					'small' => $album->image['small'],
					'medium' => $album->image['medium'],
					'large' => $album->image['large'],
				),
			);
		}

		return $output;
	}

	function getTopTags($options='')
	{
		$options = (empty($options_) ? '' : '&'.$options);
		$data = parent::retrieve('user.getTopTags&user='.$this->user);
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
