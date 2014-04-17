<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Picker Example</title>

    <script src="http://www.google.com/jsapi"></script>
<script type="text/javascript">   

    // Google Picker API for the Google Docs import
    function newPicker() {
        google.load('picker', '1', {"callback" : createPicker});
    }       

    // Create and render a Picker object for selecting documents
    function createPicker() {
        var picker = new google.picker.PickerBuilder().
            addView(google.picker.ViewId.DOCUMENTS).
            setCallback(pickerCallback).
            setOAuthToken("{{ Session::get('google_token') }}").
            build();
        picker.setVisible(true);
    }

    // A simple callback implementation which sets some ids to the picker values.
    function pickerCallback(data) {
        if(data.action == google.picker.Action.PICKED){
            document.getElementById('gdocs_resource_id').value = google.picker.ResourceId.generate(data.docs[0]);
            document.getElementById('gdocs_access_token').value = data.docs[0].accessToken;                  
        }
    }    
 </script>
  </head>
  <body>
    <a href="javascript:newPicker()" style="font-weight: bold">Import from your Google Docs</a>
  </body>
</html>