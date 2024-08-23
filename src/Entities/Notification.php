<?php declare(strict_types=1);

namespace Application\Entities;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'notifications')]
class Notification
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id = null;

    #[ORM\Column(type: 'string')]
    private $notification_user;

    #[ORM\Column(type: 'string')]
    private $notification_receiver;

    #[ORM\Column(type: 'string')]
    private $notification_type;

    #[ORM\Column(type: 'datetime')]
    private $time;

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
    public function getNotificationUser()
    {
        return $this->notification_user;
    }

    /**
     * @return mixed
     */
    public function getNotificationReceiver()
    {
        return $this->notification_receiver;
    }

    /**
     * @return mixed
     */
    public function getNotificationType()
    {
        return $this->notification_type;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
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

    /**
     * @param mixed $notification_user
     */
    public function setNotificationUser($notification_user): void
    {
        $this->notification_user = $notification_user;
    }

    /**
     * @param mixed $notification_receiver
     */
    public function setNotificationReceiver($notification_receiver): void
    {
        $this->notification_receiver = $notification_receiver;
    }

    /**
     * @param mixed $notification_type
     */
    public function setNotificationType($notification_type): void
    {
        $this->notification_type = $notification_type;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->time = $time;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->created = $created;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated): void
    {
        $this->updated = $updated;
    }
}