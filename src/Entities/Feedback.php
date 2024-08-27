<?php declare(strict_types=1);

namespace App\Entities;

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
    #[ORM\Column(type: 'string', nullable: true)]
    private $attachment;
    #[ORM\Column(type: 'datetime')]
    private $created;
    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated;

    public function getId(): null
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getFeedbackData()
    {
        return $this->feedback_data;
    }

    /**
     * @return mixed
     */
    public function getAttachment()
    {
        return $this->attachment;
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
     * @param mixed $sender
     */
    public function setSender($sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @param mixed $receiver
     */
    public function setReceiver($receiver): void
    {
        $this->receiver = $receiver;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $feedback_data
     */
    public function setFeedbackData($feedback_data): void
    {
        $this->feedback_data = $feedback_data;
    }

    /**
     * @param mixed $attachment
     */
    public function setAttachment($attachment): void
    {
        $this->attachment = $attachment;
    }

    public function setCreated(): void
    {
        // WILL be saved in the database
        $this->created = new DateTime("now");
    }

    public function setUpdated(): void
    {
        // WILL be saved in the database
        $this->updated = new DateTime("now");
    }
}