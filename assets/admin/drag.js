jQuery(document).ready(function ($) {

    // Tornar o container soltável
    $('#slides_images_list').sortable({
        containment: "#slides_images_list",
        placeholder: "ui-state-highlight",
        ui: {
            handle: '.move',
            draggable: false
        }
    })

    $('#slides_images_list').disableSelection();

});