<?php

namespace App;

class Shortcode extends Easy_Slider {

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
        add_shortcode( 'easy', [$this, 'add_easy_shortcode'] ); 
    }

    public function add_easy_shortcode($atts) {

        wp_enqueue_style('owl-caroulsel');
        wp_enqueue_style('owl-default');
        wp_enqueue_style('easy-slider');
        wp_enqueue_script('owl-caroulsel');
        wp_enqueue_script('easy-slider');

        // Attributes
        $atts = shortcode_atts(
            array(
                'id' => '',
            ),
            $atts
        );

        $slides = get_post_meta($atts['id'], 'slide_images', true);
        $links  = get_post_meta($atts['id'], 'slide_links', true);  
        
        ob_start();
        $this->view('/public/slide', [
            'slides' => $slides,
            'links' => $links
        ]);
        
        $return = ob_get_clean();
        return $return;  
    }

    public function register_scripts() {
        wp_register_style('owl-caroulsel', plugins_url('/easy-slider/assets/vendor/owl-carousel/assets/owl.carousel.min.css'));
        wp_register_style('owl-default', plugins_url('/easy-slider/assets/vendor/owl-carousel/assets/owl.theme.default.min.css'));
        wp_register_style('easy-slider', plugins_url('/easy-slider/assets/public/easy-slider.css'));
        wp_register_script('owl-caroulsel', plugins_url('/easy-slider/assets/vendor/owl-carousel/owl.carousel.min.js'), array('jquery'), false, true);
        wp_register_script('easy-slider', plugins_url('/easy-slider/assets/public/easy-slider.js'), array('jquery'), false, true);

    }

}