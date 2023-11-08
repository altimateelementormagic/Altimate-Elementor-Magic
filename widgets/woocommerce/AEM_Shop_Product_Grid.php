<?php

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use AEM_Addons_Elementor\classes\Helper;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AEM_Shop_Product_Grid extends Widget_Base {

    public function get_name() {
        return 'aem-shop-product-grid';
    }

    public function get_title() {
        return esc_html__( 'Shop Product Grid', AEM_TEXTDOMAIN );
    }

    public function get_icon() {
        return 'aem aem-logo eicon-products';
    }

    public function get_keywords() {
        return [ 'aem', 'shop', 'product', 'grid', 'woocommerce', 'woocommerce grid' ];
    }

    public function get_script_depends() {
        return ['aem-slick'];
    }
    
    public function get_style_depends() {
        return ['elementor-icons-shared-0-css','elementor-icons-fa-brands','elementor-icons-fa-regular','elementor-icons-fa-solid'];
    }


    public function get_categories() {
		return [ 'aem-category' ];
	}

    protected function register_controls() {

        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Layout', AEM_TEXTDOMAIN ),
            ]
        );
            
            $this->add_control(
                'layout',
                [
                    'label' => esc_html__( 'Layout', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'one',
                    'options' => [
                        'one'    => esc_html__( 'Layout One', AEM_TEXTDOMAIN ),
                        'two'    => esc_html__( 'Layout Two', AEM_TEXTDOMAIN ),
                        'three'  => esc_html__( 'Layout Three', AEM_TEXTDOMAIN ),
                    ],
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'query_setting_section',
            [
                'label' => esc_html__( 'Query Settings', AEM_TEXTDOMAIN ),
            ]
        );
            $this->add_control(
                'product_grid_product_filter',
                [
                    'label' => esc_html__( 'Filter By', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'recent',
                    'options' => [
                        'recent' => esc_html__( 'Recent Products', AEM_TEXTDOMAIN ),
                        'featured' => esc_html__( 'Featured Products', AEM_TEXTDOMAIN ),
                        'best_selling' => esc_html__( 'Best Selling Products', AEM_TEXTDOMAIN ),
                        'sale' => esc_html__( 'Sale Products', AEM_TEXTDOMAIN ),
                        'top_rated' => esc_html__( 'Top Rated Products', AEM_TEXTDOMAIN ),
                        'mixed_order' => esc_html__( 'Random Products', AEM_TEXTDOMAIN ),
                        'show_byid' => esc_html__( 'Show By Id', AEM_TEXTDOMAIN ),
                        'show_byid_manually' => esc_html__( 'Add ID Manually', AEM_TEXTDOMAIN ),
                    ],
                ]
            );

            $this->add_control(
                'product_id',
                [
                    'label' => esc_html__( 'Select Product', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => Helper::aem_addons_get_post_list( 'product' ),
                    'condition' => [
                        'product_grid_product_filter' => 'show_byid',
                    ]
                ]
            );

            $this->add_control(
                'product_ids_manually',
                [
                    'label' => esc_html__( 'Product IDs', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'condition' => [
                        'product_grid_product_filter' => 'show_byid_manually',
                    ]
                ]
            );

            $this->add_control(
              'product_grid_products_count',
                [
                    'label'   => esc_html__( 'Product Limit', AEM_TEXTDOMAIN ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => 3,
                    'step'    => 1,
                ]
            );

            $this->add_control(
                'show_by_tagwise',
                [
                    'label' => esc_html__( 'Show Product By Tag Wise', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', AEM_TEXTDOMAIN ),
                    'label_off' => esc_html__( 'No', AEM_TEXTDOMAIN ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'product_grid_product_filter!' => ['show_byid','show_byid_manually'],
                    ]
                ]
            );

            $this->add_control(
                'product_grid_categories',
                [
                    'label' => esc_html__( 'Product Categories', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => Helper::aem_addons_get_taxonomies('product_cat'),
                    'condition' => [
                        'show_by_tagwise!' => 'yes',
                        'product_grid_product_filter!' => ['show_byid','show_byid_manually'],
                    ]
                ]
            );

            $this->add_control(
                'product_grid_tags',
                [
                    'label' => esc_html__( 'Product Tags', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => Helper::aem_addons_get_taxonomies( 'product_tag' ),
                    'condition' => [
                        'show_by_tagwise' => 'yes',
                        'product_grid_product_filter!' => ['show_byid','show_byid_manually'],
                    ]
                ]
            );

            $this->add_control(
                'custom_order',
                [
                    'label' => esc_html__( 'Custom order', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => esc_html__( 'Orderby', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'          => esc_html__('None',AEM_TEXTDOMAIN),
                        'ID'            => esc_html__('ID',AEM_TEXTDOMAIN),
                        'date'          => esc_html__('Date',AEM_TEXTDOMAIN),
                        'name'          => esc_html__('Name',AEM_TEXTDOMAIN),
                        'title'         => esc_html__('Title',AEM_TEXTDOMAIN),
                        'comment_count' => esc_html__('Comment count',AEM_TEXTDOMAIN),
                        'rand'          => esc_html__('Random',AEM_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'order',
                [
                    'label' => esc_html__( 'order', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC'  => esc_html__('Descending',AEM_TEXTDOMAIN),
                        'ASC'   => esc_html__('Ascending',AEM_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section();

        /* Content Options */
        $this->start_controls_section(
            'content_settings',
            [
                'label' => esc_html__( 'Content Setting', AEM_TEXTDOMAIN ),
            ]
        );
            
            $this->add_control(
                'add_to_cart_text',
                [
                    'label' => esc_html__( 'Add to Cart Button Text', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Add To Cart', AEM_TEXTDOMAIN ),
                    'placeholder' => esc_html__( 'Type your cart button text', AEM_TEXTDOMAIN ),
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'button_icon',
                [
                    'label'       => esc_html__( 'Add to Cart Button Icon', AEM_TEXTDOMAIN ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'buttonicon',
                    'default'=>[
                        'value'  => 'fas fa-plus',
                        'library'=> 'solid',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_align',
                [
                    'label'   => esc_html__( 'Add to Cart Icon Position', AEM_TEXTDOMAIN ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left'   => esc_html__( 'Left', AEM_TEXTDOMAIN ),
                        'right'  => esc_html__( 'Right', AEM_TEXTDOMAIN ),
                    ],
                    'condition' => [
                        'button_icon[value]!' => '',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_responsive_control(
                'icon_specing',
                [
                    'label' => esc_html__( 'Icon Spacing', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 10,
                    ],
                    'condition' => [
                        'button_icon[value]!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-button-icon-right .aem-product .aem-product-addtocart i'  => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .aem-button-icon-left .aem-product .aem-product-addtocart i'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'badges_heading',
                [
                    'label' => esc_html__( 'Badges', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'sale_badge_txt',
                [
                    'label' => esc_html__( 'On Sale Product Badge', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'hot_badge_txt',
                [
                    'label' => esc_html__( 'Features Product Badge', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnailsize',
                    'default' => 'large',
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'content_showing_heading',
                [
                    'label' => esc_html__( 'Content Display', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'show_badge',
                [
                    'label' => esc_html__( 'Product Badge', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', AEM_TEXTDOMAIN ),
                    'label_off' => esc_html__( 'Hide', AEM_TEXTDOMAIN ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_category',
                [
                    'label' => esc_html__( 'Category', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', AEM_TEXTDOMAIN ),
                    'label_off' => esc_html__( 'Hide', AEM_TEXTDOMAIN ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_price',
                [
                    'label' => esc_html__( 'Price', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', AEM_TEXTDOMAIN ),
                    'label_off' => esc_html__( 'Hide', AEM_TEXTDOMAIN ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_rating',
                [
                    'label' => esc_html__( 'Rating', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Show', AEM_TEXTDOMAIN ),
                    'label_off' => esc_html__( 'Hide', AEM_TEXTDOMAIN ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

        $this->end_controls_section();

        /* Column Options */
        $this->start_controls_section(
            'column_options',
            [
                'label' => esc_html__( 'Column Option', AEM_TEXTDOMAIN ),
            ]
        );

            $this->add_responsive_control(
                'column',
                [
                    'label' => esc_html__( 'Columns', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [
                        '1' => esc_html__( 'One', AEM_TEXTDOMAIN ),
                        '2' => esc_html__( 'Two', AEM_TEXTDOMAIN ),
                        '3' => esc_html__( 'Three', AEM_TEXTDOMAIN ),
                        '4' => esc_html__( 'Four', AEM_TEXTDOMAIN ),
                        '5' => esc_html__( 'Five', AEM_TEXTDOMAIN ),
                        '6' => esc_html__( 'Six', AEM_TEXTDOMAIN ),
                        '7' => esc_html__( 'Seven', AEM_TEXTDOMAIN ),
                        '8' => esc_html__( 'Eight', AEM_TEXTDOMAIN ),
                        '9' => esc_html__( 'Nine', AEM_TEXTDOMAIN ),
                        '10'=> esc_html__( 'Ten', AEM_TEXTDOMAIN ),
                    ],
                    'label_block' => true,
                    'prefix_class' => 'aem-columns%s-',
                ]
            );

            $this->add_control(
                'no_gutters',
                [
                    'label' => esc_html__( 'No Gutters', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', AEM_TEXTDOMAIN ),
                    'label_off' => esc_html__( 'No', AEM_TEXTDOMAIN ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_responsive_control(
                'item_space',
                [
                    'label' => esc_html__( 'Space', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 15,
                    ],
                    'condition'=>[
                        'no_gutters!'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-row > [class*="col-"]' => 'padding: 0  {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'item_bottom_space',
                [
                    'label' => esc_html__( 'Bottom Space', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'condition'=>[
                        'no_gutters!'=>'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-row > [class*="col-"]' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Content Style tab section
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Content Style', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'content_title_heading',
                [
                    'label' => esc_html__( 'Title', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => esc_html__( 'Typography', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label' => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'content_category_heading',
                [
                    'label' => esc_html__( 'Category', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'category_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-categories li a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'category_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-categories li a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'category_typography',
                    'label' => esc_html__( 'Typography', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .aem-product .aem-product-content .aem-product-categories li a',
                ]
            );

            $this->add_responsive_control(
                'category_margin',
                [
                    'label' => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-categories' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'content_price_heading',
                [
                    'label' => esc_html__( 'Price', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'price_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-prices span.woocommerce-Price-amount' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'price_typography',
                    'label' => esc_html__( 'Typography', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .aem-product .aem-product-content .aem-product-prices span.woocommerce-Price-amount',
                ]
            );

            $this->add_responsive_control(
                'price_margin',
                [
                    'label' => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-prices' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Action Button Style tab section
        $this->start_controls_section(
            'action_btn_style_section',
            [
                'label' => esc_html__( 'Action Button Style', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'action_btn_size',
                [
                    'label' => esc_html__( 'Size', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-action-primary li .aem-product-action-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'action_btn_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-action-primary li .aem-product-action-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('action_btn_style_tabs');
                
                // Button Normal
                $this->start_controls_tab(
                    'action_btn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ),
                    ]
                );
                    
                    $this->add_control(
                        'action_btn_color',
                        [
                            'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-action-primary li .aem-product-action-btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'action_btn_border',
                            'label' => esc_html__( 'Border', AEM_TEXTDOMAIN ),
                            'selector' => '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-action-primary li .aem-product-action-btn',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'action_btn_background',
                            'label' => esc_html__( 'Background', AEM_TEXTDOMAIN ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-action-primary li .aem-product-action-btn',
                            'exclude'=>['image'],
                        ]
                    );

                $this->end_controls_tab();

                // Button Hover
                $this->start_controls_tab(
                    'action_btn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ),
                    ]
                );
                    $this->add_control(
                        'action_btn_hover_color',
                        [
                            'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-action-primary li .aem-product-action-btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'action_btn_hover_border',
                            'label' => esc_html__( 'Border', AEM_TEXTDOMAIN ),
                            'selector' => '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-action-primary li .aem-product-action-btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'action_btn_hover_background',
                            'label' => esc_html__( 'Background', AEM_TEXTDOMAIN ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-action-primary li .aem-product-action-btn:hover',
                            'exclude'=>['image'],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            // Add to Cart Button Style
            $this->add_control(
                'cart_button_heading',
                [
                    'label' => esc_html__( 'Add To Cart Button', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'cart_btn_typography',
                    'label' => esc_html__( 'Typography', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-addtocart,{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .added_to_cart,{{WRAPPER}} .aem-product-three .aem-product-thumbnail .added_to_cart',
                ]
            );

            $this->add_responsive_control(
                'cart_btn_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-addtocart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .aem-product-three .aem-product-thumbnail .aem-product-addtocart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .aem-product-three .aem-product-thumbnail .added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'cart_btn_icon_size',
                [
                    'label' => esc_html__( 'Icon Size', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-addtocart i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .aem-product-three .aem-product-thumbnail .aem-product-addtocart i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->start_controls_tabs('cart_btn_style_tabs');
                
                // Cart Button Normal
                $this->start_controls_tab(
                    'cart_btn_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ),
                    ]
                );
                    
                    $this->add_control(
                        'cart_btn_color',
                        [
                            'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-addtocart' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .aem-product-three .aem-product-thumbnail .aem-product-addtocart' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .added_to_cart' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .aem-product-three .aem-product-thumbnail .added_to_cart' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'cart_btn_border',
                            'label' => esc_html__( 'Border', AEM_TEXTDOMAIN ),
                            'selector' => '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-addtocart,{{WRAPPER}} .aem-product-three .aem-product-thumbnail .aem-product-addtocart,{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .added_to_cart,{{WRAPPER}} .aem-product-three .aem-product-thumbnail .added_to_cart',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'cart_btn_background',
                            'label' => esc_html__( 'Background', AEM_TEXTDOMAIN ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-addtocart,{{WRAPPER}} .aem-product-three .aem-product-thumbnail .aem-product-addtocart,{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .added_to_cart,{{WRAPPER}} .aem-product-three .aem-product-thumbnail .added_to_cart',
                            'exclude'=>['image'],
                        ]
                    );

                $this->end_controls_tab();
                
                // Cart Button Hover
                $this->start_controls_tab(
                    'cart_btn_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ),
                    ]
                );
                    
                    $this->add_control(
                        'cart_btn_hover_color',
                        [
                            'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-addtocart:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .aem-product-three .aem-product-thumbnail .aem-product-addtocart:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .added_to_cart:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .aem-product-three .aem-product-thumbnail .added_to_cart:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'cart_btn_hover_border',
                            'label' => esc_html__( 'Border', AEM_TEXTDOMAIN ),
                            'selector' => '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-addtocart:hover,{{WRAPPER}} .aem-product-three .aem-product-thumbnail .aem-product-addtocart:hover,{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .added_to_cart:hover,{{WRAPPER}} .aem-product-three .aem-product-thumbnail .added_to_cart:hover',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'cart_btn_hover_background',
                            'label' => esc_html__( 'Background', AEM_TEXTDOMAIN ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .aem-product-addtocart:hover,{{WRAPPER}} .aem-product-three .aem-product-thumbnail .aem-product-addtocart:hover,{{WRAPPER}} .aem-product .aem-product-content .aem-product-heading .added_to_cart:hover,{{WRAPPER}} .aem-product-three .aem-product-thumbnail .added_to_cart:hover',
                            'exclude'=>['image'],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Badge Style tab section
        $this->start_controls_section(
            'badge_style_section',
            [
                'label' => esc_html__( 'Badge Style', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'badge_typography',
                    'label' => esc_html__( 'Typography', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-badges .aem-product-badge',
                ]
            );

            $this->add_responsive_control(
                'badge_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-badges .aem-product-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'sale_badge_color',
                [
                    'label' => esc_html__( 'Sale Badge Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-badges .aem-product-badge-sale' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'sale_badge_background',
                    'label' => esc_html__( 'Background', AEM_TEXTDOMAIN ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-badges .aem-product-badge-sale',
                    'exclude'=>['image'],
                    'fields_options'=>[
                        'background'=>[
                            'label'=>esc_html__( 'Sale Badge Background', AEM_TEXTDOMAIN )
                        ]
                    ],
                ]
            );

            $this->add_control(
                'hot_badge_color',
                [
                    'label' => esc_html__( 'Feature Badge Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-badges .aem-product-badge-hot' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'hot_badge_background',
                    'label' => esc_html__( 'Background', AEM_TEXTDOMAIN ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .aem-product .aem-product-thumbnail .aem-product-badges .aem-product-badge-hot',
                    'exclude'=>['image'],
                    'fields_options'=>[
                        'background'=>[
                            'label'=>esc_html__( 'Feature Badge Background', AEM_TEXTDOMAIN )
                        ]
                    ],
                ]
            );

        $this->end_controls_section();


    }
    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $product_type = $this->get_settings_for_display('product_grid_product_filter');
        $per_page  = $this->get_settings_for_display('product_grid_products_count');
        $custom_order_ck = $this->get_settings_for_display('custom_order');
        $orderby         = $this->get_settings_for_display('orderby');
        $order           = $this->get_settings_for_display('order');

        $this->add_render_attribute( 'area_attr', 'class', 'aem-product-grid aem-row aem-product-grid-'.$settings['layout'] );
        if( $settings['no_gutters'] === 'yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'aemno-gutters' );
        }

        // Query Argument
        $args = array(
            'post_type'             => 'product',
            'post_status'           => 'publish',
            'posts_per_page'        => $per_page,
        );

        if ( !empty( $settings['product_grid_categories'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $settings['product_grid_categories'],
                    'operator' => 'IN',
                ],
            ];
        }

        if ( !empty( $settings['product_grid_tags'] ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_tag',
                    'field'    => 'slug',
                    'terms'    => $settings['product_grid_tags'],
                    'operator' => 'IN',
                ],
            ];
        }

        // Product Type Check
        switch( $product_type ){

            case 'sale':
                $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
            break;

            case 'featured':
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
                if ( !empty( $settings['product_grid_categories'] ) ) {
                    $args['tax_query'] = [
                        [
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => $settings['product_grid_categories'],
                            'operator' => 'IN',
                        ],
                    ];
                }
                if ( !empty( $settings['product_grid_tags'] ) ) {
                    $args['tax_query'] = [
                        [
                            'taxonomy' => 'product_tag',
                            'field'    => 'slug',
                            'terms'    => $settings['product_grid_tags'],
                            'operator' => 'IN',
                        ],
                    ];
                }
            break;

            case 'best_selling':
                $args['meta_key']   = 'total_sales';
                $args['orderby']    = 'meta_value_num';
                $args['order']      = 'desc';
            break;

            case 'top_rated': 
                $args['meta_key']   = '_wc_average_rating';
                $args['orderby']    = 'meta_value_num';
                $args['order']      = 'desc';          
            break;

            case 'mixed_order':
                $args['orderby']    = 'rand';
            break;

            case 'show_byid':
                $args['post__in'] = $settings['product_id'];
            break;

            case 'show_byid_manually':
                $args['post__in'] = explode( ',', $settings['product_ids_manually'] );
            break;

            default: /* Recent */
                $args['orderby']    = 'date';
                $args['order']      = 'desc';
            break;
        }

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby'] = $orderby;
            $args['order'] = $order;
        }

        ?>
        <div class="woocommerce">
            <ul <?php echo $this->get_render_attribute_string( 'area_attr' ); ?>>
                <?php echo $this->get_products_content( $args, $settings ); ?>
            </ul>
        </div>
        <?php

    }

    public function get_products_content( $args, $settings ){

        $column = $settings['column'];
        $collumval = 'aem-col-3';
        if( $column !='' ){
            $collumval = 'aem-col-'.$column;
        }
        $item_class = array( 'aem-product-grid-item', $collumval );

        // Add to Cart Button
        $cart_btn = $button_icon = '';
        if( !empty( $settings['button_icon']['value'] ) ){

            $item_class[] = 'aem-button-icon-'.$settings['button_icon_align'];

            $button_icon = Helper::aem_addons_render_icon( $settings, 'button_icon', 'buttonicon' );
        }
        $button_text  = ! empty( $settings['add_to_cart_text'] ) ? $settings['add_to_cart_text'] : '';

        if( 'right' === $settings['button_icon_align'] ){
            $cart_btn = $button_text.$button_icon;
        }else{
            $cart_btn = $button_icon.$button_text;
        }

        // Badge Text
        $onsale_badge = !empty( $settings['sale_badge_txt'] ) ? $settings['sale_badge_txt'] : 'Sale!';
        $feature_badge = !empty( $settings['hot_badge_txt'] ) ? $settings['hot_badge_txt'] : 'Hot!';

        // Thumbanail Image size
        $image_size = 'woocommerce_thumbnail';
        $size = $settings['thumbnailsize_size'];
        if( $size === 'custom' ){
            $image_size = [
                (int)$settings['thumbnailsize_custom_dimension']['width'],
                (int)$settings['thumbnailsize_custom_dimension']['height']
            ];
        }else{
            $image_size = $size;
        }

        $products = new \WP_Query( $args );

        ob_start();

        if( $products->have_posts() ){
            while ( $products->have_posts() ) {
                $products->the_post();
                $product = wc_get_product( get_the_ID() );

                // Add to cart Button Classes
                $btn_class = 'aem-product-addtocart product_type_' . $product->get_type();

                $btn_class .= $product->is_purchasable() && $product->is_in_stock() ? ' add_to_cart_button' : '';

                $btn_class .= $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? ' ajax_add_to_cart' : '';


                $rating_width = ( ( $product->get_average_rating() / 5 ) * 100 );
                $rating_count = $product->get_rating_count();

            ?>
                <li class="<?php echo implode( " ", $item_class ); ?>">
                    <div class="aem-product aem-product-<?php echo $settings['layout']; ?>">
                        <div class="aem-product-thumbnail">
                            
                            <?php if( ( $product->is_on_sale() || $product->get_featured() ) && ( $settings['show_badge'] == 'yes') ): ?>
                                <span class="aem-product-badges">
                                    <?php if( $product->get_featured() ): ?>
                                        <span class="aem-product-badge aem-product-badge-hot"><?php echo esc_html__( $feature_badge, AEM_TEXTDOMAIN); ?></span>
                                    <?php endif; ?>

                                    <?php if( $product->is_on_sale() ): ?>
                                        <span class="aem-product-badge aem-product-badge-sale"><?php echo esc_html__( $onsale_badge, AEM_TEXTDOMAIN); ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>

                            <a href="<?php echo $product->get_permalink(); ?>" class="aem-product-image">
                                <?php echo $product->get_image($image_size); ?>
                            </a>
                            <ul class="aem-product-action aem-product-action-primary">
                                <?php
                                    if ( class_exists( 'YITH_WCWL' ) ) {
                                        echo '<li>'.aem_addons_add_to_wishlist_button().'</li>';
                                    }

                                    if( class_exists('TInvWL_Public_AddToWishlist') ){
                                        echo '<li>';
                                            \TInvWL_Public_AddToWishlist::instance()->htmloutput();
                                        echo '</li>';
                                    }
                                
                                    if( class_exists('YITH_Woocompare_Frontend') ){
                                        echo '<li>';
                                            aem_addons_compare_button(2);
                                        echo '</li>';
                                    }
                                ?>
                                <li>
                                    <a href="#" class="aem-product-action-btn aemquickview" data-quickid="<?php echo $product->get_id(); ?>">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </li>
                            </ul>
                            <?php if( $settings['layout'] == 'three' ): ?>
                                <a href="<?php echo $product->add_to_cart_url(); ?>" data-quantity="1" class="<?php echo $btn_class; ?>" data-product_id="<?php echo $product->get_id(); ?>"><?php echo __( $cart_btn, AEM_TEXTDOMAIN );?></a>
                            <?php endif;?>
                        </div>
                        <div class="aem-product-content">
                            <?php if( $settings['show_category'] == 'yes' ): ?>
                                <ul class="aem-product-categories">
                                    <?php Helper::aem_addons_get_taxonomie_list(2); ?>
                                </ul>
                            <?php endif; ?>
                            <h4 class="aem-product-heading">
                                <a href="<?php echo $product->get_permalink(); ?>" class="aem-product-title"><?php echo $product->get_title(); ?></a>
                                <?php if( $settings['layout'] != 'three' ): ?>
                                    <a href="<?php echo $product->add_to_cart_url(); ?>" data-quantity="1" class="<?php echo $btn_class; ?>" data-product_id="<?php echo $product->get_id(); ?>"><?php echo __( $cart_btn, AEM_TEXTDOMAIN );?></a>
                                <?php endif; ?>
                            </h4>

                            <?php if( 0 < $rating_count && $settings['show_rating'] == 'yes' ): ?>
                                <div class="aem-product-rattings">
                                    <span class="aem-product-ratting">
                                        <span class="aem-product-star" style="width:<?php echo esc_attr( $rating_width );?>%">
                                        </span>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <?php if( $settings['show_price'] == 'yes' ): ?>
                            <div class="aem-product-prices">
                                <?php echo $product->get_price_html(); ?>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </li>
            <?php
            }
        }else{
            echo __('<p>No product found.</p>', AEM_TEXTDOMAIN);
        }

        wp_reset_postdata();
        return ob_get_clean();
    }
}