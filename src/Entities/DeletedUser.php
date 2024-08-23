<?php
// src/Product.php

namespace Application\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'deleted_users')]
class DeletedUser
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id = null;
    #[ORM\Column(type: 'string')]
    private $email;
    #[ORM\Column(type: 'datetime')]
    private $deleted_time;
    #[ORM\Column(type: 'datetime')]
    private $created;
    #[ORM\Column(type: 'datetime')]
    private $updated;

    public function getId(): null
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
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

    /**
     * @return mixed
     */
    public function getDeletedTime()
    {
        return $this->deleted_time;
    }

    /**
     * @param mixed $deleted_time
     */
    public function setDeletedTime($deleted_time): void
    {
        $this->deleted_time = $deleted_time;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}