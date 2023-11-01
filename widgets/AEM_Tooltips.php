<?php
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class AEM_Tooltips extends Widget_Base {

    public function get_name() {
        return 'aem-tooltip';
    }
    
    public function get_title() {
        return __( 'Tooltip', AEM_TEXTDOMAIN );
    }

    public function get_icon() {
        return 'aem aem-logo eicon-tools';
    }

    public function get_keywords() {
        return [ 'hover', 'title' ];
    }

    public function get_categories() {
        return [ 'aem-category' ];
    }

    protected function register_controls() {
        $aem_primary_color = get_option( 'aem_primary_color_option', '#7a56ff' );

        $this->start_controls_section(
            'tooltip_button_content',
            [
                'label' => __( 'Content Settings', AEM_TEXTDOMAIN )
            ]
        );

        $this->add_control(
			'aem_tooltip_type',
			[
                'label'       => esc_html__( 'Content Type', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::CHOOSE,
                'toggle'      => false,
                'label_block' => true,
                'options'     => [
					'icon'      => [
						'title' => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-info-circle'
					],
					'text'      => [
						'title' => esc_html__( 'Text', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-area'
					],
					'image'     => [
						'title' => esc_html__( 'Image', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-image-bold'
					]
				],
				'default'     => 'icon'
			]
		);

  		$this->add_control(
			'aem_tooltip_content',
			[
                'label'       => esc_html__( 'Content', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'Hover Me!', AEM_TEXTDOMAIN ),
                'condition'   => [
					'aem_tooltip_type' => [ 'text' ]
				]
			]
        );
		
		$this->add_control(
			'aem_tooltip_icon_content',
			[
                'label'       => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fab fa-linux',
                    'library' => 'fa-brands'
                ],
                'condition'   => [
					'aem_tooltip_type' => [ 'icon' ]
				]
			]
		);

		$this->add_control(
			'aem_tooltip_img_content',
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
					'aem_tooltip_type' => [ 'image' ]
				]
			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'aem_tooltip_image_size',
                'default'   => 'thumbnail',
                'condition' => [
                    'aem_tooltip_type'              => [ 'image' ],
                    'aem_tooltip_img_content[url]!' => ''
                ]
            ]
        );

        $this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'aem_tooltip_image_css_filter',
                'selector' => '{{WRAPPER}} .aem-tooltip .aem-tooltip-content img',
                'condition' => [
                    'aem_tooltip_type' => [ 'image' ],
                    'aem_tooltip_img_content[url]!' => ''
				]
			]
		);

        $this->add_control(
            'tooltip_style_section_align',
            [
                'label'   => __( 'Alignment', AEM_TEXTDOMAIN ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
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
                'default'       => 'center',
                'prefix_class'  => 'aem-tooltip-align-'
            ]
        );

        $this->add_control(
            'aem_tooltip_enable_link',
            [
                'label'        => __( 'Show Link', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
            'aem_tooltip_link',
            [
                'label'           => __( 'Link', AEM_TEXTDOMAIN ),
                'type'            => Controls_Manager::URL,
                'placeholder'     => __( 'https://your-link.com', AEM_TEXTDOMAIN ),
                'show_external'   => true,
                'default'         => [
                    'url'         => '',
                    'is_external' => true
                ],
                'condition'       => [
                    'aem_tooltip_enable_link'=>'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'tooltip_options',
            [
                'label' => __( 'Tooltip Options', AEM_TEXTDOMAIN )
            ]
        );

        $this->add_control(
            'aem_tooltip_text',
            [
                'label'       => esc_html__( 'Tooltip Text', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => esc_html__( 'These are some dummy tooltip contents.', AEM_TEXTDOMAIN ),
                'dynamic'     => [ 'active' => true ]
            ]
        );

        $this->add_control(
          'aem_tooltip_direction',
            [
                'label'         => esc_html__( 'Direction', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'tooltip-right',
                'label_block'   => false,
                'options'       => [
                    'tooltip-left'   => esc_html__( 'Left', AEM_TEXTDOMAIN ),
                    'tooltip-right'  => esc_html__( 'Right', AEM_TEXTDOMAIN ),
                    'tooltip-top'    => esc_html__( 'Top', AEM_TEXTDOMAIN ),
                    'tooltip-bottom' => esc_html__( 'Bottom', AEM_TEXTDOMAIN )
                ]
            ]
        );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'tooltip_style_section',
            [
                'label' => __( 'General Styles', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'     => __( 'Text Typography', AEM_TEXTDOMAIN ),
                'name'      => 'aem_tooltip_button_text_typography',
                'selector'  => '{{WRAPPER}} .aem-tooltip .aem-tooltip-content',
                'condition' => [
                    'aem_tooltip_type' => [ 'text' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_tooltip_button_icon_size',
            [
                'label'        => __( 'Icon Size', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 18
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-tooltip .aem-tooltip-content i' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'aem_tooltip_type' => [ 'icon' ]
                ]
            ]
        );

		$this->add_responsive_control(
			'aem_tooltip_content_width',
		    [
                'label' => __( 'Content Width', AEM_TEXTDOMAIN ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
		            'px'       => [
		                'min'  => 0,
		                'max'  => 1000,
		                'step' => 5
		            ],
		            '%'        => [
		                'min'  => 0,
		                'max'  => 100,
                        'step' => 1
		            ]
                ],
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 150
                ],
		        'selectors'  => [
		            '{{WRAPPER}} .aem-tooltip .aem-tooltip-content' => 'width: {{SIZE}}{{UNIT}};'
		        ]
		    ]
		);

		$this->add_responsive_control(
			'aem_tooltip_content_padding',
			[
                'label'      => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20
                ],
				'selectors'  => [
	 				'{{WRAPPER}} .aem-tooltip .aem-tooltip-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
	 			]
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'aem_tooltip_hover_border',
                'selector' => '{{WRAPPER}} .aem-tooltip .aem-tooltip-content'
            ]
        );

    
        $this->add_responsive_control(
            'aem_tooltip_content_radius',
            [
                'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 4,
                    'right'  => 4,
                    'bottom' => 4,
                    'left'   => 4
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-tooltip .aem-tooltip-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->start_controls_tabs( 'aem_tooltip_content_style_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'aem_tooltip_content_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );
                
				$this->add_control(
					'aem_tooltip_content_color',
					[
                        'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => $aem_primary_color,
                        'condition' => [
                            'aem_tooltip_type!' => [ 'image' ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .aem-tooltip .aem-tooltip-content, {{WRAPPER}} .aem-tooltip .aem-tooltip-content a' => 'color: {{VALUE}};'
						]
					]
                );

				$this->add_control(
					'aem_tooltip_content_bg_color',
					[
                        'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f9f9f9',
                        'selectors' => [
							'{{WRAPPER}} .aem-tooltip .aem-tooltip-content' => 'background-color: {{VALUE}};'
						]
					]
				);

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'aem_tooltip_content_shadow',
                        'selector' => '{{WRAPPER}} .aem-tooltip .aem-tooltip-content'
                    ]
                );

			$this->end_controls_tab();

			// Hover State Tab
			$this->start_controls_tab( 'aem_tooltip_content_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_tooltip_content_hover_color',
					[
                        'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'condition' => [
                            'aem_tooltip_type!' => [ 'image' ]
                        ],
                        'default'   => '#212121',
                        'selectors' => [
                            '{{WRAPPER}} .aem-tooltip .aem-tooltip-content:hover'   => 'color: {{VALUE}};',
                            '{{WRAPPER}} .aem-tooltip .aem-tooltip-content a:hover' => 'color: {{VALUE}};'
						]
					]
                );

				$this->add_control(
					'aem_tooltip_content_hover_bg_color',
					[
                        'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f9f9f9',
                        'selectors' => [
							'{{WRAPPER}} .aem-tooltip .aem-tooltip-content:hover' => 'background-color: {{VALUE}};'
						]
					]
				);
                
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name'     => 'aem_tooltip_hover_shadow',
                        'selector' => '{{WRAPPER}} .aem-tooltip .aem-tooltip-content:hover'
                    ]
                );
				
			$this->end_controls_tab();

        $this->end_controls_tabs();
                
        $this->end_controls_section();

        // Tooltip Style tab section
        $this->start_controls_section(
            'aem_tooltip_style_section',
            [
                'label' => __( 'Tooltip Styles', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'hover_tooltip_content_typography',
                'selector' => '{{WRAPPER}} .aem-tooltip .aem-tooltip-text'
            ]
        );

        $this->add_control(
            'aem_tooltip_style_color',
            [
                'label'     => __( 'Text Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .aem-tooltip .aem-tooltip-item .aem-tooltip-text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'hover_tooltip_content_background',
                'types'    => [ 'classic', 'gradient' ],
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => $aem_primary_color
                    ]
                ],
                'selector' => '{{WRAPPER}} .aem-tooltip .aem-tooltip-text'
            ]
        );

        $this->add_responsive_control(
			'aem_tooltip_text_width',
		    [
                'label' => __( 'Tooltip Width', AEM_TEXTDOMAIN ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
		            'px'       => [
		                'min'  => 0,
		                'max'  => 1000,
		                'step' => 5
		            ],
		            '%'        => [
		                'min'  => 0,
		                'max'  => 100
		            ]
		        ],
                'size_units'   => [ 'px', '%' ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 200
                ],
		        'selectors'    => [
		            '{{WRAPPER}} .aem-tooltip .aem-tooltip-text' => 'width: {{SIZE}}{{UNIT}};'
		        ]
		    ]
		);

        $this->add_responsive_control(
            'aem_tooltip_text_padding',
            [
                'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default'    => [
                    'top'    => 10,
                    'right'  => 10,
                    'bottom' => 10,
                    'left'   => 10
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-tooltip .aem-tooltip-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  =>'before'
            ]
        );

        $this->add_responsive_control(
            'aem_tooltip_content_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => 4,
                    'right'  => 4,
                    'bottom' => 4,
                    'left'   => 4
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-tooltip .aem-tooltip-text' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px !important;'
                ]
            ]
        );
    
        $this->add_control(
            'aem_tooltip_arrow_color',
            [
                'label'     => __( 'Arrow Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $aem_primary_color,
                'selectors' => [
                    '{{WRAPPER}} .aem-tooltip .aem-tooltip-item.tooltip-top .aem-tooltip-text:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
                    '{{WRAPPER}} .aem-tooltip .aem-tooltip-item.tooltip-left .aem-tooltip-text:after' => 'border-color: transparent transparent transparent {{VALUE}};',
                    '{{WRAPPER}} .aem-tooltip .aem-tooltip-item.tooltip-bottom .aem-tooltip-text:after' => 'border-color: transparent transparent {{VALUE}} transparent;',
                    '{{WRAPPER}} .aem-tooltip .aem-tooltip-item.tooltip-right .aem-tooltip-text:after' => 'border-color: transparent {{VALUE}} transparent transparent;'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings        = $this->get_settings_for_display();

        $this->add_render_attribute( 'aem_tooltip_wrapper', 'class', 'aem-tooltip' );

        if( isset( $settings['aem_tooltip_link']['url'] ) ) {
            $this->add_render_attribute( 'aem_tooltip_link', 'href', esc_url( $settings['aem_tooltip_link']['url'] ) );
            if( $settings['aem_tooltip_link']['is_external'] ) {
                $this->add_render_attribute( 'aem_tooltip_link', 'target', '_blank' );
            }
            if( $settings['aem_tooltip_link']['nofollow'] ) {
                $this->add_render_attribute( 'aem_tooltip_link', 'rel', 'nofollow' );
            }
        }

        $this->add_inline_editing_attributes( 'aem_tooltip_content', 'basic' );

        ?>
       
        <div <?php echo $this->get_render_attribute_string( 'aem_tooltip_wrapper' ); ?>>
            <div class="aem-tooltip-item <?php echo esc_attr( $settings['aem_tooltip_direction'] ); ?>">
                <div class="aem-tooltip-content">

                    <?php if( 'yes' === $settings['aem_tooltip_enable_link'] && !empty( $settings['aem_tooltip_link']['url'] ) ) : ?>
                        <a <?php echo $this->get_render_attribute_string( 'aem_tooltip_link' ); ?>>
                    <?php endif; ?>

                    <?php if( 'text' === $settings['aem_tooltip_type'] && !empty( $settings['aem_tooltip_content'] ) ) : ?>
                        <span <?php echo $this->get_render_attribute_string( 'aem_tooltip_content' ); ?>><?php echo wp_kses_post( $settings['aem_tooltip_content'] ); ?></span>

                    <?php elseif( 'icon' === $settings['aem_tooltip_type'] && !empty( $settings['aem_tooltip_icon_content']['value'] ) ) : ?>
                        <?php Icons_Manager::render_icon( $settings['aem_tooltip_icon_content'] ); ?>

                    <?php elseif( 'image' === $settings['aem_tooltip_type'] && !empty( $settings['aem_tooltip_img_content']['url'] ) ) : ?>
                        <?php if ( $settings['aem_tooltip_img_content']['url'] || $settings['aem_tooltip_img_content']['id'] ) { ?>
                            <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'aem_tooltip_image_size', 'aem_tooltip_img_content' ); ?>
                        <?php } ?>
                    <?php endif; ?>

                    <?php if( 'yes' === $settings['aem_tooltip_enable_link'] && !empty( $settings['aem_tooltip_link']['url'] ) ) : ?>
                        </a>
                    <?php endif; ?>

                </div>

                <?php $settings['aem_tooltip_text'] ? printf( '<div class="aem-tooltip-text">%s</div>', wp_kses_post( $settings['aem_tooltip_text'] ) ) : ''; ?>
            </div>
        </div>
        <?php
    }

}