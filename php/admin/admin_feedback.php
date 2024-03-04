<?php require_once('admin_header.php');
require_once('../connection.php');

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $qry = "DELETE FROM `feeback` WHERE id = " . $id;
    $res = mysqli_query($con, $qry);

    if ($res) {
    } else {
        echo "Delete operation failed";
    }
}
?>
<br /><br />
<div class="container">
    <h1>FEEDBACKS</h1>
    <br>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
        <?php require_once('../connection.php');

        $qry = "SELECT * FROM `feeback`";
        $res = mysqli_query($con, $qry);

        if ($res) {

            while ($rows = mysqli_fetch_row($res)) {



        ?>
                <tr>
                    <td><?php echo $rows[1] ?></td>
                    <td><?php echo $rows[2] ?></td>
                    <td>
                        <a href="./admin_feedback.php?id=<?php echo $rows[0] ?>"><i class="fa-solid fa-trash text-danger"></i></a>
                    </td>
                </tr>
        <?php

            }
        }
        ?>
    </table>
</div>


<?php require_once('admin_footer.php') ?>