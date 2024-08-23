<?php
// src/Product.php

namespace Application\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id = null;
    #[ORM\Column(type: 'string')]
    private $name;
    #[ORM\Column(type: 'string')]
    private $email;
    #[ORM\Column(type: 'string')]
    private $password;
    #[ORM\Column(type: 'string')]
    private $gender;
    #[ORM\Column(type: 'string')]
    private $mobile;
    #[ORM\Column(type: 'string')]
    private $designation;
    #[ORM\Column(type: 'string')]
    private $image;
    #[ORM\Column(type: 'string')]
    private $status;
    #[ORM\Column(type: 'datetime')]
    private $created;
    #[ORM\Column(type: 'datetime')]
    private $updated;
}