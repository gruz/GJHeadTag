<?php
/**
* @package plugin HeadTag
* @copyright (C) 2010-2011 RicheyWeb - www.richeyweb.com
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * HeadTag system plugin
 */
class plgSystemGJHeadTag extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access	protected
	 * @param	object	$subject The object to observe
	 * @param 	array   $config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	function __construct( &$subject, $config )
	{
            parent::__construct( $subject, $config );
	}
	function onBeforeRender()
	{
		// this plugin is not meant for /administrator
		$app = JFactory::getApplication();
		if($app->isAdmin()) return true;
		$doc = JFactory::getDocument();
		if($doc->getType() != 'html') return true;
		$content = $this->params->get('headtags');
		$config = JFactory::getConfig();
		$content = str_replace('%SITENAME%',$config->get( 'sitename' ),$content);
		JFactory::getDocument()->addCustomTag(PHP_EOL.'<!-- { gjheqadtag insert -->'.PHP_EOL.$content.PHP_EOL.'<!-- gjheqadtag insert } -->'.PHP_EOL);
	}

}
