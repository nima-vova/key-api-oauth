<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User\User;



class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        /*$user=$this->getDoctrine()
            ->getRepository('AppBundle:User\User')
            ->findUsernameByApiKey('237797');
        //$username=$user->getUsername();
        $username=$user[0]['username'];
        dump($username); */
        return $this->render('index.html.twig');
    }
    /**
     * @Route("/api", name="apikey")
     */
    public function getApiKeyAction(Request $request)
    {



        $user= new User();
        $user->setUsername('anon.');

        $Key=rand(100000,500000);
        $apiKey=(string) $Key;
        $user->setApiKey($apiKey);
        //$user=$this->registry->getManager()
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();


        //dump($this->get('security.token_storage')->getToken()->getUser());
        return $this->render('index.html.twig', array('apiKey'=>$apiKey));
    }

    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("/connect/facebook", name="connect_facebook")
     */
    public function connectAction()
    {
        // will redirect to Facebook!



        //$scopes = ['email'];
        return $this->get('oauth2.registry')
            ->getClient('facebook_main') // key used in config.yml
            ->redirect();

    }

    /**
     * After going to Facebook, you're redirected back here
     * because this is the "redirect_route" you configured
     * in config.yml
     *
     * @Route("/connect/facebook/check", name="connect_facebook_check")
     */
    public function connectCheckAction(Request $request)
    {
        // ** if you want to *authenticate* the user, then
        // leave this method blank and create a Guard authenticator
        // (read below)

        /** @var \KnpU\OAuth2ClientBundle\Client\Provider\FacebookClient $client */
        $client = $this->get('oauth2.registry')
            ->getClient('facebook_main');

        try {
            // the exact class depends on which provider you're using
            /** @var \League\OAuth2\Client\Provider\FacebookUser $user */
            $userClient = $client->fetchUser();

            // do something with all this new power!
            //$user->getFirstName();
            $Key=rand(100000,500000);
            $apiKey=(string) $Key;

            $em=$this->getDoctrine()->getManager();
            $userFind = $em->getRepository('AppBundle:User\User')
                     ->findUserByUserName($userClient->getEmail());
            if($userFind){
                $userRefreshApikey = $em->getRepository('AppBundle:User\User')
                    ->find($userFind[0]['id']);
                $userRefreshApikey->setApiKey($apiKey);
                $em->persist($userRefreshApikey);
                $em->flush($userRefreshApikey);
            //dump($userFind[0]['id']);
                $request = $this->get('request');
                $routeName = $request->get('_route');
                dump($routeName);
            }
           else {


            $user= new User();
            $user->setUsername($userClient->getEmail());

            $Key=rand(100000,500000);
            $apiKey=(string) $Key;
            $user->setApiKey($apiKey);
            //$user=$this->registry->getManager()
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();




         }
            // ...
        } catch (IdentityProviderException $e) {
            // something went wrong!
            // probably you should return the reason to the user
            dump($e->getMessage());die;
        }


        // do something with all this new power!

       // dump($client);
        return $this->render('index.html.twig', array('apiKey'=>$apiKey));
    }

    /**
     * @Route("/secret", name="secret_part")
     */
    public function goToSecretPartAction(Request $request)
    {
        // replace this example code with whatever you need
        /*$user=$this->getDoctrine()
            ->getRepository('AppBundle:User\User')
            ->findUsernameByApiKey('237797');
        //$username=$user->getUsername();
        $username=$user[0]['username'];
        dump($username); */
        return $this->render('index.html.twig');
    }

}
