<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Provider;
use App\Entity\Employee;
use App\Entity\Company;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class AppFixtures extends Fixture implements ContainerAwareInterface
{
    /*
    $userAdmin = new User();
    $userAdmin->setUsername('admin');
    $userAdmin->setPassword('test');

    $manager->persist($userAdmin);
    $manager->flush();

    $this->addReference('admin-user', $userAdmin);

    // in another fixture

    $userGroupAdmin = new UserGroup();
    $userGroupAdmin->setUser($this->getReference('admin-user')); 
    */
    private $encoder;

    const PROVIDERS_CANT = 5;
    const CLIENT_CANT = 20;
    const EMPLOYEES_CANT = 3;

    const SALES_CANT = 10;
    const PURCHASES_CANT = 4;
    const BUDGETS_CANT = 3; //(PRESUPUESTOS)

    const USERS_CANT = 28;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager )
    {
        try {
            $this->loadUsers($manager);
        $this->loadClients($manager);
        $this->loadEmployees($manager);
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        
	}

    private function loadClients(ObjectManager $manager)
    {
        $client = new Client();
        $client->setName($this->getRandomNombre());
        $client->setSurname($this->getRandomApellido());
        $client->setBirth($this->randomDate("01-01-1950","01-01-2018"));
        
        $manager->persist($client);
        $manager->flush();
    }

    private function loadEmployees(ObjectManager $manager)
    {
        $date= new \DateTime();
        $mybirth= $date->setTimestamp(strtotime("11-09-1990"));
        $employee = new Employee();
        $employee->setName("Fernando");
        $employee->setSurname("Lorca");
        $employee->setBirth($mybirth);
        $employee->setUser($this->getReference('userAdmin'));

        $manager->persist($employee);
        $manager->flush();
    }

	private function loadUsers(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $userAdmin = new User();
        $userAdmin->setUsername('ferlorca');
        $userAdmin->setEmail('fer@gmail.com');
        $userAdmin->setRoles('ROLE_ADMIN');
        $userAdmin->setApiToken('');
        $password = $this->encoder->encodePassword($userAdmin, '123456');
        $userAdmin->setPassword($password);
        $manager->persist($userAdmin);

        $userAdmin2 = new User();
        $userAdmin2->setUsername('alelieb');
        $userAdmin2->setEmail('ale@gmail.com');
        $userAdmin2->setRoles('ROLE_ADMIN');
        $userAdmin2->setApiToken('');
        $password2 = $this->encoder->encodePassword($userAdmin2, '123456');
        $userAdmin2->setPassword($password2);
        $manager->persist($userAdmin2);

        $userAdmin3 = new User();
        $userAdmin3->setUsername('marcote');
        $userAdmin3->setEmail('marcos@gmail.com');
        $userAdmin3->setRoles('ROLE_ADMIN');
        $userAdmin3->setApiToken('');
        $password3 = $this->encoder->encodePassword($userAdmin3, '123456');
        $userAdmin3->setPassword($password3);
        $manager->persist($userAdmin3);


        $users= array();
        $pass= array();
        foreach (range(1, self::USERS_CANT) as $i) {
            $nombre = $this->getRandomNombre();
            $users[$i] = new User();
            $users[$i]->setUsername($nombre.$this->getRandomApellido().$i);
            $users[$i]->setEmail($nombre.$i.'@gmail.com');
            $users[$i]->setApiToken('');
            $pass[$i] = $this->encoder->encodePassword($users[$i], '123456');
            $users[$i]->setPassword($pass[$i] );
            $manager->persist($users[$i]);
        }
        $manager->flush();

        $this->addReference('userAdmin', $userAdmin);
        $this->addReference('userAdmin2', $userAdmin2);
        $this->addReference('userAdmin3', $userAdmin3);
    }
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    private function getNombres()
    {
        return [
            "Aaron","Aaronit","Aba","Abaco","Abalen","Abbas","Abbie","Abbott",
            "Abdala","Abdas","Abdel","Abdias","Abdieso","Abdo","Abdon","Abdul","Abe","Abel","Abelardo","Abenamar",
            "Abencio","Abeni","Aberardo","Abercio","Abey","Abhay","Abi","Abia","Abibo","Abibon",
            "Abiel","Abigail","Abilio","Abira","Abisai","Abner","Abra","Gerardo","Pablo","Matias","Martin","Santiago",
            "Ramiro","Lucas","Alejo","Fernando","Mario","Roberto","Pepe","Juan","Pablo","Marcos","Alejandro",
            "Federico","Agustin","Rodolfo","Simon","Stefano","Ignacio",
            "Andres","Gonzalo"
        ];
    }

    private function getApellidos()
    {
        return [
            "Gonzales","Rodriguez","Lopez","Fernandez","Garcia","Perez","Martinez","Gomez",
            "Dias","Sanchez","Alvarez","Romero","Sosa","Ruiz","Torres","Suarez",
            "Castro","Gimenez","Vazquez","Acosta","Gutierrez","Pereyra","Ramirez","Flores","Benitez",
            "Aguirre","Molina","Ortiz","Medina","Herrera","Dominguez","Martin","Moreno","Rojas","Blanco",
            "Quiroga","Cabrera","Ferreyra","Peralta","Alonso","Silva","Morales","Luna","Mendez","Ramos",
            "Rios",
        ];
    }

    private function getPhrases()
    {
        return [
            'Lorem ipsum dolor sit amet consectetur adipiscing elit',
            'Pellentesque vitae velit ex',
            'Mauris dapibus risus quis suscipit vulputate',
            'Eros diam egestas libero eu vulputate risus',
            'In hac habitasse platea dictumst',
            'Morbi tempus commodo mattis',
            'Ut suscipit posuere justo at vulputate',
            'Ut eleifend mauris et risus ultrices egestas',
            'Aliquam sodales odio id eleifend tristique',
            'Urna nisl sollicitudin id varius orci quam id turpis',
            'Nulla porta lobortis ligula vel egestas',
            'Curabitur aliquam euismod dolor non ornare',
            'Sed varius a risus eget aliquam',
            'Nunc viverra elit ac laoreet suscipit',
            'Pellentesque et sapien pulvinar consectetur',
        ];
    }

    private function randomDate($start_date, $end_date)
    {
        // Convert to timetamps d-m-y => para date europeo   
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        $date =  new \DateTime();
        $date->setTimestamp($val);

        // Convert back to desired date format
        return  $date;
    }

    private function getRandomFrase()
    {
        $phrases = $this->getPhrases();

        $numPhrases = mt_rand(2, 15);
        shuffle($phrases);

        return implode(' ', array_slice($phrases, 0, $numPhrases-1));
    }

    private function getRandomNombre()
    {
        $titles = $this->getNombres();

        return $titles[array_rand($titles)];
    }

    private function getRandomApellido()
    {
        $titles = $this->getApellidos();

        return $titles[array_rand($titles)];
    }

}
