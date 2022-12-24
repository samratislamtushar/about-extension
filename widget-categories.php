<?php


if( !function_exists('is_elementor_version')){
   function is_elementor_version($operator = '<', $version = '2.6.0')
   {
       return defined('ELEMENTOR_VERSION') && version_compare(ELEMENTOR_VERSION, $version, $operator);
   }
}

if (!function_exists('get_all_pages')) {
    function get_all_pages()
    {

        $page_list = get_posts(array(
            'post_type' => 'page',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => 20,
        ));

        $pages = array();

        if (!empty($page_list) && !is_wp_error($page_list)) {
            foreach ($page_list as $page) {
                $pages[$page->ID] = $page->post_title;
            }
        }

        return $pages;
    }
}

function add_elementor_widget_categories( $elements_manager ) {

    $elements_manager->add_category(
        'layerdrops_Widget',
        [
            'title' => __( 'Layerdrops Widgets', 'dayerdrops' ),
            'icon' => 'fas fa-temperature-high',
        ]
    );

}

if(!function_exists('el_render_icon')){
    function el_render_icon($settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [])
    {
        // Check if its already migrated
        $migrated = isset($settings['__fa4_migrated'][$new_icon_id]);
        // Check if its a new widget without previously selected icon using the old Icon control
        $is_new = empty($settings[$old_icon_id]);

        $attributes['aria-hidden'] = 'true';

        if (is_elementor_version('>=', '2.6.0') && ($is_new || $migrated)) {
            \Elementor\Icons_Manager::render_icon($settings[$new_icon_id], $attributes);
        } else {
            if (empty($attributes['class'])) {
                $attributes['class'] = $settings[$old_icon_id];
            } else {
                if (is_array($attributes['class'])) {
                    $attributes['class'][] = $settings[$old_icon_id];
                } else {
                    $attributes['class'] .= ' ' . $settings[$old_icon_id];
                }
            }
            printf('<i %s></i>', \Elementor\Utils::render_html_attributes($attributes));
        }
    }
}

// ----------------------------------------------------------------------------------------
function custom_kses($raw){

    $allowed_tags = array(
       'a'                         => array(
          'class'   => array(),
          'href'    => array(),
          'rel'  => array(),
          'title'   => array(),
          'target' => array(),
       ),
       'abbr'                      => array(
          'title' => array(),
       ),
       'b'                         => array(),
       'blockquote'                => array(
          'cite' => array(),
       ),
       'cite'                      => array(
          'title' => array(),
       ),
       'code'                      => array(),
       'del'                    => array(
          'datetime'   => array(),
          'title'      => array(),
       ),
       'dd'                     => array(),
       'div'                    => array(
          'class'   => array(),
          'title'   => array(),
          'style'   => array(),
       ),
       'dl'                     => array(),
       'dt'                     => array(),
       'em'                     => array(),
       'h1'                     => array(),
       'h2'                     => array(),
       'h3'                     => array(),
       'h4'                     => array(),
       'h5'                     => array(),
       'h6'                     => array(),
       'i'                         => array(
          'class' => array(),
       ),
       'img'                    => array(
          'alt'  => array(),
          'class'   => array(),
          'height' => array(),
          'src'  => array(),
          'width'   => array(),
       ),
       'li'                     => array(
          'class' => array(),
       ),
       'ol'                     => array(
          'class' => array(),
       ),
       'p'                         => array(
          'class' => array(),
       ),
       'q'                         => array(
          'cite'    => array(),
          'title'   => array(),
       ),
       'span'                      => array(
          'class'   => array(),
          'title'   => array(),
          'style'   => array(),
          'data-count' => array(),
       ),
       'iframe'                 => array(
          'width'         => array(),
          'height'     => array(),
          'scrolling'     => array(),
          'frameborder'   => array(),
          'allow'         => array(),
          'src'        => array(),
       ),
       'strike'                 => array(),
       'br'                     => array(),
       'strong'                 => array(),
       'data-wow-duration'            => array(),
       'data-wow-delay'            => array(),
       'data-wallpaper-options'       => array(),
       'data-stellar-background-ratio'   => array(),
       'ul'                     => array(
          'class' => array(),
       ),
    );
 
    if (function_exists('wp_kses')) { // WP is here
       $allowed = wp_kses($raw, $allowed_tags);
    } else {
       $allowed = $raw;
    }
 
    return $allowed;
 }

add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );