<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
use \Elementor\Utils;
use \AEM_Addons_Elementor\classes\Helper;


class AEM_Pricing_Table extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'aem-pricing-table';
	}

	public function get_title() {
		return esc_html__( 'Pricing Table', AEM_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-price-table';
	}

	public function get_categories() {
		return [ 'aem-category' ];
	}

	public function get_keywords() {
        return [ 'price', 'package', 'product', 'plan', 'go' ];
    }

	protected function register_controls() {
		$aem_secondary_color = get_option( 'aem_secondary_color_option', '#00d8d8' );

		/**
  		 * Pricing Table Feature
  		 */
  		$this->start_controls_section(
  			'aem_section_pricing_table_feature',
  			[
  				'label' => esc_html__( 'Features', AEM_TEXTDOMAIN )
  			]
		);
		  
		$pricing_repeater = new Repeater();

		$pricing_repeater->add_control(
			'aem_pricing_table_item',
			[
				'name'        => 'aem_pricing_table_item',
				'label'       => esc_html__( 'List Item', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Pricing table list item', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);
		
		$pricing_repeater->add_control(
			'aem_pricing_table_list_icon',
			[
				'name'        => 'aem_pricing_table_list_icon',
				'label'       => esc_html__( 'List Icon', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid'
				]
			]
		);
		
		$pricing_repeater->add_control(
			'aem_pricing_table_icon_mood',
			[
				'name'         => 'aem_pricing_table_icon_mood',
				'label'        => esc_html__( 'Item Active?', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
        );

  		$this->add_control(
			'aem_pricing_table_items',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'  => $pricing_repeater->get_controls(),
				'seperator'   => 'before',
				'default'     => [
					[ 'aem_pricing_table_item' => esc_html__( 'Responsive Live', AEM_TEXTDOMAIN ) ],
					[ 'aem_pricing_table_item' => esc_html__( 'Adaptive Bitrate', AEM_TEXTDOMAIN ) ],
					[ 'aem_pricing_table_item' => esc_html__( 'Analytics', AEM_TEXTDOMAIN ) ],
					[ 	
						'aem_pricing_table_item'      => esc_html__( 'Creative Layouts', AEM_TEXTDOMAIN ),
						'aem_pricing_table_icon_mood' => 'no'
					],
					[ 
						'aem_pricing_table_item'      => esc_html__( 'Free Support', AEM_TEXTDOMAIN ),
						'aem_pricing_table_icon_mood' => 'no'
					]
				],	
				'title_field' => '{{aem_pricing_table_item}}'
			]	
		);

		$this->end_controls_section();
		  
		/**
  		 * Pricing Table Promo label
  		 */
  		$this->start_controls_section(
			'aem_section_pricing_table_promo_section',
			[
				'label' => esc_html__( 'Promo Label', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_pricing_table_promo_enable',
			[
				'label'        => esc_html__( 'Promo Label?', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'aem_pricing_table_promo_title',
			[
				'label'       => esc_html__( 'Title', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Recommended', AEM_TEXTDOMAIN ),
				'condition'   => [
					'aem_pricing_table_promo_enable' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_promo_position',
			[
				'label'        => __( 'Position', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'promo_top',
				'options'      => [
					'promo_top'    => __( 'Top', AEM_TEXTDOMAIN ),
					'promo_bottom' => __( 'Bottom', AEM_TEXTDOMAIN ),
				],
				'condition'    => [
					'aem_pricing_table_promo_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();

  		/**
  		 * Pricing Table Settings
  		 */
  		$this->start_controls_section(
  			'aem_section_pricing_table_settings',
  			[
  				'label' => esc_html__( 'Header', AEM_TEXTDOMAIN )
  			]
  		);

  		$this->add_control(
			'aem_pricing_table_title',
			[
				'label'       => esc_html__( 'Title', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'STANDARD', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'aem_pricing_table_title_tag',
            [
                'label'   => __('Title HTML Tag', AEM_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::aem_title_tags(),
                'default' => 'h3',
            ]
		);

		$this->add_control(
			'aem_pricing_table_subtitle',
			[
				'label'       => esc_html__( 'Subtitle', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_featured',
			[
				'label'        => esc_html__( 'Featured?', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'aem_pricing_table_featured_type',
			[
				'label'     => esc_html__( 'Badge Type', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'text-badge',
				'options'   => [
					'text-badge' => __( 'Text Badge', AEM_TEXTDOMAIN ),
					'icon-badge' => __( 'Icon Badge', AEM_TEXTDOMAIN )
				],
				'condition' => [
					'aem_pricing_table_featured' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_featured_tag_text',
			[
				'label'       => esc_html__( 'Featured Text', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'FEATURED', AEM_TEXTDOMAIN ),
				'condition'   => [
					'aem_pricing_table_featured'      => 'yes',
					'aem_pricing_table_featured_type' => 'text-badge'
				]
			]
		);

  		$this->end_controls_section();

  		$this->start_controls_section(
  			'aem_section_pricing_table_price',
  			[
  				'label' => esc_html__( 'Price', AEM_TEXTDOMAIN )
  			]
		);

		$this->add_control(
			'aem_pricing_table_price',
			[
				'label'       => esc_html__( 'Price', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', AEM_TEXTDOMAIN )
			]
		);
		
  		$this->add_control(
			'aem_pricing_table_price_cur',
			[
				'label'       => esc_html__( 'Price Currency', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_pricing_table_price_cur_position',
			[
				'label'       => esc_html__( 'Currency Position', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'	  => false,
				'label_block' => false,
				'default'     => 'aem-pricing-cur-left',
				'options'     => [
					'aem-pricing-cur-left' => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-angle-left'
					],
					'aem-pricing-cur-right' => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-angle-right'
					]
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_price_by',
			[
				'label'       => esc_html__( 'Price By', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'mo', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_pricing_table_period_separator',
			[
				'label'       => esc_html__( 'Separated By', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '/', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_pricing_table_discount_price',
			[
				'label' => __( 'Show Discount Price', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off' => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'aem_pricing_table_regular_price',
			[
				'label'       => esc_html__( 'Ragular Price', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', AEM_TEXTDOMAIN ),
				'condition'   => [
					'aem_pricing_table_discount_price' => 'yes'
				]
			]
		);
		
  		$this->add_control(
			'aem_pricing_table_regular_price_cur',
			[
				'label'       => esc_html__( 'Regular Price Currency', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', AEM_TEXTDOMAIN ),
				'condition'   => [
					'aem_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_price_subtitle',
			[
				'label'       => esc_html__( 'Price Subtitle', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

  		$this->end_controls_section();

  		

  		/**
  		 * Pricing Table Footer
  		 */
  		$this->start_controls_section(
  			'aem_section_pricing_table_button',
  			[
  				'label' => esc_html__( 'Button', AEM_TEXTDOMAIN )
  			]
		);
		  

		$this->add_control(
			'aem_pricing_table_btn_position',
			[
				'label'   => esc_html__( 'Position', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'middle' => __( 'Middle', AEM_TEXTDOMAIN ),
					'bottom' => __( 'Bottom', AEM_TEXTDOMAIN )
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_btn',
			[
				'label'       => esc_html__( 'Text', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Choose Plan', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_pricing_table_btn_link',
			[
				'label'       => esc_html__( 'Link', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
     			'show_external' => true
			]
		);

		$this->end_controls_section();
		  
		  /**
  		 * Pricing Table Note
  		 */
  		$this->start_controls_section(
			'aem_section_pricing_table_note',
			[
				'label' => esc_html__( 'Note', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_pricing_table_note_text',
			[
				'label' => __( 'Text', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
			]
		);

		$this->end_controls_section();

  	
		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Style)
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'aem_section_pricing_tables_styles_presets',
			[
				'label' => esc_html__( 'Container', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'aem_section_pricing_tables_min_height',
			[
				'label'       => esc_html__( 'Min Height', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 2000,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-pricing-table-badge-wrapper' => 'min-height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'aem_pricing_table_bg_color_simple',
				'label' => __( 'Background', AEM_TEXTDOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector' => '{{WRAPPER}} .aem-pricing-table-badge-wrapper',
				'condition' => [
					'aem_pricing_table_header_type' => 'simple'
				]
			]
		);
				
		$this->add_control(
			'aem_pricing_table_bg_color',
			[
				'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
				'seperator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-badge-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .aem-pricing-table-header .aem-pricing-table-header-curved svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
					'aem_pricing_table_header_type' => 'curved-header'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_content_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '45',
					'right'    => '30',
					'bottom'   => '45',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-badge-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'aem_pricing_table_content_border',
				'selector' => '{{WRAPPER}} .aem-pricing-table-badge-wrapper'
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_content_border_radius',
			[
				'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '10',
                    'right'    => '10',
                    'bottom'   => '10',
                    'left'     => '10',
                    'unit'     => 'px'
                ],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-badge-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aem-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .aem-pricing-table-header .aem-pricing-table-header-svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_pricing_table_content_box_shadow',
				'selector' => '{{WRAPPER}} .aem-pricing-table-badge-wrapper',
				'fields_options'         => [
		            'box_shadow_type'    => [
		                'default'        =>'yes'
		            ],
		            'box_shadow'         => [
		                'default'        => [
		                    'horizontal' => 0,
		                    'vertical'   => 13,
		                    'blur'       => 33,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.08)'
		                ]
		            ]
	            ]
			]
		);

		$content_align = is_rtl() ? 'right' : 'left';

		$this->add_control(
			'aem_pricing_table_content_alignment',
			[
				'label'         => __( 'Alignment', AEM_TEXTDOMAIN ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'separator'     => 'after',
				'default'       => $content_align,
				'options'       => [
					'left'      => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_pricing_table_transition_shadow',
				'label'    => __( 'Hover Box Shadow', AEM_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper:hover .aem-pricing-table-badge-wrapper',
				'fields_options'      => [
		            'box_shadow_type' => [
		                'default'     =>'yes'
		            ],
		            'box_shadow'  => [
		                'default' => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 40,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.2)'
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'aem_pricing_table_transition_type',
			[
				'label'   => __( 'Hover Style', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'              =>  __( 'None', AEM_TEXTDOMAIN ),
					'transition_top'    =>  __( 'Transition Top', AEM_TEXTDOMAIN ),
					'transition_bottom' => __( 'Transition Bottom', AEM_TEXTDOMAIN ),
					'transition_zoom'   => __( 'Transition Zoom', AEM_TEXTDOMAIN )
				],
				'default' => 'none'
			]
		);

		
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Promo label)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_pricing_table_promo_style',
			[
				'label'     => esc_html__( 'Promo Label', AEM_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_pricing_table_promo_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_promo_alignment',
			[
				'label'     => __( 'Alignment', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'options'   => [
					'left'      => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-promo-label' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'aem_pricing_table_promo_background',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector'  => '{{WRAPPER}} .aem-pricing-table-promo-label',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_promo_typography',
				'label'    => __( 'Typography', AEM_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .aem-pricing-table-promo-label',
			]
		);

		$this->add_control(
			'aem_pricing_table_promo_text-color',
			[
				'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-promo-label' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_promo_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-promo-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_promo_radius',
			[
				'label'      => __( 'Border radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-promo-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Header)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_pricing_table_title_header_settings',
			[
				'label' => esc_html__( 'Header', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_pricing_table_header_type',
			[
				'label'   => esc_html__( 'Header Type', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'simple',
				'options' => [
					'simple'        => __( 'Simple', AEM_TEXTDOMAIN ),
					'curved-header' => __( 'Curved Header', AEM_TEXTDOMAIN )
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'aem_pricing_table_header_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .aem-pricing-table-header',
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_header_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_header_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_header_border_radius',
			[
				'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'aem_pricing_table_header_border',
				'selector'  => '{{WRAPPER}} .aem-pricing-table-header',
				'condition' => [
					'aem_pricing_table_header_type' => 'simple'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_pricing_table_header_shadow',
				'selector' => '{{WRAPPER}} .aem-pricing-table-header',
				'condition' => [
					'aem_pricing_table_header_type' => 'simple'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Title)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_pricing_table_title_style_settings',
			[
				'label' => esc_html__( 'Header Title', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_section_pricing_table_title_heading',
			[
				'label'     => esc_html__( 'Title', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'aem_pricing_table_title_color',
			[
				'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-title' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_title_typography',
				'selector' => '{{WRAPPER}} .aem-pricing-table-title',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 15
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '400'
		            ]
	            ]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_title_margin',
			[
				'label'      => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		/**
		 * -------------------------------------------
		 * Style (Sub Title)
		 * -------------------------------------------
		 */

		$this->add_control(
			'aem_section_pricing_table_subtitletitle_heading',
			[
				'label'     => esc_html__( 'Sub Title', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'aem_pricing_table_subtitle_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-subtitle' => 'color: {{VALUE}};'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_subtitle_typography',
				'selector' => '{{WRAPPER}} .aem-pricing-table-subtitle'
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_subtitle_margin',
			[
				'label'   => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::DIMENSIONS,
				'default' => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Style (Pricing)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_pricing_table_price_style_settings',
			[
				'label' => esc_html__( 'Pricing', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_pricing_table_price_box_separator',
			[
				'label'        => esc_html__( 'Enable Separator', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'OFF', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_price_box_separator_height',
			[
				'label'     => esc_html__( 'Separator Height', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '1',
				'selectors' => [
					'{{WRAPPER}} .aem-price-bottom-separator' => 'height: {{VALUE}}px;'
				],
				'condition' => [
					'aem_pricing_table_price_box_separator' => 'yes'
				]
				
			]
		);

		$this->add_control(
			'aem_pricing_table_price_box_separator_color',
			[
				'label'     => esc_html__( 'Separator Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .aem-price-bottom-separator'  => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'aem_pricing_table_price_box_separator' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_price_box_separator_spacing',
			[
				'label'       => esc_html__( 'Separator Spacing', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 30
				],
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-price-bottom-separator' => 'margin: {{SIZE}}px 0;'
				],
				'condition'   => [
					'aem_pricing_table_price_box_separator' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_price_box',
			[
				'label'        => esc_html__( 'Price Box', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'OFF', AEM_TEXTDOMAIN ),
				'separator'	   => 'before',
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_price_box_height',
			[
				'label'     => __( 'Box Height', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'height: {{VALUE}}px'
				],
				'condition' => [
					'aem_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_price_box_width',
			[
				'label'     => __( 'Box Width', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'width: {{VALUE}}px'
				],
				'condition' => [
					'aem_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'aem_pricing_table_price_box_background',
				'types'     => [ 'classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'aem_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'aem_pricing_table_price_box_border',
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'aem_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_price_box_radius',
			[
				'label'      => __( 'Box Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} .price-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'aem_pricing_table_price_box' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_price_tag_heading',
			[
				'label'     => esc_html__( 'Original Price', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);

		$this->add_control(
			'aem_pricing_table_pricing_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price p.aem-pricing-table-new-price'  => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price p.aem-pricing-table-new-price',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 48
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => -3.2
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'aem_pricing_table_regular_price_heading',
			[
				'label'     => esc_html__( 'Regular Price', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before',
				'condition' => [
					'aem_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_regular_price_typography',
				'selector' => '{{WRAPPER}} .aem-pricing-table-price.aem-discount-price-yes p.aem-pricing-table-regular-price',
				'condition' => [
					'aem_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_regular_price_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-price.aem-discount-price-yes p.aem-pricing-table-regular-price' => 'color: {{VALUE}};'
				],
				'condition' => [
					'aem_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_regular_price_right_spacing',
			[
				'label'       => esc_html__( 'Regular Price Right Spacing', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 10
				],
				'range'       => [
					'px'      => [
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-pricing-table-price.aem-discount-price-yes p.aem-pricing-table-regular-price' => 'margin-right: {{SIZE}}px;'
				],
				'condition' => [
					'aem_pricing_table_discount_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_pricing_curency_heading',
			[
				'label'     => esc_html__( 'Pricing Curency', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'aem_pricing_table_pricing_curency_spacing',
			[
				'label' => __( 'Spacing', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', AEM_TEXTDOMAIN ),
				'label_on' => __( 'Custom', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$this->start_popover();

			$this->add_responsive_control(
				'aem_pricing_table_pricing_curency_bottom_spacing',
				[
					'label'      => esc_html__( 'Bottom Spacing', AEM_TEXTDOMAIN ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => -100,
							'max'  => 100,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price span.aem-pricing-table-currency' => 'top: {{SIZE}}{{UNIT}};'
					],
				]
			);

            $this->add_responsive_control(
				'aem_pricing_table_pricing_curency_right_spacing',
				[
					'label'      => esc_html__( 'Right Spacing', AEM_TEXTDOMAIN ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 200,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price span.aem-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};'
					],
				]
			);

        $this->end_popover();

		$this->add_control(
			'aem_pricing_table_pricing_curency_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price span.aem-pricing-table-currency' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_price_curency_typography',
				'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price span.aem-pricing-table-currency',
			]
		);

		$this->add_control(
			'aem_pricing_table_pricing_period_heading',
			[
				'label'     => esc_html__( 'Pricing By', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'aem_pricing_table_pricing_period_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price span.aem-price-period' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-price-period',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 20
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => 0
		                ]
		            ]
	            ]
			]
		);

		$this->add_control(
			'aem_pricing_table_price_subtitle_heading',
			[
				'label'     => esc_html__( 'Price Subtitle', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'aem_pricing_table_price_subtitle_color',
			[
				'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price-subtitle' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_price_subtitle_typography',
				'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price-subtitle',
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_price_subtitle_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'unit'   => 'px',
					'islinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-price-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);

		$this->end_controls_section();


		/**
		 * -------------------------------------------
		 * Style (Feature List)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_pricing_table_style_featured_list_settings',
			[
				'label' => esc_html__( 'Feature List', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_list_item_typography',
				'selector' => '{{WRAPPER}} .aem-pricing-table-features li'
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_featured_list_icon_size',
			[
				'label'       => esc_html__( 'Icon Size', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-pricing-li-icon' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$icon_gap = is_rtl() ? 'left' : 'right';

		$this->add_responsive_control(
			'aem_pricing_table_featured_list_icon_space',
			[
				'label'       => esc_html__( 'Icon Space', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 7
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-pricing-table-features li .aem-pricing-li-icon' => 'margin-'.$icon_gap.': {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_list_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $aem_secondary_color,
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-features li span.aem-pricing-li-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_list_item_color',
			[
				'label'     => esc_html__( 'Item Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-features li' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_list_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-features li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_list_border_bottom',
			[
				'label'        => __( 'List Border Bottom', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'aem_pricing_table_list_border_bottom_style',
			[
				'label'     => __( 'List Border Bottom Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'defailt'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .list-border-bottom li:not(:last-child)' => 'border-bottom:1px solid {{VALUE}};'
				],
				'condition' => [
					'aem_pricing_table_list_border_bottom' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_list_disable_item_styling',
			[
				'label'     => esc_html__( 'Disable Items', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'aem_pricing_table_list_disable_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-features li.aem-pricing-table-features-disable span.aem-pricing-li-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_list_disable_item_color',
			[
				'label'     => esc_html__( 'Item color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-features li.aem-pricing-table-features-disable' => 'color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Featured Tag Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_pricing_table_featured_tag_settings',
			[
				'label'     => esc_html__( 'Featured Badge', AEM_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_pricing_table_featured' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_featured_tag_font_size',
			[
				'label'       => esc_html__( 'Font Size', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 40
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .text-badge'   => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .icon-badge i' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'aem_pricing_table_featured_tag_text_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .text-badge'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-badge i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'aem_pricing_table_featured_text_badge_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .text-badge',
				'condition' => [
					'aem_pricing_table_featured_type' => 'text-badge'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'aem_pricing_table_featured_icon_badge_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .icon-badge',
				'condition' => [
					'aem_pricing_table_featured_type' => 'icon-badge'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_pricing_table_btn_style_settings',
			[
				'label' => esc_html__( 'Button', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_pricing_table_btn_typography',
				'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action'
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_button_border_radius',
			[
				'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '4',
					'right'  => '4',
					'bottom' => '4',
					'left'   => '4'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_button_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '12',
					'right'    => '30',
					'bottom'   => '12',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_pricing_table_button_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '30',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'aem_pricing_table_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'aem_pricing_table_btn_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

			$this->add_control(
				'aem_pricing_table_btn_normal_text_color',
				[
					'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'aem_pricing_table_btn_normal_bg_color',
				[
					'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => $aem_secondary_color,
					'selectors' => [
						'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'aem_pricing_table_btn_normal_border',
					'fields_options'  => [
						'border'      => [
							'default' => 'solid'
                    	],
	                    'width'       => [
	                        'default' => [
	                            'top'    => '1',
	                            'right'  => '1',
	                            'bottom' => '1',
	                            'left'   => '1'
	                        ]
	                    ],
	                    'color'       => [
	                        'default' => $aem_secondary_color
	                    ]
	                ],
					'selector'        => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'aem_pricing_table_btn_box_shadow',
					'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action'
				]
			);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'aem_pricing_table_btn_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

			$this->add_control(
				'aem_pricing_table_btn_hover_text_color',
				[
					'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => $aem_secondary_color,
					'selectors' => [
						'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action:hover' => 'color: {{VALUE}};'
					]
				]
			);

			$this->add_control(
				'aem_pricing_table_btn_hover_bg_color',
				[
					'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action:hover' => 'background-color: {{VALUE}};'
					]
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'aem_pricing_table_btn_hover_border',
					'fields_options'  => [
						'border'      => [
							'default' => 'solid'
                    	],
	                    'width'       => [
	                        'default' => [
	                            'top'    => '1',
	                            'right'  => '1',
	                            'bottom' => '1',
	                            'left'   => '1'
	                        ]
	                    ],
	                    'color'       => [
	                        'default' => $aem_secondary_color
	                    ]
	                ],
					'selector'        => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action:hover'
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'aem_pricing_table_btn_box_shadow_hover',
					'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-action:hover'
				]
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Note Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_pricing_table_note_style',
			[
				'label' => esc_html__( 'Note', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_pricing_table_note_alignment',
			[
				'label'         => __( 'Alignment', AEM_TEXTDOMAIN ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'default'		=> 'center',
				'options'       => [
					'left'      => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-note' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_section_pricing_table_note_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-note' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_section_pricing_table_note_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-note' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'aem_section_pricing_table_note_background',
				'label' => __( 'Background', AEM_TEXTDOMAIN ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-note',
			]
		);

		$this->add_control(
			'aem_section_pricing_table_note_text_color',
			[
				'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-note' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_section_pricing_table_note_text_typography',
				'label'    => __( 'Typography', AEM_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-note',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'aem_section_pricing_table_note_border',
				'selector' => '{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-note'
			]
		);

		$this->add_responsive_control(
			'aem_section_pricing_table_note_border_radius',
			[
				'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-pricing-table-wrapper .aem-pricing-table-note' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

	}

	private function pricing_table_currency( $currency ) {
		return $currency ? '<span '.$this->get_render_attribute_string( 'aem_pricing_table_price_cur' ).'>'.esc_html( $currency ).'</span>' : '';
	}

	protected function render() {
		$settings      = $this->get_settings_for_display();
		$title         = $settings['aem_pricing_table_title'];
		$sub_title     = $settings['aem_pricing_table_subtitle'];
		$price         = $settings['aem_pricing_table_price'];
		$separator     = $settings['aem_pricing_table_period_separator'];
		$price_by      = $settings['aem_pricing_table_price_by'];
		$featured_text = $settings['aem_pricing_table_featured_tag_text'];

		$this->add_render_attribute( 
			'aem_pricing_table_wrapper', 
			[ 
				'class' => [ 
					'aem-pricing-table-wrapper', 
					'aem-pricing-table', 
					esc_attr( $settings['aem_pricing_table_content_alignment'] ), 
					esc_attr( $settings['aem_pricing_table_transition_type'] )
				]
			]
		);
	
		$this->add_render_attribute( 'aem_pricing_table_featured_tag_text', 'class', 'aem-pricing-featured-tag-text' );
		$this->add_inline_editing_attributes( 'aem_pricing_table_featured_tag_text', 'basic' );

		$this->add_render_attribute( 'aem_pricing_table_promo_title', 'class', 'aem-pricing-table-promo-label' );
		$this->add_inline_editing_attributes( 'aem_pricing_table_promo_title', 'basic' );

		$this->add_render_attribute( 'aem_pricing_table_title', 'class', 'aem-pricing-table-title' );
		$this->add_inline_editing_attributes( 'aem_pricing_table_title', 'basic' );

		$this->add_render_attribute( 'aem_pricing_table_subtitle', 'class', 'aem-pricing-table-subtitle' );
		$this->add_inline_editing_attributes( 'aem_pricing_table_subtitle', 'basic' );

		$this->add_render_attribute( 'aem_pricing_table_box_value', 'class', [ 'aem-pricing-table-price', 'aem-discount-price-'.$settings['aem_pricing_table_discount_price'] ] );

		if( 'yes' === $settings['aem_pricing_table_price_box'] ){
			$this->add_render_attribute( 'aem_pricing_table_box_value', 'class', 'price-box' );
		}

		$this->add_render_attribute( 'aem_pricing_table_price_cur', 'class', 'aem-pricing-table-currency' );
		$this->add_inline_editing_attributes( 'aem_pricing_table_price_cur', 'basic' );

		$this->add_render_attribute( 'aem_pricing_table_period_separator', 'class', 'aem-pricing-table-currency-separator' );
		$this->add_inline_editing_attributes( 'aem_pricing_table_period_separator', 'none' );

		$this->add_render_attribute( 'aem_pricing_table_price_by', 'class', 'aem-pricing-table-price-by' );
		$this->add_inline_editing_attributes( 'aem_pricing_table_price_by', 'basic' );

		$this->add_render_attribute( 'aem_pricing_table_price', 'class', 'aem-pricing-table-price' );
		$this->add_inline_editing_attributes( 'aem_pricing_table_price', 'basic' );

		$this->add_render_attribute( 'aem_pricing_table_features', 'class', 'aem-pricing-table-features' );
		if( 'yes' === $settings['aem_pricing_table_list_border_bottom'] ){
			$this->add_render_attribute( 'aem_pricing_table_features', 'class', 'list-border-bottom' );
		}

        $this->add_render_attribute( 'aem_pricing_table_btn_link', 'class', 'aem-pricing-table-action' );
		if( $settings['aem_pricing_table_btn_link']['url'] ) {
            $this->add_render_attribute( 'aem_pricing_table_btn_link', 'href', esc_url( $settings['aem_pricing_table_btn_link']['url'] ) );
	        if( $settings['aem_pricing_table_btn_link']['is_external'] ) {
	            $this->add_render_attribute( 'aem_pricing_table_btn_link', 'target', '_blank' );
	        }
	        if( $settings['aem_pricing_table_btn_link']['nofollow'] ) {
	            $this->add_render_attribute( 'aem_pricing_table_btn_link', 'rel', 'nofollow' );
	        }
        }

        $this->add_inline_editing_attributes( 'aem_pricing_table_btn', 'none' );

		?>

		<div <?php echo $this->get_render_attribute_string( 'aem_pricing_table_wrapper' ); ?>>
			<?php if( 'promo_top' === $settings['aem_pricing_table_promo_position'] ) { 
				if( 'yes' === $settings['aem_pricing_table_promo_enable'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'aem_pricing_table_promo_title' ); ?>><?php echo wp_kses_post( $settings['aem_pricing_table_promo_title'] ); ?></span>
				<?php } ?>
			<?php } ?>
			<div class="aem-pricing-table-badge-wrapper">

				<?php if ( 'yes' === $settings['aem_pricing_table_featured'] ) { ?>
					<span class="aem-pricing-table-badge <?php echo esc_attr( $settings['aem_pricing_table_featured_type'] ); ?>">
						<?php if( 'text-badge' === $settings['aem_pricing_table_featured_type'] && !empty( $featured_text ) ) { ?>
							<span <?php echo $this->get_render_attribute_string( 'aem_pricing_table_featured_tag_text' ); ?>>
								<?php echo esc_html( $featured_text ); ?>
							</span>
						<?php } ?>
						<?php if( 'icon-badge' === $settings['aem_pricing_table_featured_type'] ) { ?>
							<i class="demo-icon eicon-star"></i>
						<?php } ?>
					</span>
				<?php } ?>

				<div class="aem-pricing-table-header">
					<?php do_action( 'aem_pricing_table_header_wrapper_before' ); ?>

					<?php $title ? printf( '<'.Utils::validate_html_tag( $settings['aem_pricing_table_title_tag'] ).' ' .$this->get_render_attribute_string( 'aem_pricing_table_title' ).'>%s</'.Utils::validate_html_tag( $settings['aem_pricing_table_title_tag'] ).'>', wp_kses_post( $title ) ) : '';
					$sub_title ? printf( '<div '.$this->get_render_attribute_string( 'aem_pricing_table_subtitle' ).'>%s</div>', wp_kses_post( $sub_title ) ) : ''; ?>

					<div <?php echo $this->get_render_attribute_string( 'aem_pricing_table_box_value' ); ?>>
						<?php if( 'yes' === $settings['aem_pricing_table_discount_price'] ) { ?>
							<p class="aem-pricing-table-regular-price">				
								<span class="aem-pricing-table-regular-price-cur"><?php echo $settings['aem_pricing_table_regular_price_cur']; ?></span>
								<span class="aem-pricing-table-regular-price-text"><?php echo $settings['aem_pricing_table_regular_price']; ?></span>
							</p>
						<?php } ?>
						<p class="aem-pricing-table-new-price">							
							<?php if( 'aem-pricing-cur-left' === $settings['aem_pricing_table_price_cur_position'] ) : ?>
								<?php echo $this->pricing_table_currency( $settings['aem_pricing_table_price_cur'] ); ?>
							<?php endif; ?>

							<?php $price ? printf( '<span '.$this->get_render_attribute_string( 'aem_pricing_table_price' ).'>%s</span>', esc_html( $price ) ) : ''; ?>

							<?php if( 'aem-pricing-cur-right' === $settings['aem_pricing_table_price_cur_position'] ) : ?>
								<?php echo $this->pricing_table_currency( $settings['aem_pricing_table_price_cur'] ); ?>
							<?php endif; ?>

							<?php if( $separator || $price_by ) : ?>
								<span class="aem-price-period">
									<?php $separator ? printf( '<span '.$this->get_render_attribute_string( 'aem_pricing_table_period_separator' ).'>%s</span>', esc_html( $separator ) ) : ''; ?>
									<?php $price_by ? printf( '<span '.$this->get_render_attribute_string( 'aem_pricing_table_price_by' ).'>%s</span>', esc_html( $price_by ) ) : ''; ?>
								</span>
							<?php endif; ?>
						</p>
					</div>

					<?php if( !empty( $settings['aem_pricing_table_price_subtitle'] ) ){ ?>
						<span class="aem-pricing-table-price-subtitle"><?php echo $settings['aem_pricing_table_price_subtitle']; ?></span>
					<?php } ?>

					<?php if ( 'yes' === $settings['aem_pricing_table_price_box_separator'] ) : ?>
						<div class="aem-price-bottom-separator"></div>
					<?php endif; ?>

					<?php if( 'curved-header' === $settings['aem_pricing_table_header_type'] ) { ?>
						<div class="aem-pricing-table-header-curved">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">
								<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />
							</svg>
						</div>
					<?php } ?>

					<?php do_action( 'aem_pricing_table_header_wrapper_after' ); ?>
				</div>
				
				 <?php if( 'middle' === $settings['aem_pricing_table_btn_position'] && !empty( $settings['aem_pricing_table_btn'] ) ) {
					$this->pricing_table_btn();
				}

				do_action( 'aem_pricing_table_content_wrapper_before' ); ?>

				<?php if ( is_array( $settings['aem_pricing_table_items'] ) ) : ?>
					<ul <?php echo $this->get_render_attribute_string( 'aem_pricing_table_features' ); ?>>
						<?php foreach( $settings['aem_pricing_table_items'] as $index => $item ) : ?> 

							<?php $each_pricing_item = 'link_' . $index;
							$icon_mod = 'yes' !== $item['aem_pricing_table_icon_mood'] ? 'aem-pricing-table-features-disable' : 'aem-pricing-table-features-enable';
							$this->add_render_attribute( $each_pricing_item, 'class', [
								esc_attr( $icon_mod ),
								'elementor-repeater-item-'.esc_attr( $item['_id'] )
							] );

							$pricing_item = $this->get_repeater_setting_key( 'aem_pricing_table_item', 'aem_pricing_table_items', $index );
							$this->add_render_attribute( $pricing_item, 'class', 'aem-pricing-item' );
							$this->add_inline_editing_attributes( $pricing_item, 'basic' );
							$price = $item['aem_pricing_table_item']; ?>

							<li <?php echo $this->get_render_attribute_string( $each_pricing_item ); ?>>
								<?php if ( !empty( $item['aem_pricing_table_list_icon']['value'] ) ) { ?>
									<span class="aem-pricing-li-icon">
										<?php Icons_Manager::render_icon( $item['aem_pricing_table_list_icon'] ); ?>
									</span>
								<?php } ?>
								<?php $price ? printf( '<span '.$this->get_render_attribute_string( $pricing_item ).'>%s</span>', wp_kses_post( $price ) ) : ''; ?>
							</li>

						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php do_action( 'aem_pricing_table_content_wrapper_after' ); ?>

				<?php if( 'bottom' === $settings['aem_pricing_table_btn_position'] && !empty( $settings['aem_pricing_table_btn'] ) ) { ?>
					<?php $this->pricing_table_btn(); ?>
				<?php } ?> 
				<?php if( !empty( $settings['aem_pricing_table_note_text'] ) ){ ?>
					<div class="aem-pricing-table-note"><?php echo $settings['aem_pricing_table_note_text']; ?></div>
				<?php } ?>
			</div>
			<?php if( 'promo_bottom' === $settings['aem_pricing_table_promo_position'] ) {
				if( 'yes' === $settings['aem_pricing_table_promo_enable'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'aem_pricing_table_promo_title' ); ?>><?php echo $settings['aem_pricing_table_promo_title']; ?></span>
				<?php } ?>
			<?php } ?>
		</div>
		<?php
	}

    private function pricing_table_btn() {
		?>
		<a <?php echo $this->get_render_attribute_string( 'aem_pricing_table_btn_link' ); ?>>
			<span <?php echo $this->get_render_attribute_string( 'aem_pricing_table_btn' ); ?>>
				<?php echo esc_html( $this->get_settings_for_display( 'aem_pricing_table_btn' ) ); ?>
			</span>
		</a>
		<?php
	}
}