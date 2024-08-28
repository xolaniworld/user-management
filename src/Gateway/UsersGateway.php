<?php declare(strict_types=1);

namespace App\Gateway;

use PDO;

class UsersGateway extends AbstractGateway
{
    public function findByEmail($email)
    {
        $sql = "select * from users where email = (:email);";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function findById($id)
    {
        $sql = "select * from users where id = :editid";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':editid', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        return $result;
    }

    public function getPasswordHasByEmail(string $email, $status = '1')
    {
        $sql = 'select password from users where email=:email and status=(:status)';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();

        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->password;
        }

        return null;
    }

    public function countByEmailPasswordAndStatus($email, $password, $status)
    {
        $sql = "select email,password from users where email=:email and password=:password and status=(:status)";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        return $query->rowCount();
    }

    public function countByUsernameAndPassword($username, $password)
    {
        $sql = "select Password from users where email=:username and password=:password";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        return $query->rowCount();
    }

    public function updateById($name, $email, $mobile, $designation, $image, $idedit)
    {
        $sql = "update users set name=(:name), email=(:email), mobile=(:mobile), designation=(:designation), Image=(:image) where id=(:idedit)";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':designation', $designation, PDO::PARAM_STR);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->bindParam(':idedit', $idedit, PDO::PARAM_STR);
        $query->execute();
    }

    public function updateByIdWithGender($name, $email, $gender, $mobile, $designation, $image, $idedit)
    {
        $sql = "update users set name=(:name), email=(:email), gender=(:gender), mobile=(:mobile), designation=(:designation), Image=(:image) where id=(:idedit)";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':designation', $designation, PDO::PARAM_STR);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->bindParam(':idedit', $idedit, PDO::PARAM_STR);
        return $query->execute();
    }

    public function updatePasswordByUsername($newpassword, $username)
    {
        $con = "update users set password=:newpassword where email=:username";
        $chngpwd1 = $this->pdo->prepare($con);
        $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
        $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd1->execute();
    }

    /**
     * @return int
     */
    public function countIds()
    {
        $sql = "select id from users";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        return $query->rowCount();
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteById($id)
    {
        $sql = "delete from users where id=:id";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        return $query->execute();
    }

    /**
     * @param $memstatus
     * @param $aeid
     * @return bool
     */
    public function updateStatusById($memstatus, $aeid)
    {
        $sql = "update users set status=:status where id=:aeid";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':status', $memstatus, PDO::PARAM_STR);
        $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
        return $query->execute();
    }

    /**
     * @return array
     */
    public function findAllUsers()
    {
        $sql = "select * from  users ";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        return [$results, $query->rowCount()];
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        $sql = "select * from users;";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     * @param $gender
     * @param $mobile
     * @param $designation
     * @param $image
     * @param $status
     * @return bool
     */
    public function insertUser($name, $email, $password, $gender, $mobile, $designation, $image, $status)
    {
        $sql = "insert into users(name,email, password, gender, mobile, designation, image, status) values(:name, :email, :password, :gender, :mobile, :designation, :image, :status)";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':designation', $designation, PDO::PARAM_STR);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_INT);
        $success = $query->execute();

        return $success;
    }

    /**
     * @param $email
     * @return bool
     */
    public function deleteByEmail($email)
    {
        $sql = 'delete from users where email = :email';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        return $query->execute();
    }
}