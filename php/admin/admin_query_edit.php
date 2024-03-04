<?php require_once('admin_header.php');

require_once('../connection.php');
$nm = $em = $phno = $sub = $msg= $id = $res =$reply= "";
$gen = "Male";
$fnmError = $lnmError = $emError = $phnoError = $pwError = $cpwError = $genError = $bdateError = $addressError = "";
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}
$qry = "select * from `contactus` where id = " . $id;
$res = mysqli_query($con, $qry);
if (!$res) {
    echo "Invalid error";
} else if ($res) {
    $rows = mysqli_fetch_row($res);
}
$nm = $rows[1];
$em = $rows[2];
$sub = $rows[3];
$msg=$rows[5];
$phno = $rows[4];
$reply=$rows[6];

if (isset($_POST['btn'])) {
    $nm = $_POST['nm'];
    $em = $_POST['em'];
    $phno = $_POST['phno'];
    $sub = $_POST['sub'];
    $msg = $_POST['msg'];
    $reply=$_POST['reply'];
    $qry="UPDATE `contactus` SET `nm`='$nm',`em`='$em',`phno`='$phno',`sub`='$sub',`msg`='$msg',`reply`='$reply' WHERE `id`='$id'";
    // $qry = "UPDATE `users` SET `fnm`='$fnm',`lnm`='$lnm',`gen`='$gen',`email`='$em',`phno`='$phno',`pw`='$pw',`bdate`='$bdate',`address`='$address' WHERE `id`='$id'";
    
    $res = mysqli_query($con, $qry);

    if ($res) {
?>
        <script>
            window.location.href = 'admin_query.php';
        </script>
<?php
    } else {
        echo "Updation Failed";
    }
}

if (isset($_POST['btn1'])) {
    echo "hey";
}
?>

<h1 class="text-center mb-5 formTitleColor ">Edit Query</h1>
<div class="container">
    <form method="post">
        <center>
            <table class="fs-4 px-4">

                <tr>
                    <td class="px-4">
                        <div style="color:#616161;">Name : </div>
                    </td>
                    <td>
                        <input type="text" name="nm" value="<?php echo $nm ?>" class="px-3">
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
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
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
                        <div style="color:#616161;">Subject : </div>
                    </td>
                    <td>
                        <input type="text" class="px-3" name="sub" value="<?php echo $sub ?>">
                    </td>
                    </tr>
                    <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td class="px-4">
                        <div style="color:#616161;">Message : </div>
                    </td>
                    <td>
                        <textarea class="px-3" name="msg"><?php echo $msg ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td class="px-4">
                        <div style="color:#616161;">Reply : </div>
                    </td>
                    <td>
                        <textarea class="px-3" name="reply"><?php echo $reply ?></textarea>
                        <button  type="submit" name="btn1" class="formBtn px-4 py-2 mb-4 fs-5" >Send Email</button>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td><button type="submit" name="btn" class="formBtn px-4 py-2 mb-4 fs-5"> Edit </button></td>
                </tr>
            </table>
    </form>
    </center>

</div>

<?php require_once('admin_footer.php') ?>