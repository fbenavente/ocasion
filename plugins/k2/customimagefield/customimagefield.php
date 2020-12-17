<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
JLoader::register('K2Plugin', JPATH_ADMINISTRATOR . '/components/com_k2/lib/k2plugin.php');

class plgcustomimagefield extends K2Plugin {


    public $pluginName = 'customimagefield';
    public $pluginNameHumanReadable;

    public function plgcustomimagefield(&$subject, $params) {
        parent::__construct($subject, $params);
        $this->loadLanguage();
        $this->pluginNameHumanReadable = JText::_('K2 Custom Image Field');
    }

}

