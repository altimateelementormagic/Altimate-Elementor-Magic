<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use AEM_Addons_Elementor\classes\Helper;

class AEM_Flipbox extends Widget_Base {

	public function get_name() {
		return 'aem-flipbox';
	}

	public function get_title() {
		return esc_html__( 'Flip Box', AEM_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-flip-box';
	}

   	public function get_categories() {
		return [ 'aem-category' ];
	}

	public function get_keywords() {
        return [ 'info', 'flipbox' ];
    }

	protected function register_controls() {
		$goee_primary_color = get_option( 'goee_primary_color_option', '#7a56ff' );

  		$this->start_controls_section(
			'goee_section_side_a_content',
			[
				'label' => __( 'Front', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_flipbox_front_icon_image',
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
			'goee_flipbox_front_icon',
			[
				'label'   => __( 'Icon', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::ICONS,
                'default' => [
					'value'   => 'fas fa-heart',
					'library' => 'fa-solid'
				],
				'condition' => [
					'goee_flipbox_front_icon_image' => 'icon'
				]
			]
		);

		$this->add_control(
			'goee_flipbox_front_image',
			[
				'label'     => esc_html__( 'Image', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url'   => Utils::get_placeholder_image_src()
				],
				'condition' => [
					'goee_flipbox_front_icon_image' => 'img'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'goee_flipbox_front_image_thumbnail',
				'default'   => 'medium_large',
				'condition' => [
					'goee_flipbox_front_icon_image' => 'img'
				]
			]
		);

		$this->add_control(
			'goee_flipbox_front_title',
			[
				'label'       => __( 'Title', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Front', AEM_TEXTDOMAIN ),
				'placeholder' => __( 'Your Title', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
            'goee_flipbox_front_title_html_tag',
            [
                'label'   => __('Title HTML Tag', AEM_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::goee_title_tags(),
                'default' => 'h3',
            ]
		);

		$this->add_control(
			'goee_flipbox_front_description',
			[
				'label'       => __( 'Description', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor. Add some more test in here.', AEM_TEXTDOMAIN ),
				'placeholder' => __( 'Your Description', AEM_TEXTDOMAIN ),
				'title'       => __( 'Input image text here', AEM_TEXTDOMAIN )
			]
		);
	
		$this->end_controls_section();

		$this->start_controls_section(
			'goee_section_back_content',
			[
				'label' => __( 'Back', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_flipbox_back_icon_image',
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
			'goee_flipbox_back_icon',
			[
				'label'     => __( 'Icon', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::ICONS,
				'condition' => [
					'goee_flipbox_back_icon_image' => 'icon'
				]
			]
		);

		$this->add_control(
			'goee_flipbox_back_image',
			[
				'label'     => esc_html__( 'Image', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url'   => Utils::get_placeholder_image_src()
				],
				'condition' => [
					'goee_flipbox_back_icon_image' => 'img'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'goee_flipbox_back_image_thumbnail',
				'default'   => 'medium_large',
				'condition' => [
					'goee_flipbox_back_icon_image' => 'img'
				]
			]
		);

		$this->add_control(
			'goee_flipbox_back_title',
			[
				'label'       => __( 'Title', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Heading Back', AEM_TEXTDOMAIN ),
				'placeholder' => __( 'Your Title', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
            'goee_flipbox_back_title_html_tag',
            [
                'label'   => __('Title HTML Tag', AEM_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::goee_title_tags(),
                'default' => 'h2',
            ]
		);

		$this->add_control(
			'goee_flipbox_back_description',
			[
				'label'       => __( 'Description', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', AEM_TEXTDOMAIN ),
				'placeholder' => __( 'Your Description', AEM_TEXTDOMAIN ),
				'title'       => __( 'Input image text here', AEM_TEXTDOMAIN ),
				'separator'   => 'none'
			]
		);

		$this->add_control(
			'goee_flipbox_back_button_enable',
			[
				'label' => __( 'Show Button', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off' => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'goee_flipbox_button_text',
			[
				'label'     => __( 'Button Text', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [ 'active' => true ],
				'default'   => __( 'Read More', AEM_TEXTDOMAIN ),
				'separator' => 'before',
				'condition' => [
					'goee_flipbox_back_button_enable' => 'yes'
				]
			]
		);

		$this->add_control(
			'goee_flipbox_button_link',
			[
				'label'       => __( 'Link', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
				'show_external' => true,
				 'condition' => [
					'goee_flipbox_back_button_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'goee_section_flipbox_settings',
			[
				'label' => __( 'Flip Settings', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'goee_flipbox_style',
			[
				'label'   => __( 'Flip Direction', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left-to-right',
				'options' => [
					'left-to-right'       => __( 'Left to Right', AEM_TEXTDOMAIN ),
					'right-to-left'       => __( 'Right to Left', AEM_TEXTDOMAIN ),
					'top-to-bottom'       => __( 'Top to Bottom', AEM_TEXTDOMAIN ),
					'bottom-to-top'       => __( 'Bottom to Top', AEM_TEXTDOMAIN ),
					'top-to-bottom-angle' => __( 'Diagonal (Top to Bottom)', AEM_TEXTDOMAIN ),
					'bottom-to-top-angle' => __( 'Diagonal (Bottom to Top)', AEM_TEXTDOMAIN ),
					'fade-in-out'         => __( 'Fade In Out', AEM_TEXTDOMAIN ),
					'three-d-flip'        => __( '3D Rotation', AEM_TEXTDOMAIN ),
					'fade'        		  => __( 'Fade', AEM_TEXTDOMAIN ),
				]
				
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'goee_section_flipbox_container',
			[
				'label' => __( 'Container', AEM_TEXTDOMAIN ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_3d_height',
			[
				'label'      => __( 'Height', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px'      => [
						'min' => 0,
						'max' => 1000
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 300
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-inner .aem-flip-box-front,
					{{WRAPPER}} .aem-flip-box .aem-flip-box-inner .aem-flip-box-back' => 'min-height: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Front)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_front_end_style_section',
			[
				'label' => __( 'Front', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'goee_flipbox_front_container',
			[
				'label'     => esc_html__( 'Container', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'front_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-inner .aem-flip-box-front'
			]
		);

		$this->add_control(
			'goee_flipbox_front_background_oberlay',
			[
				'label'     => esc_html__( 'Background Overlay', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box-front-overlay' => 'background: {{VALUE}};'
				]		
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_front_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'goee_flipbox_front_container_border',
				'selector'           => '{{WRAPPER}} .aem-flip-box .aem-flip-box-front',
			  	'fields_options'     => [
                    'border'         => [
                        'default'    => 'solid'
                    ],
                    'width'          => [
                        'default'    => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                 	'color'          => [
                        'default'    => $goee_primary_color
                    ]
                ]
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_front_border_radius',
			[
				'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'goee_flipbox_front_box_shadow',
				'label'    => __( 'Box Shadow', AEM_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-front'
			]
		);

		$this->add_responsive_control(
            'goee_flipbox_front_content_alignment',
            [
                'label'          => esc_html__( 'Alignment', AEM_TEXTDOMAIN ),
                'type'           => Controls_Manager::CHOOSE,
                'toggle'         => false,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', AEM_TEXTDOMAIN ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', AEM_TEXTDOMAIN ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', AEM_TEXTDOMAIN ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                'default'        => 'center'
            ]
        ); 

		$this->add_control(
			'goee_flipbox_front_icon_style',
			[
				'label'     => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
                    'goee_flipbox_front_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_front_icon_box_height_width',
			[
				'label'       => __( 'Box Size/Image Size', AEM_TEXTDOMAIN ),
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
                    'size'    => 90
                ],
				'selectors'   => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-image' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
                    'goee_flipbox_front_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
            'goee_flipbox_front_icon_size',
            [
                'label'        => esc_html__( 'Icon Size', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 150,
                        'step' => 2
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 50
                ],
                'selectors'    => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-image i' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-image svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;'
                ],
                'condition' => [
                    'goee_flipbox_front_icon[value]!' => '',
					'goee_flipbox_front_icon_image' => 'icon'
                ]
            ]
        );

		$this->add_control(
			'goee_flipbox_front_icon_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => $goee_primary_color,
				'selectors' => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-image i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-image svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
                    'goee_flipbox_front_icon[value]!' => ''
                ]				
			]
		);

		$this->add_control(
			'goee_flipbox_front_icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-image' => 'background-color: {{VALUE}};'
				],
				'condition' => [
                    'goee_flipbox_front_icon[value]!' => ''
                ]				
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_front_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-inner .aem-flip-box-front .aem-flip-box-front-image'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
                    'goee_flipbox_front_icon[value]!' => ''
                ]
			]
		);

		$this->add_control(
			'goee_flipbox_front_title_heading',
			[
				'label'     => esc_html__( 'Title', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'goee_flipbox_front_title_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-title' => 'color: {{VALUE}};'
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_flipbox_front_title_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ]
	            ],
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-title'
			]
		);

		$this->add_responsive_control(
            'goee_flipbox_front_title_margin',
            [
				'label'      => __('Margin', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'      => '20',
                    'right'    => '0',
                    'bottom'   => '10',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
                    '{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'goee_flipbox_content_heading',
			[
				'label'     => esc_html__( 'Description', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'goee_flipbox_front_content_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#817e7e',
				'selectors' => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-description' => 'color: {{VALUE}};'
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_flipbox_front_content_typography',
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-description'				
			]
		);

		$this->add_responsive_control(
            'goee_flipbox_front_content_margin',
            [
				'label'      => __('Margin', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
                    '{{WRAPPER}} .aem-flip-box .aem-flip-box-front .aem-flip-box-front-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style (Flipbox Back)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'goee_back_end_style_section',
			[
				'label' => __( 'Back', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'goee_flipbox_back_container_heading',
			[
				'label'     => esc_html__( 'Container', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'goee_flipbox_back_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-inner .aem-flip-box-back',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => $goee_primary_color
					]
				]
			]
		);

		$this->add_control(
			'goee_flipbox_back_background_oberlay',
			[
				'label'     => esc_html__( 'Background Overlay', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box-back-overlay' => 'background: {{VALUE}};'
				]		
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_back_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '30',
                    'right'    => '20',
                    'bottom'   => '30',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'goee_flipbox_back_container_border',
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-back'
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_back_border_radius',
			[
				'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'goee_flipbox_back_box_shadow',
				'label'    => __( 'Box Shadow', AEM_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-back'
			]
		);

		$this->add_responsive_control(
            'goee_flipbox_back_content_alignment',
            [
                'label'          => esc_html__( 'Alignment', AEM_TEXTDOMAIN ),
                'type'           => Controls_Manager::CHOOSE,
                'toggle'         => false,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', AEM_TEXTDOMAIN ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', AEM_TEXTDOMAIN ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', AEM_TEXTDOMAIN ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                'default'        => 'center'
            ]
        ); 

		$this->add_control(
			'goee_flipbox_back_icon_style',
			[
				'label'     => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
                    'goee_flipbox_back_icon[value]!' => ''
                ] 
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_back_icon_box_height_width',
			[
				'label'       => __( 'Box Size/Image Size', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 200
					]
				],
				'default'     => [
                    'unit'    => 'px',
                    'size'    => 90
                ],
				'selectors'   => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-image' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
                    'goee_flipbox_back_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
            'goee_flipbox_back_icon_size',
            [
                'label'        => esc_html__( 'Icon Size', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 150,
                        'step' => 2
                    ]
                ],
                'selectors'    => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back i' => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;'
                ],
                'condition'    => [
                    'goee_flipbox_back_icon[value]!' => '',
                    'goee_flipbox_back_icon_image' => 'icon'
                ]
            ]
        );

		$this->add_control(
			'goee_flipbox_back_icon_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
                    'goee_flipbox_back_icon[value]!' => ''
                ]				
			]
		);

		$this->add_control(
			'goee_flipbox_back_icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-image' => 'background-color: {{VALUE}};'
				],
				'condition' => [
                    'goee_flipbox_back_icon[value]!' => ''
                ]
				
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_back_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-image'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
                    'goee_flipbox_back_icon[value]!' => ''
                ]
			]
		);

		$this->add_control(
			'goee_flipbox_back_title_heading',
			[
				'label'     => esc_html__( 'Title', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);		

		$this->add_control(
			'goee_flipbox_back_title_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-title' => 'color: {{VALUE}};'
				]
				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_flipbox_back_title_typography',
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-title'
			]
		);

		$this->add_responsive_control(
            'goee_flipbox_back_title_margin',
            [
				'label'      => __('Margin', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'      => '6',
                    'right'    => '0',
                    'bottom'   => '20',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
                    '{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'goee_flipbox_back_details_heading',
			[
				'label'     => esc_html__( 'Details', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'goee_flipbox_back_details_color',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-description' => 'color: {{VALUE}};'
				]				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_flipbox_back_details_typography',
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-description'
				
			]
		);

		$this->add_responsive_control(
            'goee_flipbox_back_details_margin',
            [
				'label'      => __('Margin', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
                    'top'      => '6',
                    'right'    => '0',
                    'bottom'   => '20',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
                    '{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'goee_flipbox_back_button',
			[
				'label'     => esc_html__( 'Button', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'goee_flipbox_button_typography',
				'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action',
			 	'fields_options'  => [
		            'font_weight' => [
		                'default' => '400'
		            ]
	            ]
			]
		);

		$this->add_responsive_control(
			'goee_flipbox_button_padding',
			[
                'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '6',
                    'right'    => '20',
                    'bottom'   => '6',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

		$this->add_responsive_control(
			'goee_flipbox_button_margin',
			[
                'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
        );

        $this->add_responsive_control(
          'goee_flipbox_button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => '4',
                    'right'  => '4',
                    'bottom' => '4',
                    'left'   => '4'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'goee_flipbox_button_box_shadow',
                'label'    => __( 'Box Shadow', AEM_TEXTDOMAIN ),
                'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action'
            ]
        );

		$this->start_controls_tabs( 'goee_cta_button_tabs' );

			// Normal State Tab
			$this->start_controls_tab( 'goee_flipbox_btn_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'goee_flipbox_btn_normal_text_color',
					[
						'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'goee_flipbox_btn_normal_bg_color',
					[
						'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'            => 'goee_flipbox_btn_normal_border',
                        'fields_options'  => [
		                    'border'      => [
		                        'default' => 'solid'
		                    ],
		                    'width'          => [
		                        'default'    => [
		                            'top'    => '1',
		                            'right'  => '1',
		                            'bottom' => '1',
		                            'left'   => '1'
		                        ]
		                    ],
		                    'color'       => [
		                        'default' => '#ffffff'
		                    ]
		                ],
                        'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action'
                    ]
                );
			
			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'goee_flipbox_btn_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'goee_flipbox_btn_hover_text_color',
					[
						'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'goee_flipbox_btn_hover_bg_color',
					[
						'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'goee_flipbox_btn_hover_border',
                        'selector' => '{{WRAPPER}} .aem-flip-box .aem-flip-box-back .aem-flip-box-back-action:hover'
                    ]
                );

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {

		$settings    = $this->get_settings_for_display();
		$front_title = $settings['goee_flipbox_front_title'];
		$front_desc  = $settings['goee_flipbox_front_description'];
		$back_title  = $settings['goee_flipbox_back_title'];
		$back_desc   = $settings['goee_flipbox_back_description'];
	   
	    $this->add_render_attribute(
		   'goee_flipbox_attribute', 
		    [
			   'class' => [ 
			   		'aem-flip-box-inner',
			   		esc_attr( $settings['goee_flipbox_style'] ) 
			   	]
		    ]   
	    );

	    $this->add_render_attribute( 'goee_flipbox_front_title', 'class', 'aem-flip-box-front-title' );
		$this->add_inline_editing_attributes( 'goee_flipbox_front_title', 'none' );

	    $this->add_render_attribute( 'goee_flipbox_front_description', 'class', 'aem-flip-box-front-description' );
		$this->add_inline_editing_attributes( 'goee_flipbox_front_description' );


	    $this->add_render_attribute( 'goee_flipbox_back_title', 'class', 'aem-flip-box-back-title' );
		$this->add_inline_editing_attributes( 'goee_flipbox_back_title', 'none' );

	    $this->add_render_attribute( 'goee_flipbox_back_description', 'class', 'aem-flip-box-back-description' );
		$this->add_inline_editing_attributes( 'goee_flipbox_back_description' );

	    $this->add_render_attribute( 'goee_flipbox_button_link', 'class', 'aem-flip-box-back-action' );
		$this->add_inline_editing_attributes( 'goee_flipbox_button_text', 'none' );

		if( isset( $settings['goee_flipbox_button_link']['url'] ) ) {
            $this->add_render_attribute( 'goee_flipbox_button_link', 'href', esc_url( $settings['goee_flipbox_button_link']['url'] ) );
        }
        if( isset( $settings['goee_flipbox_button_link']['is_external'] ) ) {
            $this->add_render_attribute( 'goee_flipbox_button_link', 'target', '_blank' );
        }
        if( isset( $settings['goee_flipbox_button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'goee_flipbox_button_link', 'rel', 'nofollow' );
        }
		?>

		<div class="aem-flip-box">
	      	<div <?php echo $this->get_render_attribute_string( 'goee_flipbox_attribute' ); ?>>
	        	<div class="aem-flip-box-front <?php echo esc_attr( $settings['goee_flipbox_front_content_alignment'] ); ?>">
					<div class="aem-flip-box-front-overlay"></div>
	        		<div class="aem-flip-box-front-content">
					<?php do_action('goee_flipbox_frontend_content_wrapper_before');

		        		if ( 'icon' === $settings['goee_flipbox_front_icon_image'] && !empty( $settings['goee_flipbox_front_icon']['value'] ) ) { ?>
			          		<div class="aem-flip-box-front-image">
							  <?php Icons_Manager::render_icon( $settings['goee_flipbox_front_icon'] ); ?>
			        		</div>
						<?php }
		        		if ( 'img' === $settings['goee_flipbox_front_icon_image'] ) { ?>
			          		<div class="aem-flip-box-front-image">
							  	<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'goee_flipbox_front_image_thumbnail', 'goee_flipbox_front_image' ); ?>
			        		</div>
						<?php }
				        $front_title ? printf('<'. Utils::validate_html_tag( $settings['goee_flipbox_front_title_html_tag'] ) .' '.$this->get_render_attribute_string( 'goee_flipbox_front_title' ).'>%s</'.Utils::validate_html_tag( $settings['goee_flipbox_front_title_html_tag'] ).'>', Helper::goee_wp_kses( $front_title ) ) : '';
				        $front_desc ? printf('<div '.$this->get_render_attribute_string( 'goee_flipbox_front_description' ).'>%s</div>', wp_kses_post( $front_desc ) ) : '';

				        do_action('goee_flipbox_frontend_content_wrapper_after'); ?>
	        		</div>
	        	</div>

		        <div class="aem-flip-box-back <?php echo esc_attr( $settings['goee_flipbox_back_content_alignment'] ); ?>">
					<div class="aem-flip-box-back-overlay"></div>
		        	<div class="aem-flip-box-back-content">
			        <?php 
						do_action('goee_flipbox_backend_content_wrapper_before');

			        	if ( 'icon' === $settings['goee_flipbox_back_icon_image'] && !empty( $settings['goee_flipbox_back_icon']['value'] ) ) { ?>
			        		<div class="aem-flip-box-back-image">
								<?php Icons_Manager::render_icon( $settings['goee_flipbox_back_icon'] ); ?>
		          			</div>
						<?php 	  
			        	}

						if ( 'img' === $settings['goee_flipbox_back_icon_image'] ) { ?>
							<div class="aem-flip-box-back-image">
								<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'goee_flipbox_back_image_thumbnail', 'goee_flipbox_back_image' ); ?>
							</div>
						<?php }

				        $back_title ? printf('<'. Utils::validate_html_tag( $settings['goee_flipbox_back_title_html_tag'] ) .' '.$this->get_render_attribute_string( 'goee_flipbox_back_title' ).'>%s</'.Utils::validate_html_tag( $settings['goee_flipbox_back_title_html_tag'] ).'>', Helper::goee_wp_kses( $back_title) ) : '';
				        $back_desc ? printf('<div '.$this->get_render_attribute_string( 'goee_flipbox_back_description' ).'>%s</div>', wp_kses_post( $back_desc ) ) : '';

				        do_action('goee_flipbox_backend_content_wrapper_after');

						if ( $settings['goee_flipbox_back_button_enable'] === 'yes' ) { ?>
							<a <?php echo $this->get_render_attribute_string( 'goee_flipbox_button_link' ); ?>>
								<span <?php echo $this->get_render_attribute_string( 'goee_flipbox_button_text' ); ?>><?php echo esc_html( $settings['goee_flipbox_button_text'] ); ?></span>
							</a>
						<?php } ?>
			        </div>
		        </div>
	      	</div>
	    </div>
	<?php 	
	}

	/**
     * Render flipbox widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
	protected function content_template() {
		?>
		<#
			view.addRenderAttribute( 'goee_flipbox_attribute', {
				'class': [ 
					'aem-flip-box-inner', 
					settings.goee_flipbox_style
				]
			} );

			var iconHTML     = elementor.helpers.renderIcon( view, settings.goee_flipbox_front_icon, { 'aria-hidden': true }, 'i' , 'object' );
			var backIconHTML = elementor.helpers.renderIcon( view, settings.goee_flipbox_back_icon, { 'aria-hidden': true }, 'i' , 'object' );

			view.addRenderAttribute( 'goee_flipbox_front_title', 'class', 'aem-flip-box-front-title' );
			view.addInlineEditingAttributes( 'goee_flipbox_front_title', 'none' );

			view.addRenderAttribute( 'goee_flipbox_front_description', 'class', 'aem-flip-box-front-description' );
			view.addInlineEditingAttributes( 'goee_flipbox_front_description' );

			view.addRenderAttribute( 'goee_flipbox_back_title', 'class', 'aem-flip-box-back-title' );
			view.addInlineEditingAttributes( 'goee_flipbox_back_title', 'none' );

			view.addRenderAttribute( 'goee_flipbox_back_description', 'class', 'aem-flip-box-back-description' );
			view.addInlineEditingAttributes( 'goee_flipbox_back_description' );

			view.addRenderAttribute( 'goee_flipbox_button_link', 'class', 'aem-flip-box-back-action' );
			view.addInlineEditingAttributes( 'goee_flipbox_button_text', 'none' );

			var target = settings.goee_flipbox_button_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.goee_flipbox_button_link.nofollow ? ' rel="nofollow"' : '';

			var front_image = {
				id: settings.goee_flipbox_front_image.id,
				url: settings.goee_flipbox_front_image.url,
				size: settings.goee_flipbox_front_image_thumbnail_size,
				dimension: settings.goee_flipbox_front_image_thumbnail_custom_dimension,
				model: view.getEditModel()
			};
			var front_image_url = elementor.imagesManager.getImageUrl( front_image );

			var back_image = {
				id: settings.goee_flipbox_back_image.id,
				url: settings.goee_flipbox_back_image.url,
				size: settings.goee_flipbox_back_image_thumbnail_size,
				dimension: settings.goee_flipbox_back_image_thumbnail_custom_dimension,
				model: view.getEditModel()
			};
			var back_image_url = elementor.imagesManager.getImageUrl( back_image );

			var fontTitleHTMLTag = elementor.helpers.validateHTMLTag( settings.goee_flipbox_front_title_html_tag );
			var backTitleHTMLTag = elementor.helpers.validateHTMLTag( settings.goee_flipbox_back_title_html_tag );

		#>
		<div class="aem-flip-box">
			<div {{{ view.getRenderAttributeString( 'goee_flipbox_attribute' ) }}}>
				<div class="aem-flip-box-front {{{ settings.goee_flipbox_front_content_alignment }}}">
					<div class="aem-flip-box-front-overlay"></div>
					<div class="aem-flip-box-front-content">
						<# if ( 'icon' === settings.goee_flipbox_front_icon_image && iconHTML.value ) { #>
							<div class="aem-flip-box-front-image">
								{{{ iconHTML.value }}}
							</div>
						<# } #>

						<# if ( 'img' === settings.goee_flipbox_front_icon_image ) { #>
			          		<div class="aem-flip-box-front-image">
							  	<img src="{{{ front_image_url }}}" />
			        		</div>
						<# } #>

						<# if ( settings.goee_flipbox_front_title ) { #>
				        	<{{{ fontTitleHTMLTag }}} {{{ view.getRenderAttributeString( 'goee_flipbox_front_title' ) }}}>
				        		{{{ settings.goee_flipbox_front_title }}}
				        	</{{{ fontTitleHTMLTag }}}>
				    	<# } #>

						<# if ( settings.goee_flipbox_front_description ) { #>
				        	<div {{{ view.getRenderAttributeString( 'goee_flipbox_front_description' ) }}}>
				        		{{{ settings.goee_flipbox_front_description }}}
				        	</div>
				    	<# } #>
					</div>
				</div>

				<div class="aem-flip-box-back {{{ settings.goee_flipbox_back_content_alignment }}}">
					<div class="aem-flip-box-back-overlay"></div>
					<div class="aem-flip-box-back-content">
						<# if ( 'icon' === settings.goee_flipbox_back_icon_image && backIconHTML.value ) { #>
							<div class="aem-flip-box-back-image">
								{{{ backIconHTML.value }}}
							</div>
						<# } #>

						<# if ( 'img' === settings.goee_flipbox_back_icon_image ) { #>
			          		<div class="aem-flip-box-back-image">
							  	<img src="{{{ back_image_url }}}" />
			        		</div>
						<# } #>

						<# if ( settings.goee_flipbox_back_title ) { #>
				        	<{{{ backTitleHTMLTag }}} {{{ view.getRenderAttributeString( 'goee_flipbox_back_title' ) }}}>
				        		{{{ settings.goee_flipbox_back_title }}}
				        	</{{{ backTitleHTMLTag }}}>
				    	<# } #>

						<# if ( settings.goee_flipbox_back_description ) { #>
				        	<div {{{ view.getRenderAttributeString( 'goee_flipbox_back_description' ) }}}>
				        		{{{ settings.goee_flipbox_back_description }}}
				        	</div>
				    	<# } #>

						<# if ( settings.goee_flipbox_back_button_enable === 'yes' ) { #>
							<a href="{{{ settings.goee_flipbox_button_link.url }}}" {{{ view.getRenderAttributeString( 'goee_flipbox_button_link' ) }}}{{{ target }}}{{{ nofollow }}}>
								<span {{{ view.getRenderAttributeString( 'goee_flipbox_button_text' ) }}}>
									{{{ settings.goee_flipbox_button_text }}}
								</span>
							</a>
						<# } #>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}