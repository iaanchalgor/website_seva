<?php

require_once('admin_header.php');
require_once('../connection.php');
if (isset($_REQUEST['id'])) {
  $id = $_REQUEST['id'];
  $qry = "DELETE FROM `contactus` WHERE id = " . $id;

  $res = mysqli_query($con, $qry);

  if ($res) {
  } else {
    echo "Delete operation failed";
  }
}
?>


<br /><br />
<div class="container">
  <h1>Queries</h1>
  <br>
  <table class="table">
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Phone No.</th>
      <th>Subject</th>
      <th>Message</th>
      <th colspan="2">Actions</th>
    </tr>
    <?php require_once('../connection.php');

    $qry = "SELECT * FROM `contactus`";
    $res = mysqli_query($con, $qry);

    if ($res) {

      while ($rows = mysqli_fetch_row($res)) {



    ?>
        <tr>
          <td><?php echo $rows[1] ?></td>
          <td><?php echo $rows[2] ?></td>
          <td><?php echo $rows[3] ?></td>
          <td><?php echo $rows[4] ?></td>
          <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $rows[5] ?></td>
          
          <td><a href="admin_query_edit.php?id=<?php echo $rows[0] ?>"><i class="fa-solid fa-pen-to-square text-primary"></i></a></td>
          <td><a href="admin_users.php?id=<?php echo $rows[0] ?>"><i class="fa-solid fa-trash text-danger"></i></a></td>
        </tr>
    <?php

      }
    }
    ?>
  </table>
</div>


<?php require_once('admin_footer.php') ?>