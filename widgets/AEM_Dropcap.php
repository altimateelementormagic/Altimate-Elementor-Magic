<?php

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AEM_Dropcap extends Widget_Base {

    public function get_name() {
        return 'aem-drop-cap';
    }

    public function get_title() {
        return esc_html__( 'Drop Cap', AEM_TEXTDOMAIN );
    }

    public function get_icon() {
        return 'aem aem-logo eicon-editor-paragraph';
    }

    public function get_keywords() {
        return [ 'move', 'drop cap', 'drop', 'cap' ];
    }

    public function get_style_depends() {
        return ['move-dropcap'];
    }

    public function get_categories() {
        return ['aem-category'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Drop cap', AEM_TEXTDOMAIN ),
            ]
        );
            
            $this->add_control(
                'aem_dropcap_text',
                [
                    'label'         => esc_html__( 'Content', AEM_TEXTDOMAIN ),
                    'type'          => Controls_Manager::TEXTAREA,
                    'default'       => esc_html__( 'Today, businesses at present had creatively generated effective advertising campaigns in the form of visual media that includes the television and radios and the print media that cover the newspaper and campaign materials like the posters, blackpink in your flyers and many more. Taking part with the flyers they are tiny form or a single sheet promotional tool that easily spreads by hand. They are simply characterized as a simple yet your business.', AEM_TEXTDOMAIN ),
                ]
            );

        $this->end_controls_section();

        // Style tab section
        $this->start_controls_section(
            'dropcaps_style_section',
            [
                'label' => esc_html__( 'Style', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'content_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-drop-cap p' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'selector' => '{{WRAPPER}} .htmove-drop-cap p',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-drop-cap p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'content_border',
                    'label' => esc_html__( 'Border', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .htmove-drop-cap',
                ]
            );

            $this->add_responsive_control(
                'content_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-drop-cap' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style dropcaps latter tab section
        $this->start_controls_section(
            'dropcaps_latter_style_section',
            [
                'label' => esc_html__( 'Dropcap Latter', AEM_TEXTDOMAIN ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_control(
                'dropcap_letter_color',
                [
                    'label' => esc_html__( 'Color', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-drop-cap p:first-of-type:first-letter' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'dropcap_letter_typography',
                    'selector' => '{{WRAPPER}} .htmove-drop-cap p:first-of-type:first-letter',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'dropcap_letter_background',
                    'label' => esc_html__( 'Background', AEM_TEXTDOMAIN ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htmove-drop-cap p:first-of-type:first-letter',
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'dropcap_letter_box_shadow',
                    'label' => esc_html__( 'Box Shadow', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .htmove-drop-cap p:first-of-type:first-letter',
                ]
            );

            $this->add_responsive_control(
                'dropcap_letter_padding',
                [
                    'label' => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-drop-cap p:first-of-type:first-letter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'dropcap_letter_margin',
                [
                    'label' => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htmove-drop-cap p:first-of-type:first-letter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'dropcap_letter_border',
                    'label' => esc_html__( 'Border', AEM_TEXTDOMAIN ),
                    'selector' => '{{WRAPPER}} .htmove-drop-cap p:first-of-type:first-letter',
                ]
            );

            $this->add_responsive_control(
                'dropcap_letter_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htmove-drop-cap p:first-of-type:first-letter' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $this->add_render_attribute( 'area_attr', 'class', 'htmove-drop-cap' );

        ?>                
        <div <?php echo $this->get_render_attribute_string( 'area_attr' ); ?> >
            <?php
                if( !empty( $settings['aem_dropcap_text'] ) ){
                    echo '<p>'.esc_html__( $settings['aem_dropcap_text'], AEM_TEXTDOMAIN ).'</p>';
                }
            ?>
        </div>
        <?php

    }

}