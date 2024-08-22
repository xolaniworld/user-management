<?php

namespace UserManagement;
use PDO;
class UsersRepository extends AbstractRepository
{
    public function deleteById($id)
    {
        $sql = "delete from users WHERE id=:id";
        $query = $this->dbh->prepare($sql);
        $query -> bindParam(':id',$id, PDO::PARAM_STR);
        $query -> execute();
    }
    public function count()
    {
        $sql ="SELECT id from users";
        $query = $this->dbh -> prepare($sql);
        $query->execute();
        $this->results=$query->fetchAll(PDO::FETCH_OBJ);
        return $query->rowCount();
    }
    public function selectAll()
    {
        $sql = "SELECT * from users;";
        $query = $this->dbh -> prepare($sql);
        $query->execute();
        $result=$query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function selectByEmail($email)
    {
        $sql = "SELECT * from users where email = (:email);";
        $query = $this->dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $this->results=$query->fetch(PDO::FETCH_OBJ);
        return $this->results;
    }
    public function login($email, $password)
    {
        $password = md5($password);
        $status='1';
        $sql ="SELECT email,password FROM users WHERE email=:email and password=:password and status=(:status)";
        $query= $this->dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> bindParam(':status', $status, PDO::PARAM_STR);
        $query-> execute();
        $this->results=$query->fetchAll(PDO::FETCH_OBJ);
        return $query->rowCount() > 0;
    }

    public function insert($name, $email, $password, $gender, $mobile, $designation, $image)
    {
        $sql ="INSERT INTO users(name,email, password, gender, mobile, designation, image) VALUES(:name, :email, :password, :gender, :mobile, :designation, :image)";
        $query= $this->dbh -> prepare($sql);
        $query-> bindParam(':name', $name, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> bindParam(':gender', $gender, PDO::PARAM_STR);
        $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query-> bindParam(':designation', $designation, PDO::PARAM_STR);
        $query-> bindParam(':image', $image, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $this->dbh->lastInsertId();
        return $lastInsertId;
    }

    public function update($name, $email, $mobile, $designation, $image, $idedit)
    {
        $sql="UPDATE users SET name=(:name), email=(:email), mobile=(:mobile), designation=(:designation), Image=(:image) WHERE id=(:idedit)";
        $query = $this->dbh->prepare($sql);
        $query-> bindParam(':name', $name, PDO::PARAM_STR);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query-> bindParam(':designation', $designation, PDO::PARAM_STR);
        $query-> bindParam(':image', $image, PDO::PARAM_STR);
        $query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
        $query->execute();
    }

    public function updateStatusByAeid($memstatus, $aeid)
    {
        $sql = "UPDATE users SET status=:status WHERE  id=:aeid";
        $query = $this->dbh->prepare($sql);
        $query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
        $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
        $query -> execute();
    }

}