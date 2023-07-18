jQuery(document).ready(function($) {
    $('body').on('click', '.link-selector', function(e) {
        e.preventDefault();

        let button = $(this)

        // Abra o seletor de links do WordPress
        wpLink.open();


        if(button.attr('url') != '') {
            $( '#wp-link-url' ).val(button.attr('url'))
        }

        if(button.attr('text') != '') {
            $( '#wp-link-text' ).val(button.attr('text'))
        }

        if(button.attr('target') == 'on') {
            $( '#wp-link-target' ).prop('checked', true)
        }

     

        wpLink.update = function() {

           let url = $( '#wp-link-url' ).val();
           let text = $( '#wp-link-text' ).val();
           let target = $( '#wp-link-target' );

           if(target.is(':checked')) {
            target = 'on'
           } else {
            target = ''
           }

           if(url != '') {

                let data = {
                    url: url,
                    text: text,
                    target: target
                }

                button.attr(data);
            
                button.addClass('button-primary');
                button.html('Modificar link')
                button.next().val(JSON.stringify(data))

           } else {

                button.removeAttr('url text target');
                button.removeClass('button-primary');
                button.html('Adicionar link')
                button.next().val('')
                
           }
           wpLink.close()
        };

    });

    $('.delete a').on('click', function(e) {
        $(this).parents('li').eq(0).remove()
    });
});
