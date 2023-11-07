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
				'label' => esc_html__( 'Embed Map Url', AEM_TEXTDOMAIN ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3597057.564256965!2d79.12159278173114!3d28.305850050124064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995e8c77d2e68cf%3A0x34a29abcd0cc86de!2sNepal!5e0!3m2!1sen!2snp!4v1699344816185!5m2!1sen!2snp', AEM_TEXTDOMAIN ),
				'placeholder' => esc_html__( 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3597057.564256965!2d79.12159278173114!3d28.305850050124064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995e8c77d2e68cf%3A0x34a29abcd0cc86de!2sNepal!5e0!3m2!1sen!2snp!4v1699344816185!5m2!1sen!2snp', AEM_TEXTDOMAIN ),
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
		
        <div class="google-map-embed"><iframe src="<?php echo $settings['aem_googlemap_embed'] ?>" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
	<?php 	
	}

}