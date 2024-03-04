<?php require_once('admin_header.php');

require_once('../connection.php');
$nm = $fn = $em = $phno=$vol = $pw = $cpw =  $yr = $address = $id = $res =$status=$upi=$link= "";
$vol = "Male";
$nmError = $fnError = $emError = $phnoError = $pwError = $cpwError = $volError = $yrError = $addressError = "";
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}
$qry = "select * from ngos where id = " . $id;
$res = mysqli_query($con, $qry);
if (!$res) {
    echo "Invalid error";
} else if ($res) {
    $rows = mysqli_fetch_row($res);
}
$databaseDate = $rows[4];
$displayDate = date('Y-m-d', strtotime($databaseDate));
$nm = $rows[1];
$fn = $rows[2];
$em = $rows[6];
$phno = $rows[5];
$pw = $rows[7];
$vol = $rows[3];
$yr = $displayDate;
$address = $rows[10];
$status=$rows[11];
$upi=$rows[9];
$link=$rows[8];

if (isset($_POST['btn'])) {
    $nm = $_POST['nm'];
    $fn = $_POST['fn'];
    $em = $_POST['em'];
    $phno = $_POST['phno'];
    $pw = $_POST['pw'];
    $vol = $_POST['vol'];
    $yr = $_POST['yr'];
    $address = $_POST['address'];
    $status=$_POST['status'];
    $upi=$_POST['upi'];
    $link=$_POST['link'];


    $qry="UPDATE `ngos` SET `nm`='$nm',`founder`='$fn',`vol`='$vol',`establishadate`='$yr',`phno`='$phno',`em`='$em',`pw`='$pw',`link`='$link',`upi`='$upi',`address`='$address',`status`='$status' WHERE `id`='$id'";
    // echo $qry;
    $res = mysqli_query($con, $qry);

    if ($res) {
?>
        <script>
            window.location.href = 'admin_ngo.php';
        </script>
<?php
    } else {
        echo "Updation Failed";
    }
}

?>

<h1 class="text-center mb-5 formTitleColor ">Edit NGOs</h1>
<div class="container">
    <form method="post">
        <center>
            <table class="fs-4 px-4">

                <tr>
                    <td class="px-4">
                        <div style="color:#616161;">NGO Name : </div>
                    </td>
                    <td>
                        <input type="text" name="nm" value="<?php echo $nm ?>" class="px-3">
                    </td>
                    <td class="px-4">
                        <div style="color:#616161;">Founder Name : </div>
                    </td>
                    <td>
                        <input type="text" name="fn" value="<?php echo $fn ?>" class="px-3">
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>


                <tr>

                    <td class="px-4">
                        <div style="color:#616161;">Volunteers : </div>
                    </td>

                    <td>
                    <input type="text" name="vol" value="<?php echo $vol ?>" class="px-3">
                    </td>
                    <td class="px-4">
                        <div style="color:#616161;">Date of Establishment : </div>
                    </td>
                    <td>
                        <input type="date" class="px-3" name="yr" value="<?php echo $yr ?>">
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
                        <div style="color:#616161;">Status : </div>
                    </td>
                    <td>
                        <select name="status" id="" class="px-5">
                            <option value="Approved" <?php echo $status=='Approved'?'selected':''?>>Approved</option>
                            <option value="Pending" <?php echo $status=='Pending'?'selected':''?>>Pending</option>
                            <option value="Denied" <?php echo $status=='Denied'?'selected':''?>> Denied</option>

                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td class="px-4">
                        <div style="color:#616161;">Social Media/Website Link : </div>
                    </td>
                    <td>
                        <input type="text" class="px-3" name="link" value="<?php echo $link ?>">
                    </td>
                    <td class="px-4">
                        <div style="color:#616161;">UPI I'd : </div>
                    </td>
                    <td>
                        <input type="text" class="px-3" name="upi" value="<?php echo $upi ?>">
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td class="px-4">
                    <div style="color:#616161;">Address : </div>
                    </td>
                    <td>
                        <textarea class="px-3" name="address"><?php echo $address ?></textarea>
                    </td>
                    
                </tr>
              
                <tr>
                    <td><br></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><button type="submit" name="btn" class="formBtn px-4 py-2 mb-4 fs-5" > Edit </button></td>
                </tr>

            </table>
    </form>
    </center>

</div>

<?php require_once('admin_footer.php') ?>