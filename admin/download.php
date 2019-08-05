<?php
include __DIR__ . '/../bootstrap.php';

session_regenerate_id(true);

if (strlen($_SESSION['alogin']) == 0) {
    header("Location: index.php"); //
} else {
?>
    <table border="1">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Designation</th>
        </tr>
        </thead>

        <?php
        $filename = "Users list";
        $usersGateway = new \Application\UsersGateway($dbh);
        list($results, $count) = $usersGateway->findAllUsers();
        $cnt = 1;
        if ($count > 0) {
            foreach ($results as $result) {

                echo '  
<tr>  
<td>' . $cnt . '</td> 
<td>' . $Name = $result->name . '</td> 
<td>' . $Email = $result->email . '</td> 
<td>' . $Gender = $result->gender . '</td> 
<td>' . $Phone = $result->mobile . '</td> 
<td>' . $Designation = $result->designation . '</td> 					
</tr>  
';
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=" . $filename . "-report.xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                $cnt++;
            }
        }
        ?>
    </table>
<?php }