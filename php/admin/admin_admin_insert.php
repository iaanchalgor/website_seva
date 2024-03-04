<?php require_once('admin_header.php');

require_once('../connection.php');
$fnm = $lnm = $em = $phno = $pw = $cpw =  $bdate = $address = $id = $res = "";
$gen = "Male";
$fnmError = $lnmError = $emError = $phnoError = $pwError = $cpwError = $genError = $bdateError = $addressError = "";



if (isset($_POST['btn'])) {
    $fnm = $_POST['fnm'];
    $lnm = $_POST['lnm'];
    $em = $_POST['em'];
    $phno = $_POST['phno'];
    $pw = $_POST['pw'];
    $gen = $_POST['gen'];
    $bdate = $_POST['bdate'];
    $address = $_POST['address'];
    if (empty($fnm)) {
        $fnmError = "Required *";
    } else {
        if (!preg_match('/^[a-zA-Z]+$/', $fnm)) {
            $fnmError = "Please Enter Valid Value";
        }
    }
    if (empty($lnm)) {
        $lnmError = "Required *";
    } else {
        if (!preg_match('/^[a-zA-Z]+$/', $lnm)) {
            $lnmError = "Please Enter Valid Value";
        }
    }
    if (empty($em)) {
        $emError = "Required *";
    } else {
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $emError = "Please Enter Valid Value";
        }
    }
    if (empty($phno)) {
        $phnoError = "Required *";
    } else {
        if (strlen($phno) != 10) {
            $phnoError = "Please Enter Valid Value";
        }
    }
    if (empty($pw)) {
        $pwError = "Required *";
    } else {
        if (strlen($pw) <= 6) {
            $pwError = "Password shoud be greater than 6 characters";
        }
    }

    if (empty($bdate)) {
        $bdateError = "Required *";
    } else {
        $a = countAge($bdate);
        echo $a;
        if ($a <= 18) {
            $bdateError = "Age should be greater than 18";
        }
    }
    if (empty($address)) {
        $addressError = "Required *";
    }

    if ($fnmError == "" && $lnmError == "" && $emError == "" && $phnoError == "" & $pwError == "" && $cpwError == "" && $genError == "" && $bdateError == "" && $addressError == "") {

        $qry = "INSERT INTO `admins`(`fnm`, `lnm`, `gen`, `email`, `phno`, `pw`, `bdate`, `address`) VALUES ('$fnm','$lnm','$gen','$em','$phno','$pw','$bdate','$address')";
        $res = mysqli_query($con, $qry);

        if ($res) {
?>
            <script>
                window.location.href = 'admin_admin.php';
            </script>
<?php
        } else {
            echo "Insertion Failed";
        }
    }
}
function countAge($date)
{
    $birthdate = new DateTime($date);

    $currentDate = new DateTime();

    $age = $currentDate->diff($birthdate)->y;

    return $age;
}

?>

<h1 class="text-center mb-5 formTitleColor ">ADD ADMIN</h1>
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
                    <td> <label for="" class="text-danger fs-5"><?php echo $fnmError; ?></label></td>
                    <td><br></td>
                    <td> <label for="" class="text-danger fs-5"><?php echo $lnmError; ?></label></td>
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
                    <td> <br></label></td>
                    <td><br></td>
                    <td> <label for="" class="text-danger fs-5" style="font-size: 5px;"><?php echo $bdateError; ?></label></td>
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
                        <input type="number" class="px-3" name="phno" value="<?php echo $phno ?>">
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                    <td> <label for="" class="text-danger fs-5"><?php echo $emError; ?></label></td>
                    <td><br></td>
                    <td> <label for="" class="text-danger fs-5"><?php echo $phnoError; ?></label></td>
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
                    <td><br></td>
                    <td> <label for="" class="text-danger fs-5"><?php echo $pwError; ?></label></td>
                    <td><br></td>
                    <td> <label for="" class="text-danger fs-5"><?php echo $addressError; ?></label></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="btn" class="formBtn px-5 py-2 mb-4 fs-5"> Add </button></td>
                </tr>
            </table>
    </form>
    </center>

</div>

<?php require_once('admin_footer.php') ?>