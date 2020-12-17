<?php 

defined('_JEXEC') or die;
require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
require_once (JPATH_SITE.DS.'modules'.DS.'mod_k2_tools'.DS.'includes'.DS.'calendarClass.php');

class CTHCalendar extends Calendar {

	var $category = null;

	var $monthShortNames = array('JAN','FEB','MAR','APR','MAY','JUNE','JULY','AUG','SEPT','OCT','NOV','DEC');

	function getDateLink($day, $month, $year)
	{

		$mainframe = JFactory::getApplication();
		$user = JFactory::getUser();
		$aid = $user->get('aid');
		$db = JFactory::getDBO();

		$jnow = JFactory::getDate();
		$now = K2_JVERSION == '15' ? $jnow->toMySQL() : $jnow->toSql();

		$nullDate = $db->getNullDate();

		$languageCheck = '';
		if (K2_JVERSION != '15')
		{
			$accessCheck = " access IN(".implode(',', $user->getAuthorisedViewLevels()).") ";
			if ($mainframe->getLanguageFilter())
			{
				$languageTag = JFactory::getLanguage()->getTag();
				$languageCheck = " AND language IN (".$db->Quote($languageTag).", ".$db->Quote('*').") ";
			}
		}
		else
		{
			$accessCheck = " access <= {$aid}";
		}

		$query = "SELECT COUNT(*) FROM #__k2_items WHERE YEAR(created)={$year} AND MONTH(created)={$month} AND DAY(created)={$day} AND published=1 AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." ) AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." ) AND trash=0 AND {$accessCheck} {$languageCheck} AND EXISTS(SELECT * FROM #__k2_categories WHERE id= #__k2_items.catid AND published=1 AND trash=0 AND {$accessCheck} {$languageCheck})";

		$catid = $this->category;
		if ($catid > 0)
			$query .= " AND catid={$catid}";

		$db->setQuery($query);
		$result = $db->loadResult();
		if ($db->getErrorNum())
		{
			echo $db->stderr();
			return false;
		}

		if ($result > 0)
		{
			if ($catid > 0)
				return JRoute::_(K2HelperRoute::getDateRoute($year, $month, $day, $catid));
			else
				return JRoute::_(K2HelperRoute::getDateRoute($year, $month, $day));
		}
		else
		{
			return false;
		}
	}

	function getCalendarLink($month, $year)
	{
		$itemID = JRequest::getInt('Itemid');
		if ($this->category > 0)
			return JURI::root(true)."/index.php?option=com_azurapagebuilder&amp;task=contact.calendar&amp;month={$month}&amp;year={$year}&amp;catid={$this->category}&amp;Itemid={$itemID}";
		else
			return JURI::root(true)."/index.php?option=com_azurapagebuilder&amp;task=contact.calendar&amp;month=$month&amp;year=$year&amp;Itemid={$itemID}";
	}


	/*
        Generate the HTML for a given month
    */
    function getMonthHTML($m, $y, $showYear = 1)
    {
        $s = "";

        $a = $this->adjustDate($m, $y);
        $month = $a[0];
        $year = $a[1];

    	$daysInMonth = $this->getDaysInMonth($month, $year);
    	$date = getdate(mktime(12, 0, 0, $month, 1, $year));

    	$first = $date["wday"];
    	$monthName = $this->monthNames[$month - 1];
    	

    	$prev = $this->adjustDate($month - 1, $year);
    	$next = $this->adjustDate($month + 1, $year);

    	$prevMonthName = $this->monthShortNames[$prev[0]-1];
    	$nextMonthName = $this->monthShortNames[$next[0]-1];

    	if ($showYear == 1)
    	{
    	    $prevMonth = $this->getCalendarLink($prev[0], $prev[1]);
    	    $nextMonth = $this->getCalendarLink($next[0], $next[1]);
    	}
    	else
    	{
    	    $prevMonth = "";
    	    $nextMonth = "";
    	}

    	$header = $monthName . (($showYear > 0) ? " " . $year : "");

    	$s .= '<div id="calendar_wrap">
							<table id="wp-calendar">
								<caption>'.$header.'</caption>
								<thead>
									<tr>
										<th scope="col" title="'. $this->dayNames[($this->startDay)%7] .'">'. $this->dayNames[($this->startDay)%7] .'</th>
										<th scope="col" title="'. $this->dayNames[($this->startDay+1)%7] .'">'. $this->dayNames[($this->startDay+1)%7] .'</th>
										<th scope="col" title="'. $this->dayNames[($this->startDay+2)%7] .'">'. $this->dayNames[($this->startDay+2)%7] .'</th>
										<th scope="col" title="'. $this->dayNames[($this->startDay+3)%7] .'">'. $this->dayNames[($this->startDay+3)%7] .'</th>
										<th scope="col" title="'. $this->dayNames[($this->startDay+4)%7] .'">'. $this->dayNames[($this->startDay+4)%7] .'</th>
										<th scope="col" title="'. $this->dayNames[($this->startDay+5)%7] .'">'. $this->dayNames[($this->startDay+5)%7] .'</th>
										<th scope="col" title="'. $this->dayNames[($this->startDay+6)%7] .'">'. $this->dayNames[($this->startDay+6)%7] .'</th>
									</tr>
								</thead>

								<tfoot>
									<tr>
										<td colspan="3" id="prev"> '. (($prevMonth == "") ? "&nbsp;" : "<a href=\"$prevMonth\"  class=\"monthNavLink\">&laquo; ".$prevMonthName."</a>")  .'</td>
										<td class="pad">&nbsp;</td>
										<td colspan="3" id="next">' . (($nextMonth == "") ? "&nbsp;" : "<a href=\"$nextMonth\"  class=\"monthNavLink\">".$nextMonthName." &raquo;</a>")  . '</td>
									</tr>
								</tfoot>

								<tbody>';
									
								


    	// We need to work out what date to start at so that the first appears in the correct column
    	$d = $this->startDay + 1 - $first;
    	while ($d > 1)
    	{
    	    $d -= 7;
    	}

        // Make sure we know when today is, so that we can use a different CSS style
        $today = getdate(time());

    	while ($d <= $daysInMonth)
    	{
    	    $s .= "<tr>\n";

    	    for ($i = 0; $i < 7; $i++)
    	    {
        	    $class = ($year == $today["year"] && $month == $today["mon"] && $d == $today["mday"]) ? "calendarToday" : "calendarDate";

    	        if ($d > 0 && $d <= $daysInMonth){
    	            $link = $this->getDateLink($d, $month, $year);
    	            if($link == ""){
    	            	$s .= "<td class=\"{$class}\">$d</td>\n";
    	            } else {
    	            	$s .= "<td class=\"{$class}Linked\"><a href=\"$link\">$d</a></td>\n";
    	            }
    	        } else {
    	        		$s .= "<td class=\"calendarDateEmpty\">&nbsp;</td>\n";
    	        }

        	    $d++;
    	    }
    	    $s .= "</tr>\n";
    	}

    	$s .= '</tbody>
			</table>
		</div>';

    	return $s;
    }

}


?>