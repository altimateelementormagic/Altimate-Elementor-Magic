<?php

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \AEM_Addons_Elementor\classes\Helper;

class AEM_Testimonial_Addon extends Widget_Base {

    public function get_name() {
        return 'testimonial-addon';
    }

    public function get_title() {
        return 'Testimonial';
    }

    public function get_icon() {
        return 'aem aem-logo eicon-testimonial';
    }

    public function get_categories() {
        return ['aem-category'];
    }

    protected function register_controls() {

		/**
		 * Testimonial Content Section
		 */

		$this->start_controls_section(
			'aem_testimonial_section',
			[
				'label' => esc_html__( 'Contents', AEM_TEXTDOMAIN )
			]
		);

		$this->add_control(
			'aem_testimonial_image',
			[
				'label'   => __( 'Image', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'testimonial_thumbnail',
				'default'   => 'medium_large',
				'condition' => [
					'aem_testimonial_image[url]!' => ''
				],
			]
		);

		$this->add_control(
			'aem_testimonial_description',
			[
				'label'   => esc_html__( 'Testimonial', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen.', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'aem_testimonial_name',
			[
				'label'   => esc_html__( 'Name', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
            'aem_testimonial_name_tag',
            [
                'label'   => __('Name HTML Tag', AEM_TEXTDOMAIN),
                'type'    => Controls_Manager::SELECT,
                'options' => Helper::aem_title_tags(),
                'default' => 'h4',
            ]
		);

		$this->add_control(
			'aem_testimonial_url',
			[
				'label' => __( 'URL', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', AEM_TEXTDOMAIN ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'aem_testimonial_designation',
			[
				'label'   => esc_html__( 'Designation', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Co-Founder', AEM_TEXTDOMAIN ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'aem_testimonial_enable_rating',
			[
				'label'   => esc_html__( 'Display Rating?', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->add_control(
			'aem_testimonial_rating_icon',
			[
				'label' => __( 'Rating Icon', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::ICONS,
				'label_block' => false,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'skin' => 'inline',
				'exclude_inline_options' => ['svg'],
				'condition' => [
					'aem_testimonial_enable_rating' => 'yes'
				]
			]
		);

		$rating_number = range( 1, 5 );
        $rating_number = array_combine( $rating_number, $rating_number );

		$this->add_control(
		  	'aem_testimonial_rating_number',
		  	[
				'label'   => __( 'Rating Number', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::SELECT,
				'default' => 5,
				'options' => $rating_number,
				'condition' => [
					'aem_testimonial_enable_rating' => 'yes'
				]
		  	]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Container Style Section
		 */

		$this->start_controls_section(
			'aem_testimonial_container_section_style',
			[
				'label' => esc_html__( 'Container', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_testimonial_layout',
			[
				'label' => __( 'Layout', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1'  => __( 'Layout 1', AEM_TEXTDOMAIN ),
					'layout-2' => __( 'Layout 2', AEM_TEXTDOMAIN ),
				],
			]
		);

		$this->add_control(
			'aem_testimonial_container_alignment',
			[
				'label'   => __( 'Alignment', AEM_TEXTDOMAIN ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'default' => 'aem-testimonial-align-left',
				'options' => [
					'aem-testimonial-align-left'   => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-left'
					],
					'aem-testimonial-align-center' => [
						'title' => __( 'Center', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-up'
					],
					'aem-testimonial-align-right'  => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-right'
					],
					'aem-testimonial-align-bottom' => [
						'title' => __( 'Bottom', AEM_TEXTDOMAIN ),
						'icon'  => 'eicon-arrow-down'
					]
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_container_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'before',
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_container_radius',
			[
				'label'      => __( 'Border radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-testimonial-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'aem_testimonial_container_tabs' );

			$this->start_controls_tab( 'aem_testimonial_container_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'      => 'aem_testimonial_container_background',
						'types'     => [ 'classic', 'gradient' ],
						'selector'  => '{{WRAPPER}} .aem-testimonial-wrapper'
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'            => 'aem_testimonial_container_border',
						'fields_options'  => [
							'border'      => [
								'default' => 'solid'
							],
							'width'          => [
								'default'    => [
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1'
								]
							],
							'color'       => [
								'default' => '#e3e3e3'
							]
						],
						'selector'        => '{{WRAPPER}} .aem-testimonial-wrapper'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_testimonial_container_box_shadow',
						'selector' => '{{WRAPPER}} .aem-testimonial-wrapper'
					]
				);

			$this->end_controls_tab();
	
			$this->start_controls_tab( 'aem_testimonial_container_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name'      => 'aem_testimonial_container_background_hover',
						'types'     => [ 'classic' ],
						'selector'  => '{{WRAPPER}} .aem-testimonial-wrapper:hover'
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'            => 'aem_testimonial_container_border_hover',
						'fields_options'  => [
							'border'      => [
								'default' => 'solid'
							],
							'width'          => [
								'default'    => [
									'top'    => '1',
									'right'  => '1',
									'bottom' => '1',
									'left'   => '1'
								]
							],
							'color'       => [
								'default' => '#e3e3e3'
							]
						],
						'selector'        => '{{WRAPPER}} .aem-testimonial-wrapper:hover'
					]
				);

				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name'     => 'aem_testimonial_container_box_shadow_hover',
						'selector' => '{{WRAPPER}} .aem-testimonial-wrapper:hover'
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();	

		$this->add_control(
			'aem_testimonial_container_transition_top',
            [
				'label'        => __( 'Transition Top', AEM_TEXTDOMAIN ),
				'type'         =>  Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
				'separator'   => 'before',
				'return_value' => 'yes',
				'default'      => 'yes'
			]
        );

		$this-> end_controls_section();

		/**
		 * testimonial Review Image style
		 */
		$this->start_controls_section(
			'aem_testimonial_image_style',
			[
				'label' => esc_html__( 'Reviewer Image', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_testimonial_image_box',
			[
				'label'        => __( 'Image Box', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'OFF', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_image_box_height',
			[
				'label'       => __( 'Height', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 80
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-testimonial-thumb'=> 'height: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'aem_testimonial_image_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_image_box_width',
			[
				'label'       => __( 'Width', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'separator'   => 'after',
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 80
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-testimonial-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aem-testimonial-image-align-left .aem-testimonial-thumb, {{WRAPPER}} .aem-testimonial-image-align-right .aem-testimonial-thumb'=> 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aem-testimonial-image-align-left .aem-testimonial-reviewer, {{WRAPPER}} .aem-testimonial-image-align-right .aem-testimonial-reviewer'=> 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
					'{{WRAPPER}} .aem-testimonial-wrapper.aem-testimonial-align-left .aem-testimonial-content-wrapper-arrow::before'=> 'left: calc( {{SIZE}}{{UNIT}} / 2 );',
					'{{WRAPPER}} .aem-testimonial-wrapper.aem-testimonial-align-right .aem-testimonial-content-wrapper-arrow::before'=> 'right: calc(( {{SIZE}}{{UNIT}} / 2) - 10px);'
				],
				'condition'   => [
					'aem_testimonial_image_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'aem_testimonial_image_box_border',
				'selector'  => '{{WRAPPER}} .aem-testimonial-thumb',
				'condition' => [
					'aem_testimonial_image_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_image_box_radius',
			[
				'label'      => __( 'Border radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-testimonial-thumb'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .aem-testimonial-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_testimonial_image_box_shadow',
				'selector' => '{{WRAPPER}} .aem-testimonial-thumb'
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_image_box_margin_bottom',
			[
				'label'       => __( 'Bottom Spacing', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => -500,
						'max' => 500
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 0
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-testimonial-thumb'=> 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'aem_testimonial_container_alignment' => 'aem-testimonial-align-bottom'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'aem_testimonial_image_box_css_filter',
				'selector' => '{{WRAPPER}} .aem-testimonial-thumb img',
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Testimonial Style Section
		 */
		$this->start_controls_section(
			'aem_testimonial_description_style',
			[
				'label' => esc_html__( 'Testimonial', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_testimonial_description_typography',
				'selector' => '{{WRAPPER}} .aem-testimonial-description'
			]
		);

		$this->add_control(
			'aem_testimonial_description_color',
			[
				'label'     => __( 'Text Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .aem-testimonial-description' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_testimonial_description_bg_color',
			[
				'label'     => __( 'Background Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aem-testimonial-content-wrapper'               => 'background: {{VALUE}};',
					'{{WRAPPER}} .aem-testimonial-content-wrapper-arrow::before' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_description_radius',
			[
				'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-testimonial-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_description_spacing_bottom',
			[
				'label'       => __( 'Bottom Spacing', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-testimonial-content-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'aem_testimonial_layout' => 'layout-1'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_description_spacing_top',
			[
				'label'       => __( 'Top Spacing', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-testimonial-content-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'aem_testimonial_layout' => 'layout-2'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_description_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-testimonial-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_testimonial_description_box_shadow',
				'selector' => '{{WRAPPER}} .aem-testimonial-content-wrapper'
			]
		);

		$this->add_control(
			'aem_testimonial_description_arrow_enable',
			[
				'label'        => __( 'Show Arrow', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', AEM_TEXTDOMAIN ),
				'label_off'    => __( 'OFF', AEM_TEXTDOMAIN ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before'
			]
		);

		$this-> end_controls_section();

		/**
		 * Testimonial Rating Style Section
		 */
		$this->start_controls_section(
			'aem_testimonial_rating_style',
			[
				'label'     => esc_html__( 'Rating', AEM_TEXTDOMAIN ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_testimonial_enable_rating' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_rating_size',
			[
				'label'       => __( 'Icon Size', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 50
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-testimonial-ratings li i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_rating_icon_margin',
			[
				'label'       => __( 'Icon Margin', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 30
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 5
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-testimonial-ratings li:not(:last-child) i' => 'margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_rating_margin',
			[
				'label'        => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '20',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-testimonial-ratings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		

		$this->start_controls_tabs( 'aem_testimonial_rating_tabs' );

			// normal state rating
			$this->start_controls_tab( 'aem_testimonial_rating_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_testimonial_rating_normal_color',
					[
						'label'     => __( 'Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .aem-testimonial-ratings li i' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

			// hover state rating
			$this->start_controls_tab( 'aem_testimonial_rating_active', [ 'label' => esc_html__( 'Active', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_testimonial_rating_active_color',
					[
						'label'     => __( 'Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ff5b84',
						'selectors' => [
							'{{WRAPPER}} .aem-testimonial-ratings li.aem-testimonial-ratings-active i' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this-> end_controls_section();

		/**
		 * Testimonial Riviewer Style Section
		 */
		$this->start_controls_section(
			'aem_testimonial_reviewer_style',
			[
				'label' => esc_html__( 'Reviewer', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_reviewer_padding',
			[
				'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-testimonial-reviewer-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_reviewer_spacing',
			[
				'label'       => __( 'Spacing', AEM_TEXTDOMAIN ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 100
					]
				],
				'default'     => [
					'unit'    => 'px',
					'size'    => 20
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-testimonial-wrapper.aem-testimonial-align-left .aem-testimonial-reviewer-wrapper .aem-testimonial-reviewer' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .aem-testimonial-wrapper.aem-testimonial-align-right .aem-testimonial-reviewer-wrapper .aem-testimonial-reviewer' => 'padding-right: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
					'aem_testimonial_container_alignment' => ['aem-testimonial-align-left', 'aem-testimonial-align-right']
				]
			]
		);

		/**
		 * Testimonial Title Style Section
		 */
		$this->add_control(
			'aem_testimonial_title_style',
			[
				'label'     => __( 'Reviewer Title', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'aem_testimonial_title_typography',
				'selector'         => '{{WRAPPER}} .aem-testimonial-name',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 22
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ]
			]
		);

		$this->start_controls_tabs( 'aem_testimonial_title_tabs' );

			// normal state rating
			$this->start_controls_tab( 'aem_testimonial_title_normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_testimonial_title_color',
					[
						'label'     => __( 'Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#000000',
						'selectors' => [
							'{{WRAPPER}} .aem-testimonial-name' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

			// hover state rating
			$this->start_controls_tab( 'aem_testimonial_title_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

				$this->add_control(
					'aem_testimonial_title_color_hover',
					[
						'label'     => __( 'Color', AEM_TEXTDOMAIN ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .aem-testimonial-name:hover' => 'color: {{VALUE}};'
						]
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'aem_testimonial_title_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-testimonial-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		// Testimonial Designation Style Section
		$this->add_control(
			'aem_testimonial_designation_style',
			[
				'label'     => __( 'Reviewer Designation', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'             => 'aem_testimonial_designation_typography',
				'selector'         => '{{WRAPPER}} .aem-testimonial-designation',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 14
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ]
			]
		);

		$this->add_control(
			'aem_testimonial_designation_color',
			[
				'label'     => __( 'Color', AEM_TEXTDOMAIN ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .aem-testimonial-designation' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_testimonial_designation_margin',
			[
				'label'      => __( 'Margin', AEM_TEXTDOMAIN ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-testimonial-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this-> end_controls_section();
	}

    private function render_testimonial_rating( $ratings ) {
		$settings = $this->get_settings_for_display();
		
		for( $i = 1; $i <= 5; $i++ ) {
			if( $ratings >= $i ) {
				$rating_active_class = '<li class="aem-testimonial-ratings-active"><i class="'.$settings['aem_testimonial_rating_icon']['value'].'"></i></li>';
			} else {
				$rating_active_class = '<li><i class="'.$settings['aem_testimonial_rating_icon']['value'].'"></i></li>';
			}
			echo $rating_active_class;
		}
	}

	private function render_testimonial_image( $image_url ) {
		$output = '';
		if ( !empty( $image_url ) ) :
			$output .= '<div class="aem-testimonial-thumb">';
				$output .= $image_url;
			$output .= '</div>';
		endif;
		return $output;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$testimonial_image_url_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'testimonial_thumbnail', 'aem_testimonial_image' );
		$transition_top = '';

		$target = $settings['aem_testimonial_url']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['aem_testimonial_url']['nofollow'] ? ' rel="nofollow"' : '';

		$this->add_inline_editing_attributes( 'aem_testimonial_name', 'basic' );
		$this->add_render_attribute( 'aem_testimonial_name', 'class', 'aem-testimonial-name' );

		$this->add_inline_editing_attributes( 'aem_testimonial_designation', 'basic' );
		$this->add_render_attribute( 'aem_testimonial_designation', 'class', 'aem-testimonial-designation' );

		$this->add_inline_editing_attributes( 'aem_testimonial_description', 'basic' );
		$this->add_render_attribute( 'aem_testimonial_description', 'class', 'aem-testimonial-description' );

		$this->add_render_attribute( 'aem_testimonial_content_wrapper', 'class', 'aem-testimonial-content-wrapper' );

		// if ( 'yes' === $settings['aem_testimonial_description_arrow_enable'] ){
		// 	$this->add_render_attribute( 'aem_testimonial_content_wrapper', 'class', 'aem-testimonial-content-wrapper-arrow' );
		// }
		// if ( 'yes' === $settings['aem_testimonial_container_transition_top'] ){
		// 	$transition_top = 'aem-testimonial-transition-top-'.$settings['aem_testimonial_container_transition_top'];
		// }
		?>

		<div class="aem-testimonial-wrapper <?php echo esc_attr( $settings['aem_testimonial_container_alignment'] ).' '.$transition_top; ?>">
			<div class="aem-testimonial-wrapper-inner <?php echo $settings['aem_testimonial_layout']; ?>">
			<?php
				if( 'layout-1' === $settings['aem_testimonial_layout'] ) { ?>

					<div <?php echo $this->get_render_attribute_string( 'aem_testimonial_content_wrapper' ); ?>>
					<?php
						if ( !empty( $settings['aem_testimonial_description'] ) ) : ?>
							<p <?php echo $this->get_render_attribute_string( 'aem_testimonial_description' ); ?>><?php echo wp_kses_post( $settings['aem_testimonial_description'] ); ?></p>
							<?php
							if ( 'yes' === $settings['aem_testimonial_enable_rating'] ) : ?>
								<ul class="aem-testimonial-ratings">
									<?php echo $this->render_testimonial_rating( $settings['aem_testimonial_rating_number'] ); ?>
								</ul>
							<?php	
							endif;
						endif;
						?>
					</div>
					<?php	
				}
				?>
				<div class="aem-testimonial-reviewer-wrapper">
				<?php
					if( 'aem-testimonial-align-bottom' !== $settings['aem_testimonial_container_alignment'] ) :
						echo $this->render_testimonial_image( $testimonial_image_url_html );
					endif;
					?>
					<div class="aem-testimonial-reviewer">
					<?php
						if ( !empty( $settings['aem_testimonial_name'] ) ) : ?>
							<a href="<?php echo $settings['aem_testimonial_url']['url']; ?>" <?php echo $target; ?> <?php echo $nofollow; ?>>
								<<?php echo Utils::validate_html_tag( $settings['aem_testimonial_name_tag'] ); ?> <?php echo $this->get_render_attribute_string( 'aem_testimonial_name' ); ?>>
									<?php echo Helper::aem_wp_kses( $settings['aem_testimonial_name'] ); ?>
								</<?php echo Utils::validate_html_tag( $settings['aem_testimonial_name_tag'] ); ?>>
							</a>
						<?php	
						endif;
						if ( !empty( $settings['aem_testimonial_designation'] ) ) : ?>
							<span <?php echo $this->get_render_attribute_string( 'aem_testimonial_designation' ); ?>><?php echo Helper::aem_wp_kses( $settings['aem_testimonial_designation'] ); ?></span>
						<?php	
						endif;
						?>
					</div>					

					<?php	
					if( 'aem-testimonial-align-bottom' === $settings['aem_testimonial_container_alignment'] ) :
						echo $this->render_testimonial_image( $testimonial_image_url_html );
					endif;
					?>
				</div>
				<?php
				if( 'layout-2' === $settings['aem_testimonial_layout'] ) { ?>

					<div <?php echo $this->get_render_attribute_string( 'aem_testimonial_content_wrapper' ); ?>>
					<?php
						if ( !empty( $settings['aem_testimonial_description'] ) ) : ?>
							<p <?php echo $this->get_render_attribute_string( 'aem_testimonial_description' ); ?>><?php echo wp_kses_post( $settings['aem_testimonial_description'] ); ?></p>
							<?php
							if ( 'yes' === $settings['aem_testimonial_enable_rating'] ) : ?>
								<ul class="aem-testimonial-ratings">
								<?php
									$this->render_testimonial_rating( $settings['aem_testimonial_rating_number'] ); ?>
								</ul>
							<?php	
							endif;
						endif;
						?>
					</div>
				<?php	
				}
				?>
			</div>
		</div>
	<?php	
	}

}