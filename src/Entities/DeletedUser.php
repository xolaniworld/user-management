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
}