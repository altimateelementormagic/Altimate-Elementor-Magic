<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use AEM_Addons_Elementor\classes\Helper;

class AEM_Pricing_Menu extends Widget_Base {
    
    public function get_name() {
        return 'aem-pricing-menu';
    }

    public function get_title() {
        return esc_html__( 'Pricing Menu', AEM_TEXTDOMAIN );
    }

    public function get_icon() {
        return 'aem aem-logo eicon-price-list';
    }

    public function get_categories() {
        return [ 'aem-category' ];
    }

    public function get_keywords() {
        return [ 'list', 'product', 'image', 'menu', 'price' ];
    }

    protected function register_controls() {
        $aem_primary_color = get_option( 'aem_primary_color_option', '#7a56ff' );
        
        /**
         * Pricing Menu Content
         */
        $this->start_controls_section(
            'aem_section_pricing_menu_content',
            [
                'label' => esc_html__( 'Content', AEM_TEXTDOMAIN )
            ]
        );

        $price_menu_repeater = new Repeater();

        $price_menu_repeater->add_control(
            'aem_pricing_menu_image',
            [
                'label'   => esc_html__( 'Image', AEM_TEXTDOMAIN ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ],
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $price_menu_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'aem_pricing_menu_image_size',
				'default'   => 'medium_large',
				'condition' => [
					'aem_pricing_menu_image[url]!' => ''
				]
			]
		);

        $price_menu_repeater->add_control(
            'aem_pricing_menu_title',
            [
                'label'   => esc_html__('Title', AEM_TEXTDOMAIN),
                'type'    => Controls_manager::TEXT,
                'default' => esc_html__( 'Name The Product', AEM_TEXTDOMAIN ),
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $price_menu_repeater->add_control(
            'aem_pricing_menu_description',
            [
                'label'   => esc_html__('Description', AEM_TEXTDOMAIN),
                'type'    => Controls_manager::TEXTAREA,
                'default' => esc_html__( 'List Items. Add as many as you would like.', AEM_TEXTDOMAIN ),
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $price_menu_repeater->add_control(
            'aem_pricing_menu_price',
            [
                'label'   => __( 'Price', AEM_TEXTDOMAIN ),
                'type'    => Controls_Manager::TEXT,
                'default' => '$14'
            ]
        );

        $price_menu_repeater->add_control(
            'aem_pricing_menu_enable_link',
            [
                'label'        => __( 'Enable Order Button', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $price_menu_repeater->add_control(
            'aem_pricing_menu_action_text',
            [
                'label'     => esc_html__('Order Action', AEM_TEXTDOMAIN),
                'type'      => Controls_manager::TEXT,
                'default'   => 'Order Now',
                'condition' => [
                    'aem_pricing_menu_enable_link' => 'yes'
                ],
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $price_menu_repeater->add_control(
            'aem_pricing_menu_btn_link',
            [
                'label'       => esc_html__( 'Link', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
                'default'     => [
                    'url'         => '#',
                    'is_external' => ''
                ],
                'condition'   => [
                    'aem_pricing_menu_enable_link' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pricing_menu_repeater',
            [
                'label'       => esc_html__( 'Pricing List', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $price_menu_repeater->get_controls(),
                'title_field' => '{{aem_pricing_menu_title}}',
                'default'     => [
                    [ 'aem_pricing_menu_title' => __( 'List #1', AEM_TEXTDOMAIN ) ],
                    [ 'aem_pricing_menu_title' => __( 'List #2', AEM_TEXTDOMAIN ) ],
                    [ 'aem_pricing_menu_title' => __( 'List #3', AEM_TEXTDOMAIN ) ],
                    [ 'aem_pricing_menu_title' => __( 'List #4', AEM_TEXTDOMAIN ) ]
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Pricing Menu Container
         */
        $this->start_controls_section(
            'aem_section_pricing_menu_container',
            [
                'label' => esc_html__( 'Container', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'aem_pricing_menu_image_align',
            [
                'label'   => __( 'Alignment', AEM_TEXTDOMAIN ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'flex-start',
                'options' => [
                    'flex-start' => __( 'Top', AEM_TEXTDOMAIN ),
                    'center'     => __( 'Center', AEM_TEXTDOMAIN )
                ],
                'selectors' => [
                    '{{WRAPPER}} .aem-pricing-list-item' => 'align-items: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'aem_price_list_container_bg',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .aem-pricing-list .aem-pricing-list-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'aem_pricing_menu_container_border',
                'selector' => '{{WRAPPER}} .aem-pricing-list .aem-pricing-list-wrapper'
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_con_border_radius',
            [
                'label'        => __( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-pricing-list .aem-pricing-list-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_con_padding',
            [
                'label'      => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 15,
                    'right'  => 15,
                    'bottom' => 15,
                    'left'   => 15,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-pricing-list .aem-pricing-list-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'aem_pricing_menu_con_shadow',
                'selector' => '{{WRAPPER}} .aem-pricing-list .aem-pricing-list-wrapper'
            ]
        );

        $this->end_controls_section();

        /**
         * Pricing menu List Item style
         */

        $this->start_controls_section(
            'aem_pricing_menu_list_item',
            [
                'label' => esc_html__( 'List Item', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'aem_pricing_menu_list_item_background',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .aem-pricing-list-item'
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_list_item_padding',
            [
                'label'        => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => '20',
                    'right'    => '0',
                    'bottom'   => '20',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-pricing-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_list_item_margin',
            [
                'label'      => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-pricing-list-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'aem_pricing_menu_list_item_border',
                'selector'  => '{{WRAPPER}} .aem-pricing-list-item',
                'separator' => 'before'
            ]
        );
        
        $this->add_control(
            'aem_pricing_menu_list_item_border_bottom',
            [
                'label'        => __( 'Disable Border Bottom(Last Item)', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
                'return_value' => 'border_bottom',
                'default'      => 'yes'
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_list_item_radius',
            [
                'label'      => esc_html__( 'Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-pricing-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'aem_pricing_menu_list_item_shadow',
                'selector' => '{{WRAPPER}} .aem-pricing-list-item'
            ]
        );

        $this->end_controls_section();


        /**
         * Pricing menu List Image style
         */

        $this->start_controls_section(
            'aem_pricing_menu_image_style',
            [
                'label' => esc_html__( 'Image', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'aem_pricing_menu_img_size',
                'default'   => 'thumbnail'
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_image_width',
            [
                'label'       => __( 'Width', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'min' => 0,
                        'max' => 500
                    ]
                ],
                'default'  => [
                    'unit' => 'px',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .aem-pricing-list-item.yes .aem-pricing-list-item-thumbnail' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .aem-pricing-list-item.yes .aem-pricing-list-item-content'   => 'width: calc( 100% - {{SIZE}}{{UNIT}} );'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_image_height',
            [
                'label'       => __( 'Height', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'min' => 0,
                        'max' => 500
                    ]
                ],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => 100
                ],
                'selectors'   => [
                    '{{WRAPPER}} .aem-pricing-list-item.yes .aem-pricing-list-item-thumbnail' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_image_padding',
            [
                'label'      => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-pricing-list-item-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_image_margin',
            [
                'label'        => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => '0',
                    'right'    => '15',
                    'bottom'   => '0',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-pricing-list-item-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'aem_pricing_menu_image_border',
                'selector' => '{{WRAPPER}} .aem-pricing-list-item-thumbnail'
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_image_radius',
            [
                'label'      => esc_html__( 'Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-pricing-list-item-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'aem_pricing_menu_image_shadow',
                'selector' => '{{WRAPPER}} .aem-pricing-list-item-thumbnail'
            ]
        );

        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'aem_pricing_menu_image_css_filter',
				'selector' => '{{WRAPPER}} .aem-pricing-list-item-thumbnail img',
			]
		);

        $this->end_controls_section();


        /**
         * Pricing menu Title style
         */
        $this->start_controls_section(
            'aem_pricing_menu_title',
            [
                'label' => esc_html__( 'Title', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'aem_pricing_menu_title_connector',
            [
                'label'        => __( 'Enable Connector', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

        $this->add_control(
            'aem_pricing_menu_title_connector_color',
            [
                'label'     => __( 'Connector Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .aem-pricing-list-item-content-conntector' => 'border-bottom-color: {{VALUE}};'
                ],
                'condition' => [
                    'aem_pricing_menu_title_connector' => 'yes'
                ]
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'aem_pricing_menu_title_typography',
                'selector' => '{{WRAPPER}} .aem-pricing-list-item-content-title'
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_title_margin',
            [
                'label'        => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => 0,
                    'right'    => 0,
                    'bottom'   => 0,
                    'left'     => 0,
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-pricing-list-item-content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->start_controls_tabs( 'aem_pricing_menu_title_color' );

            $this->start_controls_tab( 'aem_pricing_menu_title_color_control', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

                $this->add_control(
                    'aem_pricing_menu_title_color_normal',
                    [
                        'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#0A1724',
                        'selectors' => [
                            '{{WRAPPER}} .aem-pricing-list-item-content-title' => 'color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'aem_pricing_menu_title_color_hover_control', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );
                $this->add_control(
                    'aem_pricing_menu_title_color_hover',
                    [
                        'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $aem_primary_color,
                        'selectors' => [
                            '{{WRAPPER}} .aem-pricing-list-item-content-title:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();
        /**
         * Pricing menu Description style
         */
        $this->start_controls_section(
            'aem_pricing_menu_description',
            [
                'label' => esc_html__( 'Description', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'aem_pricing_menu_description_color',
            [
                'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .aem-pricing-list-item .aem-pricing-list-item-content .aem-pricing-list-item-content-description' => 'color: {{VALUE}};'
                ]
            ]
        );
            
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'aem_pricing_menu_description_typography',
                'selector' => '{{WRAPPER}} .aem-pricing-list-item-content-description'
            ]
        );
        
        $this->add_responsive_control(
            'aem_pricing_menu_description_margin',
            [
                'label'        => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => '20',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-pricing-list-item-content-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();

        /**
         * Pricing menu Price style
         */
        $this->start_controls_section(
            'aem_pricing_menu_price_style',
          [
            'label' => esc_html__( 'Price', AEM_TEXTDOMAIN ),
            'tab'   => Controls_Manager::TAB_STYLE
          ]
        );
        
        $this->add_control(
            'aem_pricing_menu_price_position',
            [
                'label'   => __( 'Position', AEM_TEXTDOMAIN ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
                    'price_pos_down'  => [
                        'title' => __( 'Bottom', AEM_TEXTDOMAIN ),
                        'icon'  => 'eicon-arrow-down'
                    ],
                    'price_pos_right' => [
                        'title' => __( 'Right', AEM_TEXTDOMAIN ),
                        'icon'  => 'eicon-arrow-right'
                    ],
                ],
                'default' => 'price_pos_right'
            ]
        );

        $this->add_control(
            'aem_pricing_menu_price_color',
            [
                'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $aem_primary_color,
                'selectors' => [
                    '{{WRAPPER}} .aem-pricing-list-item .aem-pricing-list-item-price' => 'color: {{VALUE}};'
                ]
            ]
        );
            
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'             => 'aem_pricing_menu_price_typography',
                'fields_options'   => [
                    'font_size'    => [
                        'default'  => [
                            'unit' => 'px',
                            'size' => 20
                        ]
                    ],
                    'line_height'  => [
                        'desktop_default' => [
                            'unit' => 'px',
                            'size' => 20
                        ]
                    ]
                ],
                'selector'         => '{{WRAPPER}} .aem-pricing-list-item-price span'
            ]
        );
        
        $this->add_responsive_control(
            'aem_pricing_menu_price_margin',
            [
                'label'        => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => 0,
                    'right'    => 0,
                    'bottom'   => 0,
                    'left'     => 0,
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-pricing-list-item-price span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'    => [
                    'aem_pricing_menu_price_position' => 'price_pos_down'
                ]
            ]
        );

        $this->end_controls_section();
        
        /**
         * Pricing menu Price style
         */
        $this->start_controls_section(
            'aem_pricing_menu_order_btn_style',
          [
            'label' => esc_html__( 'Order Button', AEM_TEXTDOMAIN ),
            'tab'   => Controls_Manager::TAB_STYLE
          ]
        );
            
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'aem_pricing_menu_order_btn_typography',
                'selector' => '{{WRAPPER}} .aem-pricing-list-item-content-action'
            ]
        );

        $this->add_responsive_control(
            'aem_pricing_menu_order_btn_padding',
            [
                'label'        => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'top'      => '8',
                    'right'    => '20',
                    'bottom'   => '8',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-pricing-list-item-content-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        
        $this->add_responsive_control(
            'aem_pricing_menu_order_btn_radius',
            [
                'label'      => esc_html__( 'Border radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-pricing-list-item-content-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'aem_pricing_menu_order_btn_tabs' );

            $this->start_controls_tab( 'aem_pricing_menu_order_btn_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

                $this->add_control(
                    'aem_pricing_menu_order_btn_normal_color',
                    [
                        'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .aem-pricing-list-item-content-action' => 'color: {{VALUE}};'
                        ]
                    ]
                );
            
                $this->add_control(
                    'aem_pricing_menu_order_btn_normal_background',
                    [
                        'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#0A1724',
                        'selectors' => [
                            '{{WRAPPER}} .aem-pricing-list-item-content-action' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'aem_pricing_menu_order_btn_normal_border',
                        'selector' => '{{WRAPPER}} .aem-pricing-list-item-content-action'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'aem_pricing_menu_order_btn_normal_shadow',
                        'selector' => '{{WRAPPER}} .aem-pricing-list-item-content-action'
                    ]
                );
                
            $this->end_controls_tab();

            $this->start_controls_tab( 'aem_pricing_menu_order_btn_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

                $this->add_control(
                    'aem_pricing_menu_order_btn_hover_color',
                    [
                        'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#ffffff',
                        'selectors' => [
                            '{{WRAPPER}} .aem-pricing-list-item-content-action:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );
            
                $this->add_control(
                    'aem_pricing_menu_order_btn_hover_background',
                    [
                        'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#0A1724',
                        'selectors' => [
                            '{{WRAPPER}} .aem-pricing-list-item-content-action:hover' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'aem_pricing_menu_order_btn_hover_border',
                        'selector' => '{{WRAPPER}} .aem-pricing-list-item-content-action:hover'
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'aem_pricing_menu_order_btn_hover_shadow',
                        'selector' => '{{WRAPPER}} .aem-pricing-list-item-content-action:hover'
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

    private function pricing( $param, $index ) {
        $price_key = $this->get_repeater_setting_key( 'aem_pricing_menu_price', 'pricing_menu_repeater', $index );
        $this->add_inline_editing_attributes( $price_key, 'none' );
        $price = '<div class="aem-pricing-list-item-price">';
            $price .= '<span '.$this->get_render_attribute_string( $price_key ).'>'. $param .'</span>';
        $price .= '</div>';
        return $price;
    }

    protected function render() {
    $settings = $this->get_settings_for_display();
    ?>
        <div class="aem-pricing-list">
            <div class="aem-pricing-list-wrapper <?php echo esc_attr( $settings['aem_pricing_menu_list_item_border_bottom'] ) ?>" >
            <?php 
            foreach ( $settings['pricing_menu_repeater'] as $index => $list ) : 
                $img_url = $list['aem_pricing_menu_image']['url'] ? ' yes' : '';

                $each_pricing_menu = 'each_item_' . $index;
                $this->add_render_attribute( $each_pricing_menu, 'class', [
                    'elementor-repeater-item-'.esc_attr( $list['_id'] ),
                    'aem-pricing-list-item'.$img_url
                ] );

                $pricing_title_key = $this->get_repeater_setting_key( 'aem_pricing_menu_title', 'pricing_menu_repeater', $index );
                $this->add_render_attribute( $pricing_title_key, 'class', 'aem-pricing-list-item-content-title' );
                $this->add_inline_editing_attributes( $pricing_title_key, 'basic' );

                $pricing_description_key = $this->get_repeater_setting_key( 'aem_pricing_menu_description', 'pricing_menu_repeater', $index );
                $this->add_render_attribute( $pricing_description_key, 'class', 'aem-pricing-list-item-content-description' );
                $this->add_inline_editing_attributes( $pricing_description_key, 'basic' );
                
                $aem_pricing_menu_price = $this->get_repeater_setting_key( 'aem_pricing_menu_price', 'pricing_menu_repeater', $index );
                $this->add_inline_editing_attributes( $aem_pricing_menu_price, 'basic' );
                ?>
                <div <?php echo $this->get_render_attribute_string( $each_pricing_menu );?> >
                    <?php if ( $list['aem_pricing_menu_image']['url'] || $list['aem_pricing_menu_image']['id'] ) : ?>
                        <div class="aem-pricing-list-item-thumbnail">
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $list, 'aem_pricing_menu_image_size', 'aem_pricing_menu_image' ); ?>
                        </div>
                    <?php endif;?>

                    <div class="aem-pricing-list-item-content <?php echo esc_attr( $settings['aem_pricing_menu_price_position'] );?>" >
                        <div class="aem-pricing-list-item-content-inner">
                            <div class="aem-pricing-title">
                                <?php if ( !empty( $list['aem_pricing_menu_title'] ) ) : ?>
                                        <h5 <?php echo $this->get_render_attribute_string( $pricing_title_key );?> ><?php echo Helper::aem_wp_kses( $list['aem_pricing_menu_title'] );?></h5>
                                <?php endif;?>

                                <?php if( 'yes' === $settings['aem_pricing_menu_title_connector'] ) : ?>
                                        <span class="aem-pricing-list-item-content-conntector"></span>
                                <?php endif;

                                if( 'price_pos_right' === $settings['aem_pricing_menu_price_position'] ) :
                                    echo $this->pricing( wp_kses_post( $list['aem_pricing_menu_price'] ), $index );
                                endif; ?>
                            </div>

                            <?php if ( !empty( $list['aem_pricing_menu_description'] ) ) : ?>
                                <p <?php echo $this->get_render_attribute_string( $pricing_description_key );?> >
                                    <?php echo wp_kses_post( $list['aem_pricing_menu_description'] );?>
                                </p>
                            <?php endif;
                            
                            if( 'yes' === $list['aem_pricing_menu_enable_link'] && !empty( $list['aem_pricing_menu_action_text'] ) ) {
                                $link_key = 'link_' . $index;
                                $this->add_render_attribute( $link_key, 'class', 'aem-pricing-list-item-content-action' );
                                $aem_heading_link = $list['aem_pricing_menu_btn_link']['url'];
                                if( $aem_heading_link ) {
                                    $this->add_render_attribute( $link_key, 'href', esc_url( $aem_heading_link ) );
                                    if( $list['aem_pricing_menu_btn_link']['is_external'] ) {
                                        $this->add_render_attribute( $link_key, 'target', '_blank' );
                                    }
                                    if( $list['aem_pricing_menu_btn_link']['nofollow'] ) {
                                        $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                                    }
                                }
                                $pricing_btn_key = $this->get_repeater_setting_key( 'aem_pricing_menu_action_text', 'pricing_menu_repeater', $index );
                                $this->add_inline_editing_attributes( $pricing_btn_key, 'none' );?>

                                    <a <?php echo $this->get_render_attribute_string( $link_key ) ;?>>
                                        <span <?php $this->get_render_attribute_string( $pricing_btn_key );?> >
                                            <?php echo esc_html( $list['aem_pricing_menu_action_text'] );?>
                                        </span>
                                    </a>

                            <?php } ?>
                            </div>
                        <?php if( 'price_pos_down' === $settings['aem_pricing_menu_price_position'] ) {
                            echo $this->pricing( wp_kses_post( $list['aem_pricing_menu_price'] ), $index );
                        } ?>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    <?php
    }

}