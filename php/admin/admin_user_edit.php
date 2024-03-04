<?php require_once('admin_header.php');

require_once('../connection.php');
$fnm = $lnm = $em = $phno = $pw = $cpw =  $bdate = $address = $id = $res = "";
$gen = "Male";
$fnmError = $lnmError = $emError = $phnoError = $pwError = $cpwError = $genError = $bdateError = $addressError = "";
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}
$qry = "select * from users where id = " . $id;
$res = mysqli_query($con, $qry);
if (!$res) {
    echo "Invalid error";
} else if ($res) {
    $rows = mysqli_fetch_row($res);
}
$databaseDate = $rows[7];
$displayDate = date('Y-m-d', strtotime($databaseDate));
$fnm = $rows[1];
$lnm = $rows[2];
$em = $rows[4];
$phno = $rows[5];
$pw = $rows[6];
$gen = $rows[3];
$bdate = $displayDate;
$address = $rows[8];


if (isset($_POST['btn'])) {
    $fnm = $_POST['fnm'];
    $lnm = $_POST['lnm'];
    $em = $_POST['em'];
    $phno = $_POST['phno'];
    $pw = $_POST['pw'];
    $gen = $_POST['gen'];
    $bdate = $_POST['bdate'];
    $address = $_POST['address'];

    $qry = "UPDATE `users` SET `fnm`='$fnm',`lnm`='$lnm',`gen`='$gen',`email`='$em',`phno`='$phno',`pw`='$pw',`bdate`='$bdate',`address`='$address' WHERE `id`='$id'";
    $res = mysqli_query($con, $qry);

    if ($res) {
?>
        <script>
            window.location.href = 'admin_users.php';
        </script>
<?php
    } else {
        echo "Updation Failed";
    }
}

?>

<h1 class="text-center mb-5 formTitleColor ">Edit User</h1>
<div class="container">
    <form method="post">
        <center>
            <table class="fs-4 px-4">

                <tr>
                    <td class="px-4">
                        <div style="color:#616161;">First Name : </div>
                    </td>
                    <td>
                        <input type="text" name="fnm" value="<?php echo $fnm ?>" class="px-3">
                    </td>
                    <td class="px-4">
                        <div style="color:#616161;">Last Name : </div>
                    </td>
                    <td>
                        <input type="text" name="lnm" value="<?php echo $lnm ?>" class="px-3">
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>


                <tr>

                    <td class="px-4">
                        <div style="color:#616161;">Gender : </div>
                    </td>

                    <td>
                        <input type="radio" id="sub" name="gen" <?php echo $gen == 'Male' ? 'checked' : ''; ?> value="Male" />
                        Male
                        <input type="radio" id="sub" name="gen" <?php echo $gen == 'Female' ? 'checked' : ''; ?> value="Female" />
                        Female
                        <input type="radio" id="sub" name="gen" <?php echo $gen == 'Other' ? 'checked' : ''; ?> value="Other" />
                        Other
                    </td>
                    <td class="px-4">
                        <div style="color:#616161;">Birthdate : </div>
                    </td>
                    <td>
                        <input type="date" class="px-3" name="bdate" value="<?php echo $bdate ?>">
                    </td>

                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td class="px-4">
                        <div style="color:#616161;">Email : </div>
                    </td>
                    <td>
                        <input type="text" class="px-3" name="em" value="<?php echo $em ?>">
                    </td>
                    <td class="px-4">
                        <div style="color:#616161;">Phone No. : </div>
                    </td>
                    <td>
                        <input type="text" class="px-3" name="phno" value="<?php echo $phno ?>">
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td class="px-4">
                        <div style="color:#616161;">Password : </div>
                    </td>
                    <td>
                        <input type="password" class="px-3" name="pw" value="<?php echo $pw ?>">
                    </td>
                    <td class="px-4">
                        <div style="color:#616161;">Address : </div>
                    </td>
                    <td>
                        <textarea class="px-3" name="address"><?php echo $address ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td><button type="submit" name="btn" class="formBtn px-4 py-2 mb-4 fs-5" "> Edit </button></td>
                </tr>
            </table>
    </form>
    </center>

</div>

<?php require_once('admin_footer.php') ?>