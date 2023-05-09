// Theory Content add Success Popup

function showAddSuccessfulPopup() {

    // Show the popup
    document.getElementById("page-mask-add-success").style.display = "block";


    // Hide the popup after 3 seconds
    setTimeout(function () {
        document.getElementById("page-mask-add-success").style.display = "none";
    }, 2500);
}

// Theory Content add Unsuccess Popup

function showAddUnsuccessfulPopup() {

    // Show the popup
    document.getElementById("page-mask-add-unsuccess").style.display = "block";


    // Hide the popup after 3 seconds
    setTimeout(function () {
        document.getElementById("page-mask-add-unsuccess").style.display = "none";
    }, 2500);
}


// Check Availability of the User Given Section No.

$(document).ready(function () {
    $('#sectionNo').on('blur', function () {
        var contentId = $(this).val();
        $.ajax({
            url: '../../controller/contentCreatorController/theoryContentController/addTheoryContentController.php',
            type: 'POST',
            data: { contentId: contentId },
            success: function (response) {
                if (response == 'exists') {
                    $('#content_id_error').text('Content Id already exists!');
                }
            }
        });
    });
});



// Quill TextEditor

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

