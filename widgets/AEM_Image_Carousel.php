<?php

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class AEM_Image_Carousel extends Widget_Base {
	
	public function get_name() {
		return 'aem-image-carousel';
	}

	public function get_title() {
		return esc_html__( 'Image Carousel', AEM_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-carousel';
	}

	public function get_categories() {
		return [ 'aem-category' ];
	}

	public function get_script_depends() {
		return [ 'aem-slick' ];
	}

	public function get_keywords() {
        return [ 'image', 'slider', 'thumbnail', 'brand' ];
    }
	protected function register_controls() {
		$aem_primary_color   = get_option( 'aem_primary_color_option', '#7a56ff' );
		
	    /*
	    * Logo carousel Image
	    */
	    $this->start_controls_section(
			'aem_logo_carousel_content',
			[
				'label' => esc_html__( 'Content', AEM_TEXTDOMAIN )
			]
		);

        $logo_repeater = new Repeater();

		$logo_repeater->add_control(
			'aem_logo_carousel_image',
			[
				'label'   => __( 'Logo', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
        );
        
		$logo_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'logo_image_size',
				'default'   => 'full',
				'condition' => [
					'aem_logo_carousel_image[url]!' => ''
				]
			]
		);
        
		$logo_repeater->add_control(
			'aem_logo_carousel_link_to_type',
			[
				'label'   => esc_html__( 'Link to', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'separator'  => 'before',
				'options' => [
					''       => esc_html__( 'None', AEM_TEXTDOMAIN ),
					'file'   => esc_html__( 'Media File', AEM_TEXTDOMAIN ),
					'custom' => esc_html__( 'Custom URL', AEM_TEXTDOMAIN ),
				],
			]
		);

		$logo_repeater->add_control(
			'aem_logo_carousel_image_link_to',
			[
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'dynamic'     => [ 'active' => true ],
				'separator'  => 'none',
				'show_label' => false,
				'condition' => [
					'aem_logo_carousel_link_to_type' => 'custom',
				],
			]
		);

        $this->add_control(
			'aem_logo_carousel_repeater',
			[
				'label'   => esc_html__( 'Logo Carousel', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $logo_repeater->get_controls(),
				'default' => [
					[ 'aem_logo_carousel_image' => Utils::get_placeholder_image_src() ],
					[ 'aem_logo_carousel_image' => Utils::get_placeholder_image_src() ],
					[ 'aem_logo_carousel_image' => Utils::get_placeholder_image_src() ],
					[ 'aem_logo_carousel_image' => Utils::get_placeholder_image_src() ]
				]	
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'aem_logo_carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', AEM_TEXTDOMAIN )
			]
		);

		$this->add_responsive_control(
			'aem_logo_slide_to_show',
			[
				'label'   => esc_html__( 'Columns', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);

		$this->add_control(
			'aem_logo_slide_to_scroll',
			[
				'label'   => esc_html__( 'Slide to Scroll', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1'
			]
		);

		$this->add_control(
			'aem_logo_carousel_nav',
			[
				'label'     => esc_html__( 'Navigation', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'arrows',
				'separator' => 'before',
				'options' => [
                    'arrows' => esc_html__( 'Arrows', AEM_TEXTDOMAIN ),
                    'dots'   => esc_html__( 'Dots', AEM_TEXTDOMAIN ),
                    'both'   => esc_html__( 'Arrows and Dots', AEM_TEXTDOMAIN ),
                    'none'   => esc_html__( 'None', AEM_TEXTDOMAIN )
                    
                ]
			]
		);

		$this->add_control(
			'aem_logo_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'default'   => 'no'
			]
		);

		$this->add_control(
			'aem_logo_autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'aem_logo_autoplay' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_logo_loop',
			[
				'label'   => esc_html__( 'Infinite Loop', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'aem_logo_smooth_scroll',
			[
				'label'   => esc_html__( 'Smooth Scroll', AEM_TEXTDOMAIN ),
				'description' => __( '<b>Autoplay Speed option not working. This is not necessary for linear slide</b>', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->add_control(
			'aem_logo_smooth_scroll_speed',
			[
				'label'     => esc_html__( 'Speed', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3000,
				'condition' => [
					'aem_logo_smooth_scroll' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/*
		* Logo Carousel Styling Section
		*/

		$this->start_controls_section(
			'aem_logo_carousel_style_background',
			[
				'label' => esc_html__( 'General Style', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'aem_logo_carousel_max_height_enable',
            [
                'label'        => __( 'Minimum Height', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_responsive_control(
			'aem_logo_carousel_max_height',
			[
				'label' => __( 'Height', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .aem-image-carousel-element.aem-image-carousel-max-height-yes .aem-image-carousel-item' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'aem_logo_carousel_max_height_enable' => 'yes'
                ]
			]
		);

		$this->add_control(
			'aem_logo_carousel_alignment',
			[
				'label'       => esc_html__( 'Alignment', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => true,
				'options'     => [
					'aem-image-carousel-left'   => [
						'title' => esc_html__( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'aem-image-carousel-center' => [
						'title' => esc_html__( 'Center', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'aem-image-carousel-right'  => [
						'title' => esc_html__( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default'     => 'aem-image-carousel-center'
			]
		);

		$this->add_responsive_control(
			'aem_logo_carousel_item_radius',
			[
				'label'      => esc_html__( 'Item Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-image-carousel .aem-image-carousel-element .aem-image-carousel-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_logo_carousel_item_margin',
			[
				'label'      => esc_html__( 'Item margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default'    => [
					'top'    => '0',
					'right'  => '10',
					'bottom' => '20',
					'left'   => '10'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-image-carousel .aem-image-carousel-element .aem-image-carousel-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_logo_carousel_item_padding',
			[
				'label'      => esc_html__( 'Item Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .aem-image-carousel .aem-image-carousel-element .aem-image-carousel-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'aem_logo_carousel_background_tabs' );

			$this->start_controls_tab( 'aem_logo_carousel_background_control', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_logo_carousel_background',
					[
						'label'     => esc_html__( 'Background', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-item' => 'background: {{VALUE}};'
						]
					]
				);
				$this->add_control(
					'aem_logo_carousel_opacity_normal',
					[
						'label'     => __('Opacity', AEM_TEXTDOMAIN),
						'type'      => Controls_Manager::NUMBER,
						'range'     => [
							'min'   => 0,
							'max'   => 1
						],
						'selectors' => [
							'{{WRAPPER}} .aem-image-carousel .aem-image-carousel-element .aem-image-carousel-item img' => 'opacity: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_logo_carousel_border_normal',
						'selector' => '{{WRAPPER}} .aem-image-carousel .aem-image-carousel-element .aem-image-carousel-item'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_logo_carousel_shadow_normal',
						'selector' => '{{WRAPPER}} .aem-image-carousel .aem-image-carousel-element .aem-image-carousel-item'
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'aem_logo_carousel_background_hover_control', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_logo_carousel_background_hover',
					[
						'label'     => esc_html__( 'Background Hover', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-item:hover' => 'background: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'aem_logo_carousel_opacity_hover',
					[
						'label'     => __('Opacity', AEM_TEXTDOMAIN),
						'type'      => Controls_Manager::NUMBER,
						'range'     => [
							'min'   => 0,
							'max'   => 1
						],
						'selectors' => [
							'{{WRAPPER}} .aem-image-carousel .aem-image-carousel-element .aem-image-carousel-item:hover img' => 'opacity: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_logo_carousel_border_hover',
						'selector' => '{{WRAPPER}} .aem-image-carousel .aem-image-carousel-element .aem-image-carousel-item:hover'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_logo_carousel_shadow_hover',
						'selector' => '{{WRAPPER}} .aem-image-carousel .aem-image-carousel-element .aem-image-carousel-item:hover'
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();
		
		$this->end_controls_section();

		$this->start_controls_section(
            'aem_logo_carousel_arrow_controls_style_section',
            [
                'label'     => __('Arrow Controls', AEM_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'aem_logo_carousel_nav' => ['arrows', 'both']
                ]               
            ]
        );

        $this->add_control(
            'aem_logo_carousel_arrows_style',
            [
				'label' => esc_html__( 'Arrows', AEM_TEXTDOMAIN ),
				'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_responsive_control(
            'aem_logo_carousel_arrows_size',
            [
                'label'         => __( 'Size', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 20
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 70,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev i, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_logo_carousel_arrow_width',
            [
                'label'         => __( 'Width', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 60
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 200,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_logo_carousel_arrow_height',
            [
                'label'         => __( 'Height', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 60
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 1,
                        'max'   => 200,
                        'step'  => 1
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};'
                ]
            ]
		);
		
		$this->add_control(
			'aem_logo_carousel_prev_arrow_position',
			[
				'label' => __( 'Previous Arrow Position', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', AEM_TEXTDOMAIN ),
				'label_on' => __( 'Custom', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'aem_logo_carousel_prev_arrow_position_x_offset',
                [
                    'label' => __( 'X Offset', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'aem_logo_carousel_prev_arrow_position_y_offset',
                [
                    'label' => __( 'Y Offset', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

        $this->add_control(
			'aem_logo_carousel_next_arrow_position',
			[
				'label' => __( 'Next Arrow Position', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', AEM_TEXTDOMAIN ),
				'label_on' => __( 'Custom', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );
        
        $this->start_popover();

            $this->add_responsive_control(
                'aem_logo_carousel_next_arrow_position_x_offset',
                [
                    'label' => __( 'X Offset', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'aem_logo_carousel_next_arrow_position_y_offset',
                [
                    'label' => __( 'Y Offset', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -500,
                            'max' => 500,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

		$this->end_popover();
		
		$this->add_responsive_control(
			'aem_logo_carousel_arrows_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ '%'],
				'selectors'  => [
					'{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next,{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'default'    => [
					'top'    => 50,
					'right'  => 50,
					'bottom' => 50,
					'left'   => 50
				] 
			]
		);

		$this->start_controls_tabs( 'aem_logo_carousel_arrows_style_tabs' );

        	// normal state tab
        	$this->start_controls_tab( 'aem_logo_carousel_arrow_normal_style', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

		        $this->add_control(
		            'aem_logo_carousel_arrows_color',
		            [
		                'label'         => __( 'Color', AEM_TEXTDOMAIN ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#000000',
		                'selectors'     => [
		                    '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next i, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev i' => 'color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_control(
		            'aem_logo_carousel_arrows_bg_color',
		            [
		                'label'         => __( 'Background Color', AEM_TEXTDOMAIN ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#dddddd',
		                'selectors'     => [
		                    '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev' => 'background-color: {{VALUE}}'
		                ]            
		            ]
		        );

		        $this->add_group_control(
		        	Group_Control_Border::get_type(),
		            [
		                'name'      => 'aem_logo_carousel_arrows_border',
		                'selector'  => '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev'
		            ]
		        );

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_logo_carousel_arrows_shadow',
						'selector' => '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next'
					]
				);

			$this->end_controls_tab();


        	// hover state tab
        	$this->start_controls_tab( 'aem_logo_carousel_arrow_hover_style', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

		        $this->add_control(
		            'aem_logo_carousel_arrows_hover_color',
		            [
		                'label'         => __( 'Color', AEM_TEXTDOMAIN ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => '#ffffff',
		                'selectors'     => [
		                    '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next:hover i, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev:hover i' => 'color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_control(
		            'aem_logo_carousel_arrows_hover_bg_color',
		            [
		                'label'         => __( 'Background Color', AEM_TEXTDOMAIN ),
		                'type'          => Controls_Manager::COLOR,
		                'default'       => $aem_primary_color,
		                'selectors'     => [
		                    '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next:hover, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev:hover' => 'background-color: {{VALUE}}'
		                ]          
		            ]
		        );

		        $this->add_group_control(
		        	Group_Control_Border::get_type(),
		            [
		                'name'      => 'aem_logo_carousel_arrows_hover_border',
		                'selector'  => '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next:hover, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev:hover'
		            ]
		        );

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_logo_carousel_arrows_hover_shadow',
						'selector' => '{{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-prev:hover, {{WRAPPER}} .aem-image-carousel-element .aem-image-carousel-next:hover'
					]
				);

			$this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'aem_logo_carousel_dot_bullet_controls_style_section',
            [
                'label'     => __('Dots', AEM_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'aem_logo_carousel_nav' => ['dots', 'both']
                ]                
            ]
        );

        $this->add_responsive_control(
            'aem_logo_carousel_dot_bullet_margin',
            [
                'label'      => __('Margin', AEM_TEXTDOMAIN),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
					'top'    => 0,
					'right'  => 10,
					'bottom' => 0,
					'left'   => 0
                ], 
                'selectors'  => [
                    '{{WRAPPER}} .aem-image-carousel .slick-dots li button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'aem_logo_carousel_dot_bullet_style_tabs' );

        // normal state tab
        $this->start_controls_tab( 'aem_logo_carousel_dot_bullet_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

            $this->add_responsive_control(
                'aem_logo_carousel_dot_bullet_height',
                [
                    'label'  => __( 'Height', AEM_TEXTDOMAIN ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'default'  => [
                        'size' => 10,
                        'unit' => 'px'
                    ],
                    'selectors'=> [
                        '{{WRAPPER}} .aem-image-carousel .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
                'aem_logo_carousel_dot_bullet_width',
                [
                    'label'  => __( 'Width', AEM_TEXTDOMAIN ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'default'  => [
                        'size' => 10,
                        'unit' => 'px'
                    ],
                    'selectors'=> [
                        '{{WRAPPER}} .aem-image-carousel .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_control(
                'aem_logo_carousel_dot_bullet_color',
                [
                    'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#dadada',
                    'selectors' => [
                        '{{WRAPPER}} .aem-image-carousel .slick-dots li button' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'            => 'aem_logo_carousel_dot_bullet_border',
                    'selector'        => '{{WRAPPER}} .aem-image-carousel .slick-dots li button',
                ]
            );

            $this->add_responsive_control(
                'aem_logo_carousel_dot_bullet_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'default'    => [
                        'top'    => 100,
                        'right'  => 100,
                        'bottom' => 100,
                        'left'   => 100,
                        'unit'   => '%'
                    ],                
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .aem-image-carousel .slick-dots li button'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

            // active state tab
            $this->start_controls_tab( 'aem_logo_carousel_dot_bullet_active', [ 'label' => esc_html__( 'Active', AEM_TEXTDOMAIN ) ] );

            $this->add_responsive_control(
                'aem_logo_carousel_dot_bullet_active_height',
                [
                    'label'  => __( 'Height', AEM_TEXTDOMAIN ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .aem-image-carousel .slick-dots li.slick-active button' => 'height: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_responsive_control(
                'aem_logo_carousel_dot_bullet_active_width',
                [
                    'label'  => __( 'Width', AEM_TEXTDOMAIN ),
                    'type'   => Controls_Manager::SLIDER,
                    'range'  => [
                        'px' => [
                            'min' => 1,
                            'max' => 100
                        ]
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .aem-image-carousel .slick-dots li.slick-active button' => 'width: {{SIZE}}{{UNIT}};'
                    ]
                ]
            );

            $this->add_control(
                'aem_logo_carousel_dot_bullet_active_color',
                [
                    'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => $aem_primary_color,
                    'selectors' => [
                        '{{WRAPPER}} .aem-image-carousel .slick-dots li.slick-active button' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
					'name'     => 'aem_logo_carousel_dot_bullet_active_border',
					'selector' => '{{WRAPPER}} .aem-image-carousel .slick-dots li.slick-active button'
                ]
            );

            $this->add_responsive_control(
                'aem_logo_carousel_dot_bullet_active_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type'       => Controls_Manager::DIMENSIONS,         
                    'size_units'    => [ 'px', 'em', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .aem-image-carousel .slick-dots li.slick-active button'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


	}
	protected function render() {
		$settings  = $this->get_settings_for_display();
		$direction = is_rtl() ? 'true' : 'false';

		$this->add_render_attribute( 
			'aem_logo_carousel', 
			[ 
				'class'               => ['aem-image-carousel-element', 'aem-image-carousel-max-height-'.esc_attr($settings['aem_logo_carousel_max_height_enable'])],
				'data-carousel-nav'   => esc_attr( $settings['aem_logo_carousel_nav'] ),
				'data-slidestoshow'   => esc_attr( $settings['aem_logo_slide_to_show'] ),
				'data-slidestoshow-tablet'   => intval( esc_attr( isset( $settings['aem_logo_slide_to_show_tablet'] ) ) ? (int)$settings['aem_logo_slide_to_show_tablet'] : 2  ),
				'data-slidestoshow-mobile'   => intval( esc_attr( isset( $settings['aem_logo_slide_to_show_mobile'] ) ) ? (int)$settings['aem_logo_slide_to_show_mobile'] : 1),
				'data-slidestoscroll' => esc_attr( $settings['aem_logo_slide_to_scroll'] ),
				'data-direction'      => esc_attr( $direction ),
			]
		);

		if ( 'yes' === $settings['aem_logo_loop'] ) {
			$this->add_render_attribute( 'aem_logo_carousel', 'data-loop', 'true' );
		}
		if ( 'yes' === $settings['aem_logo_autoplay'] ) {
			$this->add_render_attribute( 'aem_logo_carousel', 'data-autoplay', 'true' );
			$this->add_render_attribute( 'aem_logo_carousel', 'data-autoplayspeed', esc_attr( $settings['aem_logo_autoplay_speed'] ) );
		}
		if ( 'yes' === $settings['aem_logo_smooth_scroll'] ) {
			$this->add_render_attribute( 'aem_logo_carousel', 'data-smooth', 'true' );
			$this->add_render_attribute( 'aem_logo_carousel', 'data-smooth-speed', esc_attr( $settings['aem_logo_smooth_scroll_speed'] ) );
		}

		if ( is_array( $settings['aem_logo_carousel_repeater'] ) ) : ?>
			<div class="aem-image-carousel">
				<div <?php echo $this->get_render_attribute_string('aem_logo_carousel') ;?> >
					<?php foreach ( $settings['aem_logo_carousel_repeater'] as $index => $logo ) :?>
						<?php $logo_link = 'aem-image-link-' . $index ;?>
						<div class="aem-image-carousel-item <?php echo esc_attr( $settings['aem_logo_carousel_alignment'] );?>">
						<?php 
							if ( ! empty( $logo['aem_logo_carousel_image_link_to']['url'] ) ) {
								$this->add_render_attribute( $logo_link, 'href', $logo['aem_logo_carousel_image_link_to']['url'] );

								if ( $logo['aem_logo_carousel_image_link_to']['is_external'] ) {
									$this->add_render_attribute( $logo_link, 'target', '_blank' );
								}

								if ( $logo['aem_logo_carousel_image_link_to']['nofollow'] ) {
									$this->add_render_attribute( $logo_link, 'rel', 'nofollow' );
								}
							} else if( "file" === $logo['aem_logo_carousel_link_to_type'] ) {
								$this->add_render_attribute( $logo_link, 'href', $logo['aem_logo_carousel_image']['url'] );
								$this->add_render_attribute( $logo_link, 'class', 'aem-image-carousel-lightbox' );
								$this->add_render_attribute( $logo_link, 'data-elementor-open-lightbox', 'yes' );
							}
							if( ! empty( $logo['aem_logo_carousel_link_to_type'] ) ){
						?>
						<a <?php echo $this->get_render_attribute_string( $logo_link ); ?> > <?php } ?>

							<?php echo Group_Control_Image_Size::get_attachment_image_html( $logo, 'logo_image_size', 'aem_logo_carousel_image' ); ?>

						<?php if( ! empty( $logo['aem_logo_carousel_link_to_type'] ) ){ ?>
							</a>
						<?php } ?>

						</div>					
					<?php endforeach; ?>
				</div>
			</div>
		<?php
		endif;
	}
}