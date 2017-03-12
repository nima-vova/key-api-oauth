<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User\User;
use \Facebook;


class FacebookController extends Controller
{

    /**
     * @Route("/sdk", name="facebook_sdk")
     */
    public function connectFacebookSdkAction(Request $request)
    {
        $fb = new \Facebook\Facebook([
            'app_id' => '',
            'app_secret' => '',
            'default_graph_version' => 'v2.8',
            //'default_access_token' => 'EAACNyCNIZAEABAP3YNSGcmL8qzSosUeEfYnjDlBLmcOga81xBBsWoR0nkWhPe8YXga3VpKgZC56oHzPi7X9iPGZAZCT2e0oob4HUdxUaEcZBEGJyRLUFBPLL33V4zW3ViiHDLDa8rYplRjbt7zHWK71g9RBGJu09FUfqIaMJAh1tUtMYAhislgAFZAaONFJAMZD',
        ]);
        $helper = $fb->getJavaScriptHelper();
        //$accessToken = $helper->getAccessToken();
        //dump($accessToken);
        $accessToken = $request->headers->get('token');

        $fb->setDefaultAccessToken($accessToken);

        try {
            $response = $fb->get('/me?fields=id,name,email');
            $userNode = $response->getGraphUser();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        echo 'Logged in as ' . $userNode->getEmail();
       dump($userNode);
        //echo 'Logged in as ' . $me->getName();



        //dump($this->get('security.token_storage')->getToken()->getUser());
        return $this->render('facebook_sdk.html.twig');
    }



}
