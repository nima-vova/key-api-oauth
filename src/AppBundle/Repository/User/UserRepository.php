<?php

namespace AppBundle\Repository\User;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public $apikey;
    public function findUsernameByApiKey($apiKey){
        $qb = $this->createQueryBuilder('u');
        $qb->select('u.username')
            // ->from('User', 'u')
            ->where('u.apiKey =:api')
            ->setParameter('api', $apiKey);
        //->getQuery()
        //->getResult();
        return $qb->getQuery()->getResult();
    }
    public $id;
    public function findUserByFacebookId($id){
        $qb = $this->createQueryBuilder('u');
        $qb->select('u.id, u.username, u.facebookID')
            // ->from('User', 'u')
            ->where('u.facebookID =:name')
            ->setParameter('name', $id);
        //->getQuery()
        //->getResult();
        return $qb->getQuery()->getResult();
    }
}
