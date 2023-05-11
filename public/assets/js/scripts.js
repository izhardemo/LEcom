/*
NOTE:
------
PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
  }
});

// Sweetalert
var Swal = Swal.mixin({
  position: 'center',
  showConfirmButton: true,
  confirmButtonText: 'Yes',
  customClass: {
    confirmButton: 'btn btn-gradient-primary btn-sm fs-6',
    cancelButton: 'btn btn-gradient-danger btn-sm ms-2 fs-6'
  },
  showClass: {
    popup: 'animate__animated animate__bounceIn'
  },
  hideClass: {
    popup: 'animate__animated animate__fadeOutDown'
  },
  buttonsStyling: false,
});

// create slug
function createSlug(e) {
  var str = e.value;
  str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//replace stapces with dash
  document.querySelector('input[data-slug="slug"]').value = str;
}

// Delete data with sweetalert
function deleteConfirm(event) {
  event.preventDefault();
  // Don't change deleteNav value
  var deleteNav = event.currentTarget.firstElementChild;
  Swal.fire({
    title: 'Are you sure want to delete?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    customClass: {
      confirmButton: 'btn btn-gradient-danger btn-sm fs-6',
      cancelButton: 'btn btn-gradient-dark btn-sm ms-1 fs-6'
    },
  }).then((result) => {
    if (result.isConfirmed) {
      deleteNav.submit();
      swal_success_alert('Successfully Deleted!');
    }
  });
}

//check all checkboxes
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
var x = document.querySelector('#checkall');

function checkAll(val) {
  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i] != val) {
      checkboxes[i].checked = val.checked;
      $('.btn-table-delete').show();
    } else {
      $('.btn-table-delete').hide();
    }
  }
  if (x.checked == true) {
    $('.btn-table-delete').show();
  } else {
    $('.btn-table-delete').hide();
  }
}

function check(val) {
  var checkbox = document.querySelectorAll('.checkbox:checked');

  if (checkbox.length > 0) {
    $('#checkall').prop('indeterminate', true);
    $('.btn-table-delete').show();
  } else {
    $('#checkall').prop('indeterminate', false);
    $('.btn-table-delete').hide();
  }

  if (val.checked == true) {
    if (checkbox.length + 1 == checkboxes.length) {
      $('#checkall').prop('indeterminate', false);
      x.checked = true;
    }
  } else {
    x.checked = false;
  }
}

// tinymce
var directionality = "ltr";

function init_tinymce(selector, min_height) {
  var menu_bar = 'file edit view insert format tools table help';
  if (selector == 'textarea.tinyMCEQuiz' || selector == 'textarea#basic-example') {
    menu_bar = false;
  }
  tinymce.init({
    selector: selector,
    height: min_height,
    valid_elements: '*[*]',
    relative_urls: false,
    remove_script_host: false,
    directionality: directionality,
    language: 'en',
    menubar: menu_bar,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code codesample fullscreen",
        "insertdatetime media table paste imagetools help wordcount"
    ],
    toolbar: 'undo redo | formatselect | fullscreen code preview | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | forecolor backcolor removeformat | image media link | outdent indent | help',
    content_css: ['../../assets/plugins/tinymce/editor_content.css'],
  });
  tinymce.DOM.loadCSS('../../assets/plugins/tinymce/editor_ui.css');
}

if ($('textarea.tinyMCEsmall').length > 0) {
  init_tinymce('textarea.tinyMCEsmall', 300);
}

/* Toastr Notifications */
function toastr_success_noti(message,title) {
  toastr['success'](
    message,title ? title : 'Success!',
    {
      closeButton: title ? false : true,
      progressBar: title ? false : true,
      tapToDismiss: true,
      positionClass: 'toast-top-right',
      showMethod: 'slideDown',
      hideMethod: 'slideUp',
      timeOut: 2000,
      rtl: isRtl
    }
  );
}

function toastr_info_noti(message,title) {
  toastr['info'](
    message,title ? title : 'Information!',
    {
      closeButton: true,
      progressBar: true,
      showMethod: 'slideDown',
      hideMethod: 'slideUp',
      timeOut: 10000,
      rtl: isRtl
    }
  );
}

function toastr_warning_noti(message,title) {
  toastr['warning'](
    message,title ? title : 'Warning!',
    {
      closeButton: true,
      progressBar: true,
      showMethod: 'slideDown',
      hideMethod: 'slideUp',
      timeOut: 3000,
      rtl: isRtl
    }
  );
}

function toastr_error_noti(message,title) {
  toastr['error'](
    message,title ? title : 'Error!',
    {
      closeButton: true,
      progressBar: true,
      showMethod: 'slideDown',
      hideMethod: 'slideUp',
      timeOut: 5000,
      rtl: isRtl
    }
  );
}

// Alert
function swal_success_alert(message) {
  Swal.fire({
      icon: 'success',
      text: message,
      confirmButtonText: 'OK',
      customClass: {
          confirmButton: 'btn btn-gradient-success btn-sm fs-6'
      },
      timer: 1500,
  });
}

function swal_error_alert(message) {
  Swal.fire({
      icon: 'error',
      text: message,
      confirmButtonText: 'OK',
      customClass: {
          confirmButton: 'btn btn-gradient-danger btn-sm fs-6'
      },
      timer: 1500,
  });
}

function swal_warning_alert(message) {
  Swal.fire({
      icon: 'warning',
      text: message,
      confirmButtonText: 'OK',
      customClass: {
          confirmButton: 'btn btn-gradient-warning btn-sm fs-6'
      },
      timer: 1500,
  });
}

function swal_info_alert(message) {
  Swal.fire({
      icon: 'info',
      text: message,
      confirmButtonText: 'OK',
      customClass: {
          confirmButton: 'btn btn-gradient-info btn-sm fs-6'
      },
      timer: 1500,
  });
}