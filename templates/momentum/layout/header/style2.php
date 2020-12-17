<?php 

defined('_JEXEC') or die;
?>
    <?php if($this->countModules('mobile_nav')) :?>
    <i class="glyphicon glyphicon-align-justify" id="envor-mobile-menu-btn"></i>
    <div class="envor-mobile-menu" id="envor-mobile-menu">
      <h3><?php echo JText::_('TPL_ENVOR_MENU_TEXT');?></h3>
      
        <nav>
            <!-- Menu items -->
            <jdoc:include type="modules" name="mobile_nav" style="none" />
        </nav>
      
    </div>
    <?php endif;?>

    <?php if($this->countModules('shopping_cart')) :?>
    <i class="glyphicon glyphicon-shopping-cart" id="envor-mobile-cart-btn"></i>
    <div class="envor-mobile-menu desktop-show" id="envor-mobile-cart">
      <jdoc:include type="modules" name="shopping_cart" style="envor" />
    </div>
    <?php endif;?>
    <!--

    Envor header start

    //-->
    <header class="envor-header envor-header-2">
      <!--

      Envor Header 2 Bg start

      //-->
      <div class="envor-header-bg">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="envor-relative">
                <a href="<?php echo JURI::root(true);?>">
                  <div class="envor-logo">
                      <?php if(!empty($logoImage)) :?>
                        <img src="<?php echo JURI::root(true).'/'.$logoImage;?>" alt="<?php echo $sitename;?>">
                      <?php endif;?>
                      <?php if(!empty($logoText)) :?>
                        <p class="logo"><?php echo $logoText;?></p>
                      <?php endif;?>
                      <?php if(!empty($logoSubText)) :?>
                        <p class="tagline"><?php echo $logoSubText;?></p>
                      <?php endif;?>
                  </div>
                </a>
                <?php if($this->countModules('top_bar')||!empty($phonenumber)||!empty($email)||!empty($facebooklink)||!empty($twitterlink)||!empty($linkedinlink)||!empty($googlepluslink)||!empty($rsslink)) :?>
                <div class="social-buttons">
                    <ul>
                        <?php if(!empty($facebooklink)) :?>
                            <li><a href="<?php echo $facebooklink;?>"><i class="fa fa-facebook"></i></a></li>
                        <?php endif;?>
                        <?php if(!empty($twitterlink)) :?>
                            <li><a href="<?php echo $twitterlink;?>"><i class="fa fa-twitter"></i></a></li>
                        <?php endif;?>
                        <?php if(!empty($linkedinlink)) :?>
                            <li><a href="<?php echo $linkedinlink;?>"><i class="fa fa-linkedin"></i></a></li>
                        <?php endif;?>
                        <?php if(!empty($googlepluslink)) :?>
                            <li><a href="<?php echo $googlepluslink;?>"><i class="fa fa-google-plus"></i></a></li>
                        <?php endif;?>
                        <?php if(!empty($rsslink)) :?>
                            <li><a href="<?php echo $rsslink;?>"><i class="fa fa-rss"></i></a></li>
                        <?php endif;?>
                        
                    </ul>
                    <jdoc:include type="modules" name="top_bar" style="none" />
                </div>
                <?php endif;?>
                <?php if($this->countModules('top_search')) :?>
                <div class="header-search">
                    <jdoc:include type="modules" name="top_search" style="none" />
                </div>
                <?php endif;?>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      
            
    <!-- Logo & Menu start//-->
    <div class="envor-desktop-menu-bg" id="envor-header-menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php if($this->countModules('megamenu-1')) :?>
                        <!-- Mega menu #1 //-->
                        <div class="riva-mega-menu" id="mega-menu-1" style="top:51px;">
                            <jdoc:include type="modules" name="megamenu-1" style="mega_section" />
                        </div>
                    <?php endif;?>
                    <?php if($this->countModules('megamenu-1')) :?>
                        <!-- Mega menu #2 //-->
                        <div class="riva-mega-menu" id="mega-menu-2" style="top:51px;">
                            <jdoc:include type="modules" name="megamenu-2" style="mega_section_2" />
                        </div>
                    <?php endif;?>

                    <?php if($this->countModules('main_nav')) :?>
                        <nav>
                            <!-- Menu items -->
                            <jdoc:include type="modules" name="main_nav" style="none" />
                        </nav>
                    <?php endif;?>

                </div>
            </div>
        </div>
    </div>
</header>
