$(document).ready(function() {
  dropZoneGo();
});

var dropzone;
var img_count = 0, pdf_count = 0, zip_count = 0;

var dropZoneGo = function() {

Dropzone.autoDiscover = false;

dropzone = new Dropzone("#dropzone", {
  paramName: "file",
  url: "/documents/upload",
  acceptedFiles: '.pdf,.zip,.jpg,.jpeg,.png',
  addRemoveLinks: true,
  maxFilesize: 20,
  maxFiles: 5,
  uploadMultiple: false,
  accept: function(file, done) {
    if(isImage(file)) {
      if(img_count == 3) {
        $('.bottom-left').notify({
          message: { html: '<p><strong>Whoops! </strong> You have already uploaded 3 images. Remove one of them to upload a new image</p>' },
          type: 'warning',
          fadeOut: {
            delay: 8500
          }
        }).show();
        done("You have already uploaded 3 images");
      }
      else done();
    }
    else if(isPDF(file)) {
      if(pdf_count == 1) {
        $('.bottom-left').notify({
          message: { html: '<p><strong>Whoops! </strong> You have already uploaded 1 PDF. Remove it to upload a new PDF</p>' },
          type: 'warning',
          fadeOut: {
            delay: 8500
          }
        }).show();
        done("You have already uploaded 1 PDF");
      }
      else done();
    }
    else {
      if(zip_count == 1) {
        $('.bottom-left').notify({
          message: { html: '<p><strong>Whoops! </strong> You have already uploaded 1 ZIP. Remove it to upload a new ZIP</p>' },
          type: 'warning',
          fadeOut: {
            delay: 8500
          }
        }).show();
        done("You have already uploaded 1 zip");
      }
      else done();
    }
  }
});

dropzone.on("success", function(file, response) {
  $(file.previewTemplate).children('div.dz-details').children('.dz-filepath').children('span').html(response.path);
  if(isImage(file)) img_count++;
  else if(isPDF(file)) pdf_count++;
  else zip_count++;
});

dropzone.on("removedfile", function(file) {
  if($(file.previewTemplate).hasClass('dz-error')) return 0;
  var server_file = $(file.previewTemplate).children('div.dz-details').children('.dz-filepath').children('span').text();
  if(isImage(file)) img_count--;
  else if(isPDF(file)) pdf_count--;
  else zip_count--;
  $.post('/documents/remove', { name : server_file })
    .done(function(data) {});
});

};

var getExt = function(file) {
  return file.name.substr(file.name.lastIndexOf('.')+1);
};

var isImage = function(file) {
  var ext = getExt(file);
  if(ext == 'jpg' || ext == 'jpeg' || ext == 'png') return true;
  return false;
}

var isPDF = function(file) {
  var ext = getExt(file);
  if(ext == 'pdf') return true;
  return false;
}

var isZIP = function(file) {
  var ext = getExt(file);
  if(ext == 'zip') return true;
  return false;
}

$('#showcase_add').submit(function() {
  var error = false;
  var help = $('#dz-helper');
  var first = false;
  var st = "";
  $.each(dropzone.getAcceptedFiles(), function(index, file) {
    if(first) st+=",";
    st+=$(file.previewTemplate).children('div.dz-details').children('.dz-filepath').children('span').text();
    first = true;
  });
  help.val(st);
  if(img_count < 3) {
    error = true;
    $('.bottom-left').notify({
      message: { html: '<p><strong>Hey! </strong> You must upload 3 images</p>' },
      type: 'danger',
      fadeOut: {
        delay: 8500
      }
    }).show();
  }
  if(pdf_count < 1) {
    error = true;
    $('.bottom-left').notify({
      message: { html: '<p><strong>Hey! </strong> You must upload 1 PDF</p>' },
      type: 'danger',
      fadeOut: {
        delay: 8500
      }
    }).show();
  }
  if(error) return false;
});