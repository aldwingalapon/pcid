<?php

function fb_opengraph() {
    global $post;
 
    if(is_single() || is_page()) {
        if(has_post_thumbnail($post->ID)) {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
            $img_src = $img[0];
	//} else {
    //        $img_src = get_stylesheet_directory_uri() . "/images/logo_sm.png";
	}
	if($excerpt = $post->post_excerpt) {
		$excerpt = strip_tags($post->post_excerpt);
		$excerpt = str_replace("", "'", $excerpt);
	} else {
		$excerpt = get_bloginfo('description');
	}
	?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
 
<?php
    } else {
        return;
    }
}
add_action('wp_head', 'fb_opengraph', 5);

/*	@desc attach custom admin login CSS file	*/
function custom_login_css() {
  echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/login.css" />';
}
add_action('login_head', 'custom_login_css');

/*	@desc update logo URL to point towards Homepage	*/
function custom_login_header_url($url) {
  return get_option('home');
}
add_filter( 'login_headerurl', 'custom_login_header_url' );

function custom_login_header_title($title) {
  $blog_title = get_bloginfo('name') . ' - ' . get_bloginfo('description');
  return $blog_title;
}
add_filter( 'login_headertitle', 'custom_login_header_title' );

function login_error_override() {
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');

function my_login_head() {
remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'my_login_head');

function login_checked_remember_me() {
add_filter( 'login_footer', 'rememberme_checked' );
}
add_action( 'init', 'login_checked_remember_me' );

function rememberme_checked() {
echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

/*	@desc update admin icon to client icon	*/
function custom_admin_icon_css() {
  echo '<link rel="shortcut icon" href="'.get_stylesheet_directory_uri().'/images/logo.ico" />';
}
add_action('admin_head', 'custom_admin_icon_css');

function remove_footer_admin () {
    echo '<span id="footer-thankyou">Template implemented and developed by <a href="http://www.jamediasolutions.com/" target="_blank" title="JA Media Solutions">JA Media Solutions</a>.</span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Disable Admin Bar for all users
add_filter('show_admin_bar', '__return_false');

function rboct_remove_version() {return '';}
add_filter('the_generator', 'rboct_remove_version');

function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyDOiDvxa8z9wWPR8YJGaFkty1JFA4XXy_Q';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
//Making jQuery Google API

//Making jQuery Google API
function modify_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', false, '1.11.3');
		wp_enqueue_script('jquery');
	}
}
//add_action('init', 'modify_jquery');

// custom menu support
add_theme_support( 'menus' );
if (function_exists( 'register_nav_menus')) {register_nav_menus(array('primary_navigation' => 'Primary Navigation', 'secondary_navigation' => 'Secondary Navigation', 'utility_navigation' => 'Utility Navigation'));}

if ( function_exists('register_sidebar') )
register_sidebar(array('id'=>'default-sidebar','name'=>'Default Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));
register_sidebar(array('id'=>'default-news-sidebar','name'=>'Default News Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));
register_sidebar(array('id'=>'default-articles-sidebar','name'=>'Default Articles Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));
register_sidebar(array('id'=>'default-events-sidebar','name'=>'Default Events Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));
register_sidebar(array('id'=>'default-blog-sidebar','name'=>'Default Blog Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));
register_sidebar(array('id'=>'default-media-sidebar','name'=>'Default Media Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));
register_sidebar(array('id'=>'default-page-sidebar','name'=>'Default Page Sidebar','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h2 class="widgettitle">','after_title' => '</h2>',));
register_sidebar(array('id'=>'footer-one','name'=>'Footer One','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h4>','after_title' => '</h4>',));
register_sidebar(array('id'=>'footer-two','name'=>'Footer Two','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h4>','after_title' => '</h4>',));
register_sidebar(array('id'=>'footer-three','name'=>'Footer Three','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h4>','after_title' => '</h4>',));
register_sidebar(array('id'=>'footer-four','name'=>'Footer Four','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h4>','after_title' => '</h4>',));
register_sidebar(array('id'=>'footer-copyright','name'=>'Footer Copyright','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h4>','after_title' => '</h4>',));
register_sidebar(array('id'=>'footer-menu','name'=>'Footer Menu','before_widget' => '<span id="%1$s" class="widget %2$s">','after_widget' => '</span>','before_title' => '<h4>','after_title' => '</h4>',));

// thumbnail support
add_theme_support('post-thumbnails'); 
add_image_size('medium-news-thumbnails', 400, 175, true);

add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}

// Remove Query String
function _remove_script_version( $src ){
$parts = explode( '?ver', $src );
return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

// Add a unique id attribute to the body tag of an HTML page
function id_the_body() {
        global $post, $wp_query, $wpdb;
        $post = $wp_query->post;
	$body_id = "";
        if ($post->post_type == 'page') $body_id = 'page-' . $post->ID;
        if ($post->post_type == 'post') $body_id = 'post-' . $post->ID;
        if ( is_front_page() ) $body_id = 'home';
        if ( is_home() ) $body_id = 'home';
        if ( is_category() ) $body_id = 'category-' . get_query_var('cat');
        if ( is_tag() ) $body_id = 'tag-' . get_query_var('tag');
        if ( is_author() ) $body_id = 'author-' . get_query_var('author');
        if ( is_date() ) $body_id = 'date-archive';
        if (is_search()) $body_id = 'search-archive';
        if (is_404()) $body_id = '404-error';
        if ($body_id) echo "id=\"$body_id\"";
}
// Add special class names for the parents of the page
function class_the_body($more_classes='') {
        global $post, $wp_query, $wpdb;
        $post = $wp_query->post;
		$parent_id_string = "";
        if ($post->ancestors) {
                /* reverse the order of the array elements b/c we want the immediate parent to be last in the class list */
                $parent_array = array_reverse($post->ancestors);
                foreach ($parent_array as $key => $parent_id) {
                        $parent_id_string = $parent_id_string . ' childof-' . 
$parent_id;
                }
        }
	$type = "";
        if ($post->post_type == 'page') $type = 'page';
        if ($post->post_type == 'post') $type = 'single';
        // these 2 are not needed since we id the body with home
        //if (is_home()) $type = 'home';
        //if (is_front_page()) $type = 'front';
        if (is_category()) $type = 'archive category-archive';
        if (is_tag()) $type = 'archive tag-archive';
        if (is_author()) $type = 'archive author-archive';
        // again, these 3 are not needed since we id the body with these
        if (is_date()) $type = 'archive date-archive';
        if (is_search()) $type = 'archive search-archive';
        if (is_404()) $type = '404-error';
        // need a lot of trimming b/c any combination of these could be blank
		if($parent_id_string) {
			$classes = trim($parent_id_string . ' ' . $more_classes);
		}else{
			$classes = trim($more_classes);
		}
        if ($type) $classes = $type . ' ' . $classes;
        $classes = trim($classes);
        if ($classes) echo " class=\"$classes\"";
}

function set_pcid_post_views($postID) {
    $count_key = 'pcid_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function get_pcid_post_views($postID){
    $count_key = 'pcid_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

function limit_words($string, $word_limit) {
	$words = explode(' ', $string);

	return implode(' ', array_slice($words, 0, $word_limit));
}

function the_breadcrumbs() {
	global $post;
	echo "<p class='trail'>";
	if (!is_home()) {
		echo "<span><a href='".get_option('home')."'>Home</a></span>";

		if (is_category() || is_singular( 'post' )) {
			echo " <span class='sep'></span> ";

			$post_object = get_field('blogs_page', 'option');
			if( $post_object ){
				$post = $post_object;
				setup_postdata( $post ); 

				echo "<span class='post'><a href='".get_the_permalink()."'>" . get_the_title() . "</a></span>";

				wp_reset_postdata();
			}

			if (is_category()) {
				echo " <span class='sep'></span> <span class='single-category'>".single_cat_title( '', false )."</span>";
			}

			if (is_singular( 'post' )) {
				echo " <span class='sep'></span> <span class='single-post-".$post->ID."'>".get_the_title()."</span>";
			}
		} elseif (is_page()) {
			if($post->post_parent){
				$anc = get_post_ancestors( $post->ID );
				krsort($anc);
				//$anc_link = get_page_link( $post->post_parent );

				foreach ( $anc as $ancestor ) {
					echo " <span class='sep'></span> <span><a href=" . get_page_link( $ancestor ) . ">".get_the_title($ancestor)."</a></span> ";
				}

				echo " <span class='sep'></span> <span>".get_the_title()."</span>";
			} else {
				echo " <span class='sep'></span> ";
				echo "<span>".get_the_title()."</span>";
			}
		} elseif (is_singular('video')) {
			echo " <span class='sep'></span> ";
			$post_object = get_field('videos_page', 'option');
			if( $post_object ){
				$post = $post_object;
				setup_postdata( $post ); 
				echo "<span class='videos-page'><a href='".get_the_permalink()."'>" . get_the_title() . "</a></span>";
				wp_reset_postdata();
			}
			echo "<span class='sep'></span> <span class='single-video-".$post->ID."'>".get_the_title()."</span>";
		} elseif (is_singular('story')) {
			echo " <span class='sep'></span> ";

			$post_object = get_field('news_page', 'option');
			if( $post_object ){
				$post = $post_object;
				setup_postdata( $post ); 

				echo "<span class='news-page'><a href='".get_the_permalink()."'>" . get_the_title() . "</a></span>";

				wp_reset_postdata();
			}
			echo "<span class='sep'></span> <span class='single-news-".$post->ID."'>".get_the_title()."</span>";
		} elseif (is_singular('event')) {
			echo " <span class='sep'></span> ";

			$post_object = get_field('events_page', 'option');
			if( $post_object ){
				$post = $post_object;
				setup_postdata( $post ); 

				echo "<span class='event-page'><a href='".get_the_permalink()."'>" . get_the_title() . "</a></span>";

				wp_reset_postdata();
			}
			echo "<span class='sep'></span> <span class='single-event-".$post->ID."'>".get_the_title()."</span>";
		} elseif (is_singular('press_release')) {
			echo " <span class='sep'></span> ";

			$post_object = get_field('press_release_page', 'option');
			if( $post_object ){
				$post = $post_object;
				setup_postdata( $post ); 

				echo "<span class='press-release-page'><a href='".get_the_permalink()."'>" . get_the_title() . "</a></span>";

				wp_reset_postdata();
			}
			echo "<span class='sep'></span> <span class='single-press_release-".$post->ID."'>".get_the_title()."</span>";
		} elseif (is_search()) {
			echo " <span class='sep'></span> <span>Search results</span>"; 
		} elseif (is_404()) {
			echo " <span class='sep'></span> <span>Error 404: Page Not Found</span>"; 
		} elseif (is_tag()) {
			$current_tag = single_tag_title("", false);
			echo " <span class='sep'></span> <span>Tag Archive: ".$current_tag."</span>";
		} elseif (is_author()) {
			echo " <span class='sep'></span> <span>".get_the_author_meta('display_name')."</span>";
		}
	}
	echo "</p>";
}

class pcid_walker_nav_menu extends Walker_Nav_Menu {
	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
			);
		$class_names = implode( ' ', $classes );
	  
		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
	  
	// add main/sub classes to li's and links
	 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
	  
		// depth dependent classes
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
	  
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
	  
		// build html
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
		
		if(get_field('menu_background_image', $item->object_id)){
			$img = get_field('menu_background_image', $item->object_id);
			$menubg = $img['url'];
			$style .= '#nav-menu-item-'. $item->ID .':before{content: ""; display: block; position: absolute; left: 0; top: 0; width: 100%; height: 100%; z-index: 0; opacity: 0.1; background-image:url(' . $menubg . '); background-repeat: no-repeat; background-position: center; -ms-background-size: cover; -o-background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; background-size: cover;}';
		}
	  
		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
		
		if(get_field('menu_icon', $item->object_id) || get_field('menu_icon_hover', $item->object_id)){
			$icon = get_field('menu_icon', $item->object_id);
			$menu_icon = $icon['url'];
			$icon_hover = get_field('menu_icon_hover', $item->object_id);
			$menu_icon_hover = $icon_hover['url'];
			$icon_container = '<div class="menu-icon-container menu-icon-'. $item->ID . ' lazy-image" ' . ($menu_icon ? 'data-src="' . $menu_icon . '"' : '') . '></div>';
			if($icon_hover){
				$style .= '#nav-menu-item-'. $item->ID .' a:hover .menu-icon-container{background-image:url(' . $menu_icon_hover . ') !important;}';
			}
		}
	  
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
			$args->before,
			$attributes,
			$args->link_before,
			$icon_container,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
	  
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		echo ($style ? '<style>' . $style . '</style>' : '');
	}
}

class wp_bootstrap_navwalker extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			if ( $args->has_children )
				$class_names .= ' dropdown';
			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			$item_output = $args->before;
			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .'><span class="glyphicon ' . strtolower(str_replace(' ', '_', esc_attr( $item->attr_title ))) . '"></span>';
			else
				$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;
        $id_field = $this->db_fields['id'];
        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {
			extract( $args );
			$fb_output = null;
			if ( $container ) {
				$fb_output = '<' . $container;
				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';
				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';
				$fb_output .= '>';
			}
			$fb_output .= '<ul';
			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';
			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';
			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';
			if ( $container )
				$fb_output .= '</' . $container . '>';
			echo $fb_output;
		}
	}
}

add_filter( 'wp_nav_menu_items', 'utility_navigation_hamburger_menu_item', 10, 2 );
function utility_navigation_hamburger_menu_item( $items, $args ) {
    if ($args->theme_location == 'utility_navigation') {
        $items .= '<li class="search-menu-item" data-toggle="collapse" data-target="#menu_searchform"><i class="fa fa-search" aria-hidden="true"></i></li>';
    }
    return $items;
}

add_action( 'init', 'cptui_register_my_cpts_news' );
function cptui_register_my_cpts_news() {
	$labels = array(
		"name" => __( 'News', 'pcid' ),
		"singular_name" => __( 'News', 'pcid' ),
		"search_items" => __( 'Search News', 'pcid' ),
		"all_items" => __( 'All News', 'pcid' ),
		"edit_item" => __( 'Edit News', 'pcid' ),
		"update_item" => __( 'Update News', 'pcid' ),
		"add_new_item" => __( 'Add New News', 'pcid' ),
		"new_item_name" => __( 'New News', 'pcid' ),
		"menu_name" => __( 'News', 'pcid' ),
		);

	$args = array(
		"label" => __( 'News', 'pcid' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "story", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,"menu_icon" => "dashicons-media-document",
		"supports" => array( "title", "editor", "thumbnail", "page-attributes", "excerpt" ),		
		"taxonomies" => array( "department", "category", "post_tag" ),
			);
	register_post_type( "story", $args );

// End of cptui_register_my_cpts_news()
}

add_action( 'init', 'cptui_register_my_cpts_press_release' );
function cptui_register_my_cpts_press_release() {
	$labels = array(
		"name" => __( 'Announcements & Press Releases', 'pcid' ),
		"singular_name" => __( 'Announcements & Press Releases', 'pcid' ),
		"search_items" => __( 'Search Announcements & Press Releases', 'pcid' ),
		"all_items" => __( 'All Announcements & Press Releases', 'pcid' ),
		"edit_item" => __( 'Edit Announcements & Press Releases', 'pcid' ),
		"update_item" => __( 'Update Announcements & Press Releases', 'pcid' ),
		"add_new_item" => __( 'Add New Announcements & Press Releases', 'pcid' ),
		"new_item_name" => __( 'New Announcements & Press Releases', 'pcid' ),
		"menu_name" => __( 'Announcements & Press Releases', 'pcid' ),
		);

	$args = array(
		"label" => __( 'Announcements & Press Releases', 'pcid' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "press_release", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,"menu_icon" => "dashicons-megaphone",
		"supports" => array( "title", "editor", "thumbnail", "page-attributes", "excerpt" ),		
		"taxonomies" => array( "department", "category", "post_tag" ),
			);
	register_post_type( "press_release", $args );

// End of cptui_register_my_cpts_press_release()
}

add_action( 'init', 'cptui_register_my_cpts_event' );
function cptui_register_my_cpts_event() {
	$labels = array(
		"name" => __( 'Events', 'pcid' ),
		"singular_name" => __( 'Event', 'pcid' ),
		"search_items" => __( 'Search Events', 'pcid' ),
		"all_items" => __( 'All Events', 'pcid' ),
		"edit_item" => __( 'Edit Event', 'pcid' ),
		"update_item" => __( 'Update Event', 'pcid' ),
		"add_new_item" => __( 'Add New Event', 'pcid' ),
		"new_item_name" => __( 'New Event', 'pcid' ),
		"menu_name" => __( 'Event', 'pcid' ),
		);

	$args = array(
		"label" => __( 'Events', 'pcid' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "event", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,"menu_icon" => "dashicons-calendar-alt",
		"supports" => array( "title", "editor", "thumbnail", "page-attributes", "excerpt" ),		
		"taxonomies" => array( "department", "category", "post_tag" ),
			);
	register_post_type( "event", $args );

// End of cptui_register_my_cpts_event()
}

add_action( 'init', 'cptui_register_my_cpts_video' );
function cptui_register_my_cpts_video() {
	$labels = array(
		"name" => __( 'Videos', 'pcid' ),
		"singular_name" => __( 'Video', 'pcid' ),
		"search_items" => __( 'Search Videos', 'pcid' ),
		"all_items" => __( 'All Videos', 'pcid' ),
		"edit_item" => __( 'Edit Video', 'pcid' ),
		"update_item" => __( 'Update Video', 'pcid' ),
		"add_new_item" => __( 'Add New Video', 'pcid' ),
		"new_item_name" => __( 'New Video', 'pcid' ),
		"menu_name" => __( 'Video', 'pcid' ),
		);
	$args = array(
		"label" => __( 'Videos', 'pcid' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "video", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,"menu_icon" => "dashicons-video-alt3",
		"supports" => array( "title", "thumbnail", "page-attributes" ),
		"taxonomies" => array( "category", "post_tag" ),
			);	register_post_type( "video", $args );
// End of cptui_register_my_cpts_video()
}

add_action( 'init', 'cptui_register_my_cpts_slider' );
function cptui_register_my_cpts_slider() {
	$labels = array(
		"name" => __( 'Sliders', 'pcid' ),
		"singular_name" => __( 'Slider', 'pcid' ),
		"search_items" => __( 'Search Sliders', 'pcid' ),
		"all_items" => __( 'All Sliders', 'pcid' ),
		"edit_item" => __( 'Edit Slider', 'pcid' ),
		"update_item" => __( 'Update Slider', 'pcid' ),
		"add_new_item" => __( 'Add New Slider', 'pcid' ),
		"new_item_name" => __( 'New Slider', 'pcid' ),
		"menu_name" => __( 'Slider', 'pcid' ),
		);

	$args = array(
		"label" => __( 'Sliders', 'pcid' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
				"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "slider", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,"menu_icon" => "dashicons-slides",
		"supports" => array( "title", "editor", "thumbnail", "page-attributes" ),
		"taxonomies" => array( "slider_position" ),
);
	register_post_type( "slider", $args );

// End of cptui_register_my_cpts_slider()
}

add_action( 'init', 'cptui_register_my_taxes_slider_position' );
function cptui_register_my_taxes_slider_position() {
	$labels = array(
		"name" => __( 'Slider Position', 'pcid' ),
		"singular_name" => __( 'Slider Position', 'pcid' ),
		"search_items" => __( 'Search Slider Positions', 'pcid' ),
		"all_items" => __( 'All Slider Positions', 'pcid' ),
		"parent_item" => __( 'Parent Slider Position', 'pcid' ),
		"parent_item_colon" => __( 'Parent Slider Position:', 'pcid' ),
		"edit_item" => __( 'Edit Slider Position', 'pcid' ),
		"update_item" => __( 'Update Slider Position', 'pcid' ),
		"add_new_item" => __( 'Add New Slider Position', 'pcid' ),
		"new_item_name" => __( 'New Slider Position', 'pcid' ),
		"menu_name" => __( 'Slider Position', 'pcid' ),
		);

	$args = array(
		"label" => __( 'Slider Position', 'pcid' ),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Slider Position",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'slider_position', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);
	register_taxonomy( "slider_position", array( "slider" ), $args );

// End cptui_register_my_taxes_slider_position()
}

/**
 * Abstract class for counting shares 
 */
interface Share_Counter {
  
  /**
   * Getting the share count
   */
  public static function get_share_count( $url );
  
}

/**
 * Facebook Shares
 */
class FacebookShareCount implements Share_Counter {
	public static function get_share_count( $url ) {
		$facebook_app_id = "1653375018291061";
		$facebook_app_secret = "da4c1cc40cd1fd86689b6c63671dc0b9";
		$access_token = $facebook_app_id . '|' . $facebook_app_secret;
		$check_url = 'https://graph.facebook.com/v2.7/?id=' . urlencode(  $url ) . '&fields=share&access_token=' . $access_token;
		$response = wp_remote_retrieve_body( wp_remote_get( $check_url ) );
		$encoded_response = json_decode( $response, true );
		$share_count = intval( $encoded_response['share']['share_count'] );
		return $share_count;
	}
}

/**
 * Twitter Shares
 */
class TwitterShareCount implements Share_Counter {
	public static function get_share_count( $url ) {
		$check_url = 'http://public.newsharecounts.com/count.json?url=' . urlencode( $url );
		$response = wp_remote_retrieve_body( wp_remote_get( $check_url ) );
		$encoded_response = json_decode( $response, true );
		$share_count = intval( $encoded_response['count'] ); 
		return $share_count;
	}
}

/**
 * Google+ Shares
 */
class GoogleShareCount implements Share_Counter {
	public static function get_share_count( $url ) {
		if( !$url ) {
	    	return 0;
	    }
		if ( !filter_var($url, FILTER_VALIDATE_URL) ){
			return 0;
		}
	    foreach (array('apis', 'plusone') as $host) {
	        $ch = curl_init(sprintf('https://%s.google.com/u/0/_/+1/fastbutton?url=%s',
	                                      $host, urlencode($url)));
	        curl_setopt_array($ch, array(
	            CURLOPT_FOLLOWLOCATION => 1,
	            CURLOPT_RETURNTRANSFER => 1,
	            CURLOPT_SSL_VERIFYPEER => 0,
	            CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 6.1; WOW64) ' .
	                                      'AppleWebKit/537.36 (KHTML, like Gecko) ' .
	                                      'Chrome/32.0.1700.72 Safari/537.36' ));
	        $response = curl_exec($ch);
	        $curlinfo = curl_getinfo($ch);
	        curl_close($ch);
	        if (200 === $curlinfo['http_code'] && 0 < strlen($response)) { break 1; }
	        $response = 0;
	    }
	    
	    if( !$response ) {
	    		return 0;
	    }
	    preg_match_all('/window\.__SSR\s\=\s\{c:\s(\d+?)\./', $response, $match, PREG_SET_ORDER);
	    return (1 === sizeof($match) && 2 === sizeof($match[0])) ? intval($match[0][1]) : 0;
	}
}

/**
 * LinkedIN Shares
 */
class LinkedINShareCount implements Share_Counter {
	public static function get_share_count( $url ) {
		$remote_get = json_decode( file_get_contents('https://www.linkedin.com/countserv/count/share?url=' . urlencode( $url ) . '&format=json'), true);
		 
		$share_count = $remote_get['count'];
		return $share_count; 
	}
}

/**
 * Pinterest Shares
 */
class PinterestShareCount implements Share_Counter {
	public static function get_share_count( $url ) {
		$check_url = 'http://api.pinterest.com/v1/urls/count.json?callback=pin&url=' . urlencode( $url );
		$response = wp_remote_retrieve_body( wp_remote_get( $check_url ) );
		 
		$response = str_replace( 'pin({', '{', $response);
		$response = str_replace( '})', '}', $response);
		$encoded_response = json_decode( $response, true );
		 
		$share_count = intval( $encoded_response['count'] ); 
		return $share_count;
	}
}

/**
 * StumbleUpon Shares
 */
class StumbleUponShareCount implements Share_Counter {
	public static function get_share_count( $url ) {
		$check_url = 'http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . urlencode( $url );
		$response = wp_remote_retrieve_body( wp_remote_get( $check_url ) );
		$encoded_response = json_decode( $response, true );
		$share_count = intval( $encoded_response['result']['views'] ); 
		return $share_count;
	}
}

?>