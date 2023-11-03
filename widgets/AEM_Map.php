<?php
if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;

class AEM_Map extends Widget_Base {

	public function get_name() {
		return 'aem-google-maps';
	}

	public function get_title() {
		return esc_html__( 'Google Maps', AEM_TEXTDOMAIN );
	}

	public function get_icon() {
		return 'aem aem-logo eicon-google-maps';
	}

	public function get_keywords() {
        return [ 'direction', 'roadmap', 'satellite', 'earth' ];
    }

   	public function get_categories() {
		return [ 'aem-category' ];
	}

	public function get_script_depends() {
		return [ 'aem-google-map-api', 'aem-gmap3' ];
	}

	protected function register_controls() {
		/**
  		 * Google Map General Settings
  		 */
  		$this->start_controls_section(
  			'aem_section_google_map_settings',
  			[
  				'label' => esc_html__( 'Map Settings', AEM_TEXTDOMAIN )
  			]
		);

        $this->add_control(
			'aem_googlemap_embed',
			[
				'label' => esc_html__( 'Embed Map HTML', AEM_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Default description', AEM_TEXTDOMAIN ),
				'placeholder' => esc_html__( 'Type your description here', AEM_TEXTDOMAIN ),
			]
		);
		 
  		$this->end_controls_section();
		
  		/**
		 * -------------------------------------------
		 * Tab Style Google Map Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'aem_section_google_map_style_settings',
			[
				'label' => esc_html__( 'General Styles', AEM_TEXTDOMAIN ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings_for_display();
        ?>
		
        <div class="google-map-embed"><?php echo $settings['aem_googlemap_embed'] ?></div>
	<?php 	
	}

}