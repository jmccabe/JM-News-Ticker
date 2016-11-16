<?php
/**
 * @module	JM News Ticker
 * @copyright	Copyright (C) 2016 John McCabe
 * @license	GPL 3
 * 
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );
error_reporting ( E_ERROR );
define ( "DS", DIRECTORY_SEPARATOR );

require_once __DIR__ . '/helper.php';

/* Handle the JQuery and Javascript stuff */
$document = &JFactory::getDocument ();

$loadJ = $params->get ( 'loadJ', true );
if ($loadJ) {
	$document->addScript ( JURI::root () . 'modules/mod_jmnewsticker/js/jquery.js' );
}
$document->addScript ( JURI::root () . 'modules/mod_jmnewsticker/js/jquery.nc.js' );
$document->addScript ( JURI::root () . 'modules/mod_jmnewsticker/js/jquery.ticker.js' );
$document->addStylesheet ( JURI::root () . 'modules/mod_jmnewsticker/css/style.css' );

/* Get the data we're going to show from the helper */
$rows = mod_jmnewstickerHelper::getList ( $params );

/* Need to pull in the selected layout file */
require JModuleHelper::getLayoutPath ( 'mod_jmnewsticker', $params->get ( 'layout', 'default' ) );
