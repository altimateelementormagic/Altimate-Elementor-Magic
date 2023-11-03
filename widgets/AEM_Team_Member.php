<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use AEM_Addons_Elementor\classes\Helper;

class AEM_Team_Member extends Widget_Base {
	
	public function get_name() {
		return 'aem-team-member';
	}

	public function get_title() {
		return esc_html__( 'Team Member', AEM_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-person';
	}

	public function get_categories() {
		return [ 'aem-category' ];
	}

	public function get_keywords() {
        return [ 'employee', 'staff' ];
    }

	protected function register_controls() {
		
		/**
		* Team Member Content Section
		*/
		$this->start_controls_section(
			'aem_team_content',
			[
				'label' => esc_html__( 'Content', AEM_TEXTDOMAIN )
			]
		);
		
		$this->add_control(
			'aem_team_member_image',
			[
				'label'   => __( 'Image', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'team_member_image_size',
				'default'   => 'medium_large',
				'condition' => [
					'aem_team_member_image[url]!' => ''
				]
			]
		);

		$this->add_control(
			'aem_team_member_name',
			[
				'label'       => esc_html__( 'Name', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'John Doe', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'aem_team_member_name_tag',
            [
                'label'   => __('Name HTML Tag', AEM_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::aem_title_tags(),
                'default' => 'h3',
            ]
		);
		
		$this->add_control(
			'aem_team_member_designation',
			[
				'label'       => esc_html__( 'Designation', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Designation', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);
		
		$this->add_control(
			'aem_team_member_description',
			[
				'label'   => esc_html__( 'Description', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Put team member details here. Click here to edit it from the inline editor.', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'aem_section_team_members_cta_btn',
			[
				'label'        => __( 'Call To Action', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'OFF', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'aem_team_members_cta_btn_text',
			[
				'label'       => esc_html__( 'Text', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Read More', AEM_TEXTDOMAIN ),
				'condition'   => [
					'aem_section_team_members_cta_btn' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'aem_team_members_cta_btn_link',
			[
				'label'       => esc_html__( 'Link', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
				'show_external' => true,
				'condition' => [
					'aem_section_team_members_cta_btn' => 'yes'
				]
			]
		);


		$this->end_controls_section();
		/*
		* Team member Social profiles section
		*/
		
		$this->start_controls_section(
			'aem_section_team_member_social_profiles',
			[
				'label' => esc_html__( 'Social Profiles', AEM_TEXTDOMAIN )
			]
		);
		$this->add_control(
			'aem_team_member_enable_social_profiles',
			[
				'label'   => esc_html__( 'Display Social Profiles?', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		
		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label'            => __( 'Icon', AEM_TEXTDOMAIN ),
				'type'             => Controls_Manager::ICONS,
				'label_block'      => true,
				'default'          => [
					'value'        => 'fab fa-wordpress',
					'library'      => 'fa-brands'
				],
				'recommended'      => [
					'fa-brands'    => [
						'android',
						'apple',
						'behance',
						'bitbucket',
						'codepen',
						'delicious',
						'deviantart',
						'digg',
						'dribbble',
						'facebook',
						'flickr',
						'foursquare',
						'free-code-camp',
						'github',
						'gitlab',
						'globe',
						'google-plus',
						'houzz',
						'instagram',
						'jsfiddle',
						'linkedin',
						'medium',
						'meetup',
						'mixcloud',
						'odnoklassniki',
						'pinterest',
						'product-hunt',
						'reddit',
						'shopping-cart',
						'skype',
						'slideshare',
						'snapchat',
						'soundcloud',
						'spotify',
						'stack-overflow',
						'steam',
						'stumbleupon',
						'telegram',
						'thumb-tack',
						'tripadvisor',
						'tumblr',
						'twitch',
						'twitter',
						'viber',
						'vimeo',
						'vk',
						'weibo',
						'weixin',
						'whatsapp',
						'wordpress',
						'xing',
						'yelp',
						'youtube',
						'500px'
					],
					'fa-solid' => [
						'envelope',
						'link',
						'rss'
					]
				]
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => __( 'Link', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => 'true'
				],
				'dynamic'     => [
					'active'  => true
				],
				'placeholder' => __( 'https://your-link.com', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_team_member_social_profile_links',
			[
				'label'       => __( 'Social Icons', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'condition'   => [
					'aem_team_member_enable_social_profiles!' => ''
				],
				'default'     => [
					[
						'social_icon' => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands'
						]
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'fa-brands'
						],
					],
					[
						'social_icon' => [
							'value'   => 'fab fa-google-plus-g',
							'library' => 'fa-brands',
						]
					]
				],
				'title_field' => '{{{ elementor.helpers.getSocialNetworkNameFromIcon( social_icon, false, true, false, true ) }}}'
			]
		);


		$this->end_controls_section();


		/*
		* Team Members Styling Section
		*/

		/*
		* Team Members Container Style
		*/
		$this->start_controls_section(
			'aem_section_team_members_styles_preset',
			[
				'label' => esc_html__( 'Container', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'aem_team_members_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aem-team-member'
			]
		);

		// $this->add_control(
		// 	'aem_team_members_glass_effect',
		// 	[
		// 		'label' => __( 'Blur Size', AEM_TEXTDOMAIN ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px' ],
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 100,
		// 				'step' => 1,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .aem-team-member' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
		// 		],
		// 	]
		// );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'aem_team_members_border',
				'selector' => '{{WRAPPER}} .aem-team-member'
			]
		);
		
		$this->add_responsive_control(
			'aem_team_members_radius',
			[
				'label'      => __( 'Border radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_team_members_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_team_members_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_team_members_box_shadow',
				'selector' => '{{WRAPPER}} .aem-team-member',
				'fields_options'         => [
		            'box_shadow_type'    => [
		                'default'        =>'yes'
		            ],
		            'box_shadow'         => [
		                'default'        => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 49,
		                    'spread'     => 0,
		                    'color'      => 'rgba(24, 27, 33, 0.1)'
		                ]
		            ]
	            ]
			]
		);

		$this->end_controls_section();

		/**
		 * For Thumbnail style
		 */

		$this->start_controls_section(
			'aem_section_team_members_image_style',
			[
				'label' => esc_html__( 'Image', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'aem_team_membe_image_position',
            [
                'label'         => esc_html__( 'Image Position', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'default'       => 'aem-position-top',
                'options'       => [
                    'aem-position-left'  => [
                        'title' => esc_html__( 'Left', AEM_TEXTDOMAIN ),
                        'icon'  => 'eicon-arrow-left'
                    ],
                    'aem-position-top'   => [
                        'title' => esc_html__( 'Top', AEM_TEXTDOMAIN ),
                        'icon'  => 'eicon-arrow-up'
                    ],
                    'aem-position-right' => [
                        'title' => esc_html__( 'Right', AEM_TEXTDOMAIN ),
                        'icon'  => 'eicon-arrow-right'
                    ]
                ]
            ]
        );

		$this->add_control(
			'aem_section_team_members_thumbnail_box',
			[
				'label'        => __( 'Image Box', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
            'aem_section_team_members_thumbnail_box_height',
            [
                'label'      => __( 'Height', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 100
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'max'  => 500,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 2
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-team-member-thumb'=> 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'aem_section_team_members_thumbnail_box' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_section_team_members_thumbnail_box_width',
            [
                'label'      => __( 'Width', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 100
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'max'  => 500,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 2
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-team-member-thumb'=> 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'aem_section_team_members_thumbnail_box' => 'yes'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'aem_section_team_members_thumbnail_box_border',
				'selector'  => '{{WRAPPER}} .aem-team-member-thumb',
				'condition' => [
					'aem_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);
		
		$this->add_responsive_control(
			'aem_section_team_members_thumbnail_box_radius',
			[
				'label'      => __( 'Border radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aem-team-member-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_section_team_members_thumbnail_box_margin_top',
			[
				'label'      => __( 'Top Spacing', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'unit'   => 'px',
					'size'   => 0
				],
				'range'        => [
                    'px'       => [
                        'min'  => -300,
                        'max'  => 300,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => -50,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-thumb' => 'margin-top: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'aem_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_section_team_members_thumbnail_box_margin_bottom',
			[
				'label'      => __( 'Bottom Spacing', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'unit'   => 'px',
					'size'   => 0
				],
				'range'        => [
                    'px'       => [
                        'min'  => -300,
                        'max'  => 300,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => -50,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'aem_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'aem_section_team_members_thumbnail_box_shadow',
				'selector'  => '{{WRAPPER}} .aem-team-member-thumb',
				'condition' => [
					'aem_section_team_members_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'aem_section_team_members_thumbnail_css_filter',
				'selector' => '{{WRAPPER}} .aem-team-member-thumb img',
			]
		);

		$this->end_controls_section();

		/*
		* Team Members Content Style
		*/
		$this->start_controls_section(
			'aem_section_team_members_content_style',
			[
				'label' => esc_html__( 'Content', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_team_member_content_alignment',
			[
				'label'   => __( 'Alignment', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'aem-left'   => [
						'title'   => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'    => 'eicon-text-align-left'
					],
					'aem-center' => [
						'title'   => __( 'Center', AEM_TEXTDOMAIN ),
						'icon'    => 'eicon-text-align-center'
					],
					'aem-right'  => [
						'title'   => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'    => 'eicon-text-align-right'
					]
				],
				'default' => 'aem-center'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'aem_team_members_content_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aem-team-member-content'
			]
		);

		$this->add_responsive_control(
			'aem_section_team_members_content_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '30',
					'right'  => '30',
					'bottom' => '30',
					'left'   => '30'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_section_team_members_content_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_team_member_content_border_radius',
			[
				'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_section_team_members_content_box_shadow',
				'selector' => '{{WRAPPER}} .aem-team-member-content'
			]
		);
		
		$this->end_controls_section();

		/*
		* Name style
		*/
		$this->start_controls_section(
            'section_team_carousel_name',
            [
				'label' => __('Name', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'aem_team_name_color',
            [
				'label'     => __('Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
                    '{{WRAPPER}} .aem-team-member-name' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'aem_team_name_typography',
				'selector' => '{{WRAPPER}} .aem-team-member-name'
            ]
		);
		
		$this->add_responsive_control(
			'aem_team_members_name_margin',
			[
				'label'        => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
		
		/**
		 * Designation Style
		 */
        $this->start_controls_section(
            'section_team_member_designation',
            [
				'label' => __('Designation', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'aem_team_designation_color',
            [
				'label'     => __('Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
                    '{{WRAPPER}} .aem-team-member-designation' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'aem_team_designation_typography',
				'selector' => '{{WRAPPER}} .aem-team-member-designation'
            ]
		);
		
		$this->add_responsive_control(
			'aem_team_members_designation_margin',
			[
				'label'        => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-team-member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
				
		/**
		 * Description Style
		 */

        $this->start_controls_section(
            'section_team_carousel_description',
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
				'default'   => '#8a8d91',
				'selectors' => [
                    '{{WRAPPER}} .aem-team-member-about' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'aem_description_typography',
				'selector' => '{{WRAPPER}} .aem-team-member-about',
				'fields_options'          => [
		              'line_height'       => [
		                'desktop_default' => [
		                    'unit' => 'em',
		                    'size' => 1.5
		                ]
		            ]
	            ]
            ]
		);
				
		$this->add_responsive_control(
			'aem_team_members_description_margin',
			[
				'label'        => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-team-member-about' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Call to action Style
		 */
        $this->start_controls_section(
            'aem_team_member_cta_btn_style',
            [
				'label'     => __('Call To Action', AEM_TEXTDOMAIN),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_section_team_members_cta_btn' => 'yes'
				]
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_team_member_cta_btn_typography',
				'selector' => '{{WRAPPER}} .aem-team-member-cta'
			]
		);
		
		$this->add_responsive_control(
			'aem_team_member_cta_btn_margin',
			[
				'label'        => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-team-member-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_team_member_cta_btn_padding',
			[
				'label'        => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-team-member-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_team_member_cta_btn_radius',
			[
				'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'aem_team_member_cta_btn_tabs' );

			$this->start_controls_tab( 'aem_team_member_cta_btn_tab_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_team_member_cta_btn_text_color_normal',
					[
						'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .aem-team-member-cta' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'aem_team_member_cta_btn_background_normal',
					[
						'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .aem-team-member-cta' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_team_member_cta_btn_border_normal',
						'selector' => '{{WRAPPER}} .aem-team-member-cta'
					]
				);
		
			$this->end_controls_tab();

			$this->start_controls_tab( 'aem_team_member_cta_btn_tab_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_team_member_cta_btn_text_color_hover',
					[
						'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .aem-team-member-cta:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'aem_team_member_cta_btn_background_hover',
					[
						'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .aem-team-member-cta:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_team_member_cta_btn_border_hover',
						'selector' => '{{WRAPPER}} .aem-team-member-cta:hover'
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();
		
		/**
		 * Social icons style
		 */
        $this->start_controls_section(
            'aem_team_member_social_section',
            [
				'label'     => __('Social Icons', AEM_TEXTDOMAIN),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_team_member_enable_social_profiles!' => ''
				]
            ]
		);
		

		$this->add_responsive_control(
			'aem_team_members_social_icon_size',
			[
				'label'        => __( 'Size', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px' ],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 14
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-team-member-social li a i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_team_member_social_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '15',
					'right'  => '15',
					'bottom' => '15',
					'left'   => '15'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_team_members_social_box_radius',
			[
				'label'      => __( 'Border radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_team_member_social_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .aem-team-member-social li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'aem_team_members_social_icons_style_tabs' );

			$this->start_controls_tab( 'aem_team_members_social_icon_tab', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_team_carousel_social_icon_color_normal',
					[
						'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#a4a7aa',
						'selectors' => [
							'{{WRAPPER}} .aem-team-member-social li a i' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'aem_team_carousel_social_bg_color_normal',
					[
						'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .aem-team-member-social li a' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_team_carousel_social_border_normal',
						'selector' => '{{WRAPPER}} .aem-team-member-social li a'
					]
				);
		
			$this->end_controls_tab();

			$this->start_controls_tab( 'aem_team_members_social_icon_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_team_carousel_social_icon_color_hover',
					[
						'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#8a8d91',
						'selectors' => [
							'{{WRAPPER}} .aem-team-member-social li a:hover i' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'aem_team_carousel_social_bg_color_hover',
					[
						'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .aem-team-member-social li a:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'aem_team_carousel_social_border_hover',
						'selector' => '{{WRAPPER}} .aem-team-member-social li a:hover'
					]
				);

			$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

	}
	
	private function team_member_cta() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'aem_team_members_cta_btn_text', 'class', 'aem-team-cta-button-text' );
		$this->add_inline_editing_attributes( 'aem_team_members_cta_btn_text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'aem_team_members_cta_btn_text' ); ?>>
			<?php echo esc_html( $settings['aem_team_members_cta_btn_text'] );	?>
		</span>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'aem_team_member_name', 'class', 'aem-team-member-name' );
		$this->add_inline_editing_attributes( 'aem_team_member_name', 'basic' );

		$this->add_render_attribute( 'aem_team_member_designation', 'class', 'aem-team-member-designation' );
		$this->add_inline_editing_attributes( 'aem_team_member_designation', 'basic' );

		$this->add_render_attribute( 'aem_team_member_description', 'class', 'aem-team-member-about' );
		$this->add_inline_editing_attributes( 'aem_team_member_description', 'basic' );

		$this->add_render_attribute( 'aem_team_member_item', [
            'class' => [ 
                'aem-team-member', 
                esc_attr( $settings['aem_team_member_content_alignment'] ),
                esc_attr( $settings['aem_team_membe_image_position'] )
            ]
        ]);

		$this->add_render_attribute( 'aem_team_members_cta_btn_link', 'class', 'aem-team-member-cta' );
		if( isset( $settings['aem_team_members_cta_btn_link']['url'] ) ) {
            $this->add_render_attribute( 'aem_team_members_cta_btn_link', 'href', esc_url( $settings['aem_team_members_cta_btn_link']['url'] ) );
	        if( $settings['aem_team_members_cta_btn_link']['is_external'] ) {
	            $this->add_render_attribute( 'aem_team_members_cta_btn_link', 'target', '_blank' );
	        }
	        if( $settings['aem_team_members_cta_btn_link']['nofollow'] ) {
	            $this->add_render_attribute( 'aem_team_members_cta_btn_link', 'rel', 'nofollow' );
	        }
        }

		?>

		<div class="aem-team-item">
			<div <?php echo $this->get_render_attribute_string( 'aem_team_member_item' ); ?>>
				<?php do_action('aem_team_member_wrapper_before'); ?>
				<?php 
					if ( $settings['aem_team_member_image']['url'] || $settings['aem_team_member_image']['id'] ) { ?>
						<div class="aem-team-member-thumb">
							<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'team_member_image_size', 'aem_team_member_image' ); ?>
						</div>
					<?php
					}
				?>

				<div class="aem-team-member-content">
					<?php do_action('aem_team_member_content_area_before'); ?>
					<?php if ( !empty( $settings['aem_team_member_name'] ) ) : ?>
						<<?php echo Utils::validate_html_tag( $settings['aem_team_member_name_tag'] ); ?> <?php echo $this->get_render_attribute_string( 'aem_team_member_name' ); ?>>
							<?php echo Helper::aem_wp_kses( $settings['aem_team_member_name'] ); ?>
						</<?php echo Utils::validate_html_tag( $settings['aem_team_member_name_tag'] ); ?>>
					<?php endif; ?>

					<?php if ( !empty( $settings['aem_team_member_designation'] ) ) : ?>
						<span <?php echo $this->get_render_attribute_string( 'aem_team_member_designation' ); ?>><?php echo Helper::aem_wp_kses( $settings['aem_team_member_designation'] ); ?></span>
					<?php endif; ?>

					<?php do_action('aem_team_member_description_before'); ?>
					<?php if ( !empty( $settings['aem_team_member_description'] ) ) : ?>
						<div <?php echo $this->get_render_attribute_string( 'aem_team_member_description' ); ?>><?php echo wp_kses_post( $settings['aem_team_member_description'] ); ?></div>
					<?php endif; ?>
					<?php do_action('aem_team_member_description_after'); ?>

					<?php if ( 'yes' === $settings['aem_section_team_members_cta_btn'] && !empty( $settings['aem_team_members_cta_btn_text'] ) ) : ?>
						<a <?php echo $this->get_render_attribute_string( 'aem_team_members_cta_btn_link' ); ?>>
							<?php echo $this->team_member_cta(); ?>
						</a>
					<?php	
					endif;

					if ( 'yes' === $settings['aem_team_member_enable_social_profiles'] ) : ?>
						<ul class="list-inline aem-team-member-social">
							<?php
							foreach ( $settings['aem_team_member_social_profile_links'] as $index => $item ) :
								$social   = '';
								$link_key = 'link_' . $index;

								if ( 'svg' !== $item['social_icon']['library'] ) {
									$social = explode( ' ', $item['social_icon']['value'], 2 );
									if ( empty( $social[1] ) ) {
										$social = '';
									} else {
										$social = str_replace( 'fa-', '', $social[1] );
									}
								}
								if ( 'svg' === $item['social_icon']['library'] ) {
									$social = '';
								}

								if( $item['link']['url'] ) {
									$this->add_render_attribute( $link_key, 'href', esc_url( $item['link']['url'] ) );
									if( $item['link']['is_external'] ) {
										$this->add_render_attribute( $link_key, 'target', '_blank' );
									}
									if( $item['link']['nofollow'] ) {
										$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
									}
								}

								$this->add_render_attribute( $link_key, 'class', [
									'aem-social-icon',
									'elementor-repeater-item-' . $item['_id'],
								] );
								?>	
								<li>
									<a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
										<?php Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</a>
								</li>	
							<?php endforeach; ?>
						</ul>
					<?php
					endif;

					do_action('aem_team_member_content_area_after'); ?>

				</div>
				<?php do_action('aem_team_member_wrapper_after'); ?>	
			</div>
		</div>	
		<?php
	}

}