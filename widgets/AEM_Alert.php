<?php
if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;


class AEM_Alert extends Widget_Base
{

    public function get_name()
    {
        return 'aem-alert';
    }

    public function get_title()
    {
        return esc_html__('Alert', AEM_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'aem aem-logo eicon-alert';
    }

    public function get_categories()
    {
        return ['aem-category'];
    }

    public function get_keywords()
    {
        return ['notice', 'message'];
    }
    protected function register_controls()
    {
        $aem_primary_color   = get_option('aem_primary_color_option', '#7a56ff');
        $aem_secondary_color = get_option('aem_secondary_color_option', '#00d8d8');

        /**
         * Alert Content Tab
         */
        $this->start_controls_section(
            'aem_alert_content',
            [
                'label' => esc_html__('Content', 'exclusive-addons-elementor')
            ]
        );

        $this->add_control(
            'aem_alert_content_icon_show',
            [
                'label'        => esc_html__('Enable Icon', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('On', 'exclusive-addons-elementor'),
                'label_off'    => __('Off', 'exclusive-addons-elementor'),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'aem_alert_content_icon',
            [
                'label'   => __('Icon', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fab fa-wordpress-simple',
                    'library' => 'fa-brands'
                ],
                'condition' => [
                    'aem_alert_content_icon_show' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'aem_alert_content_title_show',
            [
                'label'        => esc_html__('Enable Title', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('On', 'exclusive-addons-elementor'),
                'label_off'    => __('Off', 'exclusive-addons-elementor'),
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'aem_alert_content_title',
            [
                'label'     => __('Title', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => 'Well Done!',
                'condition' => [
                    'aem_alert_content_title_show' => 'yes'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'aem_alert_content_description',
            [
                'label'   => __('Description', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'A simple alert—check it out!',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'aem_alert_close_button',
            [
                'label'   => __('Close Icon/Button', 'exclusive-addons-elementor'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'none'    => esc_html__('None', 'exclusive-addons-elementor'),
                    'icon'    => esc_html__('Icon', 'exclusive-addons-elementor'),
                    'button'  => esc_html__('Button', 'exclusive-addons-elementor')
                ]
            ]
        );

        $this->add_control(
            'aem_alert_close_primary_button',
            [
                'label'     => __('Primary Button', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __('Done', 'exclusive-addons-elementor'),
                'condition' => [
                    'aem_alert_close_button' => ['button']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'aem_alert_close_secondary_button',
            [
                'label'                   => __('Secondary Button', 'exclusive-addons-elementor'),
                'type'                    => Controls_Manager::TEXT,
                'default'                 => __('Cancel', 'exclusive-addons-elementor'),
                'condition'               => [
                    'aem_alert_close_button' => ['button']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Alert Content style Tab
         */
        $this->start_controls_section(
            'aem_alert_style',
            [
                'label' => esc_html__('Container', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'aem_alert_background_style',
            [
                'label'     => esc_html__('Background', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ECF9FD',
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-wrapper' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_border_radius',
            [
                'label'     => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_padding',
            [
                'label'      => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'    => '20',
                    'right'  => '20',
                    'bottom' => '20',
                    'left'   => '20'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-alert-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'aem_alert_border',
                'selector' => '{{WRAPPER}} .aem-alert-wrapper'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'aem_alert_box_shadow',
                'selector' => '{{WRAPPER}} .aem-alert-wrapper'
            ]
        );

        $this->end_controls_section();

        /**
         * Alert Icon style
         */
        $this->start_controls_section(
            'aem_alert_icon_style',
            [
                'label'     => esc_html__('Icon', 'exclusive-addons-elementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'aem_alert_content_icon_show' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_icon_size',
            [
                'label'        => esc_html__('Size', 'exclusive-addons-elementor'),
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
                    'size'     => 24
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-alert .aem-alert-element .aem-alert-element-icon i' => 'font-size: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_icon_width',
            [
                'label'       => esc_html__('Width', 'exclusive-addons-elementor'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px'],
                'default'     => [
                    'size'    => 50,
                    'unit'    => 'px'
                ],
                'range'       => [
                    'px'      => [
                        'max' => 200
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .aem-alert .aem-alert-element .aem-alert-element-icon' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .aem-alert .aem-alert-element .aem-alert-element-content' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );'
                ]
            ]
        );

        $this->add_control(
            'aem_alert_icon_color',
            [
                'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-icon span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'aem_alert_icon_bg_color',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-icon span' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_icon_padding',
            [
                'label'      => __('Padding', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-icon span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_icon_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-icon span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Alert Content Title style Tab
         */
        $this->start_controls_section(
            'aem_alert_title_style',
            [
                'label'     => esc_html__('Title', 'exclusive-addons-elementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'aem_alert_content_title_show' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'aem_alert_title_typography',
                'selector' => '{{WRAPPER}} .aem-alert-element .aem-alert-element-content h5'
            ]
        );

        $this->add_control(
            'aem_alert_title_color',
            [
                'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-content h5' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_title_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Alert Content Description style Tab
         */
        $this->start_controls_section(
            'aem_alert_description_style',
            [
                'label' => esc_html__('Description', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'aem_alert_description_typography',
                'selector' => '{{WRAPPER}} .aem-alert-element .aem-alert-element-content .aem-alert-desc'
            ]
        );

        $this->add_control(
            'aem_alert_description_color',
            [
                'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-content .aem-alert-desc' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_description_margin',
            [
                'label'      => __('Margin', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  .aem-alert-element .aem-alert-element-content .aem-alert-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Alert Dismiss button style
         */
        $this->start_controls_section(
            'aem_alert_dismiss_style',
            [
                'label' => esc_html__('Dismiss Button', 'exclusive-addons-elementor'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'aem_alert_dismiss_icon_size',
            [
                'label'        => esc_html__('Size', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 60,
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 16
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-dismiss-icon svg' => 'width: {{SIZE}}px; height: {{SIZE}}px;'
                ]
            ]
        );

        $this->add_control(
            'aem_alert_dismiss_icon_color',
            [
                'label'     => esc_html__('Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#A1A5B5',
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-dismiss-icon svg path' => 'fill: {{VALUE}};'
                ],
                'condition' => [
                    'aem_alert_close_button' => 'icon'
                ]
            ]
        );

        $dismiss_icon_spacing = is_rtl() ? 'left: {{SIZE}}{{UNIT}};' : 'right: {{SIZE}}{{UNIT}};';
        $this->add_responsive_control(
            'aem_alert_dismiss_icon_pos_right',
            [
                'label'      => esc_html__('Offset-X', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 0
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-dismiss-icon' => $dismiss_icon_spacing
                ],
                'condition'  => [
                    'aem_alert_close_button' => 'icon'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_dismiss_icon_pos_top',
            [
                'label'      => esc_html__('Offset-Y', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 15
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-alert-element .aem-alert-element-dismiss-icon' => 'top: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'aem_alert_close_button' => 'icon'
                ]
            ]
        );

        $this->start_controls_tabs(
            'aem_alert_dismiss_button',
            [
                'condition' => ['aem_alert_close_button' => 'button']
            ]
        );

        $this->start_controls_tab('aem_alert_dismiss_primary_button', ['label' => esc_html__('Primary Button', 'exclusive-addons-elementor')]);

        $this->add_control(
            'aem_alert_dismiss_primary_button_background',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => $aem_primary_color,
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-done' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'aem_alert_dismiss_primary_button_text_color',
            [
                'label'     => esc_html__('Text Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-done' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'aem_alert_dismiss_primary_button_text',
                'selector' => '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-done'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'aem_alert_dismiss_primary_button_border',
                'selector' => '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-done'
            ]
        );

        $this->add_responsive_control(
            'aem_alert_dismiss_primary_button_padding',
            [
                'label'        => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%', 'em'],
                'default'      => [
                    'top'      => '10',
                    'right'    => '30',
                    'bottom'   => '10',
                    'left'     => '30',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-done' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_dismiss_primary_button_ border_radius',
            [
                'label'      => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => '5',
                    'right'  => '5',
                    'bottom' => '5',
                    'left'   => '5'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-done' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();


        $this->start_controls_tab('aem_alert_dismiss_secondary_button', ['label' => esc_html__('Secondary Button', 'exclusive-addons-elementor')]);

        $this->add_control(
            'aem_alert_dismiss_secondary_button_background',
            [
                'label'     => esc_html__('Background Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => $aem_secondary_color,
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-cancel' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'aem_alert_close_button' => 'button'
                ]
            ]
        );

        $this->add_control(
            'aem_alert_dismiss_secondary_button_text_color',
            [
                'label'     => esc_html__('Text Color', 'exclusive-addons-elementor'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-cancel' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'aem_alert_dismiss_secondary_button_text',
                'selector' => '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-cancel'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'aem_alert_dismiss_secondary_button_border',
                'selector' => '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-cancel'
            ]
        );

        $this->add_responsive_control(
            'aem_alert_dismiss_secondary_button_padding',
            [
                'label'        => esc_html__('Padding', 'exclusive-addons-elementor'),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => ['px', '%', 'em'],
                'default'      => [
                    'top'      => '10',
                    'right'    => '30',
                    'bottom'   => '10',
                    'left'     => '30',
                    'isLinked' => false
                ],
                'selectors'    => [
                    '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-cancel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'aem_alert_dismiss_secondary_button_radius',
            [
                'label'      => esc_html__('Border Radius', 'exclusive-addons-elementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'default'    => [
                    'top'    => '5',
                    'right'  => '5',
                    'bottom' => '5',
                    'left'   => '5'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-alert-element-dismiss-button .aem-alert-element-dismiss-cancel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings     = $this->get_settings_for_display();
        $title        = $settings['aem_alert_content_title'];
        $description  = $settings['aem_alert_content_description'];
        $primary_btn  = $settings['aem_alert_close_primary_button'];
        $seconday_btn = $settings['aem_alert_close_secondary_button'];

        $this->add_render_attribute('aem_alert_content_title', 'class', 'aem-alert-title');
        $this->add_inline_editing_attributes('aem_alert_content_title', 'basic');

        $this->add_render_attribute('aem_alert_content_description', 'class', 'aem-alert-desc');
        $this->add_inline_editing_attributes('aem_alert_content_description', 'basic');

        $this->add_render_attribute('aem_alert_close_primary_button', 'class', 'aem-alert-element-dismiss-done');
        $this->add_inline_editing_attributes('aem_alert_close_primary_button', 'none');

        $this->add_render_attribute('aem_alert_close_secondary_button', 'class', 'aem-alert-element-dismiss-cancel');
        $this->add_inline_editing_attributes('aem_alert_close_secondary_button', 'none');

        do_action('aem_alert_wrapper_before');
?>

        <div class="aem-alert">
            <div class="aem-alert-wrapper" data-alert>
                <div class="aem-alert-element">
                    <?php
                    do_action('aem_alert_content_wrapper_before');

                    if ('yes' === $settings['aem_alert_content_icon_show'] && !empty($settings['aem_alert_content_icon']['value'])) {
                    ?>
                        <div class="aem-alert-element-icon">
                            <span>
                                <?php Icons_Manager::render_icon($settings['aem_alert_content_icon'], ['aria-hidden' => 'true']); ?>
                            </span>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="aem-alert-element-content">
                        <?php
                        if (!empty($title) && 'yes' === $settings['aem_alert_content_title_show']) {
                            printf('<h5 ' . $this->get_render_attribute_string('aem_alert_content_title') . '>%s</h5>', wp_kses_post($title));
                        }
                        $description ? printf('<div ' . $this->get_render_attribute_string('aem_alert_content_description') . '>%s</div>', wp_kses_post($description)) : '';
                        ?>
                    </div>

                    <?php
                    if ('icon' === $settings['aem_alert_close_button']) { ?>
                        <div class="aem-alert-element-dismiss-icon">
                            <svg viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2.343 15.071L.929 13.656 6.586 8 .929 2.343 2.343.929 8 6.585 13.657.929l1.414 1.414L9.414 8l5.657 5.656-1.414 1.415L8 9.414l-5.657 5.657z" />
                            </svg>
                        </div>
                    <?php
                    }

                    do_action('aem_alert_content_wrapper_after'); ?>
                </div>

                <?php
                if ('button' === $settings['aem_alert_close_button']) { ?>
                    <div class="aem-alert-element-dismiss-button">
                        <?php
                        $primary_btn ? printf('<button ' . $this->get_render_attribute_string('aem_alert_close_primary_button') . '>%s</button>', esc_html($primary_btn)) : '';
                        $seconday_btn ? printf('<button ' . $this->get_render_attribute_string('aem_alert_close_secondary_button') . '>%s</button>', esc_html($seconday_btn)) : '';
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>

<?php do_action('aem_alert_wrapper_after');
    }
}
