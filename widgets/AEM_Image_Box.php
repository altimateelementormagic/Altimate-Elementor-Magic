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

class AEM_Image_Box extends Widget_Base {
	
	public function get_name() {
		return 'aem-image-box';
	}

	public function get_title() {
		return esc_html__( 'Image Box', AEM_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-image-box';
    }
    
    public function get_keywords() {
		return [ 'Image' ];
	}

	public function get_categories() {
		return [ 'aem-category' ];
	}

	protected function register_controls() {

        /*
        * Image Image
        */
        $this->start_controls_section(
            'aem_section_image_image',
            [
                'label' => esc_html__( 'Content', AEM_TEXTDOMAIN )
            ]
        );
        
        $this->add_control(
            'aem_image_image',
            [
                'label'   => esc_html__( 'Image Image', AEM_TEXTDOMAIN ),
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
                    'aem_image_image[url]!' => ''
                ]
            ]
        );

        $this->add_control(
            'aem_image_box_enable_link',
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
            'aem_image_box_link',
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
                    'aem_image_box_enable_link' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'aem_image_box_max_height_enable',
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
			'aem_image_box_max_height',
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
					'{{WRAPPER}} .aem-image-item.aem-image-item-max-height-yes' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'aem_image_box_max_height_enable' => 'yes'
                ]
			]
		);
        
        $this->end_controls_section();

        /*
        * Image Style
        *
        */
    	$this->start_controls_section(
    		'aem_section_image_style',
    		[
                'label' => esc_html__( 'Style', AEM_TEXTDOMAIN ),
                'tab'   => Controls_Manager::TAB_STYLE
    		]
        );

        $this->add_control(
			'aem_section_image_alignment',
			[
				'label' => __( 'Alignment', AEM_TEXTDOMAIN ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'aem-image-left' => [
						'title' => __( 'Left', AEM_TEXTDOMAIN ),
						'icon' => 'fa fa-align-left',
					],
					'aem-image-center' => [
						'title' => __( 'Center', AEM_TEXTDOMAIN ),
						'icon' => 'fa fa-align-center',
					],
					'aem-image-right' => [
						'title' => __( 'Right', AEM_TEXTDOMAIN ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'aem-image-center',
				'toggle' => true,
			]
		);

        $this->start_controls_tabs( 'aem_image_tabs' );

    	# Normal tab
        $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', AEM_TEXTDOMAIN ) ] );

            $this->add_control(
        		'aem_image_background_style',
        			[
                    'label' => __( 'Background Style', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
        			]
            );

            $this->add_group_control(
        		Group_Control_Background::get_type(),
    			[
                    'name'      => 'aem_image_background',
                    'types'     => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector'  => '{{WRAPPER}} .aem-image-box .aem-image-item'
    			]
            );

            $this->add_control(
        		'aem_image_opacity_style',
        		[
                    'label' => __( 'Opacity', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
        		]
            );

            $this->add_control(
                'aem_image_opacity',
                [
                    'label' => __('Opacity', AEM_TEXTDOMAIN),
                    'type'  => Controls_Manager::NUMBER,
                    'range' => [
                        'min'   => 0,
                        'max'   => 1
            		],
                    'selectors' => [
                        '{{WRAPPER}} .aem-image-box .aem-image-item img' => 'opacity: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
    			'aem_image_shadow_style',
    			[
                    'label' => __( 'Box Shadow', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
    			]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'aem_image_box_shadow',
                    'selector' => '{{WRAPPER}} .aem-image-box .aem-image-item'
                ]
            );

        $this->end_controls_tab();

    	# Hover tab
        $this->start_controls_tab( 'aem_exclusive_button_hover', [ 'label' => esc_html__( 'Hover', AEM_TEXTDOMAIN ) ] );

            $this->add_control(
    			'aem_image_hover_background',
    			[
                    'label' => __( 'Background Style', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
    			]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'      => 'aem_image_hover_background_hover',
                    'types'     => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector'  => '{{WRAPPER}} .aem-image-box .aem-image-item:hover'
                ]
            );

            $this->add_control(
        		'aem_image_opacity_hover_style',
        		[
                    'label' => __( 'Opacity', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
        		]
            );

            $this->add_control(
                'aem_image_hover_opacity',
                [
                    'label'     => __('Opacity', AEM_TEXTDOMAIN),
                    'type'      => Controls_Manager::NUMBER,
                    'range'     => [
                        'min'   => 0,
                        'max'   => 1
                    ],
                    'default'   => __( 'From 0.1 to 1', AEM_TEXTDOMAIN ),
                    'selectors' => [
                        '{{WRAPPER}} .aem-image-box .aem-image-item:hover img' => 'opacity: {{VALUE}};'
                    ]
                ]
            );
        		
            $this->add_control(
                'aem_image_shadow_hover_style',
                [
                    'label' => __( 'Box Shadow', AEM_TEXTDOMAIN ),
                    'type'  => Controls_Manager::HEADING
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'aem_image_box_hover_shadow',
                    'selector' => '{{WRAPPER}} .aem-image-box .aem-image-item:hover'
                ]
            );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'aem_image_padding',
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
                    '{{WRAPPER}} .aem-image-box .aem-image-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'selector' => '{{WRAPPER}} .aem-image-box .aem-image-item'
            ]
        );
        $this->add_responsive_control(
    		'aem_image_border_radius',
            [
                'label'      => __( 'Border Radius', AEM_TEXTDOMAIN ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .aem-image-box .aem-image-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
	}
	protected function render() {
        $settings       = $this->get_settings_for_display();
        $aem_image_link = $settings['aem_image_box_link'];

        if( 'yes' === $settings['aem_image_box_enable_link'] && $aem_image_link ) {
            $this->add_render_attribute( 'aem_image_box_link', 'href', esc_url( $settings['aem_image_box_link']['url'] ) );
            if( $settings['aem_image_box_link']['is_external'] ) {
                $this->add_render_attribute( 'aem_image_box_link', 'target', '_blank' );
            }
            if( $settings['aem_image_box_link']['nofollow'] ) {
                $this->add_render_attribute( 'aem_image_box_link', 'rel', 'nofollow' );
            }
        }
        ?>

        <div class="aem-image-box one <?php echo $settings['aem_section_image_alignment']; ?>">
            <div class="aem-image-item aem-image-item-max-height-<?php echo $settings['aem_image_box_max_height_enable']; ?>">
            <?php
                if( ! empty( $settings['aem_image_image'] ) ) :

                    if( !empty( $aem_image_link ) && 'yes' === $settings['aem_image_box_enable_link'] ) :
                        echo '<a '.$this->get_render_attribute_string( 'aem_image_box_link' ).'>';
                    endif;
                    echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'aem_image_image' );
                    if( !empty( $aem_image_link ) && 'yes' === $settings['aem_image_box_enable_link'] ) :
                        echo '</a>';
                    endif;
                endif;
            ?>    
            </div>
        </div>
    <?php    
	}

    /**
     * Render image box widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            if ( settings.aem_image_image.url || settings.aem_image_image.id ) {
                var image = {
                    id: settings.aem_image_image.id,
                    url: settings.aem_image_image.url,
                    size: settings.thumbnail_size,
                    dimension: settings.thumbnail_custom_dimension,
                    class: 'aem-image-box-img',
                    model: view.getEditModel()
                };

                var image_url = elementor.imagesManager.getImageUrl( image );
            }

            var target   = settings.aem_image_box_link.is_external ? ' target="_blank"' : '';
            var nofollow = settings.aem_image_box_link.nofollow ? ' rel="nofollow"' : '';
        #>
        <div class="aem-image-box one {{ settings.aem_section_image_alignment }}">
            <div class="aem-image-item aem-image-item-max-height-{{ settings.aem_image_box_max_height_enable }}">
                <# if ( image_url ) { #>
                    <# if ( settings.aem_image_box_link && 'yes' === settings.aem_image_box_enable_link ) { #>
                        <a href="{{{ settings.aem_image_box_link.url }}}"{{{ target }}}{{{ nofollow }}}>
                    <# } #>
                    <img src="{{{ image_url }}}">
                    <# if ( settings.aem_image_box_link && 'yes' === settings.aem_image_box_enable_link ) { #>
                        </a>
                    <# } #>
                <# } #>
            </div>
        </div>
        <?php
    }
}