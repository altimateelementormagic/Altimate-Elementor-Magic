<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \AEM_Addons_Elementor\classes\Helper;


class AEM_Iconbox extends Widget_Base {
	
	public function get_name() {
		return 'aem-iconbox';
	}

	public function get_title() {
		return esc_html__( 'Icon Box', AEM_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-icon-box';
	}

	public function get_categories() {
		return [ 'aem-category' ];
	}

	public function get_keywords() {
		return [ 'information', 'iconbox', 'service' ];
	}

	protected function register_controls() {
		$aem_primary_color = get_option( 'aem_primary_color_option', '#7a56ff' );
		
		/*
		* Iconbox Image
		*/
		$this->start_controls_section(
			'aem_section_iconbox_content',
			[
				'label' => esc_html__( 'Content', AEM_TEXTDOMAIN )
			]
		);
		
		$this->add_control(
			'aem_iconbox_img_or_icon',
			[
				'label'         => esc_html__( 'Image or Icon', AEM_TEXTDOMAIN ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'label_block'   => true,
				'default'       => 'icon',
				'options'       => [
					'none'      => [
						'title' => esc_html__( 'None', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-ban'
					],
					'icon'      => [
						'title' => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-info-circle'
					],
					'img'       => [
						'title' => esc_html__( 'Image', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-image-bold'
					]
				]
			]
		);
		
		$this->add_control(
			'aem_iconbox_image',
			[
				'label'     => esc_html__( 'Image', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url'   => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'aem_iconbox_img_or_icon' => 'img'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'medium_large',
				'condition' => [
					'aem_iconbox_img_or_icon' => 'img'
				]
			]
		);

		$this->add_control(
			'aem_iconbox_icon',
			[
				'label'       => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-tag',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'aem_iconbox_img_or_icon' => 'icon'
				]
			]
		);

		
		$this->add_control(
			'aem_iconbox_title',
			[
				'label'       => esc_html__( 'Title', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Iconbox Title', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'aem_iconbox_title_html_tag',
            [
                'label'   => __('Title HTML Tag', AEM_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::aem_title_tags(),
                'default' => 'h3',
            ]
		);

		$this->add_control(
			'aem_iconbox_title_link',
			[
				'label'       => __( 'Title URL', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', AEM_TEXTDOMAIN ),
				'label_block' => true
			]
		);
		
		$this->add_control(
			'aem_iconbox_description',
			[
				'label'   => esc_html__( 'Description', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Put your information in the box. Anything you\'d like. Please don\'t keep it empty.', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->end_controls_section();
		

		/*
		* Iconbox Styling Section
		*/
		$this->start_controls_section(
			'aem_section_iconbox_styles_preset',
			[
				'label' => esc_html__( 'Container', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'aem_iconbox_container_min_height',
			[
				'label'       => esc_html__( 'Min Height', AEM_TEXTDOMAIN ),
				'type'    	  => Controls_Manager::SLIDER,
			  	'range'       => [
				  	'px'      => [
					  	'max' => 1000
				  	]
			 	],
			  	'selectors'   => [
				  	'{{WRAPPER}} .aem-iconbox .aem-iconbox-item' => 'min-height: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'aem_iconbox_alignment',
            [
				'label'   => __( 'Alignment', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'aem-iconbox-align-left'   => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'aem-iconbox-align-center' => [
						'title' => __( 'Center', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'aem-iconbox-align-right'  => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'aem-iconbox-align-center'
			]
		);

        // $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	[
		// 		'name'      => 'aem_iconbox_background',
		// 		'types'     => [ 'classic', 'gradient' ],
		// 		'separator' => 'before',
		// 		'selector'  => '{{WRAPPER}} .aem-iconbox .aem-iconbox-item',
		// 		'default'   => '#ffffff'
		// 	]
		// );

		$this->add_responsive_control(
			'aem_iconbox_padding',
			[
				'label'      => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '30',
					'right'  => '30',
					'bottom' => '30',
					'left'   => '30'
				],
			  	'selectors'  => [
			  		'{{WRAPPER}} .aem-iconbox-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			  	]
			]
		);

		$this->add_responsive_control(
			'aem_iconbox_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
			  	'selectors'  => [
				  	'{{WRAPPER}} .aem-iconbox-item, {{WRAPPER}} .zoom-transition:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			  	]
			]
		);

		$this->start_controls_tabs( 'aem_iconbox_container_tabs' );

			$this->start_controls_tab( 'aem_iconbox_container_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'      => 'aem_iconbox_background_normal',
						'types'     => [ 'classic', 'gradient' ],
						'selector'  => '{{WRAPPER}} .aem-iconbox .aem-iconbox-item',
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_iconbox_border_normal',
						'selector' => '{{WRAPPER}} .aem-iconbox-item'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_iconbox_box_shadow_normal',
						'selector' => '{{WRAPPER}} .aem-iconbox-item'
					]
				);

			$this->end_controls_tab();
		
			$this->start_controls_tab( 'aem_iconbox_container_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'      => 'aem_iconbox_background_hover',
						'types'     => [ 'classic', 'gradient' ],
						'separator' => 'before',
						'selector'  => '{{WRAPPER}} .aem-iconbox .aem-iconbox-item:hover',
					]
				);

				$this->add_control(
					'aem_iconbox_background_hover_title_color',
					[
						'label'     => esc_html__( 'Title Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							  '{{WRAPPER}} .aem-iconbox-item:hover .aem-iconbox-content-title' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'aem_iconbox_background_hover_description_color',
					[
						'label'     => esc_html__( 'Description Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .aem-iconbox-item:hover .aem-iconbox-content-description' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_iconbox_border_hover',
						'selector' => '{{WRAPPER}} .aem-iconbox-item:hover'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_iconbox_box_shadow_hover',
						'selector' => '{{WRAPPER}} .aem-iconbox-item:hover'
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();	

		
		$this->end_controls_section();

		// transition style

		$this->start_controls_section(
            'section_iconbox_transition_style',
            [
				'label' => __('Transition', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'aem_iconbox_transition_top',
            [
				'label'        => __( 'Transition Top', AEM_TEXTDOMAIN ),
				'type'         =>  Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
        );
		$this->add_control(
			'aem_iconbox_transition_zoom',
            [
				'label'        => __( 'Transition Zoom', AEM_TEXTDOMAIN ),
				'type'         =>  Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'aem_iconbox_transition_zoom_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .zoom-transition::before',
				'condition' => [
					'aem_iconbox_transition_zoom' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'aem_iconbox_transition_zoom_title_color',
			[
				'label'     => esc_html__( 'Title Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '100',
				'selectors' => [
				  	'{{WRAPPER}} .aem-iconbox-item:hover .aem-iconbox-content-title' => 'color: {{VALUE}};'
			  	],
			  	'condition' => [
					'aem_iconbox_transition_zoom' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_iconbox_transition_zoom_description_color',
			[
				'label'     => esc_html__( 'Description Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '100',
				'selectors' => [
				  	'{{WRAPPER}} .aem-iconbox-item:hover .aem-iconbox-content-description' => 'color: {{VALUE}};'
		  		],
		  		'condition' => [
					'aem_iconbox_transition_zoom' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		//icon style
		$this->start_controls_section(
            'section_iconbox_icon',
            [
				'label' => __('Icon/Image', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'aem_iconbox_icon_position',
			[
				'label'   => __( 'Position', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'aem-iconbox-icon-position-left'   => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-left'
					],
					'aem-iconbox-icon-position-center' => [
						'title' => __( 'Top', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-up'
					],
					'aem-iconbox-icon-position-right'  => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-right'
					]
				],
				'default' => 'aem-iconbox-icon-position-center'
			]
		);

		$this->add_control(
			'aem_iconbox_enable_box',
            [
				'label'        => __( 'Enable Box', AEM_TEXTDOMAIN ),
				'type'         =>  Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_responsive_control(
			'aem_iconbox_icon_height',
			[
				'label'       => esc_html__( 'Height', AEM_TEXTDOMAIN ),
				'type'    	  => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 80
			  	],
			  	'range'       => [
				  	'px'      => [
					  	'max' => 250
				  	]
			 	],
			  	'selectors'   => [
				  	'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon' => 'height: {{SIZE}}px;'
				],
				'condition' => [
					'aem_iconbox_enable_box' => 'yes' 
				]
			]
		);

		$this->add_responsive_control(
			'aem_iconbox_icon_width',
			[
				'label'       => esc_html__( 'Width', AEM_TEXTDOMAIN ),
				'type'    	  => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 80
			  	],
			  	'range'       => [
				  	'px'      => [
					  	'max' => 250
				  	]
			 	],
			  	'selectors'   => [
				  	'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon' => 'width: {{SIZE}}px;',
				  	'{{WRAPPER}} .aem-iconbox-icon-position-left .aem-iconbox-content' => 'flex-basis: calc( 100% - {{SIZE}}px );',
				  	'{{WRAPPER}} .aem-iconbox-icon-position-right .aem-iconbox-content' => 'flex-basis: calc( 100% - {{SIZE}}px );'
				],
				'condition' => [
					'aem_iconbox_enable_box' => 'yes' 
				]
			]
		);

		$this->add_responsive_control(
			'aem_iconbox_icon_font_size',
			[
				'label'       => esc_html__( 'Icon Size', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 35
			  	],
			  	'range'       => [
				  	'px'      => [
					  	'max' => 250
				  	]
			 	],
			  	'selectors'   => [
					'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon i'   => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;'
			  	],
				'condition'   => [
					'aem_iconbox_img_or_icon'  => 'icon',
					'aem_iconbox_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'aem_iconbox_icon_image_size',
			[
				'label'       => esc_html__( 'Image Size', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 40
			  	],
			  	'range'       => [
				  	'px'      => [
					  	'max' => 400
				  	]
			 	],
			  	'selectors'   => [
					'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon img' => 'height: {{SIZE}}px; width: {{SIZE}}px;'
			  	],
				'condition'   => [
					'aem_iconbox_img_or_icon'  => 'img',
					'aem_iconbox_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'aem_iconbox_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_iconbox_icon_box_shadow',
				'selector' => '{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon'
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'aem_iconbox_image_css_filter',
				'selector' => '{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon img',
				'condition'   => [
					'aem_iconbox_img_or_icon'  => 'img',
					'aem_iconbox_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'aem_iconbox_icon_margin_top',
			[
				'label'       => esc_html__( 'Top Spacing', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => -300,
						'max' => 300
					]
                ],
                'default'     => [
					'unit'    => 'px',
					'size'    => 0
				],
				'selectors'   => [
				  	'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon' => 'margin-top: {{SIZE}}{{UNIT}};'
			  	]
			]
		);

		$this->add_responsive_control(
			'aem_iconbox_icon_margin_bottom',
			[
				'label'       => esc_html__( 'Bottom Spacing', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => -300,
						'max' => 300
					]
                ],
                'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
			  	]
			]
		);

		$this->start_controls_tabs( 'aem_iconbox_icon_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'aem_iconbox_icon_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_iconbox_icon_background_color_normal',
					[
						'label'     => esc_html__( 'Background', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => $aem_primary_color,
						'selectors' => [
							'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon' => 'background: {{VALUE}}'
						]
					]
				);

				$this->add_control(
					'aem_iconbox_icon_color_normal',
					[
						'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon i' => 'color: {{VALUE}}'
						],
						'condition' => [
							'aem_iconbox_img_or_icon'  => 'icon',
							'aem_iconbox_icon[value]!' => ''
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_iconbox_icon_border_normal',
						'selector' => '{{WRAPPER}} .aem-iconbox-item .aem-iconbox-icon'
					]
				);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'aem_iconbox_icon_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_iconbox_icon_background_color_hover',
					[
						'label'     => esc_html__( 'Background', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .aem-iconbox-item:hover .aem-iconbox-icon' => 'background: {{VALUE}}'
						]
					]
				);

				$this->add_control(
					'aem_iconbox_icon_color_hover',
					[
						'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => $aem_primary_color,
						'selectors' => [
							'{{WRAPPER}} .aem-iconbox-item:hover .aem-iconbox-icon i' => 'color: {{VALUE}}'
						],
						'condition' => [
							'aem_iconbox_img_or_icon'  => 'icon',
							'aem_iconbox_icon[value]!' => ''
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_iconbox_icon_border_hover',
						'selector' => '{{WRAPPER}} .aem-iconbox-item:hover .aem-iconbox-icon'
					]
				);
				
			$this->end_controls_tab();
        $this->end_controls_tabs();
		
		$this->end_controls_section();

		// Title , Description Font Color and Typography

		$this->start_controls_section(
            'section_iconbox_title',
            [
				'label' => __('Title', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'iconbox_title_typography',
				'selector' => '{{WRAPPER}} .aem-iconbox-content-title',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ]
            ]
		);
		
		$this->add_responsive_control(
			'aem_iconbox_title_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .aem-iconbox-content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'aem_iconbox_title_tabs' );

			$this->start_controls_tab( 'aem_iconbox_title_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_title_color_normal',
					[
						'label'     => __('Color', AEM_TEXTDOMAIN),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .aem-iconbox-content-title' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();
		
			$this->start_controls_tab( 'aem_iconbox_title_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_title_color_hover',
					[
						'label'     => esc_html__( 'Title Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							  '{{WRAPPER}} .aem-iconbox-item .aem-iconbox-content-title:hover' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();	

        $this->end_controls_section();

        $this->start_controls_section(
            'section_iconbox_description',
            [
				'label' => __('Description', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'aem_description_color',
            [
				'label'     => __('Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#797c80',
				'selectors' => [
                    '{{WRAPPER}} .aem-iconbox-content-description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'aem_description_typography',
				'selector' => '{{WRAPPER}} .aem-iconbox-content-description'
            ]
		);
		
		$this->add_responsive_control(
			'aem_iconbox_description_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'default'    => [
                    'top'      => '10',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .aem-iconbox-content-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
		
		/*
		* Iconbox Animating Mask
		*/
		
		$this->start_controls_section(
			'aem_section_iconbox_animating_mask',
			[
				'label' 	=> esc_html__( 'Animating Mask', AEM_TEXTDOMAIN ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'aem_iconbox_animating_mask_switcher',
			[
				'label' 		=> __( 'Enable Animating Mask', AEM_TEXTDOMAIN ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'ON', AEM_TEXTDOMAIN ),
				'label_off' 	=> __( 'OFF', AEM_TEXTDOMAIN ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);

		$this->add_control(
			'aem_iconbox_animating_mask_style',
			[
				'label'        => __( 'Animating Mask Style', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'style_1',
				'options'      => [
					'style_1'  => __( 'Style 1', AEM_TEXTDOMAIN ),
					'style_2'  => __( 'Style 2', AEM_TEXTDOMAIN ),
					'style_3'  => __( 'Style 3', AEM_TEXTDOMAIN ),
				],
				'condition'		=> [
					'aem_iconbox_animating_mask_switcher' => 'yes'
				]
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() {
		$settings                  = $this->get_settings_for_display();		
		$title                     = $settings['aem_iconbox_title'];
		$details                   = $settings['aem_iconbox_description'];

		if ( $settings['aem_iconbox_img_or_icon'] == 'img' ) {

			$iconbox_image_url_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'aem_iconbox_image' );
		}

		$this->add_render_attribute( 'aem_iconbox_transition',[
			'class' => [
				'aem-iconbox-item', 
				esc_attr( $settings['aem_iconbox_alignment'] ), 
				esc_attr( $settings['aem_iconbox_icon_position'] ),
				'aem-iconbox-enable-box-'.esc_attr( $settings['aem_iconbox_enable_box'] )
			]
		]);

		if( 'yes' === $settings['aem_iconbox_transition_top'] ){
			$this->add_render_attribute( 'aem_iconbox_transition', 'class', 'simple-transition' );
		}

		if( 'yes' === $settings['aem_iconbox_transition_zoom'] ){
			$this->add_render_attribute( 'aem_iconbox_transition', 'class', 'zoom-transition' );
		}

		if( isset( $settings['aem_iconbox_title_link']['url'] ) ) {
            $this->add_render_attribute( 'aem_iconbox_title_link', 'href', esc_url( $settings['aem_iconbox_title_link']['url'] ) );
		    if( $settings['aem_iconbox_title_link']['is_external'] ) {
		        $this->add_render_attribute( 'aem_iconbox_title_link', 'target', '_blank' );
		    }
		    if( $settings['aem_iconbox_title_link']['nofollow'] ) {
		        $this->add_render_attribute( 'aem_iconbox_title_link', 'rel', 'nofollow' );
		    }
        }

        $this->add_render_attribute( 'aem_iconbox_title', 'class', 'aem-iconbox-content-title' );
		$this->add_inline_editing_attributes( 'aem_iconbox_title', 'none' );

        $this->add_render_attribute( 'aem_iconbox_description', 'class', 'aem-iconbox-content-description' );
		$this->add_inline_editing_attributes( 'aem_iconbox_description' );

		?>

		<div class="aem-iconbox">
			<div <?php echo $this->get_render_attribute_string( 'aem_iconbox_transition' ); ?>>
			  	<?php if( 'none' !== $settings['aem_iconbox_img_or_icon'] ) { ?>
					<div class="aem-iconbox-icon<?php echo ( 'yes' === $settings['aem_iconbox_animating_mask_switcher'] ) ? ' '.$settings['aem_iconbox_animating_mask_style'] : ''; ?>">
						<?php if( 'icon' === $settings['aem_iconbox_img_or_icon'] && $settings['aem_iconbox_icon']['value'] ) : ?>
							<?php Icons_Manager::render_icon( $settings['aem_iconbox_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php endif; ?>

						<?php if( 'img' === $settings['aem_iconbox_img_or_icon'] ) :
							echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'aem_iconbox_image' );
						endif; ?>	
					</div>
			  	<?php } ?>
	            <div class="aem-iconbox-content">
	            	<?php if( !empty( $settings['aem_iconbox_title_link']['url'] ) ) { ?>
                        <a <?php echo $this->get_render_attribute_string( 'aem_iconbox_title_link' ); ?>>
                    <?php } ?>
	            	<?php $title ? printf( '<'. Utils::validate_html_tag( $settings['aem_iconbox_title_html_tag'] ) . ' ' .$this->get_render_attribute_string( 'aem_iconbox_title' ).'>%s</'.Utils::validate_html_tag( $settings['aem_iconbox_title_html_tag'] ).'>', Helper::aem_wp_kses( $title ) ) : ''; ?>
	            	<?php if( !empty( $settings['aem_iconbox_title_link']['url'] ) ) { ?>
                        </a>
                    <?php } ?>

	            	<?php $details ? printf( '<div '.$this->get_render_attribute_string( 'aem_iconbox_description' ).'>%s</div>', wp_kses_post( $details ) ) : ''; ?>
	            </div>
          	</div>
        </div>
		<?php
	}
}