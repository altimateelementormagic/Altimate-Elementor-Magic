<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class AEM_Logobox extends Widget_Base {
	
	public function get_name() {
		return 'aem-logo';
	}

	public function get_title() {
		return esc_html__( 'Logo Box', AEM_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-image-box';
    }
    
    public function get_keywords() {
		return [ AEM_TEXTDOMAIN, 'brand', 'logo', 'image' ];
	}

	public function get_categories() {
		return [ 'aem-category' ];
	}

	protected function register_controls() {

        /*
        * Logo Image
        */
        $this->start_controls_section(
            'aem_section_logo_image',
            [
                'label' => esc_html__( 'Content', AEM_TEXTDOMAIN )
            ]
        );
        
        $this->add_control(
            'aem_logo_image',
            [
                'label'   => esc_html__( 'Logo Image', AEM_TEXTDOMAIN ),
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
                'name'      => 'thumbnail',
                'default'   => 'full',
                'condition' => [
                    'aem_logo_image[url]!' => ''
                ]
            ]
        );

        $this->add_control(
            'aem_logo_box_enable_link',
            [
                'label'        => __( 'Enable Link', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
            'aem_logo_box_link',
            [
                'label'         => __( 'Link', AEM_TEXTDOMAIN ),
                'type'          => Controls_Manager::URL,
                'placeholder'   => __( 'https://your-link.com', AEM_TEXTDOMAIN ),
                'show_external' => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => true
                ],
                'condition'     => [
                    'aem_logo_box_enable_link' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'aem_logo_box_max_height_enable',
            [
                'label'        => __( 'Minimum Height', AEM_TEXTDOMAIN ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', AEM_TEXTDOMAIN ),
                'label_off'    => __( 'Hide', AEM_TEXTDOMAIN ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_control(
			'aem_logo_box_max_height',
			[
				'label' => __( 'Height', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .aem-logo-item.aem-logo-item-max-height-yes' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'aem_logo_box_max_height_enable' => 'yes'
                ]
			]
		);
        
        $this->end_controls_section();

        /*
        * Logo Style
        *
        */
    	$this->start_controls_section(
    		'aem_section_logo_style',
    		[
                'label' => esc_html__( 'Style', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
    		]
        );

        $this->add_control(
			'aem_section_logo_alignment',
			[
				'label' => __( 'Alignment', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'aem-logo-left' => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon' => 'fa fa-align-left',
					],
					'aem-logo-center' => [
						'title' => __( 'Center', AEM_TEXTDOMAIN ),
						'icon' => 'fa fa-align-center',
					],
					'aem-logo-right' => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'aem-logo-center',
				'toggle' => true,
			]
		);

        $this->start_controls_tabs( 'aem_logo_tabs' );

    	# Normal tab
        $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

            $this->add_control(
        		'aem_logo_background_style',
        			[
                    'label' => __( 'Background Style', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
        			]
            );

            $this->add_group_control(
        		Group_Control_Background::get_type(),
    			[
                    'name'      => 'aem_logo_background',
                    'types'     => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector'  => '{{WRAPPER}} .aem-logo-box .aem-logo-item'
    			]
            );

            $this->add_control(
        		'aem_logo_opacity_style',
        		[
                    'label' => __( 'Opacity', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
        		]
            );

            $this->add_control(
                'aem_logo_opacity',
                [
                    'label' => __('Opacity', AEM_TEXTDOMAIN),
                    'type'  => Controls_Manager::NUMBER,
                    'range' => [
                        'min'   => 0,
                        'max'   => 1
            		],
                    'selectors' => [
                        '{{WRAPPER}} .aem-logo-box .aem-logo-item img' => 'opacity: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
    			'aem_logo_shadow_style',
    			[
                    'label' => __( 'Box Shadow', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
    			]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'aem_logo_box_shadow',
                    'selector' => '{{WRAPPER}} .aem-logo-box .aem-logo-item'
                ]
            );

        $this->end_controls_tab();

    	# Hover tab
        $this->start_controls_tab( 'aem_button_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

            $this->add_control(
    			'aem_logo_hover_background',
    			[
                    'label' => __( 'Background Style', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
    			]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'aem_logo_hover_background_hover',
                    'types'     => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector'  => '{{WRAPPER}} .aem-logo-box .aem-logo-item:hover'
                ]
            );

            $this->add_control(
        		'aem_logo_opacity_hover_style',
        		[
                    'label' => __( 'Opacity', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
        		]
            );

            $this->add_control(
                'aem_logo_hover_opacity',
                [
                    'label'     => __('Opacity', AEM_TEXTDOMAIN),
                    'type'      => Controls_Manager::NUMBER,
                    'range'     => [
                        'min'   => 0,
                        'max'   => 1
                    ],
                    'default'   => __( 'From 0.1 to 1', AEM_TEXTDOMAIN ),
                    'selectors' => [
                        '{{WRAPPER}} .aem-logo-box .aem-logo-item:hover img' => 'opacity: {{VALUE}};'
                    ]
                ]
            );
        		
            $this->add_control(
                'aem_logo_shadow_hover_style',
                [
                    'label' => __( 'Box Shadow', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'aem_logo_box_hover_shadow',
                    'selector' => '{{WRAPPER}} .aem-logo-box .aem-logo-item:hover'
                ]
            );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'aem_logo_padding',
            [
                'label'      => __( 'Padding', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'separator'  => 'before',
                'default'    => [
                    'top'    => 20,
                    'right'  => 20,
                    'bottom' => 20,
                    'left'   => 20,
                    'unit'   => 'px'
                ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-logo-box .aem-logo-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .aem-logo-box .aem-logo-item'
            ]
        );
        $this->add_responsive_control(
    		'aem_logo_border_radius',
            [
                'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-logo-box .aem-logo-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
	}
	protected function render() {
        $settings       = $this->get_settings_for_display();
        $aem_logo_link = $settings['aem_logo_box_link'];

        if( 'yes' === $settings['aem_logo_box_enable_link'] && $aem_logo_link ) {
            $this->add_render_attribute( 'aem_logo_box_link', 'href', esc_url( $settings['aem_logo_box_link']['url'] ) );
            if( $settings['aem_logo_box_link']['is_external'] ) {
                $this->add_render_attribute( 'aem_logo_box_link', 'target', '_blank' );
            }
            if( $settings['aem_logo_box_link']['nofollow'] ) {
                $this->add_render_attribute( 'aem_logo_box_link', 'rel', 'nofollow' );
            }
        }
        ?>

        <div class="aem-logo-box one <?php echo $settings['aem_section_logo_alignment']; ?>">
            <div class="aem-logo-item aem-logo-item-max-height-<?php echo $settings['aem_logo_box_max_height_enable']; ?>">
            <?php
                if( ! empty( $settings['aem_logo_image'] ) ) :

                    if( !empty( $aem_logo_link ) && 'yes' === $settings['aem_logo_box_enable_link'] ) :
                        echo '<a '.$this->get_render_attribute_string( 'aem_logo_box_link' ).'>';
                    endif;
                    echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'aem_logo_image' );
                    if( !empty( $aem_logo_link ) && 'yes' === $settings['aem_logo_box_enable_link'] ) :
                        echo '</a>';
                    endif;
                endif;
            ?>    
            </div>
        </div>
    <?php    
	}

}