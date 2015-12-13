<?php
/*
 * Scrobbls - A Last.fm Display plugin for e107
 *
 * Copyright (C) 2015 Patrick Weaver (http://trickmod.com/)
 * For additional information refer to the README.md file.
 *
 */
if(!defined{('e107_INIT')){ exit; }
require_once(e_PLUGIN.'scrobbls/_class.php');
$pref = e107::pref('scrobbls');
$tp = e107::getParser();
$sc = e107::getScBatch('scrobbls', true);
$template = e107::getTemplate('scrobbls');
$lfm = new scrobblUser($pref['username'], $pref['apiKey']);

$sc->setVars($lfm->getInfo());
$text = $tp->parseTemplate($template['user_menu'], false, $sc);

e107::getRender()->tablerender('Scrobbls User Info', $text);
