<?php

namespace App;

class Post_Type extends Easy_Slider {

    public function __construct()
    {
        add_action('init', [$this, 'post_types']); 
        add_filter('manage_edit-slides_columns', [$this, 'add_image_column']); 
        add_action('manage_slides_posts_custom_column', [ $this, 'fill_image_column'], 10, 2);
        add_filter('manage_edit-slides_sortable_columns', [ $this, 'make_image_column_sortable']);
        add_action('admin_enqueue_scripts', [$this, 'image_collum_enqueue_scripts'] );
        add_filter('manage_edit-slides_columns', [$this, 'add_slide_shortcode_column']);
        add_action('manage_slides_posts_custom_column', [ $this, 'fill_slide_shortcode_column'], 10, 2); 

    }
    
    public function post_types() {
        $this->slides_post_type();
    }

    private function slides_post_type() {

        $labels = array(
            'name'                  => _x( 'Easy Slider', 'Easy Slider General Name', 'easy-slider' ),
            'singular_name'         => _x( 'Easy Slider', 'Easy Slider Singular Name', 'easy-slider' ),
            'menu_name'             => __( 'Slides', 'easy-slider' ),
            'name_admin_bar'        => __( 'Slides', 'easy-slider' ),
            'archives'              => __( 'Arquivos', 'easy-slider' ),
            'attributes'            => __( 'Atributos', 'easy-slider' ),
            'parent_item_colon'     => __( 'Item Pai:', 'easy-slider' ),
            'all_items'             => __( 'Todos os slides', 'easy-slider' ),
            'add_new_item'          => __( 'Add New Slide', 'easy-slider' ),
            'add_new'               => __( 'Add New', 'easy-slider' ),
            'new_item'              => __( 'New Slide', 'easy-slider' ),
            'edit_item'             => __( 'Edit Slide', 'easy-slider' ),
            'update_item'           => __( 'Update Slide', 'easy-slider' ),
            'view_item'             => __( 'View Slide', 'easy-slider' ),
            'view_items'            => __( 'View Slides', 'easy-slider' ),
            'search_items'          => __( 'Search Slide', 'easy-slider' ),
            'not_found'             => __( 'Not found', 'easy-slider' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'easy-slider' ),
            'featured_image'        => __( 'Featured Image', 'easy-slider' ),
            'set_featured_image'    => __( 'Set featured image', 'easy-slider' ),
            'remove_featured_image' => __( 'Remove featured image', 'easy-slider' ),
            'use_featured_image'    => __( 'Use as featured image', 'easy-slider' ),
            'insert_into_item'      => __( 'Insert into slide', 'easy-slider' ),
            'uploaded_to_this_item' => __( 'Uploaded to this slide', 'easy-slider' ),
            'items_list'            => __( 'Slides list', 'easy-slider' ),
            'items_list_navigation' => __( 'Slides list navigation', 'easy-slider' ),
            'filter_items_list'     => __( 'Filter Slides list', 'easy-slider' ),
        );
        $args = array(
            'label'                 => __( 'Slide', 'easy-slider' ),
            'description'           => __( 'Slide Description', 'easy-slider' ),
            'labels'                => $labels,
            'supports'              => array( 'editor','title' ),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'slides', $args );

    }


    public function add_image_column($columns) {
        $new_columns = array(
            'cb' => $columns['cb'],
            'images' => __('Imagens', 'easy-slider')
        );
        unset($columns['cb']);
        return $new_columns + $columns;
    }

    public function fill_image_column($column, $post_id) {
        if ($column === 'images') {
            $slides  = get_post_meta($post_id, 'slide_images', true);
            $counter = 0;
            foreach($slides as $slide) {
                $this->view('admin/horizontal-images-thumb', ['slide' => $slide]);
                $counter++;

                if ($counter >= 4) {
                    break; 
                }
            }
        }
    }

    public function make_image_column_sortable($columns) {
        $columns['images'] = 'images';
        return $columns;
    }

    public function image_collum_enqueue_scripts() {
        $screen = get_current_screen();
        if($screen->post_type == 'slides') {
            wp_enqueue_style('admin-slides', plugins_url('/easy-slider/assets/admin/admin.css'));
        }
    }


    public function add_slide_shortcode_column($columns) {

        $new_columns = array(
            'shortcode' => __('Shortcode', 'easy-slider'),
            'date' => $columns['date'],
        );
        unset($columns['date']);
        return $columns + $new_columns;

    }

    public function fill_slide_shortcode_column($column, $post_id) {
        if ($column === 'shortcode') {
            echo "<input readonly type='text' value='[easy id=\"$post_id\"]'>";
        }
    }

}