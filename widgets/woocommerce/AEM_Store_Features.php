<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;

class AEM_Store_Features extends Widget_Base {

    public function get_name() {
        return 'aem-store-feature';
    }

    public function get_title() {
        return __( 'Store Feature', 'woolentor' );
    }

    public function get_icon() {
        return 'aem aem-logo eicon-checkbox';
    }

    public function get_categories() {
        return [ 'aem-category' ];
    }

    public function get_keywords(){
        return ['feature','store'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Store Feature', 'woolentor' ),
            ]
        );
            
            $this->add_control(
                'feature_style',
                [
                    'label' => __( 'Layout', 'woolentor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'  => __( 'Layout One', 'woolentor' ),
                        '2' => __( 'Layout Two', 'woolentor' ),
                        '3' => __( 'Layout Three', 'woolentor' ),
                        '4' => __( 'Layout Four', 'woolentor' ),
                        '5' => __( 'Layout Five', 'woolentor' ),
                    ],
                ]
            );

            $this->add_control(
                'icon_type',
                [
                    'label' => esc_html__( 'Icon Type', 'woolentor' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'icon' => [
                            'title' => esc_html__( 'Icon', 'woolentor' ),
                            'icon' => 'eicon-editor-italic',
                        ],
                        'image' => [
                            'title' => esc_html__( 'Image', 'woolentor' ),
                            'icon' => 'eicon-image',
                        ],
                    ],
                    'default' => 'image',
                    'toggle' => false,
                ]
            );

            $this->add_control(
                'feature_icon',
                [
                    'label'       => esc_html__( 'Icon', 'woolentor' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'fa4compatibility' => 'featureicon',
                    'condition'=>[
                        'icon_type'=>'icon'
                    ],
                ]
            );

            $this->add_control(
                'feature_image',
                [
                    'label' => esc_html__( 'Image','woolentor' ),
                    'type' => Controls_Manager::MEDIA,
                    'condition'=>[
                        'icon_type'=>'image'
                    ],
                ]
            );

            $this->add_control(
                'feature_title',
                [
                    'label' => esc_html__( 'Title', 'woolentor' ),
                    'type' => Controls_Manager::TEXT,
                    'default'=>esc_html__( 'Free shipping', 'woolentor' ),
                    'label_block'=>true,
                ]
            );

            $this->add_control(
                'feature_sub_title',
                [
                    'label' => esc_html__( 'Sub Title', 'woolentor' ),
                    'type' => Controls_Manager::TEXT,
                    'default'=>esc_html__( 'Start from $100', 'woolentor' ),
                    'label_block'=>true,
                ]
            );

        $this->end_controls_section();

        // Area Style Section
        $this->start_controls_section(
            'feature_area_style',
            [
                'label' => esc_html__( 'Area', 'woolentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'feature_area_align',
                [
                    'label' => __( 'Alignment', 'woolentor' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'woolentor' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'woolentor' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'woolentor' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'woolentor' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .aem-feature-style-2 .aem-feature-content' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'feature_area_border',
                    'label' => __( 'Border', 'woolentor' ),
                    'selector' => '{{WRAPPER}} .aem-feature-wrap .aem-feature-inner',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'feature_area_hover_border',
                    'label' => __( 'Hover Border', 'woolentor' ),
                    'selector' => '{{WRAPPER}} .aem-feature-wrap:hover .aem-feature-inner',
                    'fields_options'=>[
                        'border'=>[
                            'label' => __( 'Hover Border Type', 'woolentor' ),
                        ],
                    ],
                ]
            );

            $this->add_responsive_control(
                'feature_area_padding',
                [
                    'label' => __( 'Area Padding', 'woolentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'before',
                ]
            );

            $this->add_responsive_control(
                'feature_area_margin',
                [
                    'label' => __( 'Area Margin', 'woolentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'feature_area_background',
                    'label' => __( 'Background', 'woolentor' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .aem-feature-wrap',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'area_box_shadow',
                    'label' => __( 'Box Shadow', 'woolentor' ),
                    'selector' => '{{WRAPPER}} .aem-feature-wrap',
                ]
            );

        $this->end_controls_section();

        /* Image Style */
        $this->start_controls_section(
            'feature_icon_image_style',
            [
                'label' => esc_html__( 'Image/Icon', 'woolentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'feature_image[id]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                        [
                            'name' => 'feature_icon[value]',
                            'operator' => '!=',
                            'value' => '',
                        ],
                    ],
                ],

            ]
        );

            $this->add_control(
                'icon_color',
                [
                    'label' => __( 'Icon Color', 'woolentor' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-img i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-img svg *' => 'color: {{VALUE}}',
                    ],
                    'condition'=>[
                        'feature_icon[value]!'=>'',
                    ]
                ]
            );

            $this->add_control(
                'icon_hover_color',
                [
                    'label' => __( 'Icon Hover Color', 'woolentor' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap:hover .aem-feature-img i' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .aem-feature-wrap:hover .aem-feature-img svg *' => 'color: {{VALUE}}',
                    ],
                    'condition'=>[
                        'feature_icon[value]!'=>'',
                    ]
                ]
            );

            $this->add_responsive_control(
                'icon_size',
                [
                    'label' => __( 'Icon Size', 'woolentor' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-img i' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-img svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'=>[
                        'feature_icon[value]!'=>'',
                    ]
                ]
            );


            $this->start_controls_tabs('image_icon_style_tabs');

                $this->start_controls_tab(
                    'image_icon_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'woolentor' ),
                    ]
                );
                    
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'feature_icon_background',
                            'label' => __( 'Background', 'woolentor' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .aem-feature-wrap .aem-feature-img',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'feature_icon_border',
                            'label' => __( 'Border', 'woolentor' ),
                            'selector' => '{{WRAPPER}} .aem-feature-wrap .aem-feature-img',
                        ]
                    );

                    $this->add_responsive_control(
                        'feature_icon_border_radius',
                        [
                            'label' => __( 'Border Radius', 'woolentor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .aem-feature-wrap .aem-feature-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'feature_icon_padding',
                        [
                            'label' => __( 'Padding', 'woolentor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .aem-feature-wrap .aem-feature-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator'=>'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'feature_icon_margin',
                        [
                            'label' => __( 'Margin', 'woolentor' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .aem-feature-wrap .aem-feature-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'image_icon_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'woolentor' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'feature_icon_hover_background',
                            'label' => __( 'Background', 'woolentor' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .aem-feature-wrap:hover .aem-feature-img',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'feature_icon_hover_border',
                            'label' => __( 'Border', 'woolentor' ),
                            'selector' => '{{WRAPPER}} .aem-feature-wrap:hover .aem-feature-img',
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Content area style
        $this->start_controls_section(
            'feature_content_style',
            [
                'label' => esc_html__( 'Content Area', 'woolentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'feature_content_area_border',
                    'label' => __( 'Border', 'woolentor' ),
                    'selector' => '{{WRAPPER}} .aem-feature-wrap .aem-feature-content',
                ]
            );

            $this->add_responsive_control(
                'feature_content_area_padding',
                [
                    'label' => __( 'Padding', 'woolentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'=>'before',
                ]
            );
            
            $this->add_responsive_control(
                'feature_content_area_margin',
                [
                    'label' => __( 'Margin', 'woolentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Title style
        $this->start_controls_section(
            'feature_title_style',
            [
                'label' => esc_html__( 'Title', 'woolentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'feature_title!'=>'',
                ]
            ]
        );
            
            $this->add_control(
                'feature_title_color',
                [
                    'label' => __( 'Color', 'woolentor' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-content h4' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'feature_title_typography',
                    'label' => __( 'Typography', 'woolentor' ),
                    'selector' => '{{WRAPPER}} .aem-feature-wrap .aem-feature-content h4',
                ]
            );

            $this->add_responsive_control(
                'feature_title_margin',
                [
                    'label' => __( 'Margin', 'woolentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // SubTitle style
        $this->start_controls_section(
            'feature_subtitle_style',
            [
                'label' => esc_html__( 'Sub Title', 'woolentor' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'feature_sub_title!'=>'',
                ]
            ]
        );
            
            $this->add_control(
                'feature_sub_title_color',
                [
                    'label' => __( 'Color', 'woolentor' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-content p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'feature_sub_title_typography',
                    'label' => __( 'Typography', 'woolentor' ),
                    'selector' => '{{WRAPPER}} .aem-feature-wrap .aem-feature-content p',
                ]
            );

            $this->add_responsive_control(
                'feature_sub_title_margin',
                [
                    'label' => __( 'Margin', 'woolentor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .aem-feature-wrap .aem-feature-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }


    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'area_attr', 'class', 'aem-feature-wrap aem-feature-style-'.$settings['feature_style'] );

        $icon = '';
        if( 'icon' === $settings['icon_type'] ){
            $icon = woolentor_render_icon( $settings, 'feature_icon', 'featureicon' );
        }else{
            $icon = Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'feature_image' );
        }

        ?>
            <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
                <div class="aem-feature-inner">
                    <?php
                        if( !empty( $icon ) ){
                            echo '<div class="aem-feature-img">'.$icon.'</div>';
                        }
                    ?>
                    <div class="aem-feature-content">
                        <?php
                            if( !empty( $settings['feature_title'] ) ){
                                echo '<h4>'.$settings['feature_title'].'</h4>';
                            }
                            if( !empty( $settings['feature_sub_title'] ) ){
                                echo '<p>'.$settings['feature_sub_title'].'</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php        
    }

}