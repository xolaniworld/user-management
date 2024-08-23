<?php
// src/Product.php

namespace Application\Entities;

use Doctrine\ORM\Mapping as ORM;

 #[ORM\Entity]
 #[ORM\Table(name: 'feedbacks')]
class Feedback
{
     #[ORM\Id]
     #[ORM\Column(type: 'integer')]
     #[ORM\GeneratedValue]
    private $id = null;
     #[ORM\Column(type: 'string')]
    private $sender;
     #[ORM\Column(type: 'string')]
    private $receiver;
     #[ORM\Column(type: 'string')]
    private $title;
     #[ORM\Column(type: 'string')]
    private $feedback_data;
     #[ORM\Column(type: 'string')]
    private $attachment;
     #[ORM\Column(type: 'datetime')]
    private $created;
     #[ORM\Column(type: 'datetime')]
    private $updated;
}