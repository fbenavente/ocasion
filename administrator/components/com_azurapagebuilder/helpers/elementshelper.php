<?php

defined('_JEXEC') or die;

/**
* ElementsHelper
*/

require_once JPATH_ROOT.'/administrator/components/com_azurapagebuilder/helpers/cthmodulehelper.php';

class ElementsHelper
{
	
	public static function loadModule($id){
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("*")->from("#__modules")->where('id='.(int)$id);
        $db->setQuery($query);
        $result = $db->loadObject();
        $title = $result->title;
        $mod = $result->module;
        $module = CthModuleHelper::getModule( $mod, $title );
        //echo'<pre>';var_dump($module);die;
        $module->content = CthModuleHelper::renderModule( $module,array('style'=>'none'));
        return $module;
    }

    public static function getK2Items($catid, $limit='All', $order='created', $orderDir='ASC', $addFields = '',$child = '0'){
        //static $itemArray = array();
        //echo'<pre>';var_dump($child);die;
        if($child == '1'){
            return self::getK2ItemsChild($catid, $limit, $order, $orderDir, $addFields);
        }
        $order = 'a.'.$order;
        if((int)$limit){
            $limit = (int) $limit;
        }else{
            $limit = 'All';
        }
        $db =  JFactory::getDbo();
        $query=$db->getQuery(true);
        $where = array('a.published=1','a.trash=0');
        if($catid!=0){
            $where[]='catid='.(int)$catid;
        }
        $query  ->select('a.id,a.title,a.alias,a.extra_fields,a.introtext,a.fulltext,a.catid,c.alias as categoryalias,c.name as c_name, c.description as c_desc')
                ->select('a.created,a.created_by,a.created_by_alias,a.ordering,a.image_caption,a.image_credits,a.params');
       if(!empty($addFields)){
        $query  ->select($addFields);
       }

        $query  ->from('#__k2_items AS a')
                ->join('INNER', '#__k2_categories AS c ON (a.catid = c.id)')
                ->where($where)
                ->order($db->escape($order . ' ' . $orderDir));
        $db     ->setQuery($query,0,$limit);

        //$return = $db->loadObjectList();

        return $db->loadObjectList();
    }

    public static function getK2ItemsChild($catid, $limit = 'All', $order = 'created', $orderDir='ASC',$addFields=''){
        $catarray = self::getK2CategoryChildren($catid);
        array_unshift($catarray, $catid);

        $catsitemsarray = array();

        foreach ($catarray as $cat) {
            $catitemsarray = self::getK2Items($cat,'All',$order,$orderDir);
            foreach ($catitemsarray as $item) {
                $itempush = array();
                $itempush['id'] = $item->id;
                $itempush['catname'] = $item->c_name;
                $itempush['catalias'] = $item->categoryalias;
                array_push($catsitemsarray, $itempush);
            }
        }

        $return = array();

        if(is_numeric($limit)){
            for ($i=0; $i < $limit ; $i++) { 
                if($i < count($catsitemsarray)){
                    $itemreturn = self::getK2Item($catsitemsarray[$i]['id']);
                    $itemreturn->catname = $catsitemsarray[$i]['catname'];
                    $itemreturn->catalias = $catsitemsarray[$i]['catalias'];
                    array_push($return, $itemreturn);
                }
            }
        }else{
            foreach ($catsitemsarray as $value) {
                $itemreturn = self::getK2Item($value['id']);
                $itemreturn->catname = $value['catname'];
                $itemreturn->catalias = $value['catalias'];
                array_push($return, $itemreturn);
            }
        }

        return $return;
    }

    public static function getK2Item($id,$addFields = ''){
        
        $db =  JFactory::getDbo();
        $query=$db->getQuery(true);
        $where = array('a.published=1','a.trash=0');
        if($id!=0){
            $where[]='id='.(int)$id;
        }
        $query  ->select('a.id,a.title,a.alias,a.extra_fields,a.introtext,a.fulltext,a.catid')
                ->select('a.created,a.modified,a.created_by,a.created_by_alias,a.ordering,a.image_caption,a.image_credits,a.params');
       if(!empty($addFields)){
                $query  ->select($addFields);
       }

        $query  ->from('#__k2_items AS a')

                ->where($where);
                //->join('INNER', '#__k2_categories AS c ON (a.catid = c.id)');
        $db     ->setQuery($query);

        $item = $db->loadObject();
		
		require_once (JPATH_SITE.'/components/com_k2/helpers/route.php');
        require_once JPATH_SITE.'/components/com_k2/models/item.php';
        require_once JPATH_SITE.'/components/com_k2/helpers/permissions.php';

        JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');

        $K2ModelItem = new K2ModelItem;


        $item = $K2ModelItem->prepareItem($item, 'category', 'itemlist');

        return $item;
    }

    public static function getK2Cat($catid=0){
        $db =  JFactory::getDbo();
        $query=$db->getQuery(true);
        //$where = array('a.id=1');
        if((int)$catid!=0){
            $where ='a.id='.(int)$catid;
        }
        $query      ->select('a.id,a.name,a.alias,a.description')
            ->from('#__k2_categories AS a')
            ->where($where)
            ->order('a.ordering ASC');
        $db->setQuery($query,0,1);

        return $db->loadObject();
    }

    public static function k2CatHasChildren($id)
    {

        $mainframe = JFactory::getApplication();
        $user = JFactory::getUser();
        $aid = (int)$user->get('aid');
        $id = (int)$id;
        $db = JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories  WHERE parent={$id} AND published=1 AND trash=0 ";
        if (K2_JVERSION != '15')
        {
            $query .= " AND access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
            if ($mainframe->getLanguageFilter())
            {
                $languageTag = JFactory::getLanguage()->getTag();
                $query .= " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
            }

        }
        else
        {
            $query .= " AND access <= {$aid}";
        }

        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo $db->stderr();
            return false;
        }

        if (count($rows))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function getK2CategoryChildren($catid)
    {

        static $array = array();
        $mainframe = JFactory::getApplication();
        $user = JFactory::getUser();
        $aid = (int)$user->get('aid');
        $catid = (int)$catid;
        $db = JFactory::getDBO();
        $query = "SELECT * FROM #__k2_categories WHERE parent={$catid} AND published=1 AND trash=0 ";
        if (K2_JVERSION != '15')
        {
            $query .= " AND access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
            if ($mainframe->getLanguageFilter())
            {
                $languageTag = JFactory::getLanguage()->getTag();
                $query .= " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
            }
        }
        else
        {
            $query .= " AND access <= {$aid}";
        }
        $query .= " ORDER BY ordering ";

        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if ($db->getErrorNum())
        {
            echo $db->stderr();
            return false;
        }
        foreach ($rows as $row)
        {
            array_push($array, $row->id);
            if (self::k2CatHasChildren($row->id))
            {
                self::getK2CategoryChildren($row->id);
            }
        }
        return $array;
    }


    public static function getK2ItemTagsFilter($item,$implode = " ",$ucf = false){
        require_once JPATH_SITE.'/components/com_k2/models/item.php';

        $K2ModelItem = new K2ModelItem;

        $tags = array();
        $itemTags = $K2ModelItem->getItemTags($item->id);
        if(count($itemTags)) {
            foreach ($itemTags as $tag) {
                $tagName = str_replace(" ", "-", $tag->name);
                if($ucf === true){
                    $tags[] = ucfirst($tagName);
                }else{
                    $tags[] = strtolower($tagName);
                }
                
            }
        }

        $filter = implode($implode, $tags);

        return $filter;
    }

    public static function getK2TagsFilter($items){

        $catTags = array();

        $allTags = array();

        $tags = array();

        if(count($items)){


            require_once JPATH_SITE.'/components/com_k2/models/item.php';

            $K2ModelItem = new K2ModelItem;

            foreach ($items as $item) {
                $catTags[] = $K2ModelItem->getItemTags($item->id);
            }
            
            if(!empty($catTags)){
                foreach ($catTags as $catTag) {
                    if (!empty($catTag)) {
                        foreach ($catTag as $tag) {
                            $allTags[] = $tag->name;
                        }
                    }
                }
            }

            $tags = array_unique($allTags);
        }
        return $tags;
    }

    public static function getK2ItemLink($id,$alias,$catid,$categoryalias){
        require_once (JPATH_SITE.'/components/com_k2/helpers/route.php');
        return urldecode(JRoute::_(K2HelperRoute::getItemRoute($id.':'.urlencode($alias), $catid.':'.urlencode($categoryalias))));
    }

    public static function userGetName($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("name")->from("#__users")->where('id='.(int)$id);
        $db->setQuery($query);
        
        return $db->loadResult();
    }
}