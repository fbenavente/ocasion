<?php 

defined('_JEXEC') or die;
$logo = '';
if(!empty($logoImage)){
   $logo .= '<a '.($isHomePage ? 'href="#top" class="scrollto"' : 'href="'.JURI::root(true).'/#top"').'><img src="'.JURI::root(true).'/'.$logoImage.'" alt="'.$sitename.'"></a>';
}
if(!empty($logoText)){
   $logo .= '<h1><a '.($isHomePage ? 'href="#top" class="scrollto"' : 'href="'.JURI::root(true).'/#top"').'>'.$logoText.'</a></h1>';
}
if(empty($logo)){
   $logo = '<h1><a '.($isHomePage ? 'href="#top" class="scrollto"' : 'href="'.JURI::root(true).'/#top"').'>'.$sitename.'</a></h1>';
}
?>
<?php if ($this->countModules('main-menu')) : ?>
   <!-- Top bar -->
   <div class="top-bar tb-large<?php if($transparentheader == '1') echo ' tb-transp';?>">
      <div class="row">
         <div class="twelve col">


            <!-- Symbolic or typographic logo -->
            <div class="tb-logo">
               <?php echo $logo;?>
            </div>
               <!-- Menu toggle -->
               <input type="checkbox" id="toggle" />
               <label for="toggle" class="toggle"></label>

               <jdoc:include type="modules" name="main-menu" style="none" />

         </div>
      </div>
   </div>
<?php endif;?>