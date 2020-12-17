<?php 
/**
 * @package Azura Joomla Pagebuilder
 * @author Cththemes - www.cththemes.com
 * @date: 15-07-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
defined('_JEXEC') or die;

$classes = "azura_section";

$animationData = '';
if($animationArgs['animation'] == '1'){
	$classes .= ' animate-in';
	$animationData = 'data-anim-type="'.$animationArgs['animationtype'].'" data-anim-delay="'.$animationArgs['animationdelay'].'"';	
}
if(!empty($sec_class)){
	$classes .= ' '.$sec_class;
}
$rowclass = 'row';
if($fullwidth === '1'){
	$rowclass = 'row_full';
}
if(!empty($class)){
	$rowclass .= ' '.$class;
}

$classes = 'class="'.$classes.'"';
 
if(!empty($id)){
	$id = 'id="'.$id.'"';
}
?>
<section <?php echo $id . ' ' .$classes.' '.$rowstyle.' '.$animationData;?>>
<?php if(!empty($content)) :?>
	<!-- Title and introduction text -->
	<div class="row">
		<div class="eight col center text-center">
			<?php echo $content;?>
		</div>
	</div>
<?php endif;?>
	<div class="<?php echo $rowclass;?>">
		<?php if(count($rowColumnsArray)): 
			foreach ($rowColumnsArray as $key => $col) : ?>
			<?php $colClass = 'azp_col';
			$colAniData = '';
			if($col['animation'] === '1'){
				$colClass .= ' animate-in';
				$colAniData = 'data-anim-type="'.$col['animationtype'].'" data-anim-delay="'.$col['animationdelay'].'"';	
			}
			if(empty($col['columnwidthclass'])){
				$colClass .= ' twelve col';
			}else{
				$colClass .=' '.	str_replace(
										array("col-md-12","col-md-11","col-md-10","col-md-9","col-md-8","col-md-7","col-md-6","col-md-5","col-md-4","col-md-3","col-md-2","col-md-1"), 
										array("medium-twelve col","medium-eleven col","medium-ten col","medium-nine col","medium-eight col","medium-seven col","medium-six col","medium-five col","medium-four col","medium-three col","medium-two col","medium-one col"), 
										$col['columnwidthclass']
									);
			}
			// Responsive text
			if(!empty($col['responsivetext'])){
				$colClass .= ' '.	str_replace(
										array("col-lg-offset-11","col-lg-offset-10","col-lg-offset-9","col-lg-offset-8","col-lg-offset-7","col-lg-offset-6","col-lg-offset-5","col-lg-offset-4","col-lg-offset-3","col-lg-offset-2","col-lg-offset-1","col-lg-12","col-lg-11","col-lg-10","col-lg-9","col-lg-8","col-lg-7","col-lg-6","col-lg-5","col-lg-4","col-lg-3","col-lg-2","col-lg-1","hidden-lg"/*tablet horizontal*/,"col-md-offset-11","col-md-offset-10","col-md-offset-9","col-md-offset-8","col-md-offset-7","col-md-offset-6","col-md-offset-5","col-md-offset-4","col-md-offset-3","col-md-offset-2","col-md-offset-1","col-md-12","col-md-11","col-md-10","col-md-9","col-md-8","col-md-7","col-md-6","col-md-5","col-md-4","col-md-3","col-md-2","col-md-1","hidden-md"/*tablet vertical*/,"col-sm-offset-11","col-sm-offset-10","col-sm-offset-9","col-sm-offset-8","col-sm-offset-7","col-sm-offset-6","col-sm-offset-5","col-sm-offset-4","col-sm-offset-3","col-sm-offset-2","col-sm-offset-1","col-sm-12","col-sm-11","col-sm-10","col-sm-9","col-sm-8","col-sm-7","col-sm-6","col-sm-5","col-sm-4","col-sm-3","col-sm-2","col-sm-1","hidden-sm"/*mobile*/,"col-xs-offset-11","col-xs-offset-10","col-xs-offset-9","col-xs-offset-8","col-xs-offset-7","col-xs-offset-6","col-xs-offset-5","col-xs-offset-4","col-xs-offset-3","col-xs-offset-2","col-xs-offset-1","col-xs-12","col-xs-11","col-xs-10","col-xs-9","col-xs-8","col-xs-7","col-xs-6","col-xs-5","col-xs-4","col-xs-3","col-xs-2","col-xs-1","hidden-xs"), 
										array("offset-by-eleven","offset-by-ten","offset-by-nine","offset-by-eight","offset-by-seven","offset-by-six","offset-by-five","offset-by-four","offset-by-three","offset-by-two","offset-by-one","twelve","eleven","ten","nine","eight","seven","six","five","four","three","two","one","hide-normal"/*tablet horizontal*/,"offset-by-eleven","offset-by-ten","offset-by-nine","offset-by-eight","offset-by-seven","offset-by-six","offset-by-five","offset-by-four","offset-by-three","offset-by-two","offset-by-one","large-twelve","large-eleven","large-ten","large-nine","large-eight","large-seven","large-six","large-five","large-four","large-three","large-two","large-one","hide-large"/*tablet horizontal*/,"offset-by-eleven","offset-by-ten","offset-by-nine","offset-by-eight","offset-by-seven","offset-by-six","offset-by-five","offset-by-four","offset-by-three","offset-by-two","offset-by-one","medium-twelve","medium-eleven","medium-ten","medium-nine","medium-eight","medium-seven","medium-six","medium-five","medium-four","medium-three","medium-two","medium-one","hide-medium"/*mobile*/,"offset-by-eleven","offset-by-ten","offset-by-nine","offset-by-eight","offset-by-seven","offset-by-six","offset-by-five","offset-by-four","offset-by-three","offset-by-two","offset-by-one","small-twelve","small-eleven","small-ten","small-nine","small-eight","small-seven","small-six","small-five","small-four","small-three","small-two","small-one","hide-small"), 
										$col['responsivetext']
									);//$col['responsivetext'];
				//$colClass .= ' '.$col['responsivetext'];

			}

			if(!empty($col['class'])){
				$colClass .=' '.$col['class'];
			}
			$colID = '';
			if(!empty($col['id'])){
				$colID .= 'id="'.$col['id'].'"';
			}
			$colClass = 'class="'.$colClass.'"';
			?>
			<div <?php echo $colID . ' ' .$colClass.' '.$col['columnstyle'].' '.$colAniData;?>><?php echo $col['content'];?></div>
			<?php endforeach; 
		endif;?>
		<?php //echo ElementParser::do_shortcode($content);?>
	</div>
</section>