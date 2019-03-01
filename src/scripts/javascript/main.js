$( document ).ready(function() {
    ClassicEditor
        .create( document.querySelector( '#editor' ) , {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'image' ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: '' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: '' }
                ]
            },

            ckfinder: {
                // Open the file manager in the pop-up window.
                openerMethod: 'popup'
            },

            wordcount: {
                showParagraphs: false,
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: false,
                countHTML: false,
                maxWordCount: -1,
                maxCharCount: 5000
            }
        } )
        .then( editor => {
            window.editor = editor;
        })
        .catch( err => {
            console.error( err.stack );
        });
    
    var submit = false;
    $('.editorCreate').submit( function(event) {
        if(submit == false) {
            event.preventDefault();
            
            var html = editor.getData();
            $("#textCreate").val(html);
            
            submit = true;
            $('.editorCreate').submit
        }
    });
});

