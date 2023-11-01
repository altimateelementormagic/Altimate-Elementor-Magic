<?php

use Elementor\Repeater;
use Elementor\Controls_Manager;

class AEM_Business_Hours extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'business-hours';
    }
    public function get_title()
    {
        return esc_html__('Business Hours', AEM_TEXTDOMAIN);
    }
    public function get_icon()
    {
        return 'aem aem-logo eicon-clock eicon-clock-o';
    }
    public function get_categories()
    {
        return ['aem-category'];
    }
    public function get_keywords()
    {
        return ['card', 'service', 'highlight'];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', AEM_TEXTDOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'aem_business_hours',
            [
                'label' => esc_html__('Business Days & Timings', AEM_TEXTDOMAIN),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'aem_bh_day',
                        'label' => esc_html__('Enter Day', AEM_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'placeholder' => 'Sunday',

                    ],
                    [
                        'name' => 'aem_bh_time',
                        'label' => esc_html__('Enter Time', AEM_TEXTDOMAIN),
                        'type' => Controls_Manager::TEXT,
                        'placeholder' => '9:00 AM to 6:00 PM',
                    ],
                ],
                'default' => [
                    [
                        'aem_bh_day' => esc_html__('Sunday', AEM_TEXTDOMAIN),
                        'aem_bh_time' => esc_html__('9:00 AM to 6:00 PM ', AEM_TEXTDOMAIN),
                    ],
                    [
                        'aem_bh_day' => esc_html__('Monday', AEM_TEXTDOMAIN),
                        'aem_bh_time' => esc_html__('9:00 AM to 6:00 PM', AEM_TEXTDOMAIN),
                    ],
                ],
                'title_field' => '{{{aem_bh_day}}}',
            ],


        );

        $this->end_controls_section();

        // Style section
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', AEM_TEXTDOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Color option
        $this->add_control(
            'title_options',
            [
                'label' => esc_html__('Days Options', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#030303',
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Typography option
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} h3',
            ]
        );

        // Options widget Time

        $this->add_control(
            'description_options',
            [
                'label' => esc_html__('Time Options', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'essential-elementor-widget'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .card__description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .card__description',
            ]
        );


        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $aem_business_hours = $settings['aem_business_hours'];
        
        if ($aem_business_hours) {
            echo '<dl class="aem-business-hours">';
            foreach ($aem_business_hours as $item) {
                echo '<dt class="aem_bh_days aem_bh_days-' . esc_attr($item['_id']) . '">' . $item['aem_bh_day'] . '</dt>';
                echo '<dd class="aem_bh_time aem_bh_time-'.esc_attr($item['_id']) . '">' . $item['aem_bh_time'] . '</dd>';
            }
            echo '</dl>';
        }
    }
}
