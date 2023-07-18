jQuery(document).ready(function($) {
    // Manipulação do botão "Selecionar Imagens"
    $('#upload_slides_images').on('click', function(e) {
        e.preventDefault();

        var imageFrame = wp.media({ 
            title: 'Selecione as Imagens',
            multiple: true,
            library: {
                type: 'image'
            },
            button: {
                text: 'Selecionar'
            }
        });

        imageFrame.on('select', function() {
            var selection = imageFrame.state().get('selection');
            var imageList = $('#slides_images_list');

            selection.map(function(attachment) {
                attachment = attachment.toJSON();
                var imageUrl = attachment.url;
                var imageId = attachment.id;

                $(`
                <li>
                    <div class="move">
                        <span class="dashicons dashicons-move"></span>
                    </div>
                    <img src="${imageUrl}" alt="Slide Image">
                    <input type="hidden" name="slide_images[]" value="${imageId}">
                    <div class="w-100">
                        <a href="#" class="link-selector button">Adicionar Link</a>
                        <input type="hidden" name="slide_links[]" value="">
                    </div>
                    <div class="delete">
                        <a href="#" class="button button-primary">Remover</a>
                    </div>
                </li>`
                ).appendTo(imageList);
            });
        });

        imageFrame.open();
    });

    // Manipulação do botão "Remover"
    $('#slides_images_list').on('click', '.remove-slide-image', function(e) {
        e.preventDefault();

        $(this).closest('li').remove();
    });
});
