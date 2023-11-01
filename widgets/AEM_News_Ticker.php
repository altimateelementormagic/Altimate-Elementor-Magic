<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;

class AEM_News_Ticker extends Widget_Base {

    public function get_name() {
        return 'aem-news-ticker';
    }

    public function get_title() {
        return esc_html__( 'News Ticker', AEM_TEXTDOMAIN );
    }

    public function get_icon() {
        return 'aem aem-logo eicon-posts-ticker';
    }

    public function get_categories() {
        return [ 'aem-category' ];
    }

    public function get_keywords() {
        return [ 'bar', 'horizontal' ];
    }
    
    public function get_script_depends() {
        return [ 'aem-news-ticker' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'goee_news_ticker_all_items',
            [
                'label' => esc_html__( 'Items', AEM_TEXTDOMAIN )
            ]
        );

        $this->add_control(
            'goee_news_ticker_label',
            [   
                'label'         => esc_html__( 'Label', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __('Today\'s Hot News', AEM_TEXTDOMAIN ),
                'label_block'     => true,
                'dynamic' => [
					'active' => true,
				]
            ]
        ); 

        $news_ticker_repeater = new Repeater();
        
        $news_ticker_repeater->add_control(
            'goee_news_ticker_title',
            [
                'label'   => esc_html__( 'Content', AEM_TEXTDOMAIN ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'News item description', AEM_TEXTDOMAIN ),
                'dynamic' => [
					'active' => true,
				]
            ]
        );

        $news_ticker_repeater->add_control(
            'goee_news_ticker_link',
            [
                'label'           => esc_html__( 'Link', AEM_TEXTDOMAIN ),
                'type'            => Controls_Manager::URL,
                'label_block'     => true,
                'default'         => [
                    'url'         => '#',
                    'is_external' => ''
                ],
                'show_external'   => true
            ]
        );

        $this->add_control(
            'goee_news_ticker_items',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $news_ticker_repeater->get_controls(),
                'title_field' => '{{{ goee_news_ticker_title }}}',
                'default'     => [
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 1', AEM_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 2', AEM_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 3', AEM_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 4', AEM_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 5', AEM_TEXTDOMAIN ) ],
                    [ 'goee_news_ticker_title' => __( 'Exclusive Elementor News item 6', AEM_TEXTDOMAIN ) ]
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_settings',
            [
                'label' => esc_html__( 'Settings', AEM_TEXTDOMAIN )
            ]
        ); 

        $this->add_control(
            'goee_news_ticker_animation_direction',
            [
                'label'     => esc_html__( 'Direction', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ltr',
                'options'   => [
                    'ltr'   => esc_html__( 'Left to Right', AEM_TEXTDOMAIN ),
                    'rtl'   => esc_html__( 'Right to Left', AEM_TEXTDOMAIN )
                ],
                'description'   => esc_html__('If you enable Right-to-left(RTL) in your website than by default it will be working in RTL and this option won\'t work.', AEM_TEXTDOMAIN)

            ]
        ); 

        $this->add_control(
            'goee_news_ticker_set_fixed_position',
            [
                'type'         => Controls_Manager::SELECT,
                'label'        => esc_html__( 'Set Position', AEM_TEXTDOMAIN ),
				'default' => 'none',
				'options' => [
					'none'  => __( 'None', AEM_TEXTDOMAIN ),
					'fixed-top'  => __( 'Fixed Top', AEM_TEXTDOMAIN ),
					'fixed-bottom'  => __( 'Fixed Bottom', AEM_TEXTDOMAIN ),
				],
                'description'  => esc_html__('Stick the news ticker to the top or bottom of the page.', AEM_TEXTDOMAIN)
            ]
        );

        $this->add_control(
            'goee_news_ticker_animation_type',
            [
                'label'     => esc_html__( 'Animation Type', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'scroll',
                'options'   => [
                    'scroll'      => esc_html__( 'Scroll', AEM_TEXTDOMAIN ),
                    'slide'       => esc_html__( 'Slide', AEM_TEXTDOMAIN ),
                    'fade'        => esc_html__( 'Fade', AEM_TEXTDOMAIN ),
                    'slide-up'    => esc_html__( 'Slide Up', AEM_TEXTDOMAIN ),
                    'slide-down'  => esc_html__( 'Slide Down', AEM_TEXTDOMAIN ),
                    'slide-left'  => esc_html__( 'Slide Left', AEM_TEXTDOMAIN ),
                    'slide-right' => esc_html__( 'Slide Right', AEM_TEXTDOMAIN ),
                    'typography'  => esc_html__( 'Typography', AEM_TEXTDOMAIN )
                ]               
            ]
        );  

        $this->add_control(
            'goee_news_ticker_autoplay_interval',
            [   
                'label'         => esc_html__( 'Autoplay Interval', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '4000',
                'condition'     => [
                    '.goee_news_ticker_animation_type!' => 'scroll'
                ]              
            ]
        ); 

        $this->add_control(
            'goee_news_ticker_animation_speed',
            [   
                'label'         => esc_html__( 'Animation Speed', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => '2',
                'condition'     => [
                    '.goee_news_ticker_animation_type' => 'scroll'
                ]                
            ]
        ); 

        $this->add_responsive_control(
            'goee_news_ticker_height',
            [   
                'label'         => esc_html__( 'Height', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'default'       => [
                    'size'      => 70
                ],
                'range'         => [
                    'px'        => [
                        'min'   => 20,
                        'max'   => 100
                    ]
                ]
            ]
        ); 

        $this->add_control(
            'goee_news_ticker_autoplay',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Autoplay', AEM_TEXTDOMAIN ),
                'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );        

        $this->add_control(
            'goee_news_ticker_pause_on_hover',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Pause On Hover', AEM_TEXTDOMAIN ),
                'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    '.goee_news_ticker_autoplay' => 'yes'
                ]                
            ]
        );

        $this->add_control(
            'goee_news_ticker_show_label',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Enable Label', AEM_TEXTDOMAIN ),
                'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'goee_news_ticker_show_label_arrow',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Enable Label Arrow', AEM_TEXTDOMAIN ),
                'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'goee_news_ticker_show_label' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'goee_news_ticker_show_label_icon',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Enable Label Icon', AEM_TEXTDOMAIN ),
                'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'goee_news_ticker_show_label' => 'yes'
                ]
            ]
        ); 

        $this->add_control(
            'goee_news_ticker_show_controls',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Controls', AEM_TEXTDOMAIN ),
                'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );  

        $this->add_control(
            'goee_news_ticker_show_pause_control',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => esc_html__( 'Play/Pause Control', AEM_TEXTDOMAIN ),
                'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    'goee_news_ticker_show_controls' => 'yes'
                ]
            ]
        );         

        $this->add_control(
            'goee_news_ticker_label_icon',
            [
                'label'       => __( 'Label Icon', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-home',
                    'library' => 'fa-solid'
                ],
                'condition'   => [
                    'goee_news_ticker_show_label'      => 'yes',
                    'goee_news_ticker_show_label_icon' => 'yes'
                ]
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_container_style',
            [
                'label'         => esc_html__( 'Container', AEM_TEXTDOMAIN ),
                'tab'           => Controls_Manager::TAB_STYLE                    
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'goee_news_ticker_container_bg_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .aem-news-ticker'            
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'goee_news_ticker_container_border',
                'selector'       => '{{WRAPPER}} .aem-news-ticker',
                'fields_options' => [
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
                        'default' => '#DADCEA'
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_container_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .aem-news-ticker'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'goee_news_ticker_container_box_shadow',
                'selector' => '{{WRAPPER}} .aem-news-ticker'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_label_style',
            [
                'label'     => esc_html__( 'Label', AEM_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '.goee_news_ticker_show_label' => 'yes'
                ]             
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'goee_news_ticker_label_typography',
                'selector' => '{{WRAPPER}} .aem-news-ticker .aem-bn-label'
            ]
        );

        $this->add_control(
            'goee_news_ticker_label_color',
            [
                'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .aem-news-ticker .aem-bn-label' => 'color: {{VALUE}};'
                ]              
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'goee_news_ticker_label_bg_color',
                'types'     => [ 'classic', 'gradient' ],
                'selector'  => '{{WRAPPER}} .aem-news-ticker .aem-bn-label, {{WRAPPER}} .aem-news-ticker .aem-bn-label.yes-small:after'            
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_label_padding',
            [
                'label'         => esc_html__( 'Padding(Left & Right)', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px' ],
                'default'       => [
                    'size'      => 15
                ],
                'selectors'     => [
                    '{{WRAPPER}} .aem-news-ticker .aem-bn-label' => 'padding: 0 {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'           => 'goee_news_ticker_label_border',
                'selector'       => '{{WRAPPER}} .aem-news-ticker .aem-bn-label',
                'fields_options' => [
                    'border'      => [
                        'default' => 'solid'
                    ],
                    'width'       => [
                        'default' => [
                            'top'    => '0',
                            'right'  => '1',
                            'bottom' => '0',
                            'left'   => '0'
                        ]
                    ],
                    'color'       => [
                        'default' => '#DADCEA'
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_label_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .aem-news-ticker .aem-bn-label'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'goee_news_ticker_label_icon_style',
            [
                'label'     => esc_html__( 'Label Icon', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'goee_news_ticker_show_label_icon'    => 'yes',
                    'goee_news_ticker_label_icon[value]!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_label_icon_size',
            [
                'label'        => esc_html__( 'Size', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 10,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-news-ticker-icon i' => 'font-size: {{SIZE}}px;'
                ],
                'condition' => [
                    'goee_news_ticker_show_label_icon'    => 'yes',
                    'goee_news_ticker_label_icon[value]!' => ''
                ]
            ]
        );

        $this->add_control(
            'goee_news_ticker_label_icon_color',
            [
                'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .aem-news-ticker-icon i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'goee_news_ticker_show_label_icon'    => 'yes',
                    'goee_news_ticker_label_icon[value]!' => ''
                ]            
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_label_icon_padding',
            [
                'label'        => __('Padding', AEM_TEXTDOMAIN),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%'],
                'default'      => [
                    'top'      => '0',
                    'bottom'   => '0',
                    'left'     => '0',
                    'right'    => '10',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-news-ticker-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition'    => [
                    'goee_news_ticker_show_label_icon'    => 'yes',
                    'goee_news_ticker_label_icon[value]!' => ''
                ]
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_items_style',
            [
                'label' => esc_html__( 'Items', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE                    
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'goee_news_ticker_typography',
                'selector' => '{{WRAPPER}} .aem-news-ticker ul li, {{WRAPPER}} .aem-news-ticker ul li a'
            ]
        );

        $this->add_control(
            'goee_news_ticker_color',
            [
                'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .aem-news-ticker li, {{WRAPPER}} .aem-news-ticker li a' => 'color: {{VALUE}};'
                ]                
            ]
        );

        $this->add_control(
            'goee_news_ticker_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#3878ff',
                'selectors' => [
                    '{{WRAPPER}} .aem-news-ticker li:hover, {{WRAPPER}} .aem-news-ticker li:hover a' => 'color: {{VALUE}};'
                ]                
            ]
        );

        $this->add_control(
            'goee_news_ticker_bg_color',
            [
                'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .aem-news-ticker' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_each_item_padding',
            [
                'label'      => esc_html__( 'Padding Each Item(Left & Right)', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default'    => [
                    'size'   => 15
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-news-ticker .aem-nt-news ul li' => 'padding: 0 {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'goee_news_ticker_items_border',
                'selector' => '{{WRAPPER}} .aem-news-ticker .aem-nt-news'
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_items_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .aem-news-ticker .aem-nt-news'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'goee_news_ticker_control_style',
            [
                'label'     => esc_html__( 'Controls', AEM_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '.goee_news_ticker_show_controls' => 'yes'
                ]             
            ]
        );

        $this->add_responsive_control(
			'goee_news_ticker_control_spacing',
			[
				'label' => __( 'Spacing (Left & Right)', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .aem-news-ticker .aem-nt-controls' => 'padding: 0 {{SIZE}}{{UNIT}} 0;',
				],
			]
		);

        $this->add_control(
            'goee_news_ticker_control_box_style',
            [
                'label' => esc_html__( 'Control Box', AEM_TEXTDOMAIN ),
                'type'  => Controls_Manager::HEADING
            ]
        );

        $this->add_control(
            'goee_news_ticker_control_bg_color',
            [
                'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .aem-news-ticker .aem-nt-controls' => 'background-color: {{VALUE}};'
                ]               
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'goee_news_ticker_controls_box_border',
                'selector' => '{{WRAPPER}} .aem-news-ticker .aem-nt-controls'
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_controls_box_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors'  => [
                    '{{WRAPPER}} .aem-news-ticker .aem-nt-controls' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'goee_news_ticker_control_box_item_style',
            [
                'label'     => esc_html__( 'Control Items', AEM_TEXTDOMAIN ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'goee_news_ticker_controls_size',
            [
                'label'      => esc_html__( 'Size', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'default'    => [
                    'size'   => 30
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'goee_news_ticker_control_item_spacing',
			[
				'label' => __( 'Control Item Spacing', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .aem-news-ticker .aem-nt-controls button:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'goee_news_ticker_controls_tabs' );

            # Normal State Tab
            $this->start_controls_tab( 'goee_news_ticker_controls_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );
                $this->add_control(
                    'goee_news_ticker_controls_color',
                    [
                        'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#999999',
                        'selectors' => [
                            '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button .bn-arrow::before, {{WRAPPER}} .aem-news-ticker .aem-nt-controls button .bn-arrow::after' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button .bn-pause::before, {{WRAPPER}} .aem-news-ticker .aem-nt-controls button .bn-pause::after' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_news_ticker_controls_bg_color',
                    [
                        'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => 'rgba(0,0,0,0)',
                        'selectors' => [
                            '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );
                
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'goee_news_ticker_control_items_border',
                        'selector' => '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button'
                    ]
                );

                $this->add_responsive_control(
                    'goee_news_ticker_control_items_border_radius',
                    [
                        'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px'],
                        'selectors'  => [
                            '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );


            $this->end_controls_tab();

            #Hover State Tab
            $this->start_controls_tab( 'goee_news_ticker_controls_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );
                $this->add_control(
                    'goee_news_ticker_controls_hover_color',
                    [
                        'label'     => esc_html__( 'Icon Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#999999',
                        'selectors' => [
                            '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button:hover .bn-arrow::before, {{WRAPPER}} .aem-news-ticker .aem-nt-controls button:hover .bn-arrow::after' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button:hover .bn-pause::before, {{WRAPPER}} .aem-news-ticker .aem-nt-controls button:hover .bn-pause::after' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'goee_news_ticker_controls_bg_hover_color',
                    [
                        'label'     => esc_html__( 'Background Color', AEM_TEXTDOMAIN ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => 'rgba(0,0,0,0)',
                        'selectors' => [
                            '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button:hover' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'     => 'goee_news_ticker_control_items_hover_border',
                        'selector' => '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button:hover'
                    ]
                );

                $this->add_responsive_control(
                    'goee_news_ticker_control_items_hover_border_radius',
                    [
                        'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px'],
                        'selectors'  => [
                            '{{WRAPPER}} .aem-news-ticker .aem-nt-controls button:hover'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings       = $this->get_settings_for_display();
        $label          = $settings['goee_news_ticker_label'];
        $show_label     = $settings['goee_news_ticker_show_label'];
        $direction      = $settings['goee_news_ticker_animation_direction'];
        $ticker_height  = $settings['goee_news_ticker_height']['size'];
        $autoplay       = $settings['goee_news_ticker_autoplay'];
        $fixed_position   = $settings['goee_news_ticker_set_fixed_position'];
        $animation_type = $settings['goee_news_ticker_animation_type'];

        $arrow             = 'yes'    === $settings['goee_news_ticker_show_label_arrow'] ? ' yes-small' : ' no';
        $pause_on_hover    = 'yes'    === $autoplay ? $settings['goee_news_ticker_pause_on_hover'] : '';
        $animation_speed   = 'scroll' === $animation_type ? $settings['goee_news_ticker_animation_speed'] : '';
        $autoplay_interval = 'scroll' !== $animation_type ? $settings['goee_news_ticker_autoplay_interval'] : '';

        $this->add_render_attribute( 'aem-news-ticker-wrapper', 'class', 'aem-news-ticker' );

        $this->add_render_attribute( 
            'aem-news-ticker-wrapper', 
            [ 
                'data-autoplay'          => esc_attr( 'yes' === $autoplay ? 'true' : 'false' ),
                'data-fixed_position'      => esc_attr( $fixed_position ),
                'data-pause_on_hover'    => esc_attr( 'yes' === $pause_on_hover ? 'true' : 'false' ),
                'data-direction'         => 'rtl' === $direction || is_rtl() ? 'rtl' : 'ltr',
                'data-autoplay_interval' => esc_attr( $autoplay_interval ),
                'data-animation_speed'   => esc_attr( $animation_speed ),
                'data-ticker_height'     => esc_attr( $ticker_height ),
                'data-animation'         => esc_attr( $animation_type )
            ]
        );

        $this->add_inline_editing_attributes( 'goee_news_ticker_label', 'basic' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'aem-news-ticker-wrapper' );?>>
            <?php do_action( 'goee_news_ticker_wrapper_before' );
            if( 'yes' === $show_label ): ?>
                <div class="aem-bn-label <?php  echo esc_attr( $arrow ) ?>" >
                    <div class="aem-nt-label">
                    <?php if( 'yes' === $settings['goee_news_ticker_show_label_icon'] && !empty( $settings['goee_news_ticker_label_icon'] ) ){ ?>
                        <span class="aem-news-ticker-icon">
                            <?php Icons_Manager::render_icon( $settings['goee_news_ticker_label_icon'], [ 'aria-hidden' => 'true' ] );?>
                        </span>                               
                    <?php 
                    }
                    if( !empty( $label ) ) { ?>
                        <span <?php echo $this->get_render_attribute_string( 'goee_news_ticker_label' );?> ><?php echo wp_kses_post( $label ) ;?></span>
                    <?php } ?>
                    </div>
                </div>
            <?php endif;?>

            <div class="aem-nt-news">
                <?php if( is_array( $settings['goee_news_ticker_items'] ) ) : ?>
                    <ul>
                    <?php foreach ( $settings['goee_news_ticker_items'] as $key => $list ) :
                        $link_key  = 'link_' . $key;

                        $title = $this->get_repeater_setting_key( 'goee_news_ticker_title', 'goee_news_ticker_items', $key );
                        $this->add_inline_editing_attributes( $title, 'basic' );

                        if( $list['goee_news_ticker_link']['url'] ) :
                            $this->add_render_attribute( $link_key, 'href', esc_url( $list['goee_news_ticker_link']['url'] ) );
                            if( $list['goee_news_ticker_link']['is_external'] ) {
                                $this->add_render_attribute( $link_key, 'target', '_blank' );
                            }
                            if( $list['goee_news_ticker_link']['nofollow'] ) {
                                $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                            } ?>
                            <li>
                                <a <?php echo $this->get_render_attribute_string( $link_key );?> >
                                    <span <?php echo $this->get_render_attribute_string( $title );?> ><?php echo wp_kses_post( $list['goee_news_ticker_title'] );?></span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li>
                                <span <?php echo $this->get_render_attribute_string( $title );?>><?php echo wp_kses_post( $list['goee_news_ticker_title'] );?></span>
                            </li>
                        <?php endif;
                    endforeach ;?>
                    </ul>
                <?php endif;?>
            </div>

            <?php if ( 'yes' === $settings['goee_news_ticker_show_controls'] ) :?>
                <div class="aem-nt-controls">
                    <button><span class="bn-arrow bn-prev"></span></button>
                    <?php if( 'yes' === $settings['goee_news_ticker_show_pause_control'] ) :?>
                        <button><span class="bn-action"></span></button>
                    <?php endif;?>
                    <button><span class="bn-arrow bn-next"></span></button>
                </div>
            <?php endif;
            do_action( 'goee_news_ticker_wrapper_after' ); ?>
        </div>
    <?php 
    }

}
