<?php require_once('admin_header.php'); ?>


<br /><br />
<div class="container">
    <h1>QUERIES</h1>
    <br>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No.</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Actions</th>
        </tr>
        <?php require_once('../connection.php');

        $qry = "SELECT * FROM `contactUs`";
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
                    <td>
                        <a href="#"><i class="fa-solid fa-trash text-danger"></i></a>
                    </td>
                </tr>
        <?php

            }
        }
        ?>
    </table>
</div>

<?php require_once('admin_footer.php') ?>