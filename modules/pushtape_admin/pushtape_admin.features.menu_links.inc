<?php
/**
 * @file
 * pushtape_admin.features.menu_links.inc
 */

/**
 * Implements hook_menu_default_menu_links().
 */
function pushtape_admin_menu_default_menu_links() {
  $menu_links = array();

  // Exported menu link: menu-pushtape:<front>
  $menu_links['menu-pushtape:<front>'] = array(
    'menu_name' => 'menu-pushtape',
    'link_path' => '<front>',
    'router_path' => '',
    'link_title' => 'Home',
    'options' => array(
      'attributes' => array(
        'title' => '',
      ),
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 1,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -50,
  );
  // Exported menu link: menu-pushtape:admin
  $menu_links['menu-pushtape:admin'] = array(
    'menu_name' => 'menu-pushtape',
    'link_path' => 'admin',
    'router_path' => 'admin',
    'link_title' => 'Advanced',
    'options' => array(
      'attributes' => array(
        'title' => '',
      ),
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -44,
  );
  // Exported menu link: menu-pushtape:admin/pushtape
  $menu_links['menu-pushtape:admin/pushtape'] = array(
    'menu_name' => 'menu-pushtape',
    'link_path' => 'admin/pushtape',
    'router_path' => 'admin/pushtape',
    'link_title' => 'Dashboard',
    'options' => array(
      'attributes' => array(
        'title' => 'Dashboard',
      ),
    ),
    'module' => 'system',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -46,
  );
  // Exported menu link: menu-pushtape:node/add
  $menu_links['menu-pushtape:node/add'] = array(
    'menu_name' => 'menu-pushtape',
    'link_path' => 'node/add',
    'router_path' => 'node/add',
    'link_title' => '✚ Add',
    'options' => array(
      'attributes' => array(
        'title' => '',
      ),
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -49,
  );
  // Exported menu link: menu-pushtape:user
  $menu_links['menu-pushtape:user'] = array(
    'menu_name' => 'menu-pushtape',
    'link_path' => 'user',
    'router_path' => 'user',
    'link_title' => 'Account',
    'options' => array(
      'attributes' => array(
        'title' => '',
      ),
    ),
    'module' => 'menu',
    'hidden' => 0,
    'external' => 0,
    'has_children' => 0,
    'expanded' => 0,
    'weight' => -45,
  );
  // Translatables
  // Included for use with string extractors like potx.
  t('Account');
  t('Advanced');
  t('Dashboard');
  t('Home');
  t('✚ Add');


  return $menu_links;
}
