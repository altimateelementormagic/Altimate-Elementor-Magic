<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;
use \Elementor\Utils;
use AEM_Addons_Elementor\classes\Helper;

class AEM_Heading extends Widget_Base {
	
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'aem-heading';
	}

	public function get_title() {
		return esc_html__( 'Heading', AEM_TEXTDOMAIN );
	}
	public function get_icon() {
		return 'aem aem-logo eicon-heading';
	}
	public function get_categories() {
		return [ 'aem-category' ];
	}

	public function get_keywords() {
        return [ 'heading', 'title' ];
    }
    
	protected function register_controls() {
		$aem_secondary_color = get_option( 'aem_secondary_color_option', '#00d8d8' );
		
		/**
		* Heading Content Section
		*/
		$this->start_controls_section(
			'aem_heading_content',
			[
				'label' => esc_html__( 'Content', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_heading_title',
			[
				'label'       => esc_html__( 'Heading', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'separator'   => 'before',
				'default'     => esc_html__( 'Heading Title', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'aem_heading_title_link',
			[
				'label'       => __( 'Heading URL', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', AEM_TEXTDOMAIN ),
				'label_block' => true
			]
		);

		
		$this->add_control(
			'aem_heading_subheading',
			[
				'label'   => esc_html__( 'Sub Heading', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore odio sint harum quasi maiores nobis dignissimos illo doloremque blanditiis illum! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore odio sint harum quasi maiores nobis digniss.', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'aem_heading_icon_show',
            [
				'label'        => esc_html__( 'Enable Icon', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
				'default'      => 'yes',
				'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'aem_heading_icon',
            [
                'label'       => __( 'Icon', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
                    'value'   => 'fab fa-wordpress-simple',
                    'library' => 'fa-brands'
                ],
				'condition'   => [
					'aem_heading_icon_show' => 'yes'
                ]
            ]
        );

		$this->add_control(
            'aem_heading_divider',
            [
				'label'        => esc_html__( 'Enable Divider', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'Off', AEM_TEXTDOMAIN ),
				'default'      => 'yes',
				'return_value' => 'yes'
            ]
		);


		
        $this->add_control(
            'aem_heading_title_html_tag',
            [
                'label'   => __('Title HTML Tag', AEM_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
				'separator' => 'after',
                'options' => Helper::aem_title_tags(),
                'default' => 'h1',
            ]
		);

		$this->end_controls_section();
		

		/*
		* Heading Styling Section
		*/
		$this->start_controls_section(
			'aem_section_heading_general_style',
			[
				'label' => esc_html__( 'General', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_responsive_control(
			'aem_heading_title_alignment',
			[
				'label'       => esc_html__( 'Alignment', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'label_block' => false,
				'options'     => [
					'aem-heading-left'   => [
						'title' => esc_html__( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-left'
					],
					'aem-heading-center' => [
						'title' => esc_html__( 'Center', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-center'
					],
					'aem-heading-right'  => [
						'title' => esc_html__( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'desktop_default' => 'aem-heading-center',
				'tablet_default' => 'aem-heading-left',
				'mobile_default' => 'aem-heading-left',
				'selectors_dictionary' => [
					'aem-heading-left' => 'text-align: left; margin-right: auto; margin-left: unset;',
					'aem-heading-center' => 'text-align: center; margin-left: auto; margin-right: auto;',
					'aem-heading-right' => 'text-align: right; margin-left: auto; margin-right: unset',
				],
				'selectors' => [
					'{{WRAPPER}} .aem-heading' => '{{VALUE}};',
					'{{WRAPPER}} .aem-heading .aem-heading-separator' => '{{VALUE}};',
					'{{WRAPPER}} .aem-heading .aem-heading-icon' => '{{VALUE}};',
					'{{WRAPPER}} .aem-heading .aem-heading-icon-box-yes .aem-heading-icon' => '{{VALUE}};',
				],
				'default'     => 'aem-heading-center'
			]
		);

		$this->end_controls_section();

		/*
		* Icon Style
		*/
		$this->start_controls_section(
			'aem_section_heading_icon_style',
			[
				'label'     => esc_html__( 'Icon', AEM_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_heading_icon_show'    => 'yes',
					'aem_heading_icon[value]!' => ''
				]
			]
		);

		$this->add_control(
            'aem_heading_icon_box',
            [
				'label'        => esc_html__( 'Icon Box', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
            ]
		);
		
		$this->add_responsive_control(
			'aem_heading_icob_box_height',
			[
				'label'     => esc_html__( 'Height', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-icon' => 'height: {{VALUE}}px;'
				],
				'condition' => [
					'aem_heading_icon_box' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'aem_heading_icon_box_width',
			[
				'label'     => esc_html__( 'Width', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-icon' => 'width: {{VALUE}}px;'
				],
				'condition' => [
					'aem_heading_icon_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'            => 'aem_heading_icon_box_background',
				'types'           => [ 'classic', 'gradient' ],
				'selector'        => '{{WRAPPER}} .aem-heading-icon',
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => $aem_secondary_color
					]
				]
			]
		);

		$this->add_responsive_control(
			'aem_heading_icon_box_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '20',
                    'right'    => '20',
                    'bottom'   => '15',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
				'selectors'  => [
					'{{WRAPPER}} .aem-heading-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_heading_icon_box_radius',
			[
				'label'        => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '100',
					'right'    => '100',
					'bottom'   => '100',
					'left'     => '100',
					'unit'     => '%'
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-heading-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'aem_heading_icon_box_border',
				'selector'  => '{{WRAPPER}} .aem-heading-icon'
			]
		);

		$this->add_control(
			'aem_heading_icon_color',
			[
				'label'     => __('Icon Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aem-heading-icon svg path' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_heading_icon_size',
			[
				'label'      => __( 'Icon Size', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 30
				],
				'selectors' => [
					'{{WRAPPER}} .aem-heading-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aem-heading-icon svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}'
				]
			]
		);

		$this->add_responsive_control(
			'aem_heading_icon_margin_bottom',
			[
				'label'      => __( 'Bottom Spacing', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 100
					]
                ],
                'default'    => [
					'unit'   => 'px',
					'size'   => 20
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-heading-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();


		/*
		* Heading Content Styling Section
		*/
		$this->start_controls_section(
			'aem_section_heading_styles_heading',
			[
				'label' => esc_html__( 'Heading', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'aem_heading_type',
            [
				'label'   => esc_html__( 'Heading Type', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'aem-heading-simple',
				'options' => [
					'aem-heading-simple'          => esc_html__( 'Simple', AEM_TEXTDOMAIN ),
					'aem-heading-text-background' => esc_html__( 'Text Background', AEM_TEXTDOMAIN ),
					'aem-heading-image-gradient'  => esc_html__( 'Image/Gradient', AEM_TEXTDOMAIN )
				]
            ]
		);

		$this->add_control(
			'aem_heading_outline_enable',
			[
				'label' => __( 'Enable Text Outline', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off' => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'aem_heading_outline_width',
			[
				'label'      => __( 'Outline Width', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 5
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 1
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-heading-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'aem_heading_outline_enable' => 'yes',
				]
			]
		);

		$this->add_control(
			'aem_heading_outline_color',
			[
				'label'     => __('Outline Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-title' => '-webkit-text-stroke-color: {{VALUE}};'
				],
				'condition' => [
					'aem_heading_outline_enable' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'aem_heading_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .aem-heading-image-gradient .aem-heading-title',
				'condition' => [
					'aem_heading_type' => 'aem-heading-image-gradient'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_heading_typography',
				'selector' => '{{WRAPPER}} .aem-heading-title'
			]
		);

		$this->add_control(
			'aem_heading_color',
			[
				'label'     => __('Text Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-title, {{WRAPPER}} a .aem-heading-title' => 'color: {{VALUE}};'
				],
				'condition' => [
					'aem_heading_type' => ['aem-heading-simple', 'aem-heading-text-background']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'aem_heading_text_shadow',
				'label' => __( 'Text Shadow', AEM_TEXTDOMAIN ),
				'selector' => '{{WRAPPER}} .aem-heading-title',
			]
		);

		$this->add_responsive_control(
			'aem_heading_heading_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .aem-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Text Background Style
		 */

		$this->start_controls_section(
			'aem_section_heading_text_background_style',
			[
				'label'     => esc_html__( 'Text Background', AEM_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_heading_type' => 'aem-heading-text-background'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_heading_text_background_typography',
				'selector' => '{{WRAPPER}} .aem-heading-text-background .aem-heading-title::after'
			]
		);

		$this->add_control(
			'aem_heading_text_background_color',
			[
				'label'     => __('Text Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eaeff3',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-text-background .aem-heading-title::after' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_heading_text_background_outline_enable',
			[
				'label' => __( 'Enable Text Outline', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off' => __( 'Hide', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'aem_heading_text_background_outline_width',
			[
				'label'      => __( 'Outline Width', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 5
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 1
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-heading-text-background .aem-heading-title::after' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'aem_heading_text_background_outline_enable' => 'yes',
				]
			]
		);

		$this->add_control(
			'aem_heading_text_background_outline_color',
			[
				'label'     => __('Outline Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-text-background .aem-heading-title::after' => '-webkit-text-stroke-color: {{VALUE}};'
				],
				'condition' => [
					'aem_heading_text_background_outline_enable' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Separator Style
		 */

		$this->start_controls_section(
			'aem_section_heading_style_separator',
			[
				'label'     => esc_html__( 'Divider', AEM_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_heading_divider' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_heading_divider_height',
			[
				'label'     => esc_html__( 'Height', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '2',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-separator' => 'height: {{VALUE}}px;'
				]
				
			]
		);
		
		$this->add_responsive_control(
			'aem_heading_divider_width',
			[
				'label'     => esc_html__( 'Width', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-separator' => 'width: {{VALUE}}px;'
				]
			]
		);
		$this->add_control(
			'aem_heading_divider_background',
			[
				'label'     => esc_html__( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-separator' => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_heading_divider_margin_top',
			[
				'label'      => __( 'Top Spacing', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 12
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-heading-separator' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_heading_divider_margin_bottom',
			[
				'label'      => __( 'Bottom Spacing', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 20
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-heading-separator' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Subheading Style
		 */
		$this->start_controls_section(
			'aem_section_heading_styles_subheading',
			[
				'label' => esc_html__( 'Sub Heading', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_heading_description_color',
			[
				'label'     => __('Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .aem-heading-description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
					'name'     => 'aem_heading_subheading_typography',
					'selector' => '{{WRAPPER}} .aem-heading-description'
			]
		);

		$this->add_responsive_control(
			'aem_heading_subheading_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .aem-heading-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();
		
	}
	
	protected function render() {
		$settings          = $this->get_settings_for_display();

		$this->add_render_attribute( 
			'aem_heading_wrapper', 
			[ 
				'class' => [ 
					'aem-heading-wrapper', 
					esc_attr( $settings['aem_heading_title_alignment'] ), 
					esc_attr( $settings['aem_heading_type'] ) 
				]
			]
		);

		$this->add_render_attribute( 
			'aem_heading_title', 
			[ 
				'data-content' => esc_attr( $settings['aem_heading_title'] ),
				'class'        => 'aem-heading-title'
			]
		);

		if( 'yes' === $settings['aem_heading_icon_box'] ){
			$this->add_render_attribute( 'aem_heading_wrapper', 'class', 'aem-heading-icon-box-yes');
		}

		if( $settings['aem_heading_title_link']['url'] ) {
            $this->add_render_attribute( 'aem_heading_title_link', 'href', esc_url( $settings['aem_heading_title_link']['url'] ) );
	        if( $settings['aem_heading_title_link']['is_external'] ) {
	            $this->add_render_attribute( 'aem_heading_title_link', 'target', '_blank' );
	        }
	        if( $settings['aem_heading_title_link']['nofollow'] ) {
	            $this->add_render_attribute( 'aem_heading_title_link', 'rel', 'nofollow' );
	        }
        }

		$this->add_inline_editing_attributes( 'aem_heading_title', 'basic' );

		$this->add_render_attribute( 'aem_heading_subheading', 'class', 'aem-heading-description' );
		$this->add_inline_editing_attributes( 'aem_heading_subheading', 'basic' );
		?>

        <div class="aem-heading">
            <div <?php echo $this->get_render_attribute_string( 'aem_heading_wrapper' ); ?>>
			<?php
				if ( 'yes' === $settings['aem_heading_icon_show'] && !empty( $settings['aem_heading_icon']['value'] ) ) : ?>
          			<span class="aem-heading-icon">
          				<?php Icons_Manager::render_icon( $settings['aem_heading_icon'] ); ?>
          			</span>
				<?php 	  
				endif;

            	if( !empty( $settings['aem_heading_title_link']['url'] ) ) : ?>
            		<a <?php echo $this->get_render_attribute_string( 'aem_heading_title_link' ); ?>>
				<?php endif; ?>

                <<?php echo Utils::validate_html_tag( $settings['aem_heading_title_html_tag'] ); ?> <?php echo $this->get_render_attribute_string( 'aem_heading_title' ); ?>>
					<?php echo wp_kses_post( $settings['aem_heading_title'] ); ?>
				</<?php echo Utils::validate_html_tag( $settings['aem_heading_title_html_tag'] ); ?>>
	
                <?php if( !empty( $settings['aem_heading_title_link']['url'] ) ) { ?>
                    </a>
				<?php 
				}

				if ( 'yes' === $settings['aem_heading_divider'] ) : ?>
					<div class="aem-heading-separator"></div>
				<?php 	
				endif;
                
                if ( !empty( $settings['aem_heading_subheading'] ) ) : ?>
                    <p <?php echo $this->get_render_attribute_string( 'aem_heading_subheading' ); ?>>
						<?php echo wp_kses_post( $settings['aem_heading_subheading'] ); ?>
                    </p>
				<?php endif; ?>

            </div>
        </div>
	<?php 	
	}
}