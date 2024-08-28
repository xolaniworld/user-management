<?php declare(strict_types=1);

namespace App\Entity;

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

    public function getId()
    {
        return $this->id = null;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getGender()
    {
        return $this->gender;
    }
    public function getMobile()
    {
        return $this->mobile;
    }
    public function getDesignation()
    {
        return $this->designation;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getCreated()
    {
        return $this->created;
    }
    public function getUdated()
    {
        return $this->updated;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param $created
     * @return mixed
     */
    public function setCreated($created)
    {
        return $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated): void
    {
        $this->updated = $updated;
    }


}