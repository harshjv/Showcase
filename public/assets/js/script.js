$(function () {

    $('#upload_image').fileupload({
        add: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          $('#upload_image').prop('disabled', true).hide();
          data.context = $('<a>').text('Upload '+filename).addClass('btn btn-warning btn-block btn-upload')
            .appendTo($('#image_helper'))
            .click(function () {
              data.context.text('Uploading '+filename);
              data.submit();
            });
        },
        done: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          if(data.result.success) {
            data.context.text('Done uploading '+filename).removeClass('btn-warning').addClass('btn-success disabled');
            $('#image_file').val(data.result.file);
            $('#thumbnail_title').fadeIn();
            $('#thumbnail_view').prop('src', data.result.thumbnail).fadeIn();
            $('#thumbnail_file').val(data.result.thumbnail);
          }
          else {
            data.context.text('Failed uploading '+filename).removeClass('btn-warning').addClass('btn-danger disabled');
          }
        },
        dataType: 'json',
        maxFileSize: 50000000
    });

    $('#upload_thumbnail').fileupload({
        add: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          $('#upload_thumbnail').prop('disabled', true).hide();
          data.context = $('<a>').text('Upload '+filename).addClass('btn btn-warning btn-block btn-upload')
            .appendTo($('#thumbnail_helper'))
            .click(function () {
              data.context.text('Uploading '+filename);
              data.submit();
            });
        },
        done: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          if(data.result.success) {
            data.context.text('Done uploading '+filename).removeClass('btn-warning').addClass('btn-success disabled');
            $('#thumbnail_file').val(data.result.file);
            //$('#thumbnail_title').fadeIn();
            //$('#thumbnail_view').prop('src', data.result.thumbnail).fadeIn();
          }
          else {
            data.context.text('Failed uploading '+filename).removeClass('btn-warning').addClass('btn-danger disabled');
          }
        },
        dataType: 'json',
        maxFileSize: 50000000
    });

    $('#upload_pdf').fileupload({
        add: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          $('#upload_pdf').prop('disabled', true).hide();
          data.context = $('<a>').text('Upload '+filename).addClass('btn btn-warning btn-block btn-upload')
            .appendTo($('#pdf_helper'))
            .click(function () {
              data.context.text('Uploading '+filename);
              data.submit();
            });
        },
        done: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          if(data.result.success) {
            data.context.text('Done uploading '+filename).removeClass('btn-warning').addClass('btn-success disabled');
            $('#pdf_file').val(data.result.file);
          }
          else {
            data.context.text('Failed uploading '+filename).removeClass('btn-warning').addClass('btn-danger disabled');
          }
        },
        dataType: 'json',
        acceptFileTypes: /(\.|\/)(pdf)$/i,
        maxFileSize: 50000000
    });

    $('#upload_ppt').fileupload({
        add: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          $('#upload_ppt').prop('disabled', true).hide();
          data.context = $('<a>').text('Upload '+filename).addClass('btn btn-warning btn-block btn-upload')
            .appendTo($('#ppt_helper'))
            .click(function () {
              data.context.text('Uploading '+filename);
              data.submit();
            });
        },
        done: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          if(data.result.success) {
            data.context.text('Done uploading '+filename).removeClass('btn-warning').addClass('btn-success disabled');
            $('#ppt_file').val(data.result.file);
          }
          else {
            data.context.text('Failed uploading '+filename).removeClass('btn-warning').addClass('btn-danger disabled');
          }
        },
        dataType: 'json',
        acceptFileTypes: /(\.|\/)(ppt)$/i,
        maxFileSize: 50000000
    });

    $('#upload_zip').fileupload({
        add: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          $('#upload_zip').prop('disabled', true).hide();
          data.context = $('<a>').text('Upload '+filename).addClass('btn btn-warning btn-block btn-upload')
            .appendTo($('#zip_helper'))
            .click(function () {
              data.context.text('Uploading '+filename);
              data.submit();
            });
        },
        done: function (e, data) {
          var filename = "";
          $.each(data.files, function (index, file) {
            filename+=file.name;
          });
          if(data.result.success) {
            data.context.text('Done uploading '+filename).removeClass('btn-warning').addClass('btn-success disabled');
            $('#zip_file').val(data.result.file);
          }
          else {
            data.context.text('Failed uploading '+filename).removeClass('btn-warning').addClass('btn-danger disabled');
          }
        },
        dataType: 'json',
        acceptFileTypes: /(\.|\/)(zip)$/i,
        maxFileSize: 50000000
    });

var totalp = $('#total-part');
var tbody = $('#part-body');
var remp = $('#remove-part');
var addp = $('#add-part');

addp.click(function() {

  var part = 1;
  var cur_p = parseInt(totalp.val());

  if(cur_p == 1) remp.removeClass('disabled');

  if(cur_p == 3) addp.addClass('disabled');

  part = cur_p + 1;
  totalp.val(part);

  
  var html = '<tr>'
    +'<td><input class="form-control" type="text" name="part_'+part+'_name" required autocomplete="off"></td>'
    +'<td><input class="form-control" type="email" name="part_'+part+'_email" required autocomplete="off"></td>'
    +'<td><input class="form-control" type="text" name="part_'+part+'_enrollment" required autocomplete="off"></td>'
    +'</tr>';

  tbody.append(html);

});

remp.click(function() {

  var cur_p = parseInt(totalp.val());

  if(cur_p == 4) addp.removeClass('disabled');

  if(cur_p == 2) remp.addClass('disabled');

  part = cur_p - 1;
  totalp.val(part);

  tbody.children('tr:last-child').remove();

});

});