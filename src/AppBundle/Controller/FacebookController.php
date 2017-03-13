<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        /*$fb = new \Facebook\Facebook([
            'app_id' => '156169728227865',
            'app_secret' => '38375a80032be5d22e136f32b7f37c47',
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

*/
        $accessToken = $request->headers->get('token');
        $UserFacebook = $this->get('service_facebook_sdk');
        $UserFacebook->setValue($accessToken);
        $UserFacebook = $UserFacebook->getValue();
        dump($UserFacebook);
        echo $UserFacebook->getEmail();

        $Key=rand(100000,500000);
        $apiKey=(string) $Key;

        $em=$this->getDoctrine()->getManager();
        $userFind = $em->getRepository('AppBundle:User\User')
            ->findUserByUserName($UserFacebook->getEmail());
        if($userFind){
            $userRefreshApikey = $em->getRepository('AppBundle:User\User')
                ->find($userFind[0]['id']);
            $userRefreshApikey->setApiKey($apiKey);
            $em->persist($userRefreshApikey);
            $em->flush($userRefreshApikey);

            //dump($userFind[0]['id']);
            //$request = $this->get('request');
            //$routeName = $request->get('_route');
            //dump($routeName);
        }
        else {


            $user= new User();
            $user->setUsername($UserFacebook);

            $Key=rand(100000,500000);
            $apiKey=(string) $Key;
            $user->setApiKey($apiKey);
            //$user=$this->registry->getManager()
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();




        }


        //dump($this->get('security.token_storage')->getToken()->getUser());
        return $this->render('facebook_sdk.html.twig');
    }



}
