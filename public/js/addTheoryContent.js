var toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'], // toggled buttons
    ['blockquote', 'code-block'],
    [{
        'list': 'ordered'
    }, {
        'list': 'bullet'
    }],
    [{
        'script': 'sub'
    }, {
        'script': 'super'
    }], // superscript/subscript
    [{
        'indent': '-1'
    }, {
        'indent': '+1'
    }], // outdent/indent
    [{
        'direction': 'rtl'
    }], // text direction

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
    [{
        'font': []
    }],
    [{
        'align': []
    }],
    ['link', 'image'],

    ['clean'] // remove formatting button
];
var options = {
    modules: {
        toolbar: toolbarOptions
    },
    debug: 'info',
    placeholder: 'Compose an epic...',
    readOnly: false,
    theme: 'snow'
};
var container = document.getElementById("editorcontent1");
var editor = new Quill(container, options);

function addContentOnSubmit() {
    var addhtml = document.getElementById("editorcontent1").children[0].innerHTML;
    document.getElementById("editor1").value = addhtml;
}