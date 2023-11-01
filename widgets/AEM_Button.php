<?php

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;


if (!defined('ABSPATH')) exit;

class AEM_Button extends Widget_Base
{

    public function get_name()
    {
        return 'aem-button';
    }

    public function get_title()
    {
        return esc_html('Button', AEM_TEXTDOMAIN);
    }

    public function get_icon()
    {
        return 'aem aem-logo eicon-button';
    }

    public function get_keywords()
    {
        return ['aem', 'aem-button', 'button'];
    }

    public function get_categories()
    {
        return ['aem-category'];
    }

    protected function register_controls()
    {
        $aem_primary_color = get_option('aem_primary_color_option', '#7a56ff');

        // content controls
        $this->start_controls_section(
            'aem_section_button_content',
            [
                'label' => esc_html__('Contents', 'aem-essential-elementor')
            ]
        );

        $this->add_control(
            'aem_button_text',
            [
                'label' => __('Button Text', 'go-essential-elementor'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Download!', 'go-essential-elementor'),
                'placeholder' => __('Enter button text', 'go-essential-elementor'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'aem_button_link_url',
            [
                'label' => esc_html__('Link Url', 'go-essential-elementor'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true
                ],
                'show_external' => true
            ]
        );

        $this->add_control(
            'aem_button_icon',
            [
                'label' => esc_html__('Icon', 'go-essential-elementor'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-download',
                    'library' => 'fa-solid'
                ]
            ]
        );

        $this->add_control(
            'aem_button_icon_position',
            [
                'label' => esc_html__("Button Icon Position", 'go-essential-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'aem-button-icon-before-text',
                'options' => [
                    'aem-button-icon-before-text' => esc_html__('Before Text', 'go-essential-elementor'),
                    'aem-button-icon-after-text' => esc_html__("After Text", 'go-essential-elementor')
                ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'aem_section_button_settings',
            [
                'label' => esc_html__( 'Styles & Effects', 'go-essential-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'aem_button_effect',
            [
                'label' => esc_html__( "Button Effect", 'go-essential-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'effect-2',
                'options' => [
                    'btn-effect-1' => esc_html__( 'Effect 1', AEM_TEXTDOMAIN ),
                    'btn-effect-2' => esc_html__( 'Effect 2', AEM_TEXTDOMAIN ),
                    'btn-effect-3' => esc_html__( 'Effect 3', AEM_TEXTDOMAIN ),
                    'btn-effect-4' => esc_html__( 'Effect 4', AEM_TEXTDOMAIN ),
                    'btn-effect-5' => esc_html__( 'Effect 5', AEM_TEXTDOMAIN ),
                    'btn-effect-6' => esc_html__( 'Effect 6', AEM_TEXTDOMAIN ),
                    'btn-effect-7' => esc_html__( 'Effect 7', AEM_TEXTDOMAIN ),
                    'btn-effect-8' => esc_html__( 'Effect 8', AEM_TEXTDOMAIN ),
                    'btn-effect-9' => esc_html__( 'Effect 9', AEM_TEXTDOMAIN ),
                    'btn-effect-10' => esc_html__( 'Effect 10', AEM_TEXTDOMAIN ),
                    'btn-effect-11' => esc_html__( 'Effect 11', AEM_TEXTDOMAIN ),
                    'btn-effect-12' => esc_html__( 'Effect 12', AEM_TEXTDOMAIN )
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'aem_button_typography',
                'selector' => '{{WRAPPER}} .aem-button-wrapper .aem-button-action'
            ]
        );
        $this->add_control(
            'aem_button_enable_fixed_width',
            [
                'label' => __( 'Enable fixed Height & Width?', AEM_TEXTDOMAIN ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', AEM_TEXTDOMAIN ),
                'label_off' => __('Hide', AEM_TEXTDOMAIN),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'aem_button_fixed_width_height',
            [
                'label' => __( 'Fixed Height & Width', AEM_TEXTDOMAIN ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'Default', AEM_TEXTDOMAIN ),
                'label_on' => __( 'Custom', AEM_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'aem_button_enable_fixed_width' => 'yes'
                ]
            ]
        );

        $this->start_popover();

			$this->add_responsive_control(
				'aem_button_fixed_width',
				[
					'label'      => esc_html__( 'Width', AEM_TEXTDOMAIN ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 500,
							'step' => 1
						],
						'%'        => [
							'min'  => 0,
							'max'  => 100
						]
					],
					'default'    => [
						'unit'   => 'px',
						'size'   => 100
					],
					'selectors'  => [
						'{{WRAPPER}} .aem-button-wrapper .aem-button-action' => 'width: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'aem_button_enable_fixed_width' => 'yes'
					]
				]
			);

            $this->add_responsive_control(
				'aem_button_fixed_height',
				[
					'label'      => esc_html__( 'Height', AEM_TEXTDOMAIN ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 500,
							'step' => 1
						],
						'%'        => [
							'min'  => 0,
							'max'  => 100
						]
					],
					'default'    => [
						'unit'   => 'px',
						'size'   => 100
					],
					'selectors'  => [
						'{{WRAPPER}} .aem-button-wrapper .aem-button-action' => 'height: {{SIZE}}{{UNIT}};'
					],
					'condition' => [
						'aem_button_enable_fixed_width' => 'yes'
					]
				]
			);

        $this->end_popover();

		$this->add_responsive_control(
			'aem_button_width',
			[
				'label'      => esc_html__( 'Width', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'    => [
					'unit'   => '%',
					'size'   => 80
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-button-wrapper .aem-button-action' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'aem_button_enable_fixed_width!' => 'yes'
				]
			]
		);

		// $icon_gap = is_rtl() ? 'left' : 'right';

		$this->add_responsive_control(
			'aem_button_icon_space',
			[
                'label'       => __( 'Icon Space', AEM_TEXTDOMAIN ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 50
					]
				],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => 10
                ],
				'selectors'   => [
                    '{{WRAPPER}} .aem-button-wrapper.aem-button-incon-before-text .aem-button-action i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .aem-button-wrapper.aem-button-incon-after-text .aem-button-action i'  => 'margin-left: {{SIZE}}{{UNIT}};'
				],
                'condition'   => [
                    'aem_button_icon[value]!' => ''
                ]
			]
        );
		
		$this->add_responsive_control(
			'aem_button_alignment',
			[
				'label'       => esc_html__( 'Alignment', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => true,
				'toggle'      => false,
				'options'     => [
					'left'      => [
						'title' => esc_html__( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => esc_html__( 'Center', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => esc_html__( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'desktop_default' => 'center',
				'tablet_default' => 'center',
				'mobile_default' => 'center',
				'selectors_dictionary' => [
					'left' => 'justify-content: flex-start;',
					'center' => 'justify-content: center;',
					'right' => 'justify-content: flex-end;',
				],
				'selectors'     => [
					'{{WRAPPER}} .aem-button-wrapper' => '{{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_button_padding',
			[
				'label'      => esc_html__( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'      => 15,
					'right'    => 15,
					'bottom'   => 15,
					'left'     => 15,
					'unit'     => 'px',
					'isLinked' => true
				],
				'selectors' => [
					'{{WRAPPER}} .aem-button-wrapper .aem-button-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .aem-button-wrapper .aem-button-action, {{WRAPPER}} .aem-button-wrapper.effect-1 .aem-button-action::before'=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'aem_button_separator',
			[
				'type'  => Controls_Manager::DIVIDER,
				'style' => 'default'
			]
		);

		$this->start_controls_tabs( 'aem_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

		$this->add_control(
			'aem_button_text_color',
			[
				'label'		=> esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> $aem_primary_color,
				'selectors'	=> [
					'{{WRAPPER}} .aem-button-wrapper .aem-button-action'                     => 'color: {{VALUE}};',
					'{{WRAPPER}} .aem-button.aem-button--tamaya::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aem-button.aem-button--tamaya::after'  => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'aem_button_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aem-button-wrapper .aem-button-action'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'aem_button_border',
				'fields_options'  => [
                    'border' 	  => [
                        'default' => 'solid'
                    ],
                    'width'  	  => [
                        'default' 	 => [
                            'top'    => '1',
                            'right'  => '1',
                            'bottom' => '1',
                            'left'   => '1'
                        ]
                    ],
                    'color' 	  => [
                        'default' => $aem_primary_color
                    ]
                ],
				'selector'        => '{{WRAPPER}} .aem-button-wrapper .aem-button-action'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_button_box_shadow',
				'selector' => '{{WRAPPER}} .aem-button-wrapper .aem-button-action'
			]
		);

		$this->end_controls_tab();
		
		$this->start_controls_tab( 'aem_button_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

		$this->add_control(
			'aem_button_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aem-button-wrapper .aem-button-action:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'aem_button_hover_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .aem-button-wrapper.effect-1 .aem-button-action::before, {{WRAPPER}} .aem-button-wrapper.effect-2 .aem-button-action:before, {{WRAPPER}} .aem-button-wrapper.effect-2 .aem-button-action:after, {{WRAPPER}} .aem-button-wrapper.effect-3 .aem-button-action::before, {{WRAPPER}} .aem-button-wrapper.effect-4 .aem-button-action::after, {{WRAPPER}} .aem-button-wrapper.effect-5 .aem-button-action::before, {{WRAPPER}} .aem-button-wrapper.effect-7 .aem-button-action::before, {{WRAPPER}} .aem-button-wrapper.effect-8 .aem-button-action span.effect-8-position, {{WRAPPER}} .aem-button-wrapper.effect-10 .aem-button-action::before, {{WRAPPER}} .aem-button-wrapper.effect-11 .aem-button-action:hover, {{WRAPPER}} .aem-button-wrapper.effect-12 .aem-button-action:hover',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => $aem_primary_color
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'aem_button_border_hover',
				'selector'        => '{{WRAPPER}} .aem-button-wrapper .aem-button-action:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .aem-button-wrapper .aem-button-action:hover'
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();	
		
		$this->end_controls_section();
    }

    protected function render() {
		$settings = $this->get_settings_for_display();

        $aem_button_text = $settings['aem_button_text'];
        $aem_button_icon = $settings['aem_button_icon'];
        $aem_button_link_url = $settings['aem_button_link_url'];
        $aem_button_icon_position = $settings['aem_button_icon_position'];
        $aem_button_effect = $settings['aem_button_effect'];
        $aem_button_enable_fixed_width = $settings['aem_button_enable_fixed_width'];
		
		$this->add_render_attribute( 
			'aem_button', 
			[
				'class'	=> [ 
					'aem-button-wrapper', 
					esc_attr( $aem_button_effect ) ,
					esc_attr( $aem_button_icon_position ),
					'aem-button-fixed-height-'.esc_attr( $aem_button_enable_fixed_width )
				]
			]
		);

		if ( 'effect-8' === $aem_button_effect ) {
			$this->add_render_attribute( 'aem_button', 'class', 'mouse-hover-effect' );
		}

		$this->add_inline_editing_attributes( 'exclusive_button_text', 'none' );
		$this->add_render_attribute( 'aem_button_link_url', 'class', 'aem-button-action' );

		if( $aem_button_link_url['url'] ) {
			$this->add_render_attribute( 'aem_button_link_url', 'href', esc_url( $aem_button_link_url['url'] ) );
			if( $aem_button_link_url['is_external'] ) {
				$this->add_render_attribute( 'aem_button_link_url', 'target', '_blank' );
			}
			if( $aem_button_link_url['nofollow'] ) {
				$this->add_render_attribute( 'aem_button_link_url', 'rel', 'nofollow' );
			}
		}
		?>

		<div <?php echo $this->get_render_attribute_string( 'aem_button' ); ?>>

			<?php do_action( 'aem_button_wrapper_before' ); ?>

			<a <?php echo $this->get_render_attribute_string( 'aem_button_link_url' ); ?>>
				<?php do_action( 'aem_button_begin_anchor_tag' );

				if ( ! empty( $aem_button_icon['value'] ) ) :
					if( 'aem-button-incon-before-text' === $aem_button_icon_position ) : ?>
						<span>
							<?php Icons_Manager::render_icon( $aem_button_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php	
					endif;
				endif;
				?>

				<span <?php echo $this->get_render_attribute_string( 'aem_button_text' ); ?>>
					<?php echo esc_html( $aem_button_text ); ?>
				</span>

				<?php
				if ( ! empty( $aem_button_icon['value'] ) ) :
					if( 'aem-button-incon-after-text' === $aem_button_icon_position ) : ?>
						<span>
							<?php Icons_Manager::render_icon( $aem_button_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php	
					endif;
				endif;

				if ( 'effect-8' === $aem_button_effect ) {
					echo '<span class="effect-8-position"></span>';
				}

				do_action( 'aem_button_end_anchor_tag' ); ?>
			</a>

			<?php do_action( 'aem_button_wrapper_after' ); ?>
		</div>
		<?php	
	}
}
