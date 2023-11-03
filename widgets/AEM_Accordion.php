<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;
use \Elementor\Utils;
use \AEM_Addons_Elementor\classes\Helper;

class AEM_Accordion extends Widget_Base
{


	public function get_name()
	{
		return 'aem-accordion';
	}

	public function get_title()
	{
		return esc_html__('Accordion', AEM_TEXTDOMAIN);
	}

	public function get_icon()
	{
		return 'aem aem-logo eicon-accordion';
	}


	public function get_keywords()
	{
		return ['toggle'];
	}

	public function get_categories()
	{
		return ['aem-category'];
	}

	protected function register_controls()
	{
		/**
		 * Accordion Content Settings
		 */
		$this->start_controls_section(
			'aem_section_accordion_content_settings',
			[
				'label' => esc_html__('Contents', AEM_TEXTDOMAIN)
			]
		);

		$this->add_control(
			'aem_accordion_title_html_tag',
			[
				'label' => __('Title HTML Tag', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::SELECT,
				'separator' => 'after',
				'options' => Helper::aem_title_tags(),
				'default' => 'h3',
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs('aem_accordion_item_tabs');

		$repeater->start_controls_tab('aem_accordion_item_content_tab', ['label' => __('Content', AEM_TEXTDOMAIN)]);

		$repeater->add_control(
			'aem_accordion_default_active',
			[
				'label' => esc_html__('Active as Default', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'return_value' => 'yes'
			]
		);

		$repeater->add_control(
			'aem_accordion_icon_show',
			[
				'label' => esc_html__('Enable Title Icon', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('On', AEM_TEXTDOMAIN),
				'label_off' => __('Off', AEM_TEXTDOMAIN),
				'default' => 'no',
				'return_value' => 'yes'
			]
		);

		$repeater->add_control(
			'aem_accordion_title_icon',
			[
				'label' => __('Icon', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [
					'value' => 'far fa-user',
					'library' => 'fa-regular'
				],
				'condition' => [
					'aem_accordion_icon_show' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'aem_accordion_title',
			[
				'label' => esc_html__('Title', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Accordion Title', AEM_TEXTDOMAIN),
				'dynamic' => ['active' => true]
			]
		);

		$repeater->add_control(
			'aem_accordion_content',
			[
				'label' => esc_html__('Content', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', AEM_TEXTDOMAIN)
			]
		);

		$repeater->add_control(
			'aem_accordion_show_read_more_btn',
			[
				'label' => esc_html__('Enable Button.', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('On', AEM_TEXTDOMAIN),
				'label_off' => __('Off', AEM_TEXTDOMAIN),
				'default' => 'no',
				'return_value' => 'yes',
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'aem_accordion_read_more_btn_text',
			[
				'label' => esc_html__('Button Text', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('See Details', AEM_TEXTDOMAIN),
				'default' => esc_html__('See Details', AEM_TEXTDOMAIN),
				'condition' => [
					'.aem_accordion_show_read_more_btn' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'aem_accordion_read_more_btn_url',
			[
				'label' => esc_html__('Button Link', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#',
					'is_external' => ''
				],
				'show_external' => true,
				'placeholder' => __('http://your-link.com', AEM_TEXTDOMAIN),
				'condition' => [
					'.aem_accordion_show_read_more_btn' => 'yes'
				]
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('aem_accordion_item_image_tab', ['label' => __('Image', AEM_TEXTDOMAIN)]);

		$repeater->add_control(
			'aem_accordion_image',
			[
				'label' => esc_html__('Choose Image', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab('aem_accordion_item_style_tab', ['label' => __('Style', AEM_TEXTDOMAIN)]);

		$repeater->add_control(
			'aem_accordion_each_item_container_style',
			[
				'label' => esc_html__('Container', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::HEADING
			]
		);

		$repeater->add_control(
			'aem_accordion_each_item_container_bg_color',
			[
				'label' => __('Background Color', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.aem-accordion-single-item' => 'background-color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'aem_accordion_each_item_title_style',
			[
				'label' => esc_html__('Title', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$repeater->add_control(
			'aem_accordion_each_item_title_color',
			[
				'label' => __('Text Color', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.aem-accordion-single-item .aem-accordion-title .aem-accordion-heading' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'aem_accordion_each_item_title_bg_color',
			[
				'label' => __('Background Color', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.aem-accordion-single-item .aem-accordion-title' => 'background-color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'aem_accordion_each_item_title_hover_color',
			[
				'label' => __('Hover Color', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.aem-accordion-single-item .aem-accordion-title:hover .aem-accordion-heading' => 'color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'aem_accordion_each_item_title_hover_bg_color',
			[
				'label' => __('Hover Background Color', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.aem-accordion-single-item .aem-accordion-title:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$repeater->add_control(
			'aem_accordion_each_item_content_style',
			[
				'label' => esc_html__('Content', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'aem_accordion_each_item_container_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}.aem-accordion-single-item'
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'aem_accordion_tab',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'aem_accordion_title' => esc_html__('Accordion Title 1', AEM_TEXTDOMAIN),
						'aem_accordion_default_active' => 'yes'
					],
					['aem_accordion_title' => esc_html__('Accordion Title 2', AEM_TEXTDOMAIN)],
					['aem_accordion_title' => esc_html__('Accordion Title 3', AEM_TEXTDOMAIN)]
				],
				'title_field' => '{{aem_accordion_title}}'
			]
		);

		$this->add_control(
			'aem_accordion_tab_title_show_active_inactive_icon',
			[
				'label' => esc_html__('Show Active/Inactive Icon?', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'aem_accordion_tab_title_active_icon',
			[
				'label' => __('Active Icon', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-angle-up',
					'library' => 'fa-solid'
				],
				'condition' => [
					'aem_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

		$this->add_control(
			'aem_accordion_tab_title_inactive_icon',
			[
				'label' => __('Inactive Icon', AEM_TEXTDOMAIN),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-angle-down',
					'library' => 'fa-solid'
				],
				'condition' => [
					'aem_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Accordion Container Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_accordions_container_style',
			[
				'label'	=> esc_html__('Container', AEM_TEXTDOMAIN),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'aem_accordion_container_background_color',
			[
				'label'		=> esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_container_padding',
			[
				'label'      => __('Padding', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_container_margin',
			[
				'label'        => __('Margin', AEM_TEXTDOMAIN),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => ['px', '%'],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'aem_accordion_container_border',
				'selector' => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item'
			]
		);

		$this->add_responsive_control(
			'aem_accordion_container_border_radius',
			[
				'label'      => __('Border Radius', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_accordion_container_box_shadow',
				'selector' => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'aem_section_accordions_tab_style',
			[
				'label' => esc_html__('Title', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'            => 'aem_accordion_title_typography',
				'selector'        => '{{WRAPPER}} .aem-accordion-single-item .aem-accordion-heading',
				'fields_options'  => [
					'font_weight' => [
						'default' => '600'
					]
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_title_padding',
			[
				'label'      => __('Padding', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_title_margin',
			[
				'label'      => __('Margin', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title .aem-accordion-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'aem_accordion_title_border',
				'fields_options'     => [
					'border' 	     => [
						'default'    => 'solid'
					],
					'width'  	     => [
						'default' 	 => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1'
						]
					],
					'color' 	     => [
						'default'    => '#000000'
					]
				],
				'selector'           => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title'
			]
		);

		$this->add_responsive_control(
			'aem_accordion_title_border_radius',
			[
				'label'      => esc_html__('Border Radius', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'aem_accordion_title_box_shadow',
				'selector' => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title'
			]
		);

		$this->start_controls_tabs('aem_accordion_header_tabs');

		# Normal State Tab
		$this->start_controls_tab('aem_accordion_header_normal', ['label' => esc_html__('Normal', AEM_TEXTDOMAIN)]);
		$this->add_control(
			'aem_accordion_tab_text_color',
			[
				'label'		=> esc_html__('Text Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#000000',
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-heading' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_accordion_tab_color',
			[
				'label'     => esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();

		#Hover State Tab
		$this->start_controls_tab('aem_accordion_header_hover', ['label' => esc_html__('Hover', AEM_TEXTDOMAIN)]);
		$this->add_control(
			'aem_accordion_tab_text_color_hover',
			[
				'label'		=> esc_html__('Text Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title:hover .aem-accordion-heading' => 'color: {{VALUE}};',
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title.active:hover .aem-accordion-heading' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_accordion_tab_color_bg_hover',
			[
				'label'		=> esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();

		#Active State Tab
		$this->start_controls_tab('aem_accordion_header_active', ['label' => esc_html__('Active', AEM_TEXTDOMAIN)]);
		$this->add_control(
			'aem_accordion_tab_text_color_active',
			[
				'label'		=> esc_html__('Text Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title.active .aem-accordion-heading' => 'color: {{VALUE}} !important;'
				]
			]
		);

		$this->add_control(
			'aem_accordion_tab_color_bg_active',
			[
				'label'		=> esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title.active' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'aem_accordion_tab_title_icon_style',
			[
				'label'	=> esc_html__('Title Icon', AEM_TEXTDOMAIN),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'aem_accordion_title_icon_size',
			[
				'label'        => __('Size', AEM_TEXTDOMAIN),
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
					'size'     => 20
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title span.aem-tab-title-icon i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_title_icon_width',
			[
				'label'    => esc_html__('Width', AEM_TEXTDOMAIN),
				'type'     => Controls_Manager::SLIDER,
				'default'  => [
					'size' => 70
				],
				'range'    => [
					'px'   => [
						'max' => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title span.aem-tab-title-icon' => 'width: {{SIZE}}px;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'aem_accordion_title_icon_border',
				'selector' => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title span.aem-tab-title-icon'
			]
		);

		$this->add_responsive_control(
			'aem_accordion_title_icon_padding',
			[
				'label'      => __('Padding', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title span.aem-tab-title-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_title_icon_margin',
			[
				'label'      => __('Margin', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title span.aem-tab-title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs('aem_accordion_title_icon_style_tabs');

		// normal state tab
		$this->start_controls_tab('aem_accordion_title_icon_general_style', ['label' => esc_html__('Normal', AEM_TEXTDOMAIN)]);

		$this->add_control(
			'aem_accordion_tab_title_icon_color',
			[
				'label'		=> esc_html__('Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title span.aem-tab-title-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_accordion_tab_title_icon_bg_color',
			[
				'label'		=> esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title span.aem-tab-title-icon' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();

		// active state tab
		$this->start_controls_tab('aem_accordion_title_icon_active_style', ['label' => esc_html__('Active', AEM_TEXTDOMAIN)]);

		$this->add_control(
			'aem_accordion_title_icon_active_color',
			[
				'label'		=> esc_html__('Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title.active span.aem-tab-title-icon i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_accordion_title_icon_active_bg_color',
			[
				'label'		=> esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title.active span.aem-tab-title-icon' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'aem_accordion_active_inactive_icon_style',
			[
				'label'     => esc_html__('Active/Inactive Icon', AEM_TEXTDOMAIN),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'aem_accordion_tab_title_show_active_inactive_icon' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_active_inactive_icon_size',
			[
				'label'        => esc_html__('Size', AEM_TEXTDOMAIN),
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
					'size'     => 20
				],
				'selectors'    => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title .aem-active-inactive-icon i' => 'font-size: {{SIZE}}px;'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_active_inactive_icon_width',
			[
				'label'       => esc_html__('Width', AEM_TEXTDOMAIN),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 70
				],
				'range'       => [
					'px'      => [
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title .aem-active-inactive-icon' => 'width: {{SIZE}}px;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'aem_accordion_active_inactive_icon_border',
				'selector' => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title .aem-active-inactive-icon'
			]
		);

		$this->start_controls_tabs('aem_accordion_active_inactive_icon_style_tabs');

		// normal state tab
		$this->start_controls_tab('aem_accordion_general_style', ['label' => esc_html__('Normal', AEM_TEXTDOMAIN)]);

		$this->add_control(
			'aem_accordion_general_icon_color',
			[
				'label'		=> esc_html__('Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#000000',
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title .aem-active-inactive-icon i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_accordion_general_icon_bg_color',
			[
				'label'		=> esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title .aem-active-inactive-icon' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();

		// active state tab
		$this->start_controls_tab('aem_accordion_active_style', ['label' => esc_html__('Active', AEM_TEXTDOMAIN)]);

		$this->add_control(
			'aem_accordion_active_icon_color',
			[
				'label'		=> esc_html__('Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#000000',
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title.active .aem-active-inactive-icon i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_accordion_active_icon_bg_color',
			[
				'label'		=> esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-title.active .aem-active-inactive-icon' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Accordion Content Style
		 * -------------------------------------------
		 */

		$this->start_controls_section(
			'aem_section_accordion_tab_content_style_settings',
			[
				'label'	=> esc_html__('Content', AEM_TEXTDOMAIN),
				'tab'	=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_accordion_content_typography',
				'selector' => '{{WRAPPER}} .aem-accordion-single-item .aem-accordion-text'
			]
		);

		$this->add_control(
			'aem_accordion_content_bg_color',
			[
				'label'		=> esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '',
				'selectors'	=> [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-content .aem-accordion-content-wrapper' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_accordion_content_text_color',
			[
				'label'		=> esc_html__('Text Color', AEM_TEXTDOMAIN),
				'type'		=> Controls_Manager::COLOR,
				'default'	=> '#000000',
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-single-item .aem-accordion-text' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_content_padding',
			[
				'label'      => __('Padding', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-content .aem-accordion-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_content_margin',
			[
				'label'      => __('Margin', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-single-item .aem-accordion-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                 => 'aem_accordion_content_border',
				'fields_options'       => [
					'border' 	       => [
						'default'      => 'solid'
					],
					'width'  		   => [
						'default' 	   => [
							'top'      => '0',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => false
						]
					],
					'color' 		   => [
						'default' 	   => '#000000'
					]
				],
				'selector'             => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-content .aem-accordion-content-wrapper'
			]
		);

		$this->add_responsive_control(
			'aem_accordion_content_border_radius',
			[
				'label'      => __('Border Radius', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-content .aem-accordion-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'aem_section_accordion_tab_image_style',
			[
				'label'	=> esc_html__('Image', AEM_TEXTDOMAIN),
				'tab'	=> Controls_Manager::TAB_STYLE

			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'aem_accordion_image_size',
				'label'   => esc_html__('Image Type', AEM_TEXTDOMAIN),
				'default' => 'medium'
			]
		);

		$this->add_control(
			'aem_accordion_image_align',
			[
				'label'         => esc_html__('Image Position', AEM_TEXTDOMAIN),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'options'       => [
					'left'      => [
						'title' => esc_html__('Left', AEM_TEXTDOMAIN),
						'icon'  => 'eicon-angle-left'
					],
					'right'     => [
						'title' => esc_html__('Right', AEM_TEXTDOMAIN),
						'icon'  => 'eicon-angle-right'
					]
				],
				'default'       => 'right'
			]
		);

		$this->add_responsive_control(
			'aem_accordion_image_padding',
			[
				'label'      => __('Padding', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'default'    => [
					'top'    => '20',
					'right'  => '20',
					'bottom' => '20',
					'left'   => '20'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_image_margin',
			[
				'label'      => __('Margin', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'aem_accordion_image_css_filter',
				'selector' => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-image img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'aem_accordion_details_btn_style_section',
			[
				'label' => esc_html__('Button', AEM_TEXTDOMAIN),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'aem_accordion_details_btn_typography',
				'selector' => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a'
			]
		);

		$this->add_responsive_control(
			'aem_accordion_details_btn_padding',
			[
				'label'      => esc_html__('Padding', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'    => '15',
					'right'  => '40',
					'bottom' => '15',
					'left'   => '40'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'aem_accordion_details_btn_margin',
			[
				'label'      => esc_html__('Margin', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'    => [
					'top'    => '30',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs('aem_accordion_details_button_style_tabs');

		// normal state tab
		$this->start_controls_tab('aem_accordion_details_btn_normal', ['label' => esc_html__('Normal', AEM_TEXTDOMAIN)]);

		$this->add_control(
			'aem_accordion_details_btn_normal_text_color',
			[
				'label'     => esc_html__('Text Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_accordion_details_btn_normal_bg_color',
			[
				'label'     => esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'aem_accordion_details_btn_border',
				'fields_options'     => [
					'border' 	     => [
						'default'    => 'solid'
					],
					'width'  	     => [
						'default'    => [
							'top'    => '1',
							'right'  => '1',
							'bottom' => '1',
							'left'   => '1'
						]
					],
					'color' 	     => [
						'default'    => '#000000'
					]
				],
				'selector'           => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a'
			]
		);

		$this->add_responsive_control(
			'aem_accordion_details_button_border_radius',
			[
				'label'      => esc_html__('Border Radius', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'aem_accordion_details_button_shadow',
				'selector'  => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a'
			]
		);

		$this->end_controls_tab();

		// hover state tab
		$this->start_controls_tab('aem_accordion_details_btn_hover', ['label' => esc_html__('Hover', AEM_TEXTDOMAIN)]);

		$this->add_control(
			'aem_accordion_details_btn_hover_text_color',
			[
				'label'     => esc_html__('Text Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'aem_accordion_details_btn_hover_bg_color',
			[
				'label'     => esc_html__('Background Color', AEM_TEXTDOMAIN),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a:hover' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'aem_accordion_details_btn_hover_border',
				'selector' => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a:hover'
			]
		);

		$this->add_responsive_control(
			'aem_accordion_details_button_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', AEM_TEXTDOMAIN),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'aem_accordion_details_button_hover_shadow',
				'selector'  => '{{WRAPPER}} .aem-accordion-items .aem-accordion-single-item .aem-accordion-button a:hover'
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}
	
	protected function render() {

        $settings   = $this->get_settings_for_display();
        
        $this->add_render_attribute( 'aem_accordion_heading', 'class', 'aem-accordion-heading' );
        $this->add_render_attribute( 'aem_accordion_details', 'class', 'aem-accordion-text' );
        $this->add_render_attribute( 'aem_accordion_button', 'class', 'aem-accordion-button' );

		?>
    
        <div class="aem-accordion-items">
        	<?php do_action('aem_accordion_wrapper_before');
            foreach( $settings['aem_accordion_tab'] as $key => $accordion ) :
            	do_action('aem_accordion_each_item_wrapper_before');
                
                $accordion_item_setting_key = $this->get_repeater_setting_key('aem_accordion_title', 'aem_accordion_tab', $key);

                $accordion_class = ['aem-accordion-title'];

                if ( $accordion['aem_accordion_default_active'] === 'yes' ) {
                    $accordion_class[] = 'active-default';
                } 

                $this->add_render_attribute( $accordion_item_setting_key, 'class', $accordion_class );

				$has_image = !empty( $accordion['aem_accordion_image']['url'] ) ? 'yes' : 'no';
				$link_key  = 'link_' . $key;

				?>

                <div class="aem-accordion-single-item elementor-repeater-item-<?php echo esc_attr($accordion['_id']); ?>">
                    <div <?php echo $this->get_render_attribute_string($accordion_item_setting_key); ?>>

						<?php if ( ! empty( $accordion['aem_accordion_title_icon']['value'] ) && 'yes' === $accordion['aem_accordion_icon_show'] ) : ?>
							<span class="aem-tab-title-icon">
								<?php Icons_Manager::render_icon( $accordion['aem_accordion_title_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php endif; ?>

                        <<?php echo Utils::validate_html_tag( $settings['aem_accordion_title_html_tag'] ); ?>  <?php echo $this->get_render_attribute_string( 'aem_accordion_heading' ); ?>>
							<?php echo Helper::aem_wp_kses($accordion['aem_accordion_title']); ?>
						</<?php echo Utils::validate_html_tag( $settings['aem_accordion_title_html_tag'] ); ?> >

                        <?php if( 'yes' === $settings['aem_accordion_tab_title_show_active_inactive_icon']) : ?>
                            <div class="aem-active-inactive-icon">
                                <?php if( !empty( $settings['aem_accordion_tab_title_active_icon']['value'])) { ?>
                                    <span class="aem-active-icon">
                                        <?php Icons_Manager::render_icon( $settings['aem_accordion_tab_title_active_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>                            
                                <?php } ?>
                                <?php if( !empty( $settings['aem_accordion_tab_title_inactive_icon']['value'] ) ) { ?>
                                    <span class="aem-inactive-icon">
                                        <?php Icons_Manager::render_icon( $settings['aem_accordion_tab_title_inactive_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                <?php } ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="aem-accordion-content">
                        <div class="aem-accordion-content-wrapper has-image-<?php echo esc_attr($has_image); ?> image-position-<?php echo esc_attr( $settings['aem_accordion_image_align'] ); ?>">
                            <div <?php echo $this->get_render_attribute_string( 'aem_accordion_details' ); ?>>
                                <div> <?php echo wp_kses_post( $accordion['aem_accordion_content'] ); ?></div>
                                <?php if( 'yes' === $accordion['aem_accordion_show_read_more_btn'] ) : ?>
									<?php if( $accordion['aem_accordion_read_more_btn_url']['url'] ) { ?>
									    <?php $this->add_render_attribute( $link_key, 'href', esc_url( $accordion['aem_accordion_read_more_btn_url']['url'] ) ); ?>
									    <?php if( $accordion['aem_accordion_read_more_btn_url']['is_external'] ) { ?>
									        <?php $this->add_render_attribute( $link_key, 'target', '_blank' ); ?>
									    <?php } ?>
									    <?php if( $accordion['aem_accordion_read_more_btn_url']['nofollow'] ) { ?>
									        <?php $this->add_render_attribute( $link_key, 'rel', 'nofollow' ); ?>
									    <?php } ?>
									<?php } ?>
                                    <?php if ( ! empty( $accordion['aem_accordion_read_more_btn_text'] ) ) : ?>
                                        <div <?php echo $this->get_render_attribute_string( 'aem_accordion_button' ); ?>>
                                            <a <?php echo $this->get_render_attribute_string( $link_key ); ?>>
                                            	<?php echo esc_html( $accordion['aem_accordion_read_more_btn_text'] ); ?>
                                            </a>
                                        </div> 
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

                            <?php if ( ! empty( $accordion['aem_accordion_image']['url'] ) ) { ?>
                                <div class="aem-accordion-image">
                                    <?php echo $this->render_image( $accordion, $settings ); ?>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <?php do_action('aem_accordion_each_item_wrapper_after'); ?>
            <?php endforeach; ?>
            <?php do_action('aem_accordion_wrapper_after'); ?>
        </div>
	<?php
    }
}
