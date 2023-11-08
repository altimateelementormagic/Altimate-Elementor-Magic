<?php
namespace AEM_Addons_Elementor\classes;
class Helper {
    /**
     *
     * Get list of Post Types
     * @return array
     */

    public static function aem_get_post_types() {
        $post_type_args = array(
            'public'            => true,
            'show_in_nav_menus' => true
        );

        $post_types = get_post_types($post_type_args, 'objects');
        $post_lists = array();
        foreach ($post_types as $post_type) {
            $post_lists[$post_type->name] = $post_type->labels->singular_name;
        }
        return $post_lists;
    }

    /**
     * Custom wp_ksese function
     * 
     * @param string
     * @return array
     */
    public static function aem_wp_kses( $string ) {
        $allowed_html = [
            'b' => [],
            's' => [],
            'strong' => [],
            'i' => [],
            'u' => [],
            'br' => [],
            'em' => [],
            'del' => [],
            'ins' => [],
            'sup' => [],
            'sub' => [],
            'code' => [],
            'small' => [],
            'strike' => [],
            'abbr' => [
                'title' => [],
            ],
            'span' => [
                'class' => [],
            ],
            'a' => [
				'href' => [],
				'title' => [],
				'class' => [],
				'id' => [],
			],
			'img' => [
				'src' => [],
				'alt' => [],
				'height' => [],
				'width' => [],
			],
			'hr' => [],
        ];
        return wp_kses( $string, $allowed_html );
    }


    /**
     * Retrive the list of Contact Form 7 Forms [ if plugin activated ]
     */
    
    public static function aem_retrive_contact_form() {
        // if ( function_exists( 'wpcf7' ) ) {
            $wpcf7_form_list = get_posts(array(
                'post_type' => 'wpcf7_contact_form',
                'showposts' => 999,
            ));
            $options = array();
            $options[0] = esc_html__( 'Select a Form', 'exclusive-addons-elementor' );
            if ( ! empty( $wpcf7_form_list ) && ! is_wp_error( $wpcf7_form_list ) ){
                foreach ( $wpcf7_form_list as $post ) {
                    $options[ $post->ID ] = $post->post_title;
                }
            } else {
                $options[0] = esc_html__( 'Create a Form First', 'exclusive-addons-elementor' );
            }
            return $options;
        // }
    }

    /** 
     *
     * List all categories 
     * @return array
     */

    public static function aem_get_all_categories() {
        $cat_array = array();
        $categories = get_categories('orderby=name&hide_empty=0');
        foreach ($categories as $category):
            $cat_array[$category->term_id] = $category->name;
        endforeach;

        return $cat_array;
    }

    /** 
     *
     * List all Tags 
     * @return array
     */

    public static function aem_get_all_tags() {
        $tag_array = array();
        $tags = get_tags();
        foreach ( $tags as $tag ) {
            $tag_array[$tag->term_id] = $tag->name;
        }

        return $tag_array;
    } 


    /**
     * All Author with published post
     * @return array
     */
    public static function aem_get_authors() {
        $user_query = new \WP_User_Query(
            [
                // 'who' => 'authors', //who is deprecated Use capability instead
                'has_published_posts' => true,
                'fields' => [
                    'ID',
                    'display_name',
                ],
            ]
        );

        $authors = array();

        foreach ( $user_query->get_results() as $result ) {
            $authors[ $result->ID ] = $result->display_name;
        }

        return $authors;
    }

    /**
     * All post title
     * @return array
     */
    public static function aem_get_all_posts() {
		
		$posts = [];
        $args = array(
            'posts_per_page' => -1,
			'fields' => [
				'ID',
				'post_title'
			]
        );
		
        $query = get_posts( $args );
		
        foreach ( $query as $post ) {
			
            $posts[$post->ID] = $post->post_title;
        }
		
		wp_reset_postdata();

        return $posts;
    } 

    /**
     *
     * Post Excerpt based on ID and Excerpt Length
     * @param  int $post_id
     * @param  int $length
     * @return string
     *
     */
    public static function aem_get_post_excerpt( $post_id, $length ){
        $the_post = get_post($post_id);

        $the_excerpt = '';
        if ($the_post)
        {
            $the_excerpt = $the_post->post_excerpt ? $the_post->post_excerpt : $the_post->post_content;
        }

        $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
        $words = explode(' ', $the_excerpt, intval( $length ) + 1);

        
        if(count($words) > $length) :
            array_pop($words);
            array_push($words, '…');
            $the_excerpt = implode(' ', $words);
        endif;

        return $the_excerpt;
    }


    /**
     *
     * @return Array of Post arguments based on Post Style prefix
     *
     *
     */

    public static function aem_get_post_arguments( $settings, $prefix ) {

        $author_ids = implode( ", ", $settings[ $prefix . '_authors'] );

        if ( isset( $settings[ $prefix . '_categories'] ) ) {
            $category_ids = implode( ", ", $settings[ $prefix . '_categories'] );
        } else {
            $category_ids = [];
        }

        if ( 'yes' === $settings[ $prefix . '_ignore_sticky'] ) {
            $aem_ignore_sticky = true;
        } else {
            $aem_ignore_sticky = false;
        }

        $post_args = array(
            'post_type'        => $settings[ $prefix . '_type'],
            'posts_per_page'   => $settings[ $prefix .'_per_page'],
            'offset'           => $settings[ $prefix . '_offset'],
            'cat'              => $category_ids,
            'category_name'    => '',
            'ignore_sticky_posts' => $aem_ignore_sticky,
            'orderby'          => $settings[ $prefix . '_order_by' ],
            'order'            => $settings[ $prefix . '_order'],
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'author'           => $author_ids,
            'author_name'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => false,
            'tag__in'          => $settings[ $prefix . '_tags'],
            'post__not_in'     => $settings[ $prefix . '_exclude_post' ],
        );

        return $post_args;

    }

    /**
     *
     * Get the categories as list
     *
     */
    public static function aem_get_categories_for_post() {

        $categories = get_the_category();
        $separator = ' ';
        $output = '';
        if ( ! empty( $categories ) ) {
            foreach( $categories as $category ) {
                $output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'exclusive-addons-elementor' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></li>' . $separator;
            }
            echo trim( $output, $separator );
        }
    }

    /**
     * READING TIME
     *
     * Calculate an approximate reading-time for a post.
     *
     * @param  string $content The content to be measured.
     * @return  integer Reading-time in seconds.
     */
    public static function aem_reading_time( $content ) {
        
        $word_count = str_word_count( strip_tags( $content ) );
        $readingtime = ceil($word_count / 200);
    
        $timer = __( ' min read', 'exclusive-addons-elementor' );
        
        $totalreadingtime = $readingtime . $timer;
    
        return $totalreadingtime;
    }

    /**
     * 
     * Return the Posts from Database
     *
     * @return string of an html markup with AJAX call.
     * @return array of content and found posts count without AJAX call.
     */

    public static function aem_get_posts( $settings ) {
        
        $posts = new \WP_Query( $settings['post_args'] );

        while( $posts->have_posts() ) : $posts->the_post(); 

            if ( 'aem-post-timeline' === $settings['template_type'] ) { 
                include AEM_TEMPLATES . 'tmpl-post-timeline.php';
            } elseif ( 'aem-post-grid' === $settings['template_type'] || 'aem-filterable-post' === $settings['template_type']) { 
                include AEM_TEMPLATES . 'tmpl-post-grid.php';
            } else {
                _e( 'No Contents Found', 'exclusive-addons-elementor' );
            }

        endwhile;
        wp_reset_postdata();
    }

    /**
     * Contain masking shape list
     * @param $element
     * @return array
     */
    public static function aem_masking_shape_list( $element ) {
        $dir = AEM_ASSETS_URL . 'img/masking/';
        $shape_name = 'shape-';
        $extension = '.svg';
        $list = [];
        if ( 'list' == $element ) {
            for ($i = 1; $i <= 64; $i++) {
                $list[$shape_name.$i] = [
                    'title' => ucwords($shape_name.''.$i),
                    'url' => $dir . $shape_name . $i . $extension,
                ];
            }
        } elseif ( 'url' == $element ) {
            for ($i = 1; $i <= 64; $i++) {
                $list[$shape_name.$i] = $dir . $shape_name . $i . $extension;
            }
        }
        return $list;
    }

    /**
     * filterable Post use category name as class name
     * @param $element
     * @return array class name to filterable Post control items
     */
    public static function aem_get_categories_name_for_class( ) {
        $separator = ' ';
        $cat_name_as_class = '';
        $post_type = get_post_type(get_the_ID());   
        $taxonomies = get_object_taxonomies($post_type);   
        $taxonomy_slugs = wp_get_object_terms(get_the_ID(), $taxonomies,  array("fields" => "slugs"));
        
            foreach($taxonomy_slugs as $tax_slug) :            
                $cat_name_as_class .= $tax_slug . $separator ; 
            endforeach;
            return trim( $cat_name_as_class, $separator );
         
    }

    /**
     * Get Custom Post terms name and slug
     * @param $element
     * @return array terms name and terms links
     */
    public static function aem_get_terms_custom_post( ) {
        $separator = ' ';
        $cat_name_as_class = '';
        $post_type = get_post_type( get_the_ID() );   
        $taxonomies = get_object_taxonomies( $post_type );   
        $taxonomy_terms = wp_get_object_terms( get_the_ID(), $taxonomies );
 
        foreach( $taxonomy_terms as $term ) :   
            $cat_name_as_class .= '<li><a class="' . esc_attr( $term->slug ) . '" href="' . esc_url( get_term_link( $term->term_id ) ) . '">' .  esc_html( $term->name ) . '</a></li>' ; 
        endforeach;

        echo $cat_name_as_class;
         
    }

	/**
	** Get Terms of Taxonomy
	*/
	public static function aem_get_terms_by_taxonomy( $slug ) {
		if ( ( 'product_cat' === $slug || 'product_tag' === $slug ) && ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$query = get_terms( $slug, [ 'hide_empty' => false, 'posts_per_page' => -1 ] );
		$taxonomies = [];

		foreach ( $query as $tax ) {
			$taxonomies[$tax->term_id] = $tax->name;
		}

		wp_reset_postdata();

		return $taxonomies;
	}

    /**
	** Get Available Custom Post Types or Taxonomies
	*/
	public static function aem_get_custom_types_of( $query, $exclude_defaults = true ) {
		// Taxonomies
		if ( 'tax' === $query ) {
			$custom_types = get_taxonomies( [ 'show_in_nav_menus' => true ], 'objects' );
		
		// Post Types
		} else {
			$custom_types = get_post_types( [ 'show_in_nav_menus' => true ], 'objects' );
		}

		$custom_type_list = [];

		foreach ( $custom_types as $key => $value ) {
			if ( $exclude_defaults ) {
				if ( $key != 'post' && $key != 'page' && $key != 'category' && $key != 'post_tag' ) {
					$custom_type_list[ $key ] = $value->label;
				}
			} else {
				$custom_type_list[ $key ] = $value->label;
			}
		}

		return $custom_type_list;
	}

    /**
	** Get Posts of Post Type for exclude
	*/
	public static function aem_get_posts_by_post_type( $slug ) {
		
		$query_args = [
			'post_type' => $slug,
			'post_status' => [ 'publish', 'private' ],
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC'
		];
		
		$posts_query = new \WP_Query( $query_args );
		
		$posts = [];
		
		if ( $posts_query->have_posts() ) {
			
			foreach ( $posts_query->get_posts() as $post ) {
				
				$posts[$post->ID] = $post->post_title;
			}
		}
		
		return $posts;
	}


    /**
     *
     * @return Array of Post arguments based on Post Style prefix
     *
     *
     */

    public static function aem_get_post_carousel_arguments( $settings, $prefix ) {

        $author_ids = implode( ", ", $settings[ $prefix . '_authors'] );

        if ( isset( $settings[ $prefix . '_categories'] ) ) {
            $category_ids = implode( ", ", $settings[ $prefix . '_categories'] );
        } else {
            $category_ids = [];
        }

        if ( 'yes' === $settings[ $prefix . '_ignore_sticky'] ) {
            $aem_ignore_sticky = true;
        } else {
            $aem_ignore_sticky = false;
        }

        if ( ! empty ( $settings[ $prefix . '_type'] && 'post' === $settings[ $prefix . '_type'] ) ) {
            $post_not_in = $settings[ $prefix . '_exclude_post' ] ? $settings[ $prefix . '_exclude_post' ] : null;
        } else {
            $post_not_in = $settings[  'aem_query_exclude_' . $settings[ $prefix . '_type' ] ] ? $settings[  'aem_query_exclude_' . $settings[ $prefix . '_type' ] ] : null; 
        }

        $post_args = array(
            'post_type'        => $settings[ $prefix . '_type'],
            'posts_per_page'   => $settings[ $prefix .'_per_page'],
            'tax_query'        => self::get_tax_query_args($settings),
            'offset'           => $settings[ $prefix . '_offset'],
            'cat'              => $category_ids,
            'category_name'    => '',
            'ignore_sticky_posts' => $aem_ignore_sticky,
            'orderby'          => $settings[ $prefix . '_order_by' ],
            'order'            => $settings[ $prefix . '_order'],
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'author'           => $author_ids,
            'author_name'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => false,
            'tag__in'          => $settings[ $prefix . '_tags'],
            'post__not_in'     => $post_not_in,
        );

        return $post_args;

    }

    // Taxonomy Query Args
	public static function get_tax_query_args( $settings ) {
		
		$tax_query = [];
        $exclude_terms = [];

        foreach ( get_object_taxonomies( $settings[ 'aem_post_carousel_type' ] ) as $tax ) {
            if ( ! empty( $settings[ 'aem_query_taxonomy_'. $tax  ] ) ) {
                array_push( $tax_query, [
                    'taxonomy' => $tax,
                    'field' => 'id',
                    'terms' => $settings[ 'aem_query_taxonomy_'. $tax ]
                ] );
            }

           
            if ( ( 'post' !== $settings[ 'aem_post_carousel_type' ] ) && ( 'product' !== $settings[ 'aem_post_carousel_type' ] ) ) {
        
                $exclude_terms = $settings[ 'aem_query_exclude_terms_'. $tax ] ;
       
                if ( ! empty( $exclude_terms ) ) {
                    array_push( $tax_query, [
                        'taxonomy' => $tax,
                        'field'    => 'term_id',
                        'terms'    => $settings[ 'aem_query_exclude_terms_'. $tax ],
                        'operator' => 'NOT IN',
                    ] );
                }
            }
          
            
        }

		return $tax_query;
	}


    // Title Tags
    public static function aem_title_tags() {
        
        $title_tags = [
            'h1'   => 'H1',
            'h2'   => 'H2',
            'h3'   => 'H3',
            'h4'   => 'H4',
            'h5'   => 'H5',
            'h6'   => 'H6',
            'div'  => 'div',
            'span' => 'span',
            'p'    => 'p',
        ];

        return $title_tags;
    }

    // To Get the local plugin basic data
    public static function aem_get_local_plugin_data( $basename = '' ) {
        if ( empty( $basename ) ) {
            return false;
        }

        if ( !function_exists( 'get_plugins' ) ) {
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $plugins = get_plugins();

        if ( !isset( $plugins[ $basename ] ) ) {
            return false;
        }

        return $plugins[ $basename ];
    }
    // woocommerce 
    public static function aem_addons_get_post_list( $posttype, $args = [] ) {
        $postes = [];
        $limit = 20;
        if( !empty( $args['limit'] ) ){
            $limit = $args['limit'];
        }
    
        $get_post_list = get_posts( [
            'post_type'      => $posttype,
            'post_status'    => 'publish',
            'posts_per_page' => $limit,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );
    
        if ( ! empty( $get_post_list ) ) {
            $postes = wp_list_pluck( $get_post_list, 'post_title', 'ID' );
        }
    
        return $postes;
    }
    public static function aem_addons_get_taxonomies( $texonomy = 'category' ){
        $categories = [];
    
        $terms = get_terms( array(
            'taxonomy' => $texonomy,
            'hide_empty' => true,
        ));
        if ( ! empty( $terms ) ){
            $categories = wp_list_pluck( $terms, 'name', 'slug' );
        }
        return $categories;
    }
    public static function aem_addons_elementor_version( $operator = '<', $version = '2.6.0' ) {
        if( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator ) ) 
        { 
            return true; 
        } else{ 
            return false; 
        }
    }
    public static function aem_addons_render_icon( $settings = [], $new_icon = 'selected_icon', $old_icon = 'icon', $attributes = [] ){

        $migrated = isset( $settings['__fa4_migrated'][$new_icon] );
        $is_new = empty( $settings[$old_icon] ) && \Elementor\Icons_Manager::is_migration_allowed();
    
        $attributes['aria-hidden'] = 'true';
        $output = '';
    
        if ( self::aem_addons_elementor_version( '>=', '2.6.0' ) && ( $is_new || $migrated ) ) {
    
            if ( empty( $settings[$new_icon]['library'] ) ) {
                return false;
            }
    
            $tag = 'i';
            // handler SVG Icon
            if ( 'svg' === $settings[$new_icon]['library'] ) {
                if ( ! isset( $settings[$new_icon]['value']['id'] ) ) {
                    return '';
                }
                $output = Elementor\Core\Files\Assets\Svg\Svg_Handler::get_inline_svg( $settings[$new_icon]['value']['id'] );
    
            } else {
                $icon_types = \Elementor\Icons_Manager::get_icon_manager_tabs();
                if ( isset( $icon_types[ $settings[$new_icon]['library'] ]['render_callback'] ) && is_callable( $icon_types[ $settings[$new_icon]['library'] ]['render_callback'] ) ) {
                    return call_user_func_array( $icon_types[ $settings[$new_icon]['library'] ]['render_callback'], [ $settings[$new_icon], $attributes, $tag ] );
                }
    
                if ( empty( $attributes['class'] ) ) {
                    $attributes['class'] = $settings[$new_icon]['value'];
                } else {
                    if ( is_array( $attributes['class'] ) ) {
                        $attributes['class'][] = $settings[$new_icon]['value'];
                    } else {
                        $attributes['class'] .= ' ' . $settings[$new_icon]['value'];
                    }
                }
                $output = '<' . $tag . ' ' . \Elementor\Utils::render_html_attributes( $attributes ) . '></' . $tag . '>';
            }
    
        } else {
            if ( empty( $attributes['class'] ) ) {
                $attributes['class'] = $settings[ $old_icon ];
            } else {
                if ( is_array( $attributes['class'] ) ) {
                    $attributes['class'][] = $settings[ $old_icon ];
                } else {
                    $attributes['class'] .= ' ' . $settings[ $old_icon ];
                }
            }
            $output = sprintf( '<i %s></i>', \Elementor\Utils::render_html_attributes( $attributes ) );
        }
    
        return $output;
     
    }
    /**
 * [aem_addons_get_taxonomie_list]
 * @param  integer  $id product id
 * @param  string  $taxonomy
 * @param  integer $limit 
 * @return [void] 
 */
public static function aem_addons_get_taxonomie_list( $limit = 1, $taxonomy = 'product_cat', $id = null ) { 
    $terms = get_the_terms( $id, $taxonomy );
    $i = 0;
    if ( is_wp_error( $terms ) )
        return $terms;

    if ( empty( $terms ) )
        return false;

    foreach ( $terms as $term ) {
        $i++;
        $link = get_term_link( $term, $taxonomy );
        if ( is_wp_error( $link ) ) {
            return $link;
        }
        echo '<li><a href="' . esc_url( $link ) . '">' . $term->name . '</a></li>';
        if( $i == $limit ){
            break;
        }else{ continue; }
    }
}

}
