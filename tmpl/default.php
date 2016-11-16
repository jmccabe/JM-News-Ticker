<?php
/**
 * @module	JM News Ticker
 * @copyright	Copyright (C) 2016 John McCabe
 * @license	GPL
 */
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/* Module ID is used to uniquify the list ID accessed by the script */
$moduleId = $module->id;

/* Check whether we need to display controls or not */
$controls = $params->get ( 'controls', 1 );
if (! $controls) {
	$controls = 0;
}

/* The static text that shows on the left (or right) of the module */
$titleText = $params->get ( 'titleText', 'Latest' );

/* The writing direction */
$direction = $params->get ( 'direction', 'ltr' );

/* How to update the text; 'reveal' or 'fade' */
$displayType = $params->get ( 'displayType', 'reveal' );
?>
<script type="text/javascript">
  antjQuery(function () {
    antjQuery('#js-news-<?php echo $moduleId; ?>').ticker({
              controls: <?php echo $controls; ?>,
              titleText: '<?php echo $titleText; ?>',
              direction: '<?php echo $direction; ?>',
              displayType: '<?php echo $displayType; ?>'
              });
  });
</script>
<ul id="js-news-<?php echo $moduleId; ?>" class="js-hidden">
  <?php
		foreach ( $rows as $row ) {
			$slug = $row->id . ':' . $row->alias;
			$catslug = $row->catid . ':' . $row->category_alias;
			$link = JRoute::_ ( ContentHelperRoute::getArticleRoute ( $slug, $catslug ) );
			echo '<li class="news-item"><a href="' . $link . '">' . $row->title . '</a></li>';
		}
		?>
</ul>
