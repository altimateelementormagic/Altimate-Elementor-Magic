<?php
// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use AEM_Addons_Elementor\classes\Helper;
use Elementor\Group_Control_Background;



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AEM_Heading_Simple extends Widget_Base {

    public function get_name() {
        return 'aem-simple-heading';
    }

    public function get_title() {
        return esc_html__( 'Simple Heading', AEM_TEXTDOMAIN );
    }

    public function get_icon() {
        return 'aem aem-logo aem-elementor-icon eicon-heading';
    }

    public function get_keywords() {
        return [ 'headline', 'heading', 'section title', 'title' ];
    }
    public function get_categories() {
        return [ 'aem-category' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'heading_content',
            [
                'label' => esc_html__( 'Heading', AEM_TEXTDOMAIN ),
            ]
        );

            $this->add_control(
                'heading',
                [
                    'label' => esc_html__( 'Heading', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'AEM Plugin The Ultimate Addons', AEM_TEXTDOMAIN ),
                    'placeholder' => esc_html__( 'Type your heading here', AEM_TEXTDOMAIN ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'sub_heading',
                [
                    'label' => esc_html__( 'Sub Heading', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Modern Heading', AEM_TEXTDOMAIN ),
                    'placeholder' => esc_html__( 'Type your sub heading here', AEM_TEXTDOMAIN ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'description_heading',
                [
                    'label' => esc_html__( 'Heading Description', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__( 'Your Widget List freely use these elements to create your site. You can enable which you are not using.', AEM_TEXTDOMAIN ),
                    'placeholder' => esc_html__( 'Type your heading description here', AEM_TEXTDOMAIN ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'heading_icon',
                [
                    'label'       => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'headingicon',
                ]
            );

            $this->add_control(
                'heading_icon_align',
                [
                    'label'   => esc_html__( 'Icon Position', AEM_TEXTDOMAIN ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'top',
                    'options' => [
                        'top'   => esc_html__( 'Top', AEM_TEXTDOMAIN ),
                        'bottom'  => esc_html__( 'Bottom', AEM_TEXTDOMAIN ),
                    ],
                    'condition' => [
                        'heading_icon[value]!' => '',
                    ],
                ]
            );

        $this->end_controls_section();

        // Headinbg Option start
        $this->start_controls_section(
            'heading_setting',
            [
                'label' => esc_html__( 'Setting', AEM_TEXTDOMAIN ),
            ]
        );

            $this->add_control(
                'heading_link',
                [
                    'label' => esc_html__( 'Heading Link', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', AEM_TEXTDOMAIN ),
                    'default' => [
                        'url' => '',
                    ],
                    'condition'=>[
                        'heading!'=>'',
                    ],
                ]
            );

            $this->add_control(
                'sub_heading_link',
                [
                    'label' => esc_html__( 'Sub Heading Link', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', AEM_TEXTDOMAIN ),
                    'default' => [
                        'url' => '',
                    ],
                    'condition'=>[
                        'sub_heading!'=>'',
                    ],
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'heading_tag',
                [
                    'label' => esc_html__( 'Heading HTML Tag', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT,
                    'options' => Helper::aem_title_tags(),
                    'default' => 'h2',
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'sub_heading_tag',
                [
                    'label' => esc_html__( 'Sub Heading HTML Tag', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT,
                    'options' => Helper::aem_title_tags(),
                    'default' => 'span',
                    'condition'=>[
                        'sub_heading!'=>'',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'desc_heading_tag',
                [
                    'label' => esc_html__( 'Heading Description HTML Tag', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SELECT,
                    'options' => Helper::aem_title_tags(),
                    'default' => 'p',
                    'condition'=>[
                        'description_heading!'=>'',
                    ],
                    'label_block' => true,
                ]
            );

            $this->add_control(
                'sub_heading_position',
                [
                    'label' => esc_html__( 'Sub Heading Position', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'top' => [
                            'title' => esc_html__( 'Top', AEM_TEXTDOMAIN ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => esc_html__( 'Bottom', AEM_TEXTDOMAIN ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'condition'=>[
                        'sub_heading!'=>'',
                    ],
                    'default' => 'top',
                    'separator' => 'after',
                ]
            );

            $this->add_control(
                'enable_separator',
                [
                    'label' => esc_html__( 'Enable Separator', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', AEM_TEXTDOMAIN ),
                    'label_off' => esc_html__( 'No', AEM_TEXTDOMAIN ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition'=>[
                        'heading!'=>'',
                    ],
                ]
            );

            $this->add_responsive_control(
                'separator_width',
                [
                    'label' => esc_html__( 'Separator Width', AEM_TEXTDOMAIN ),
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
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-separator' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'enable_separator'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'separator_color',
                [
                    'label' => esc_html__( 'Separator Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#dddddd',
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-separator' => 'background-color: {{VALUE}}',
                    ],
                    'condition'=>[
                        'enable_separator'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'enable_placeholder',
                [
                    'label' => esc_html__( 'Enable Transparent text', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => esc_html__( 'Yes', AEM_TEXTDOMAIN ),
                    'label_off' => esc_html__( 'No', AEM_TEXTDOMAIN ),
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'heading_placeholder_txt',
                [
                    'label' => esc_html__( 'Heading Transparent Text', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Type your placeholder text here', AEM_TEXTDOMAIN ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition'=>[
                        'enable_placeholder'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'transparent_heading_pos_toggle',
                [
                    'label' => esc_html__( 'Transparent Heading Position', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'default' => 'no',
                    'condition'=>[
                        'heading_placeholder_txt!'=>'',
                    ]
                ]
            );

            $this->start_popover();

                $this->add_responsive_control(
                    'trans_heading_x_pos',
                    [
                        'label'   => esc_html__( 'X Position', AEM_TEXTDOMAIN ),
                        'type'    => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ]
                    ]
                );

                $this->add_responsive_control(
                    'trans_heading_y_pos',
                    [
                        'label'   => esc_html__( 'Y Position', AEM_TEXTDOMAIN ),
                        'type'    => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .aem-heading.aem-heading-placeholder .aem-heading-title::before' => '-webkit-transform: translateX( {{trans_heading_x_pos.SIZE}}{{trans_heading_x_pos.UNIT}} ) translateY( {{SIZE}}{{UNIT}} );-ms-transform: translateX( {{trans_heading_x_pos.SIZE}}{{trans_heading_x_pos.UNIT}} ) translateY( {{SIZE}}{{UNIT}} );transform: translateX( {{trans_heading_x_pos.SIZE}}{{trans_heading_x_pos.UNIT}} ) translateY( {{SIZE}}{{UNIT}} );',
                        ],

                    ]
                );

            $this->end_popover();

            $this->add_control(
                'sub_placeholder_txt',
                [
                    'label' => esc_html__( 'Sub Heading Transparent Text', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Type your placeholder text here', AEM_TEXTDOMAIN ),
                    'label_block'=>true,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition'=>[
                        'enable_placeholder'=>'yes',
                    ],
                ]
            );

            $this->add_control(
                'transparent_subheading_pos_toggle',
                [
                    'label' => esc_html__( 'Transparent Sub Heading Position', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::POPOVER_TOGGLE,
                    'default' => 'no',
                    'condition'=>[
                        'sub_placeholder_txt!'=>'',
                    ]
                ]
            );

            $this->start_popover();

                $this->add_responsive_control(
                    'trans_subheading_x_pos',
                    [
                        'label'   => esc_html__( 'X Position', AEM_TEXTDOMAIN ),
                        'type'    => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ]
                    ]
                );

                $this->add_responsive_control(
                    'trans_subheading_y_pos',
                    [
                        'label'   => esc_html__( 'Y Position', AEM_TEXTDOMAIN ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%' ],
                        'range' => [
                            'px' => [
                                'min' => -1000,
                                'max' => 1000,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .aem-heading.aem-heading-placeholder .aem-heading-sub-title::before' => '-webkit-transform: translateX( {{trans_subheading_x_pos.SIZE}}{{trans_subheading_x_pos.UNIT}} ) translateY( {{SIZE}}{{UNIT}} );-ms-transform: translateX( {{trans_subheading_x_pos.SIZE}}{{trans_subheading_x_pos.UNIT}} ) translateY( {{SIZE}}{{UNIT}} );transform: translateX( {{trans_subheading_x_pos.SIZE}}{{trans_subheading_x_pos.UNIT}} ) translateY( {{SIZE}}{{UNIT}} );',
                        ],
                        
                    ]
                );

            $this->end_popover();

        $this->end_controls_section(); // Subtitle Option end

        // Style tab section
        $this->start_controls_section(
            'heading_area_style',
            [
                'label' => esc_html__( 'Style', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'alignment',
                [
                    'label' => esc_html__( 'Alignment', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => esc_html__( 'Left', AEM_TEXTDOMAIN ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', AEM_TEXTDOMAIN ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__( 'Right', AEM_TEXTDOMAIN ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading' => 'align-items: {{VALUE}};',
                    ],
                    'default' => 'center',
                    'prefix_class' => 'aem-heading-%s',
                ]
            );

        $this->end_controls_section();

        /* Headline Style */
        $this->start_controls_section(
            'heading_style',
            [
                'label' => esc_html__( 'Heading', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'heading_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#1D39D7',
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typography',
                    'selector' => '{{WRAPPER}} .aem-heading .aem-heading-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'heading_border',
                    'label' => esc_html__( 'Border', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .aem-heading .aem-heading-title',
                ]
            );

            $this->add_responsive_control(
                'heading_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-title' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_nmargin',
                [
                    'label' => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'heading_padding',
                [
                    'label' => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        /* Sub headline Style*/
        $this->start_controls_section(
            'sub_heading_style',
            [
                'label' => esc_html__( 'Sub Heading', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'sub_heading!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'sub_heading_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#666666',
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-sub-title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sub_heading_typography',
                    'selector' => '{{WRAPPER}} .aem-heading .aem-heading-sub-title',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'sub_heading_border',
                    'label' => esc_html__( 'Border', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .aem-heading .aem-heading-sub-title',
                ]
            );

            $this->add_responsive_control(
                'sub_heading_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-sub-title' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'sub_heading_nmargin',
                [
                    'label' => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'sub_heading_padding',
                [
                    'label' => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'sub_heading_background',
                    'label' => esc_html__( 'Background', AEM_TEXTDOMAIN ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .aem-heading .aem-heading-sub-title',
                ]
            );

        $this->end_controls_section();

        /* Description headline Style*/
        $this->start_controls_section(
            'desc_heading_style',
            [
                'label' => esc_html__( 'Heading Description', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'description_heading!'=>'',
                ],
            ]
        );
            
            $this->add_control(
                'desc_heading_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#999999',
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-desc' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_heading_typography',
                    'selector' => '{{WRAPPER}} .aem-heading .aem-heading-desc',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'desc_heading_border',
                    'label' => esc_html__( 'Border', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .aem-heading .aem-heading-desc',
                ]
            );

            $this->add_responsive_control(
                'desc_heading_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-desc' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'desc_heading_margin',
                [
                    'label' => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'desc_heading_padding',
                [
                    'label' => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Icon style tab start
        $this->start_controls_section(
            'heading_icon_style_section',
            [
                'label'     => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'heading_icon[value]!' => '',
                ],
            ]
        );
            
            $this->add_control(
                'icon_color',
                [
                    'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-icon' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __( 'Size', AEM_TEXTDOMAIN ),
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
                        'size' => 36,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_margin',
                [
                    'label' => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_padding',
                [
                    'label' => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading .aem-heading-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        /* Transparent text Style*/
        $this->start_controls_section(
            'transparent_heading_style',
            [
                'label' => esc_html__( 'Transparent', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'enable_placeholder'=>'yes',
                ],
            ]
        );
            
            $this->add_control(
                'transparent_heading',
                [
                    'label' => esc_html__( 'Heading Transparent', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'transparent_heading_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#F3F3F3',
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading.aem-heading-placeholder .aem-heading-title::before' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'transparent_heading_typography',
                    'selector' => '{{WRAPPER}} .aem-heading.aem-heading-placeholder .aem-heading-title::before',
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'transparent_subheading',
                [
                    'label' => esc_html__( 'Sub Heading Transparent', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'transparent_subheading_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-heading.aem-heading-placeholder .aem-heading-sub-title::before' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'transparent_subheading_typography',
                    'selector' => '{{WRAPPER}} .aem-heading.aem-heading-placeholder .aem-heading-sub-title::before',
                    'separator'=>'before',
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'aem-heading aem-heading-title aem-heading-center' );
        $this->add_render_attribute( 'area_attr', 'class', 'aem-sub-heading-pos-'.$settings['sub_heading_position'] );

        if( $settings['enable_placeholder'] =='yes' ){
            $this->add_render_attribute( 'area_attr', 'class', 'aem-heading-placeholder' );
        }

        $heading    = ! empty( $settings['heading'] ) ? $settings['heading'] : '';
        $subheading = ! empty( $settings['sub_heading'] ) ? $settings['sub_heading'] : '';
        $des_heading = ! empty( $settings['description_heading'] ) ? $settings['description_heading'] : '';

        $heading_pl_txt = ! empty( $settings['heading_placeholder_txt'] ) ? 'data-pltext="'.$settings['heading_placeholder_txt'].'"' : '';
        $sub_heading_pl_txt = ! empty( $settings['sub_placeholder_txt'] ) ? 'data-pltext="'.$settings['sub_placeholder_txt'].'"' : '';


        // URL Generate For Heading
        if ( ! empty( $settings['heading_link']['url'] ) ) {

            $this->add_render_attribute( 'headingurl', 'href', $settings['heading_link']['url'] );

            if ( $settings['heading_link']['is_external'] ) {
                $this->add_render_attribute( 'headingurl', 'target', '_blank' );
            }

            if ( ! empty( $settings['heading_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'headingurl', 'rel', 'nofollow' );
            }

            $heading = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'headingurl' ), $heading );

        }

        // URL Generate For Sub Heading
        if ( ! empty( $settings['sub_heading_link']['url'] ) ) {

            $this->add_render_attribute( 'subheadingurl', 'href', $settings['sub_heading_link']['url'] );

            if ( $settings['sub_heading_link']['is_external'] ) {
                $this->add_render_attribute( 'subheadingurl', 'target', '_blank' );
            }

            if ( ! empty( $settings['sub_heading_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'subheadingurl', 'rel', 'nofollow' );
            }

            $subheading = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'subheadingurl' ), $subheading );

        }

        $heading_icon = '';
        if( !empty( $settings['heading_icon']['value'] ) ){

            $this->add_render_attribute( 'area_attr', 'class', 'aem-heading-icon-'.$settings['heading_icon_align'] );

            $heading_icon = '<span class="aem-heading-icon">'.move_addons_render_icon( $settings, 'heading_icon', 'headingicon' ).'</span>';
        }

        $heading_output = $sub_heading = $heading_des = $heading_text ='';
        if( !empty( $subheading ) ){
            $this->add_render_attribute( 'sub_heading_attr', 'class', 'aem-heading-sub-title' );
            $sub_heading_html_tag = Helper::aem_addons_validate_html_tag( $settings['sub_heading_tag'] );
            $sub_heading = sprintf( '<%1$s %4$s %2$s>%3$s</%1$s>', $sub_heading_html_tag, $this->get_render_attribute_string( 'sub_heading_attr' ), $subheading, $sub_heading_pl_txt );
        }

        if( !empty( $heading ) ){
            $this->add_render_attribute( 'heading_attr', 'class', 'aem-heading-title' );
            $heading_html_tag = Helper::aem_addons_validate_html_tag( $settings['heading_tag'] );
            $heading_text = sprintf( '<%1$s %4$s %2$s>%3$s</%1$s>', $heading_html_tag, $this->get_render_attribute_string( 'heading_attr' ), $heading, $heading_pl_txt );
        }

        if( !empty( $des_heading ) ){
            $this->add_render_attribute( 'des_heading_attr', 'class', 'aem-heading-desc' );
            $desc_heading_html_tag = Helper::aem_addons_validate_html_tag( $settings['desc_heading_tag'] );
            $heading_des = sprintf( '<%1$s %2$s>%3$s</%1$s>', $desc_heading_html_tag, $this->get_render_attribute_string( 'des_heading_attr' ), $des_heading );
        }

        // Separator
        if( $settings['enable_separator'] == 'yes' && !empty( $heading ) ){
            $heading_text = $heading_text.'<span class="aem-heading-separator"></span>';
        }

        // Sub Heading Position
        if( $settings['sub_heading_position'] === 'bottom' ){
            $heading_output = $heading_text.$sub_heading.$heading_des;
        }else{
            $heading_output = $sub_heading.$heading_text.$heading_des;
        }

        // Icon Position
        if( $settings['heading_icon_align'] === 'bottom' ){
            $heading_output = $heading_output.$heading_icon;
        }else{
            $heading_output = $heading_icon.$heading_output;
        }

        echo sprintf('<div %1$s>%2$s</div>', $this->get_render_attribute_string( 'area_attr' ), $heading_output );
        

    }

}