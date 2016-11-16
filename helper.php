<?php
/**
* @module	JM News Ticker
* @copyright	Copyright (C) 2016 John McCabe
* @license	GPL
*/


defined('_JEXEC') or die('Restricted access');

abstract class mod_jmnewstickerHelper
{
  static function getList($params)
  {
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);

    $query->select('*');
    $query->from('#__content');

    $category = $params->get('category', '');
    $category = intval($category);
    if (isset($category) && $category)
    {
      $query->where('catid = ' . $category . ' AND state = 1 AND ((now() >= publish_up OR publish_up = 0) AND (now() <= publish_down OR publish_down = 0))');
    }

    $showItems = $params->get('showItems', '');
    if ($showItems)
    {
      $query->setLimit($showItems);
    }

    $query->order('created DESC');

    $db->setQuery($query);

    try
    {
      $results = $db->loadObjectList();
    }
    catch (RuntimeException $e)
    {
      JError::raiseError(500, $e->getMessage());
      return false;
    }

    foreach ($items as &$item)
    {
      echo $item->title;
    }

    return $results;
  }
}
