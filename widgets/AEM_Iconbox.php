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
		return 'aem-infobox';
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
		return [ 'information', 'infobox', 'service' ];
	}

	protected function register_controls() {
		$aem_primary_color = get_option( 'aem_primary_color_option', '#7a56ff' );
		
		/*
		* Infobox Image
		*/
		$this->start_controls_section(
			'aem_section_infobox_content',
			[
				'label' => esc_html__( 'Content', AEM_TEXTDOMAIN )
			]
		);
		
		$this->add_control(
			'aem_infobox_img_or_icon',
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
			'aem_infobox_image',
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
					'aem_infobox_img_or_icon' => 'img'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'medium_large',
				'condition' => [
					'aem_infobox_img_or_icon' => 'img'
				]
			]
		);

		$this->add_control(
			'aem_infobox_icon',
			[
				'label'       => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-tag',
					'library' => 'fa-solid'
				],
				'condition'   => [
					'aem_infobox_img_or_icon' => 'icon'
				]
			]
		);

		
		$this->add_control(
			'aem_infobox_title',
			[
				'label'       => esc_html__( 'Title', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Infobox Title', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'aem_infobox_title_html_tag',
            [
                'label'   => __('Title HTML Tag', AEM_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::aem_title_tags(),
                'default' => 'h3',
            ]
		);

		$this->add_control(
			'aem_infobox_title_link',
			[
				'label'       => __( 'Title URL', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', AEM_TEXTDOMAIN ),
				'label_block' => true
			]
		);
		
		$this->add_control(
			'aem_infobox_description',
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
		* Infobox Styling Section
		*/
		$this->start_controls_section(
			'aem_section_infobox_styles_preset',
			[
				'label' => esc_html__( 'Container', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'aem_infobox_container_min_height',
			[
				'label'       => esc_html__( 'Min Height', AEM_TEXTDOMAIN ),
				'type'    	  => Controls_Manager::SLIDER,
			  	'range'       => [
				  	'px'      => [
					  	'max' => 1000
				  	]
			 	],
			  	'selectors'   => [
				  	'{{WRAPPER}} .aem-infobox .aem-infobox-item' => 'min-height: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'aem_infobox_alignment',
            [
				'label'   => __( 'Alignment', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'aem-infobox-align-left'   => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'aem-infobox-align-center' => [
						'title' => __( 'Center', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'aem-infobox-align-right'  => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'aem-infobox-align-center'
			]
		);

        // $this->add_group_control(
		// 	Group_Control_Background::get_type(),
		// 	[
		// 		'name'      => 'aem_infobox_background',
		// 		'types'     => [ 'classic', 'gradient' ],
		// 		'separator' => 'before',
		// 		'selector'  => '{{WRAPPER}} .aem-infobox .aem-infobox-item',
		// 		'default'   => '#ffffff'
		// 	]
		// );

		$this->add_responsive_control(
			'aem_infobox_padding',
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
			  		'{{WRAPPER}} .aem-infobox-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			  	]
			]
		);

		$this->add_responsive_control(
			'aem_infobox_border_radius',
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
				  	'{{WRAPPER}} .aem-infobox-item, {{WRAPPER}} .zoom-transition:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
			  	]
			]
		);

		$this->start_controls_tabs( 'aem_infobox_container_tabs' );

			$this->start_controls_tab( 'aem_infobox_container_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'      => 'aem_infobox_background_normal',
						'types'     => [ 'classic', 'gradient' ],
						'selector'  => '{{WRAPPER}} .aem-infobox .aem-infobox-item',
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_infobox_border_normal',
						'selector' => '{{WRAPPER}} .aem-infobox-item'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_infobox_box_shadow_normal',
						'selector' => '{{WRAPPER}} .aem-infobox-item'
					]
				);

			$this->end_controls_tab();
		
			$this->start_controls_tab( 'aem_infobox_container_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'      => 'aem_infobox_background_hover',
						'types'     => [ 'classic', 'gradient' ],
						'separator' => 'before',
						'selector'  => '{{WRAPPER}} .aem-infobox .aem-infobox-item:hover',
					]
				);

				$this->add_control(
					'aem_infobox_background_hover_title_color',
					[
						'label'     => esc_html__( 'Title Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							  '{{WRAPPER}} .aem-infobox-item:hover .aem-infobox-content-title' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'aem_infobox_background_hover_description_color',
					[
						'label'     => esc_html__( 'Description Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .aem-infobox-item:hover .aem-infobox-content-description' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_infobox_border_hover',
						'selector' => '{{WRAPPER}} .aem-infobox-item:hover'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_infobox_box_shadow_hover',
						'selector' => '{{WRAPPER}} .aem-infobox-item:hover'
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();	

		
		$this->end_controls_section();

		// transition style

		$this->start_controls_section(
            'section_infobox_transition_style',
            [
				'label' => __('Transition', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'aem_infobox_transition_top',
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
			'aem_infobox_transition_zoom',
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
				'name'      => 'aem_infobox_transition_zoom_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .zoom-transition::before',
				'condition' => [
					'aem_infobox_transition_zoom' => 'yes'
				]
			]
		);
		
		$this->add_control(
			'aem_infobox_transition_zoom_title_color',
			[
				'label'     => esc_html__( 'Title Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '100',
				'selectors' => [
				  	'{{WRAPPER}} .aem-infobox-item:hover .aem-infobox-content-title' => 'color: {{VALUE}};'
			  	],
			  	'condition' => [
					'aem_infobox_transition_zoom' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_infobox_transition_zoom_description_color',
			[
				'label'     => esc_html__( 'Description Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '100',
				'selectors' => [
				  	'{{WRAPPER}} .aem-infobox-item:hover .aem-infobox-content-description' => 'color: {{VALUE}};'
		  		],
		  		'condition' => [
					'aem_infobox_transition_zoom' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		//icon style
		$this->start_controls_section(
            'section_infobox_icon',
            [
				'label' => __('Icon/Image', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
		);

		$this->add_control(
			'aem_infobox_icon_position',
			[
				'label'   => __( 'Position', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'aem-infobox-icon-position-left'   => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-left'
					],
					'aem-infobox-icon-position-center' => [
						'title' => __( 'Top', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-up'
					],
					'aem-infobox-icon-position-right'  => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-right'
					]
				],
				'default' => 'aem-infobox-icon-position-center'
			]
		);

		$this->add_control(
			'aem_infobox_enable_box',
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
			'aem_infobox_icon_height',
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
				  	'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon' => 'height: {{SIZE}}px;'
				],
				'condition' => [
					'aem_infobox_enable_box' => 'yes' 
				]
			]
		);

		$this->add_responsive_control(
			'aem_infobox_icon_width',
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
				  	'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon' => 'width: {{SIZE}}px;',
				  	'{{WRAPPER}} .aem-infobox-icon-position-left .aem-infobox-content' => 'flex-basis: calc( 100% - {{SIZE}}px );',
				  	'{{WRAPPER}} .aem-infobox-icon-position-right .aem-infobox-content' => 'flex-basis: calc( 100% - {{SIZE}}px );'
				],
				'condition' => [
					'aem_infobox_enable_box' => 'yes' 
				]
			]
		);

		$this->add_responsive_control(
			'aem_infobox_icon_font_size',
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
					'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon i'   => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;'
			  	],
				'condition'   => [
					'aem_infobox_img_or_icon'  => 'icon',
					'aem_infobox_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'aem_infobox_icon_image_size',
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
					'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon img' => 'height: {{SIZE}}px; width: {{SIZE}}px;'
			  	],
				'condition'   => [
					'aem_infobox_img_or_icon'  => 'img',
					'aem_infobox_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'aem_infobox_icon_border_radius',
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
					'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_infobox_icon_box_shadow',
				'selector' => '{{WRAPPER}} .aem-infobox-item .aem-infobox-icon'
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'aem_infobox_image_css_filter',
				'selector' => '{{WRAPPER}} .aem-infobox-item .aem-infobox-icon img',
				'condition'   => [
					'aem_infobox_img_or_icon'  => 'img',
					'aem_infobox_icon[value]!' => ''
				]
			]
		);

		$this->add_responsive_control(
			'aem_infobox_icon_margin_top',
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
				  	'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon' => 'margin-top: {{SIZE}}{{UNIT}};'
			  	]
			]
		);

		$this->add_responsive_control(
			'aem_infobox_icon_margin_bottom',
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
					'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
			  	]
			]
		);

		$this->start_controls_tabs( 'aem_infobox_icon_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'aem_infobox_icon_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_infobox_icon_background_color_normal',
					[
						'label'     => esc_html__( 'Background', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => $aem_primary_color,
						'selectors' => [
							'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon' => 'background: {{VALUE}}'
						]
					]
				);

				$this->add_control(
					'aem_infobox_icon_color_normal',
					[
						'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .aem-infobox-item .aem-infobox-icon i' => 'color: {{VALUE}}'
						],
						'condition' => [
							'aem_infobox_img_or_icon'  => 'icon',
							'aem_infobox_icon[value]!' => ''
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_infobox_icon_border_normal',
						'selector' => '{{WRAPPER}} .aem-infobox-item .aem-infobox-icon'
					]
				);

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'aem_infobox_icon_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_infobox_icon_background_color_hover',
					[
						'label'     => esc_html__( 'Background', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .aem-infobox-item:hover .aem-infobox-icon' => 'background: {{VALUE}}'
						]
					]
				);

				$this->add_control(
					'aem_infobox_icon_color_hover',
					[
						'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => $aem_primary_color,
						'selectors' => [
							'{{WRAPPER}} .aem-infobox-item:hover .aem-infobox-icon i' => 'color: {{VALUE}}'
						],
						'condition' => [
							'aem_infobox_img_or_icon'  => 'icon',
							'aem_infobox_icon[value]!' => ''
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_infobox_icon_border_hover',
						'selector' => '{{WRAPPER}} .aem-infobox-item:hover .aem-infobox-icon'
					]
				);
				
			$this->end_controls_tab();
        $this->end_controls_tabs();
		
		$this->end_controls_section();

		// Title , Description Font Color and Typography

		$this->start_controls_section(
            'section_infobox_title',
            [
				'label' => __('Title', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'infobox_title_typography',
				'selector' => '{{WRAPPER}} .aem-infobox-content-title',
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
			'aem_infobox_title_margin',
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
					'{{WRAPPER}} .aem-infobox-content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'aem_infobox_title_tabs' );

			$this->start_controls_tab( 'aem_infobox_title_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_title_color_normal',
					[
						'label'     => __('Color', AEM_TEXTDOMAIN),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .aem-infobox-content-title' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();
		
			$this->start_controls_tab( 'aem_infobox_title_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_title_color_hover',
					[
						'label'     => esc_html__( 'Title Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							  '{{WRAPPER}} .aem-infobox-item .aem-infobox-content-title:hover' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();	

        $this->end_controls_section();

        $this->start_controls_section(
            'section_infobox_description',
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
                    '{{WRAPPER}} .aem-infobox-content-description' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'aem_description_typography',
				'selector' => '{{WRAPPER}} .aem-infobox-content-description'
            ]
		);
		
		$this->add_responsive_control(
			'aem_infobox_description_margin',
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
					'{{WRAPPER}} .aem-infobox-content-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
		
		/*
		* Infobox Animating Mask
		*/
		
		$this->start_controls_section(
			'aem_section_infobox_animating_mask',
			[
				'label' 	=> esc_html__( 'Animating Mask', AEM_TEXTDOMAIN ),
				'tab'   	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'aem_infobox_animating_mask_switcher',
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
			'aem_infobox_animating_mask_style',
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
					'aem_infobox_animating_mask_switcher' => 'yes'
				]
			]
		);

		$this->end_controls_section();
		
	}

	protected function render() {
		$settings                  = $this->get_settings_for_display();		
		$title                     = $settings['aem_infobox_title'];
		$details                   = $settings['aem_infobox_description'];

		if ( $settings['aem_infobox_img_or_icon'] == 'img' ) {

			$infobox_image_url_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'aem_infobox_image' );
		}

		$this->add_render_attribute( 'aem_infobox_transition',[
			'class' => [
				'aem-infobox-item', 
				esc_attr( $settings['aem_infobox_alignment'] ), 
				esc_attr( $settings['aem_infobox_icon_position'] ),
				'aem-infobox-enable-box-'.esc_attr( $settings['aem_infobox_enable_box'] )
			]
		]);

		if( 'yes' === $settings['aem_infobox_transition_top'] ){
			$this->add_render_attribute( 'aem_infobox_transition', 'class', 'simple-transition' );
		}

		if( 'yes' === $settings['aem_infobox_transition_zoom'] ){
			$this->add_render_attribute( 'aem_infobox_transition', 'class', 'zoom-transition' );
		}

		if( isset( $settings['aem_infobox_title_link']['url'] ) ) {
            $this->add_render_attribute( 'aem_infobox_title_link', 'href', esc_url( $settings['aem_infobox_title_link']['url'] ) );
		    if( $settings['aem_infobox_title_link']['is_external'] ) {
		        $this->add_render_attribute( 'aem_infobox_title_link', 'target', '_blank' );
		    }
		    if( $settings['aem_infobox_title_link']['nofollow'] ) {
		        $this->add_render_attribute( 'aem_infobox_title_link', 'rel', 'nofollow' );
		    }
        }

        $this->add_render_attribute( 'aem_infobox_title', 'class', 'aem-infobox-content-title' );
		$this->add_inline_editing_attributes( 'aem_infobox_title', 'none' );

        $this->add_render_attribute( 'aem_infobox_description', 'class', 'aem-infobox-content-description' );
		$this->add_inline_editing_attributes( 'aem_infobox_description' );

		?>

		<div class="aem-infobox">
			<div <?php echo $this->get_render_attribute_string( 'aem_infobox_transition' ); ?>>
			  	<?php if( 'none' !== $settings['aem_infobox_img_or_icon'] ) { ?>
					<div class="aem-infobox-icon<?php echo ( 'yes' === $settings['aem_infobox_animating_mask_switcher'] ) ? ' '.$settings['aem_infobox_animating_mask_style'] : ''; ?>">
						<?php if( 'icon' === $settings['aem_infobox_img_or_icon'] && $settings['aem_infobox_icon']['value'] ) : ?>
							<?php Icons_Manager::render_icon( $settings['aem_infobox_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php endif; ?>

						<?php if( 'img' === $settings['aem_infobox_img_or_icon'] ) :
							echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'aem_infobox_image' );
						endif; ?>	
					</div>
			  	<?php } ?>
	            <div class="aem-infobox-content">
	            	<?php if( !empty( $settings['aem_infobox_title_link']['url'] ) ) { ?>
                        <a <?php echo $this->get_render_attribute_string( 'aem_infobox_title_link' ); ?>>
                    <?php } ?>
	            	<?php $title ? printf( '<'. Utils::validate_html_tag( $settings['aem_infobox_title_html_tag'] ) . ' ' .$this->get_render_attribute_string( 'aem_infobox_title' ).'>%s</'.Utils::validate_html_tag( $settings['aem_infobox_title_html_tag'] ).'>', Helper::aem_wp_kses( $title ) ) : ''; ?>
	            	<?php if( !empty( $settings['aem_infobox_title_link']['url'] ) ) { ?>
                        </a>
                    <?php } ?>

	            	<?php $details ? printf( '<div '.$this->get_render_attribute_string( 'aem_infobox_description' ).'>%s</div>', wp_kses_post( $details ) ) : ''; ?>
	            </div>
          	</div>
        </div>
		<?php
	}

	/**
     * Render infoBox widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function content_template() {
		?>
		<#
			view.addRenderAttribute( 'aem_infobox_transition', {
				'class': [ 
					'aem-infobox-item', 
					settings.aem_infobox_alignment,
					settings.aem_infobox_icon_position,
					'aem-infobox-enable-box-'+settings.aem_infobox_enable_box
				]
			} );

			if ( settings.aem_infobox_image.url || settings.aem_infobox_image.id ) {
				var image = {
					id: settings.aem_infobox_image.id,
					url: settings.aem_infobox_image.url,
					size: settings.thumbnail_size,
					dimension: settings.thumbnail_custom_dimension,
					class: 'aem-infobox-img',
					model: view.getEditModel()
				};

				var image_url = elementor.imagesManager.getImageUrl( image );
			}

			if ( 'yes' === settings.aem_infobox_transition_top ){
				view.addRenderAttribute( 'aem_infobox_transition', 'class', 'simple-transition' );
			}

			if ( 'yes' === settings.aem_infobox_transition_zoom ){
				view.addRenderAttribute( 'aem_infobox_transition', 'class', 'zoom-transition' );
			}

			var iconHTML     = elementor.helpers.renderIcon( view, settings.aem_infobox_icon, { 'aria-hidden': true }, 'i' , 'object' );

			view.addRenderAttribute( 'aem_infobox_title', 'class', 'aem-infobox-content-title' );
			view.addInlineEditingAttributes( 'aem_infobox_title', 'none' );

	        view.addRenderAttribute( 'aem_infobox_description', 'class', 'aem-infobox-content-description' );
			view.addInlineEditingAttributes( 'aem_infobox_description' );

			var target = settings.aem_infobox_title_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.aem_infobox_title_link.nofollow ? ' rel="nofollow"' : '';

			var titleHTMLTag = elementor.helpers.validateHTMLTag( settings.aem_infobox_title_html_tag );

		#>
		<div class="aem-infobox">
			<div {{{ view.getRenderAttributeString( 'aem_infobox_transition' ) }}}>
				<# if( 'none' !== settings.aem_infobox_img_or_icon ) { #>
					<# if( 'yes' === settings.aem_infobox_animating_mask_switcher ) { #>
						<div class="aem-infobox-icon {{ settings.aem_infobox_animating_mask_style }}">
							<# if ( 'icon' === settings.aem_infobox_img_or_icon && iconHTML.value ) { #>
								<div class="aem-flip-box-front-image">
									{{{ iconHTML.value }}}
								</div>
							<# } #>

							<# if ( 'img' === settings.aem_infobox_img_or_icon && image_url ) { #>
								<img src="{{{ image_url }}}">
							<# } #>
						</div>
					<# } else { #>
						<div class="aem-infobox-icon">
							<# if ( 'icon' === settings.aem_infobox_img_or_icon && iconHTML.value ) { #>
								<div class="aem-flip-box-front-image">
									{{{ iconHTML.value }}}
								</div>
							<# } #>

							<# if ( 'img' === settings.aem_infobox_img_or_icon && image_url ) { #>
								<img src="{{{ image_url }}}">
							<# } #>
						</div>
					<# } #>
				<# } #>

				<div class="aem-infobox-content">
					<# if(  settings.aem_infobox_title_link.url ) { #>
						<a href="{{{ settings.aem_infobox_title_link.url }}}" {{{ view.getRenderAttributeString( 'aem_infobox_title_link' ) }}}{{{ target }}}{{{ nofollow }}}>
					<# } #>

					<# if ( settings.aem_infobox_title ) { #>
			        	<{{{ titleHTMLTag }}} {{{ view.getRenderAttributeString( 'aem_infobox_title' ) }}}>
			        		{{{ settings.aem_infobox_title }}}
			        	</{{{ titleHTMLTag }}}>
			    	<# } #>

					<# if ( settings.aem_infobox_description ) { #>
			        	<div {{{ view.getRenderAttributeString( 'aem_infobox_description' ) }}}>
			        		{{{ settings.aem_infobox_description }}}
			        	</div>
			    	<# } #>

					<# if(  settings.aem_infobox_title_link.url ) { #>
						</a>
					<# } #>

				</div>
			</div>
		</div>
		<?php
	}
}