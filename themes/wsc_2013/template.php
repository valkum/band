<?php


/**
 * Implements hook_html_head_alter().
 * We are overwriting the default meta character type tag with HTML5 version.
 */
function wsc_2013_html_head_alter(&$head_elements) {
  $head_elements['system_meta_content_type']['#attributes'] = array(
    'charset' => 'utf-8'
  );
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function wsc_2013_breadcrumb($variables) {
  // only want breadcrumbs for admin section.
  if (arg(0) != 'admin') {
    return;
  }
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $heading = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    // Uncomment to add current page to breadcrumb
	// $breadcrumb[] = drupal_get_title();
    return '<nav class="breadcrumb">' . $heading . implode('', $breadcrumb) . '</nav>';
  }
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function wsc_2013_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
    $variables['primary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['primary']);
  }
  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
    $variables['secondary']['#suffix'] = '</ul>';
    $output .= drupal_render($variables['secondary']);
  }
  return $output;
}

/**
 * Override or insert variables into the node template.
 */
function wsc_2013_preprocess_node(&$variables) {

  $variables['date'] = format_date($variables['node']->created, 'custom', 'F j, Y');
  $variables['submitted'] = t('!datetime &middot; !username', array('!username' => $variables['name'], '!datetime' => $variables['date']));
  if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
    $variables['classes_array'][] = 'node-full';
  }
  if ($variables['node']->type === 'event' && !empty($variables['content']['field_venue'])) {
    foreach(element_children($variables['content']['field_venue']) as $key) {
      $term = $variables['content']['field_venue']['#items'][$key]['taxonomy_term'];
      $item = &$variables['content']['field_venue'][$key];
      $item['#prefix'] = '<span property="schema:name">';
      $item['#suffix'] = '</span>';
      unset($item['#options']['attributes']['typeof']);
      unset($item['#options']['attributes']['property']);
      unset($item['#options']['attributes']['datatype']);
      $variables['content']['venue'] = array(
         '#weight' => 4,
         '#type' => 'container',
         '#attributes' => array('property' => 'schema:location', 'typeof' => 'http://schema.org/Place', 'class' => 'field-name-field-venue'),
        'location' => $item,
      );
      if (isset($term->field_address[LANGUAGE_NONE][0])) {
        $variables['content']['venue']['address'] = field_view_field('taxonomy_term', $term, 'field_address', array('label' => 'hidden'));
        $variables['content']['venue']['address']['#prefix'] = '<div property="schema:address" typeof="http://schema.org/PostalAddress">';
        $variables['content']['venue']['address']['#suffix'] = '</div>';
        $variables['content']['venue']['address']['#weight'] = 10;
        $variables['content']['venue']['address']['#label'] = FALSE;
      }
    }
  }
}
/**
 * Preprocess variables for region.tpl.php
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
function wsc_2013_preprocess_region(&$variables, $hook) {
  // Use a bare template for the content region.
  if ($variables['region'] == 'content') {
    $variables['theme_hook_suggestions'][] = 'region__bare';
  }
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function wsc_2013_preprocess_block(&$variables, $hook) {
  // Use a bare template for the page's main content.
  if ($variables['block_html_id'] == 'block-system-main') {
    $variables['theme_hook_suggestions'][] = 'block__bare';
  }
  $variables['title_attributes_array']['class'][] = 'block-title';
}

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
function wsc_2013_process_block(&$variables, $hook) {
  // Drupal 7 should use a $title variable instead of $block->subject.
  $variables['title'] = $variables['block']->subject;
}



function wsc_2013_preprocess_page(&$vars) {
  $vars['cover_image']  = NULL;
  if (theme_get_setting('toggle_cover_photo')) {
    $cover_image = theme_get_setting('cover_photo_path');
    if (theme_get_setting('default_cover_photo') == TRUE) {
      $cover_image = path_to_theme() . '/background.jpg';
    }
    // TODO: turn this off for admin pages
    if (is_file($cover_image)) {
      $vars['cover_image'] =  file_create_url($cover_image);
    }
    /* Note: This is a quick and dirty way to dynamically change the background cover image.
     * For more control over dynamic CSS, use LESS or SASS, don't extend this.
     */
    $dcss = format_string('html {
      background: url(@background) no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }', array('@background' => $vars['cover_image']));
    drupal_add_css($dcss, array('type' => 'inline', 'preprocess' => FALSE));
  }
  if (isset($_GET['embed']) && $_GET['embed'] == 'facebook') {
    $vars['theme_hook_suggestions'][] = 'page__embed';
  }
  /* Quick way to add google fonts.
   * A better method: http://drupal.org/project/fontyourface
   */
  //drupal_add_css('http://fonts.googleapis.com/css?family=Arvo');

}




function wsc_2013_css_alter(&$css) {
  // Remove defaults.css file.


}


/**
 * Changes the search form to use the "search" input element of HTML5.
 */
function wsc_2013_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="text"', 'type="search"', $vars['search_form']);
}


/**
 * Implements theme_field to get rid of colon on labels.
 */
function wsc_2013_field($variables) {
  $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;&nbsp;</div>';
  }

  // Render the items.
  $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
  foreach ($variables['items'] as $delta => $item) {
    $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
    $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
  }
  $output .= '</div>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
}


/**
 * Clearfix added to inline field elements causing float problems...see http://drupal.org/node/622330#comment-5215864
 */
function wsc_2013_preprocess_field(&$variables, $hook){
    $element = $variables['element'];
    if ($element['#label_display'] == 'inline') {
        $classes_arr = &$variables['classes_array'];
        for ($i = sizeof($classes_arr)-1; $i >= 0; $i--) {
            if( $classes_arr[$i]==='clearfix' ){
                unset($classes_arr[$i]);
                $i=-1;
            }
    }
  }
}

