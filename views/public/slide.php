<div class="easy-slide owl-carousel owl-theme">
    <?php foreach($slides as $slide) : 
        $image = wp_get_attachment_image_url($slide, 'full')
        ?>
        <div class="item">
            <img src="<?= $image ?>"  alt="<?= get_the_title($slide) ?>" />
        </div>
    <?php endforeach; ?>    
</div>