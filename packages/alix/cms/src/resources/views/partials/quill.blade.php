<script>
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['blockquote', 'code-block'],
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }], // outdent/indent
        [{
            'size': ['small', false, 'large', 'huge']
        }], // custom dropdown
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme
        // [{
        //     'font': []
        // }],
        [{
            'align': []
        }],
        ['image', 'link', 'video'],
        ['clean'] // remove formatting button
    ];
    var quill = new Quill('.editor', {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: '请输入',
        theme: 'snow'
    });

    quill.on('text-change', function(delta, oldDelta, source) {
        $("input[name='body']").val(quill.root.innerHTML);
    })
</script>
