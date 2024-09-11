<?php declare(strict_types=1);

namespace App\Entity;

use App\DataTransferObject\AdminRegistrationDTO;
use App\Model\AdminRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: 'admins')]
class Admin
{
    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column]
    private string $username;

    #[Column]
    private string $email;

    #[Column(name: 'password_hash')]
    private string $passwordHash;

    #[Column(name: 'created_at')]
    private DateTime $createdAt;

    #[Column(name: 'updated_at')]
    private DateTime $updatedAt;


    public function getId(): null
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @param mixed $created
     */
    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $created
     */
    public function setUpdated(DateTime $updated): void
    {
        $this->updated = $updated;
    }
}