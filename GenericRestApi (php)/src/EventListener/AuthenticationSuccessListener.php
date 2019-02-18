<?php
// src/App/EventListener/AuthenticationSuccessListener.php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
class AuthenticationSuccessListener 
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event )
    {
          
        $data = $event->getData();
        $user = $event->getUser();
        
        if (!$user instanceof User) {
            return;
        }
        
    try{
        $user->setApiToken($data["token"]);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }

        $data['data'] = array(
            'roles' => $user->getRoles(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername()
        );

        $event->setData($data);
    }
}