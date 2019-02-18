<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;


class SignUpController extends Controller
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @Route("/auth/isAuthenticated", methods={"get"})
     */
    public function isAuthenticated()
    {
        $request = Request::createFromGlobals();
        $token = str_replace("Bearer ","",$request->headers->get("Authorization"));
        $em = $this->getDoctrine()->getRepository(User::class);
        $user = $em->findOneBy(array('apiToken'  => $token));
        $users = $em->findAll();
        if( $user  != null){
            return new Response(json_encode(array('ok' => true)),Response::HTTP_OK,array('content-type' => 'application/json'));
        }
        return new Response(json_encode(array('ok' => false)),Response::HTTP_UNAUTHORIZED,array('content-type' => 'application/json'));
       
    }

    /**
     * @Route("/signup", methods={"POST"})
     */
    public function postUserAction()
    {
        $request = Request::createFromGlobals();
        $user = new User();
        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setRoles('ROLE_USER');
        $password = $this->encoder->encodePassword($user, $request->get('password'));
        $user->setPassword($password);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
       
        $jsonContent = $this->getSerializer()->serialize($user, 'json');
        return new Response($jsonContent,Response::HTTP_OK,  array('content-type' => 'application/json'));
    }

    public function getSerializer() {
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());        
        return new Serializer($normalizers, $encoders);
    }

   
}