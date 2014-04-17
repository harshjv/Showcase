<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Picker Example</title>

    <script type="text/javascript">

      // The API developer key obtained from the Google Developers Console.
      var developerKey = 'AIzaSyBMHVJP9TH8gBxxtZo3YBT7elIRp4UvxuU';

      // The Client ID obtained from the Google Developers Console.
      var clientId = '593610837010.apps.googleusercontent.com';

      // Scope to use to access user's photos.
      var scope = ['https://www.googleapis.com/auth/photos', 'https://www.googleapis.com/auth/drive.readonly'];

      var pickerApiLoaded = false;
      var oauthToken;

      // Use the API Loader script to load google.picker and gapi.auth.
      function onApiLoad() {
        gapi.load('auth', {'callback': onAuthApiLoad});
        gapi.load('picker', {'callback': onPickerApiLoad});
      }

      function onAuthApiLoad() {
        window.gapi.auth.authorize(
            {
              'client_id': clientId,
              'scope': scope,
              'immediate': false
            },
            handleAuthResult);
      }

      function onPickerApiLoad() {
        pickerApiLoaded = true;
        createPicker();
      }

      function handleAuthResult(authResult) {
        if (authResult && !authResult.error) {
          oauthToken = authResult.access_token;
          createPicker();
        }
      }

      // Create and render a Picker object for picking user Photos.
      function createPicker() {
        if (pickerApiLoaded && oauthToken) {
          alert(oauthToken);
          var picker = new google.picker.PickerBuilder().
              enableFeature(google.picker.Feature.MULTISELECT_ENABLED).
              addView(google.picker.ViewId.DOCS).
              //addView(google.picker.ViewId.PHOTOS).
              //addView(google.picker.ViewId.PDFS).
              //addView(google.picker.ViewId.PRESENTATIONS).
              setOAuthToken(oauthToken).
              setDeveloperKey(developerKey).
              setCallback(pickerCallback).
              build();
          picker.setVisible(true);
        }
      }

      // A simple callback implementation.
      function pickerCallback(data) {
        var url = 'nothing';
        if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
          var doc = data[google.picker.Response.DOCUMENTS][0];
          url = doc[google.picker.Document.URL];
        }
        var message = 'You picked: ' + url;
        document.getElementById('result').innerHTML = message;
      }
    </script>
  </head>
  <body>
    <div id="result"></div>

    <!-- The Google API Loader script. -->
    <script type="text/javascript" src="https://apis.google.com/js/api.js?onload=onApiLoad"></script>
  </body>
</html>