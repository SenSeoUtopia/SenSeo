<?php

class ForgotController extends Controller{

    function forgot($f3){

        $title = "Forgot Password";

        $site_key =  $f3->get('recaptcha_key');

        $f3->set('page', array('title'=> $title,'content' => 'forgot.htm','site_key' => $site_key));
    }

    function forgot_process($f3){

        $secret =  $f3->get('recaptcha_secret');

        $ip = $f3->get('IP');

        $get_recaptcha_response = $f3->get('POST.g-recaptcha-response');

        $recaptcha = new ReCaptcha\ReCaptcha($secret);

        $resp = $recaptcha->verify($get_recaptcha_response, $ip);
        if ($resp->isSuccess()) {

            echo "Passed";


        } else {
            $errors = $resp->getErrorCodes();

            $site_key =  $f3->get('recaptcha_key');
            $title = "Forgot Password";
            $f3->set('page', array('title'=> $title,'content' => 'forgot.htm','site_key' => $site_key,'errors' => $errors));

        }
    }
}