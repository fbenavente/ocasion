<?php 
header("Content-type: text/css; charset=utf-8");

$baseColor = '#'.htmlspecialchars($_GET['bc']);

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; 
}

?>

/* Color */
.text-color,
.btn.outline.color,
a.arrow-link:hover,
a.arrow-link:hover:before,
.service-item:hover > i,
.service-item:hover > a.arrow-link:before,
.c-details a:hover,
.c-details a:hover i,
.post-title a:hover {
	color: <?php echo $baseColor;?>;
}

/* Background color */
a.btn:hover,
button:hover,
input[type="submit"]:hover,
a .icon:hover,
a.btn.outline:hover,
button.outline:hover,
input[type="submit"].outline:hover,
.btn.color,
.icon-nav a:hover > i,
.tags a:hover,
.tagcloud a:hover,
a.comment-reply-link:hover,
.form-blog button[type="submit"]:hover,
.pagination a:hover {
	background: <?php echo $baseColor;?>;
}

/* Border color */
.tags a:hover,
.tagcloud a:hover {
	border: 1px solid <?php echo $baseColor;?>;
}

.btn.outline.color,
.form-blog button[type="submit"]:hover {
	border: 2px solid <?php echo $baseColor;?>;
}

/* RGBA border color */
a.btn.outline:hover,
button.outline:hover,
input[type="submit"].outline:hover {
	border: 2px solid <?php echo $baseColor;?>;
	border: 2px solid <?php echo 'rgba('.implode(",", hex2rgb($baseColor)).', 0.1)';?>;
}

/* RGBA background color */
.back-top {
	background: <?php echo $baseColor;?>;
	background: <?php echo 'rgba('.implode(",", hex2rgb($baseColor)).', 0.9)';?>;
}

.back-top:hover {
	background: <?php echo 'rgba('.implode(",", hex2rgb($baseColor)).', 0.1)';?>;
}