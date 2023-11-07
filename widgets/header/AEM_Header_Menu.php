<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

class AEM_Header_Menu extends Widget_Base {

	protected $nav_menu_index = 1;

	public function get_name() {
		return 'aem_header_menu';
	}

	public function get_title() {
		return esc_html__( 'AEM Menu', 'aem-elementor-widgets' );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-nav-menu';
	}

	public function get_categories() {
		return [ 'aem-category' ];
	}

	protected function get_nav_menu_index() {
		return $this->nav_menu_index ++;
	}

	private function get_available_menus() {

		$menus = wp_get_nav_menus();

		$options = array();

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	public static function is_elementor_updated() {
		if ( class_exists( 'Elementor\Icons_Manager' ) ) {
			return true;
		} else {
			return false;
		}
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_menu',
			array(
				'label' => __( ' Menu', 'aem-elementor-widgets' ),
			)
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				array(
					'label'        => __( 'Menu', 'aem-elementor-widgets' ),
					'type'         => \Elementor\Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					'separator'    => 'after',
					/* translators: %s: link */
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'aem-elementor-widgets' ), admin_url( 'nav-menus.php' ) ),
				)
			);
		} else {
			$this->add_control(
				'menu',
				array(
					'type'            => \Elementor\Controls_Manager::RAW_HTML,
					// translators: %s: link
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'aem-elementor-widgets' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator'       => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				)
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',
			array(
				'label' => __( 'Layout', 'aem-elementor-widgets' ),
			)
		);

		$this->add_control(
			'navmenu_align',
			array(
				'label'        => __( 'Alignment', 'aem-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'left'    => array(
						'title' => __( 'Left', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
					'justify' => array(
						'title' => __( 'Justify', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-stretch',
					),
				),
				'default'      => 'left',
				'prefix_class' => 'aem_menu_nav__align-',
			)
		);

		$this->add_responsive_control(
			'menu_background_color',
			array(
				'label'     => __( 'Background Color', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'html body .aem_menu_nav__breakpoint-tablet .aem_menu_nav' => 'background-color: {{VALUE}} !important',
				),
			)
		);

		$this->add_control(
			'flyout_layout',
			array(
				'label'     => __( 'Flyout Orientation', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Left', 'aem-elementor-widgets' ),
					'right' => __( 'Right', 'aem-elementor-widgets' ),
				),
				'condition' => array(
					'layout' => 'flyout',
				),
			)
		);

		$this->add_control(
			'flyout_type',
			array(
				'label'       => __( 'Appear Effect', 'aem-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'normal',
				'label_block' => false,
				'options'     => array(
					'normal' => __( 'Slide', 'aem-elementor-widgets' ),
					'push'   => __( 'Push', 'aem-elementor-widgets' ),
				),
				'render_type' => 'template',
				'condition'   => array(
					'layout' => 'flyout',
				),
			)
		);

		$this->add_responsive_control(
			'hamburger_align',
			array(
				'label'                => __( 'Hamburger Align', 'aem-elementor-widgets' ),
				'type'                 => \Elementor\Controls_Manager::CHOOSE,
				'default'              => 'center',
				'options'              => array(
					'left'   => array(
						'title' => __( 'Left', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors_dictionary' => array(
					'left'   => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right'  => 'margin-left: auto',
				),
				'selectors'            => array(
					'{{WRAPPER}} .aem_menu_nav__toggle,
						{{WRAPPER}} .aem_menu_nav-icon' => '{{VALUE}}',
				),
				'default'              => 'center',
				'condition'            => array(
					'layout' => array( 'expandible', 'flyout' ),
				),
				'label_block'          => false,
			)
		);

		$this->add_responsive_control(
			'hamburger_menu_align',
			array(
				'label'        => __( 'Menu Items Align', 'aem-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::CHOOSE,
				'options'      => array(
					'flex-start'    => array(
						'title' => __( 'Left', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'        => array(
						'title' => __( 'Center', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end'      => array(
						'title' => __( 'Right', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
					'space-between' => array(
						'title' => __( 'Justify', 'aem-elementor-widgets' ),
						'icon'  => 'eicon-h-align-stretch',
					),
				),
				'default'      => 'space-between',
				'condition'    => array(
					'layout' => array( 'expandible', 'flyout' ),
				),
				'prefix_class' => 'aem-menu-item-',
			)
		);

		$this->add_control(
			'submenu_icon',
			array(
				'label'       => __( 'Submenu Arrow', 'header-footer-elementor' ),
				'type'        => Controls_Manager::SWITCHER,
				'yes'         => __( 'Yes', 'header-footer-elementor' ),
				'no'          => __( 'No', 'header-footer-elementor' ),
				'default'     => '',
				'render_type' => 'template',
			)
		);

		$this->add_control(
			'menu_separator',
			array(
				'label'       => __( 'Separator', 'header-footer-elementor' ),
				'type'        => Controls_Manager::SWITCHER,
				'yes'         => __( 'Yes', 'header-footer-elementor' ),
				'no'          => __( 'No', 'header-footer-elementor' ),
				'default'     => 'no',
				'render_type' => 'template',
			)
		);

		$this->add_responsive_control(
			'menu_separator_color',
			array(
				'label'     => __( 'Color on action', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav__separator-yes .aem_menu_nav>li>a:after' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'menu_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'dropdown',
			array(
				'label'        => __( 'Breakpoint', 'aem-elementor-widgets' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => array(
					'tablet' => __( 'Tablet Landscape', 'aem-elementor-widgets' ),
					'mobile' => __( 'Tablet Portrait', 'aem-elementor-widgets' ),
					'none'   => __( 'None', 'aem-elementor-widgets' ),
				),
				'prefix_class' => 'aem_menu_nav__breakpoint-',
				'render_type'  => 'template',
				'description'  => __( 'Select the mobile header breakpoint (Landscape - 1024px resolution, Portrait 991px resolution).', 'aem-elementor-widgets' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_menu_1',
			array(
				'label' => __( 'Menu Level 1', 'aem-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'menu_level_1_padding',
			array(
				'label'      => __( 'Padding', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_1_margin',
			array(
				'label'      => __( 'Margin', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'menu_level_1_pointer',
			array(
				'label'   => __( 'Link Hover Effect', 'aem-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'      => __( 'None', 'aem-elementor-widgets' ),
					'underline' => __( 'Underline', 'aem-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'style_divider',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'menu_level_1_menu_typography',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .aem_menu_nav > li > a',
			)
		);

		$this->add_responsive_control(
			'menu_level_1_color_menu_item',
			array(
				'label'     => __( 'Color', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_1_color_menu_item_action',
			array(
				'label'     => __( 'Color on action', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > a:hover'             => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > a:active'            => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > a:focus'             => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li.current-menu-item > a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li.active > a'            => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > .arrow.active'       => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_1_bg_color_menu_item',
			array(
				'label'     => __( 'Background', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_1_bg_color_menu_item_action',
			array(
				'label'     => __( 'Background on action', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > a:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > a:active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > a:focus'  => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_menu_2',
			array(
				'label' => __( 'Menu Level 2', 'aem-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'menu_level_2_padding',
			array(
				'label'      => __( 'Padding', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_2_margin',
			array(
				'label'      => __( 'Margin', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'menu_level_2_pointer',
			array(
				'label'   => __( 'Link Hover Effect', 'aem-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'      => __( 'None', 'aem-elementor-widgets' ),
					'underline' => __( 'Underline', 'aem-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'style_divider_2',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'menu_level_2_menu_typography',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .aem_menu_nav > li > ul > li > a',
			)
		);

		$this->add_responsive_control(
			'menu_level_2_color_menu_item',
			array(
				'label'     => __( 'Color', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_2_color_menu_item_action',
			array(
				'label'     => __( 'Color on action', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a:active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a:focus'  => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_2_bg_color_menu_item',
			array(
				'label'     => __( 'Background', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_2_bg_color_menu_item_action',
			array(
				'label'     => __( 'Background on action', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a:active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > a:focus'  => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'style_divider_2_1',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_responsive_control(
			'menu_level_2_bg_color_submenu',
			array(
				'label'     => __( 'Submenu Background', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_menu_3',
			array(
				'label' => __( 'Menu Level 3', 'aem-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'menu_level_3_padding',
			array(
				'label'      => __( 'Padding', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_3_margin',
			array(
				'label'      => __( 'Margin', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'menu_level_3_pointer',
			array(
				'label'   => __( 'Link Hover Effect', 'aem-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'      => __( 'None', 'aem-elementor-widgets' ),
					'underline' => __( 'Underline', 'aem-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'style_divider_3',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'menu_level_3_menu_typography',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a',
			)
		);

		$this->add_responsive_control(
			'menu_level_3_color_menu_item',
			array(
				'label'     => __( 'Color', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_3_color_menu_item_action',
			array(
				'label'     => __( 'Color on action', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a:active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a:focus'  => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_3_bg_color_menu_item',
			array(
				'label'     => __( 'Background', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'menu_level_3_bg_color_menu_item_action',
			array(
				'label'     => __( 'Background on action', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a:active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul > li > a:focus'  => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'style_divider_3_1',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_responsive_control(
			'menu_level_3_bg_color_submenu',
			array(
				'label'     => __( 'Submenu Background', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li > ul > li > ul' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_mega_menu',
			array(
				'label' => __( 'Mega Menu', 'aem-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'mega_menu_padding_horizontal_menu_item',
			array(
				'label'      => __( 'Horizontal Padding', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 50,
					),
				),
				'default'    => array(
					'size' => 26,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > ul > li > a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'mega_menu_padding_vertical_menu_item',
			array(
				'label'      => __( 'Vertical Padding', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 50,
					),
				),
				'default'    => array(
					'size' => 8,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > ul > li > a' => 'padding-top: {{SIZE}}{{UNIT}} !important; padding-bottom: {{SIZE}}{{UNIT}} !important;',
				),
			)
		);

		$this->add_responsive_control(
			'mega_menu_menu_space_between',
			array(
				'label'      => __( 'Space Between', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors'  => array(
					'.aem_menu_nav > li.aem_megamenu > ul > li > ul > li' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'mega_menu_pointer',
			array(
				'label'   => __( 'Link Hover Effect', 'aem-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'      => __( 'None', 'aem-elementor-widgets' ),
					'underline' => __( 'Underline', 'aem-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'style_divider_mega',
			array(
				'type' => \Elementor\Controls_Manager::DIVIDER,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'mega_menu_typography',
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'separator' => 'before',
				'selector'  => '
                    {{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > a, 
                    {{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > ul > li > a, 
                    {{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > ul > li > a .aem_mega_textarea
                ',
			)
		);

		$this->add_responsive_control(
			'mega_menu_color_menu_item',
			array(
				'label'     => __( 'Link Color', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > ul > li > a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'mega_menu_color_menu_item_action',
			array(
				'label'     => __( 'Link Color on action', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > ul > li > a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > ul > li > a:active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > ul > li > a:focus'  => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'mega_menu_text_color_menu_item',
			array(
				'label'     => __( 'Text Color', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li'                      => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li > a'                  => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li .aem_mega_textarea'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul > li .megamenu-contacts a' => 'color: {{VALUE}} !important',
				),
			)
		);

		$this->add_responsive_control(
			'mega_menu_icon_color',
			array(
				'label'     => __( 'Icons Color', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu i' => 'color: {{VALUE}} !important',
				),
			)
		);

		$this->add_responsive_control(
			'mega_menu_icon_size',
			array(
				'label'      => __( 'Icon Size', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 14,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'mega_menu_bg_color_menu_item',
			array(
				'label'     => __( 'Background', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav > li.aem_megamenu > ul' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hamburger',
			array(
				'label' => __( 'Hamburger on mobile', 'aem-elementor-widgets' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'hamburger_position',
			array(
				'label'      => __( 'Position', 'aem-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .aem_menu_nav .menu_toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'hamburger_button_color',
			array(
				'label'     => __( 'Color', 'aem-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .aem_menu_nav .menu_toggle button'        => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav .menu_toggle button:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .aem_menu_nav .menu_toggle button:after'  => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$menus = $this->get_available_menus();

		if ( empty( $menus ) ) {
			return false;
		}

		$settings = $this->get_settings_for_display();

		$args = array(
			'echo'        => false,
			'menu'        => $settings['menu'],
			'menu_class'  => 'aem_menu_nav',
			'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container'   => '',
		);

		$menu_html = wp_nav_menu( $args );

		$this->add_render_attribute(
			'aem_menu',
			'class',
			array(
				'aem_menu_nav',
			)
		);

		$this->add_render_attribute( 'aem_menu', 'class', 'aem_menu_nav-layout' );

		$this->add_render_attribute(
			'aem_menu_nav',
			'class',
			array(
				'aem_menu_nav__separator-' . $settings['menu_separator'],
			)
		);

		if ( $settings['menu_level_1_pointer'] ) {
			$this->add_render_attribute( 'aem_menu_nav', 'class', 'aem_menu_nav__pointer_' . $settings['menu_level_1_pointer'] );
		}

		if ( true === $settings['submenu_icon'] ) {
			$this->add_render_attribute( 'aem_menu_nav', 'class', 'aem_menu_nav__submenu-icon-arrow' );
		} else {
			$this->add_render_attribute( 'aem_menu_nav', 'class', 'aem_menu_nav__submenu-icon-none' );
		}

		?>
		<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'aem_menu' ) ); ?>>
			<div class="menu_toggle">
				<button></button>
			</div>
			<nav <?php echo wp_kses_post( $this->get_render_attribute_string( 'aem_menu_nav' ) ); ?>><?php echo wp_kses_post( $menu_html ); ?></nav>
		</div>
		<?php
	}
}
