$(document).ready(function() {

var totalp = $('#total-part');
var tbody = $('#part-body');
var remp = $('#remove-part');
var addp = $('#add-part');

if(totalp.val() < 4) {
  addp.removeClass('disabled');
}

if(totalp.val() > 1) {
  remp.removeClass('disabled');
}

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