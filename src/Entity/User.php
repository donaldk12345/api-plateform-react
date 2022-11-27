<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`users`")
 * @ApiResource(
 * 
 *    itemOperations={
 * 
 *    "get"={
 *             "access_control"="is_granted('IS_AUTHENTICATED_FULLY')"
 *             
 *       }
 * 
 *   },
 *    collectionOperations={
 * 
 *    "post"
 * 
 *     },
 *    normalizationContext={
 *       "groups"={"user:read"} 
 *      }
 * 
 *   )
 * @UniqueEntity(fields={"email"},
 * message= "L'email que vous avez indiquez est déja utilisé !"
 * )
 */
class User implements UserInterface
{

    const ROLE_USER='ROLE_USER';
    const ROLE_ADMIN= 'ROLE_ADMIN';

    const DEFAULT_ROLES =   [self::ROLE_USER];


 /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read"})
     * @Assert\NotBlank()
     * @Assert\Length(min=4, max=255)
     */
    private $username;


    /**
     * @Groups({"user:read"})
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8",minMessage="Votre mot de passe doit faire minimum 8 caractères")
     * @Assert\EqualTo(propertyPath="confirm_password",message="Votre mot de passe doit être le  même  ")
     * 
     */
    private $password;

     /**
     * @Assert\EqualTo(propertyPath="password",message="Votre mot de passe doit être le  même  ")
     * 
     */
    public  $confirm_password;


       /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    public function __construct()
    {
        $this->roles = self::DEFAULT_ROLES;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

       /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
    
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public  function eraseCredentials()
    {
        
    }

         /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
        
    }

  
}
