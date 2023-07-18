<?php

namespace App;

class Metabox extends Easy_Slider {

    public function __construct() {
        add_action('add_meta_boxes', [$this, 'register_slides_metabox']);
        add_action('save_post_slides', [$this, 'slides_image_metabox_save'] );
        add_action('admin_enqueue_scripts', [$this, 'enqueue_slides_admin_scripts'] );
    }

    public function slides_image_metabox_callback() {
        global $post;
        $slides = get_post_meta($post->ID, 'slide_images', true);
        $links  = get_post_meta($post->ID, 'slide_links', true);

        $this->view('admin/metabox_slide_images', [
            'slides' => $slides,
            'links' => $links
        ]);
    }

    public function slides_image_metabox_save($post_id) {
        if (isset($_POST['slide_images'])) {
            $slide_images = (array) $_POST['slide_images'];
            update_post_meta($post_id, 'slide_images', $slide_images);
        } else {
            delete_post_meta($post_id, 'slide_images');
        }

        if (isset($_POST['slide_links'])) {
            $slide_links  = (array) $_POST['slide_links'];
            update_post_meta($post_id, 'slide_links', $slide_links);

        } else {
            delete_post_meta($post_id, 'slide_links');
        }
    }

    public function register_slides_metabox() {
        add_meta_box('slides_image_metabox', 'Imagens', [$this, 'slides_image_metabox_callback'], 'slides', 'normal', 'high');
    }

    public function enqueue_slides_admin_scripts($hook) {
        
        $screen = get_current_screen();
        if ($hook === 'post.php' || $hook === 'post-new.php' && $screen->post_type === 'slides') {
            wp_enqueue_media();
            wp_enqueue_script('wplink');
            wp_enqueue_style( 'editor-buttons' );

            wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array('jquery'), false, true);

            wp_enqueue_style('jquery-ui-base', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
            wp_enqueue_style('admin-metabox', plugins_url('/easy-slider/assets/admin/admin.css'));

            wp_enqueue_script('slides-media-script', plugins_url('/easy-slider/assets/admin/media.js'), array('jquery'), false, true);
            wp_enqueue_script('slides-drag-script', plugins_url('/easy-slider/assets/admin/drag.js'), array('jquery'), false, true);
            wp_enqueue_script('slides-buttons-script', plugins_url('/easy-slider/assets/admin/buttons.js'), array('jquery'), false, true);

        }

    }

}

