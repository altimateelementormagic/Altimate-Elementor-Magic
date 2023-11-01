<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;

class AEM_Countdown extends Widget_Base {

	public function get_name() {
		return 'aem-countdown-timer';
	}

	public function get_title() {
		return esc_html__( 'Countdown Timer', AEM_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-time-line';
	}

	public function get_keywords() {
        return [ 'coming', 'soon', ];
    }

	public function get_categories() {
		return [ 'aem-category' ];
	}

	public function get_script_depends() {
		return [ 'aem-countdown' ];
	}

	protected function register_controls() {
		$aem_primary_color = get_option( 'aem_primary_color_option', '#7a56ff' );

		/**
		 * Countdown Timer Settings
		 */
		$this->start_controls_section(
  			'aem_section_countdown_settings_general',
  			[
  				'label' => esc_html__( 'Timer Settings', AEM_TEXTDOMAIN )
  			]
  		);
		
		$this->add_control(
			'aem_countdown_time',
			[
				'label'       => esc_html__( 'Countdown Date', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date("Y/m/d", strtotime("+ 1 week")),
				'description' => esc_html__( 'Set the date and time here', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_countdown_expired_text',
			[
				'label'       => __( 'Countdown Expired Title', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'Hurray! This is the event day.', AEM_TEXTDOMAIN ),
				'description' => __( 'This text will show when the CountDown will over.', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'aem_section_countdown_container_style',
			[
				'label' => esc_html__( 'Container', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'aem_countdown_container_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aem-countdown'
			]
		);

		$this->add_responsive_control(
			'aem_countdown_container_padding',
			[
				'label'      => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-countdown' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'aem_countdown_border',
				'selector' => '{{WRAPPER}} .aem-countdown'
			]
		);

		$this->add_responsive_control(
			'aem_countdown_container_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-countdown' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'aem_section_countdown_box_style',
			[
				'label' => esc_html__( 'Counter Box', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_section_countdown_show_box',
			[
				'label' => __( 'Enable Box', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off' => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'aem_section_countdown_box_width',
			[
				'label' => __( 'Width', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 150
				],
				'selectors' => [
					'{{WRAPPER}} .aem-countdown .aem-countdown-container' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'aem_section_countdown_show_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_section_countdown_box_height',
			[
				'label' => __( 'Height', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 150
				],
				'selectors' => [
					'{{WRAPPER}} .aem-countdown .aem-countdown-container' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'aem_section_countdown_show_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'aem_countdown_box_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aem-countdown .aem-countdown-container'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_countdown_box_shadow',
				'selector' => '{{WRAPPER}} .aem-countdown-container'
			]
		);

		$this->add_control(
			'aem_before_border',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'thin'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'aem_countdown_box_border',
				'selector' => '{{WRAPPER}} .aem-countdown .aem-countdown-container'
			]
		);

		$this->add_responsive_control(
			'aem_countdown_box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'    => 4,
					'right'  => 4,
					'bottom' => 4,
					'left'   => 4,
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-countdown .aem-countdown-container' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'aem_section_countdown_divider_style',
			[
				'label' => esc_html__( 'Divider', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_countdown_divider_enable',
			[
				'label'        => __( 'Enable Divider', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'aem_countdown_divider_color',
			[
				'label'     => __( 'Divider Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .aem-countdown.aem-countdown-divider .aem-countdown-container::after' => 'color: {{VALUE}};'
				],
				'condition' => [
					'aem_countdown_divider_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_countdown_divider_size',
			[
				'label'        => __( 'Size', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'devices'      => [ 'desktop', 'tablet' ],
				'range'        => [
					'px'       => [
						'min'  => 50,
						'max'  => 150,
						'step' => 5
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 80
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-countdown.aem-countdown-divider .aem-countdown-container::after' => 'font-size: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'aem_countdown_divider_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_countdown_divider_position_right',
			[
				'label'        => __( 'Offset X', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'devices'      => [ 'desktop', 'tablet' ],
				'range'        => [
					'%'       => [
						'min'  => -50,
						'max'  => 50,
						'step' => 1
					],
					'px'       => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 0
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-countdown.aem-countdown-divider .aem-countdown-container::after' => 'right: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'aem_countdown_divider_enable' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_countdown_divider_position_left',
			[
				'label'        => __( 'Offset Y', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'devices'      => [ 'desktop', 'tablet' ],
				'range'        => [
					'%'       => [
						'min'  => -50,
						'max'  => 50,
						'step' => 1
					],
					'px'       => [
						'min'  => -200,
						'max'  => 200,
						'step' => 1
					]
				],
				'default'      => [
					'unit'     => '%',
					'size'     => -30
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-countdown.aem-countdown-divider .aem-countdown-container::after' => 'top: {{SIZE}}{{UNIT}};'
				],
				'condition'    => [
					'aem_countdown_divider_enable' => 'yes'
				]
			]
		);

		$this->end_controls_section();
		
		// Counter Styles
		$this->start_controls_section(
			'aem_section_countdown_styles_counter',
			[
				'label' => esc_html__( 'Counter', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_typography',
				'selector' => '{{WRAPPER}} .aem-countdown-count'
			]
		);

		$this->add_control(
			'aem_countdown_number_color',
			[
				'label'     => __( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .aem-countdown-count' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
            'aem_countdown_number_margin',
            [
                'label'      => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                    '{{WRAPPER}} .aem-countdown-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->end_controls_section();
		
		// Title Styles
		$this->start_controls_section(
			'aem_countdown_styles_title',
			[
				'label' => esc_html__( 'Title', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'aem_countdown_title_typography',
					'selector' => '{{WRAPPER}} .aem-countdown-title'
				]
		);

		$this->add_control(
			'aem_countdown_title_color',
			[
				'label'     => __( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .aem-countdown-title' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
            'aem_countdown_title_margin',
            [
                'label'      => esc_html__( 'Margin', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                    '{{WRAPPER}} .aem-countdown-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
		
		$this->end_controls_section();

		$this->start_controls_section(
			'aem_countdown_expired_title_style',
			[
				'label'     => esc_html__( 'Expired Title', AEM_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_countdown_expired_text!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'aem_countdown_expired_title_typography',
					'selector' => '{{WRAPPER}} .aem-countdown-content-container .aem-countdown p.message'
				]
		);

		$this->add_control(
			'aem_countdown_expired_title_color',
			[
				'label'     => __( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aem-countdown-content-container .aem-countdown p.message' => 'color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'aem-countdown-timer-attribute',
			[
				'class'             => [ 'aem-countdown' ],
				'data-day'          => esc_attr__( 'Days', AEM_TEXTDOMAIN ),
				'data-minutes'      => esc_attr__( 'Minutes', AEM_TEXTDOMAIN ),
				'data-hours'        => esc_attr__( 'Hours', AEM_TEXTDOMAIN ),
				'data-seconds'      => esc_attr__( 'Seconds', AEM_TEXTDOMAIN ),
				'data-countdown'    => esc_attr( $settings['aem_countdown_time'] ),
				'data-expired-text' => esc_attr( $settings['aem_countdown_expired_text'] )
			]
		);
		
		if ( 'yes' === $settings['aem_countdown_divider_enable'] ) {
			$this->add_render_attribute(
				'aem-countdown-timer-attribute',
				[
					'class' => [ 'aem-countdown-divider' ]
				]
			);
		}
		?>

		<div class="aem-countdown-content-container <?php echo $settings['aem_section_countdown_show_box']; ?>">
			<div <?php echo $this->get_render_attribute_string('aem-countdown-timer-attribute'); ?>></div>
		</div>
		
		<?php
	}

}