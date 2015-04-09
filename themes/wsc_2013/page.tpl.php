<?php render($page['content']['metatags']); ?>

<?php if($page['top'] || $breadcrumb || $messages): ?>
<div id="top">
  <?php print render($page['top']); ?>
  <?php if ($breadcrumb): print $breadcrumb; endif;?>
   <?php print $messages; ?>
</div>
<?php endif; ?>


<div id="container" class="clearfix">

  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
    <?php if ($main_menu): ?>
      <a href="#navigation" class="element-invisible element-focusable"><?php print t('Skip to navigation'); ?></a>
    <?php endif; ?>
  </div>
  <div id="logo" role="banner" class="clearfix"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a></div>
  <div class="container-inner">
    <header id="header" role="banner" class="clearfix">
      <?php print render($page['header']); ?>

      <?php if ($main_menu || $secondary_menu || !empty($page['navigation'])): ?>
        <nav id="navigation" role="navigation" class="clearfix">
          <?php if (!empty($page['navigation'])): ?> <!--if block in navigation region, override $main_menu and $secondary_menu-->
            <?php print render($page['navigation']); ?>
          <?php endif; ?>
          <?php if (empty($page['navigation'])): ?>
        <?php print theme('links__system_main_menu', array(
              'links' => $main_menu,
              'attributes' => array(
                'id' => 'main-menu',
                'class' => array('links', 'clearfix'),
              ),
              'heading' => array(
                'text' => t('Main menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
              ),
            )); ?>
        <?php print theme('links__system_secondary_menu', array(
              'links' => $secondary_menu,
              'attributes' => array(
                'id' => 'secondary-menu',
                'class' => array('links', 'clearfix'),
              ),
              'heading' => array(
                'text' => t('Secondary menu'),
                'level' => 'h2',
                'class' => array('element-invisible'),
              ),
            )); ?>
          <?php endif; ?>
        </nav> <!-- /#navigation -->
      <?php endif; ?>
    </header> <!-- /#header -->

    <section id="main" role="main" class="clearfix">
      <a id="main-content"></a>
      <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div><?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php print render($page['content']); ?>
    </section> <!-- /#main -->

    <?php if ($page['sidebar_first']): ?>
      <aside id="sidebar-first" role="complementary" class="sidebar clearfix">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>

    <footer id="footer" role="contentinfo" class="clearfix">
      <div>
        <?php print render($page['footer']) ?>
        <?php print $feed_icons ?>
      </div>
      <div class="copyright">
        © 2015 - Well Seasoned Christ
        <br />
        Gemacht mit viel Bier &amp; Metal.
        <br />
        Design von <a target="_blank" href="https://drupal.org/user/10692">zirafa</a>. Angepasst von Rudi Floren.
        <br />
        Diese Webseite läuft mit <a href="http://drupal.org" target="_blank">Drupal</a>.
      </div>
    </footer> <!-- /#footer -->
  </div> <!-- /#container-inner -->
</div> <!-- /#container -->

<?php if($page['bottom'] || $messages): ?>
<div id="bottom">
  <?php print render($page['bottom']); ?>
</div>
<?php endif; ?>
