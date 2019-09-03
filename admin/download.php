<?php
include dirname(__DIR__) . '/bootstrap.php';

session_regenerate_id(true);

if(\Application\Authentication::adminIsLogin()) {
    header("Location: index.php");
} else {
    echo "#, Name, Email, Gender, Phone, Designation \n";

    $filename = "Users list";
    $usersGateway = new \Application\UsersGateway($dbh);
    list($results, $count) = $usersGateway->findAllUsers();
    $cnt = 1;
    if ($count > 0) {
        foreach ($results as $result) {
            echo "$cnt, $result->name, $result->email, $result->gender, $result->mobile, $result->designation \n";

            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . $filename . "-report.csv");
            header("Pragma: no-cache");
            header("Expires: 0");
            $cnt++;
        }
    }
}