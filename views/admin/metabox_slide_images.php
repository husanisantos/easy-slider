<div>

    <label for="slide_images"></label>
    <input type="button" id="upload_slides_images" class="button button-large button-primary" value="<?php _e('Selecionar Imagens', 'easy-slider') ?>">
    <ul id="slides_images_list">
        <?php 
        if ($slides) :
            $count = 0;
            foreach ($slides as $image_id) :
                $image_url = wp_get_attachment_image_url($image_id, 'large');
                $link = json_decode($links[$count], true);

                $attributes  = !empty($link['url']) ? ' url="' . $link['url'] . '"' : '';
                $attributes .= !empty($link['text']) ? ' text="' . $link['text'] . '"' : '';
                $attributes .= !empty($link['target']) ? ' target="' . $link['target'] . '"' : '';

                ?>
                <li>
                    <div class="move">
                        <span class="dashicons dashicons-move"></span>
                    </div>
                    <img src="<?php echo esc_url($image_url); ?>" alt="Slide Image">
                    <div class="w-100">
                        <?php if(!empty($link['url'])) { ?>
                            <a href="#" class="link-selector button button-primary" <?php echo $attributes ?>><?php _e('Modificar link', 'easy-slider')?></a>
                        <?php } else { ?>
                            <a href="#" class="link-selector button" <?php echo $attributes ?>><?php _e('Adicionar Link', 'easy-slider')?></a>
                        <?php } ?>
                        <input type="hidden" name="slide_links[]" value='<?php echo $links[$count] ?>'>
                    </div>
                    <input type="hidden" name="slide_images[]" value="<?php echo esc_attr($image_id); ?>">

                    <div class="delete">
                        <a href="#" class="button button-primary"><?php _e('Remover', 'easy-slider') ?></a>
                    </div>
                </li>
            <?php 
            $count ++;
            endforeach;
        endif; ?>
    </ul>
</div>