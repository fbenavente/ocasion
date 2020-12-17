<?php

defined('_JEXEC') or die;

class PlgContentAzuracontent extends JPlugin
{

	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		require_once JPATH_ROOT.'/components/com_azurapagebuilder/helpers/elementparser.php';

		if($context == 'com_azurapagebuilder.page'){
			return true;
		}

		$article->text = ElementParser::do_shortcode( $article->text );


	}

}
