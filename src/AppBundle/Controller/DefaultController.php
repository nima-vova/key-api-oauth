<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\AppBundle\Entity\User\User;

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

        //dump($this->get('security.token_storage')->getToken()->getUser());
        return $this->render('index.html.twig');
    }
}
