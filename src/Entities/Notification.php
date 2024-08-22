<?php
// src/Product.php

namespace Application\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="notifications")
 */
class Notification
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id = null;
    /**
     * @ORM\Column(type="string")
     */
    private $notification_user;
    /**
     * @ORM\Column(type="string")
     */
    private $notification_receiver;
    /**
     * @ORM\Column(type="string")
     */
    private $notification_type;
    /**
     * @ORM\Column(type="datetime")
     */
    private $time;
    /**
     * @ORM\Column(type="datetime")
     */
    private $created;
    /**
     * @ORM\Column(type="datetime")
     */
    private $updated;
}