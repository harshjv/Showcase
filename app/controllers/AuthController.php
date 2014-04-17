<?php

class AuthController extends BaseController {

  public function google() {

    // get data from input
    $code = Input::get('code');

    // get google service
    $googleService = OAuth::consumer('Google');

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from google, get the token
        $token = $googleService->requestAccessToken($code);

        echo $token->getAccessToken();

        //echo $token;

        echo "<br><br>";
        Session::forget('google_token');
        Session::put('google_token', $token->getAccessToken());
        Session::put('harsh', "hello Pal");

        // Send a request with it
        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true);

        $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
        echo $message. "<br/>";

        //Var_dump
        //display whole array().
        dd($result);

    }
    // if not ask for permission first
    else {
        // get googleService authorization
        $url = $googleService->getAuthorizationUri();
        // return to facebook login url
        return Redirect::to((string)$url);
    }
  }


}