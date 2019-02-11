$( document ).ready(function() {
    ClassicEditor
        .create( document.querySelector( '#editor' ) , {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: '' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: '' }
                ]
            }
        } )
        .then( editor => {
            window.editor = editor;
        })
        .catch( err => {
            console.error( err.stack );
        });

    $('.editorCreate').submit( function(event) {
        var html = editor.getData();
        $("#textCreate").val(html);
    });
});

