<?php require_once('admin_header.php');
require_once('../connection.php');

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $qry = "DELETE FROM `admins` WHERE id = " . $id;
    $res = mysqli_query($con, $qry);

    if ($res) {
    } else {
        echo "Delete operation failed";
    }
}

?>

<br /><br />

<div class="container">
    <h1>ADMINS</h1>
    <br>
    <table class="table mb-4">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone No.</th>
            <th>Birthdate</th>
            <th>Address</th>
            <th colspan="2">Actions</th>

        </tr>
        <?php require_once('../connection.php');

        $qry = "SELECT * FROM `admins`";
        $res = mysqli_query($con, $qry);

        if ($res) {

            while ($rows = mysqli_fetch_row($res)) {



        ?>
                <tr>
                    <td><?php echo $rows[1] ?></td>
                    <td><?php echo $rows[2] ?></td>
                    <td><?php echo $rows[3] ?></td>
                    <td><?php echo $rows[4] ?></td>
                    <td><?php echo $rows[5] ?></td>
                    <td><?php echo $rows[7] ?></td>
                    <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $rows[8] ?></td>
                    <td><a href="admin_admin_edit.php?id=<?php echo $rows[0] ?>"><i class="fa-solid fa-pen-to-square text-primary"></i></a></td>
                    <td><a href="admin_admin.php?id=<?php echo $rows[0] ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
                </tr>
        <?php

            }
        }
        ?>
    </table>

    <button type="submit" name="btn" class="formBtn px-4 py-2 mb-4 fs-5" onclick="goToAdmin()"> Add Admin </button></td>
</div>
<script>
    function goToAdmin() {
        window.location.href = 'admin_admin_insert.php';
    }
</script>
<?php require_once('admin_footer.php') ?>