<?php  



namespace  App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;


 class PasswordHashSubscriber implements  EventSubscriberInterface{

    /**
     * 
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder =$passwordEncoder;
    }

    public  static function getSubscribedEvents()
    {
        return [

            KernelEvents::VIEW  =>  ['hashPassword', EventPriorities::PRE_WRITE]
        ];
    }

    public function hashPassword(GetResponseForControllerResultEvent $event){
         $user= $event->getControllerResult();
         $method =$event->getRequest()->getMethod();
         
         if(!$user instanceof User || Request::METHOD_POST !==$method){
              return ;
         }

         $user->setPassword(
             $this->passwordEncoder->encodePassword($user , $user->getPassword()) 
         ) ;
    }
   

 }



