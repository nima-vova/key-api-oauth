<?php
/**
 * Created by PhpStorm.
 * User: nima
 * Date: 24.02.17
 * Time: 17:58
 */

namespace AppBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\Entity\User\User;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * Class OAuthUserProvider
 * @package AppBundle\Security\Core\User
 */
class OAuthUserProvider extends BaseClass
{


    private  $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }


    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $socialID = $response->getUsername();
        //$user = $this->userManager->findUserBy(array($this->getProperty($response)=>$socialID));
        $email = $response->getEmail();
        $accessToken = $response->getAccessToken();
        dump(strlen($accessToken));

        $user= new User();
        $user->setUsername($email);
        //$user->setApiKey($apiKey);
        $user->setSocialkaToken($accessToken);
        $em = $this->registry->getManager();
        $em->persist($user);
        $em->flush();

        $token = new UsernamePasswordToken($email, null, "secured_area", $user->getRoles("fecebook"));




        //check if the user already has the corresponding social account
        //if (null === $user) {
            //check if the user has a normal account
            //$user = $this->userManager->findUserByEmail($email);

        //    if (null === $user || !$user instanceof UserInterface) {
                //if the user does not have a normal account, set it up:
          //      $user = $this->userManager->createUser();
            //    $user->setEmail($email);
                //$user->setPlainPassword(md5(uniqid()));
              //  $user->setEnabled(true);
               // $user-setUsername($email);
          //  }
            //then set its corresponding social id
          /*  $service = $response->getResourceOwner()->getName();
            switch ($service) {
                case 'google':
                    $user->setGoogleID($socialID);
                    break;
                case 'facebook':
                    $user->setFacebookID($socialID);
                   break; */
           // }

        //    $this->userManager->updateUser($user);
        } /*else {
            //and then login the user
            $checker = new UserChecker();
            $checker->checkPreAuth($user);
        }
*/
       // return $user;
    //}
}