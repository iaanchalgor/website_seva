<?php

// Firebase Firestore configuration
$projectId = "lastt-93374";
$collection = "register";
$url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";

// Function to validate the input
function validateInput($data) {
    return htmlspecialchars(trim($data));
}
require_once('header.php');
//require_once('connection.php');

/*$fnm = $lnm = $em = $phno = $pw = $cpw =  $bdate = $address =$fm= "";
$gen = "Male";
$fnmError = $lnmError = $emError = $phnoError = $pwError = $cpwError = $genError = $bdateError = $addressError = "";*/

$fnm = $lnm = $em = $phno = $pw = $cpw = $bdate = $address = $gen = "";
$fnmError = $lnmError = $emError = $phnoError = $pwError = $cpwError = $genError= $bdateError = $addressError = "";


if (isset($_REQUEST['fm'])) {

  $fm = $_REQUEST['fm'];

  }
if (isset($_POST['btnRegister'])) {
  $fnm = validateInput($_POST['fname']);
    $lnm = validateInput($_POST['lname']);
    $em = validateInput($_POST['email']);
    $phno = validateInput($_POST['phno']);
    $pw = validateInput($_POST['pw']);
    $cpw = validateInput($_POST['cpw']);
    $gen = isset($_POST['gen']) ? $_POST['gen'] : '';
    $bdate = validateInput($_POST['birthdate']);
    $address = validateInput($_POST['address']);
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
  if (empty($cpw)) {
    $cpwError = "Required *";
  } else {
    if (strcmp($cpw, $pw) != 0) {
      $cpwError = "Both password should be same";
    }
  }
  if (empty($bdate)) {
    $bdateError = "Required *";
  } else {
    $a = countAge($bdate);
    if ($a < 18) {
      $bdateError = "Age should be greater than 18";
    }
  }
  if (empty($address)) {
    $addressError = "Required *";
  }
  
if (empty($fnmError) && empty($lnmError) && empty($emError) && empty($phnoError) && empty($pwError) && empty($cpwError) && empty($genError) && empty($bdateError) && empty($addressError)) {
        // Firestore document data
        $data = [
            "fields" => [
                "fname" => ["stringValue" => $fnm],
                "lname" => ["stringValue" => $lnm],
                "email" => ["stringValue" => $em],
                "phno" => ["stringValue" => $phno],
                "pw" => ["stringValue" => $pw],
                "cpw" => ["stringValue" => $cpw],
                "gen" => ["stringValue" => $gen],
                "birthdate" => ["stringValue" => $bdate],
                "address" => ["stringValue" => $address],
            ]
        ];

        // Send data to Firestore
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = curl_exec($ch);
        curl_close($ch);

        // Check for successful storage
        if ($response) {
            echo "Data stored successfully in Firestore.";
        } else {
            echo "Error storing data in Firestore.";
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
<html>
<body>
<div class="container">
  <div class="brownText fs-1 my-1 fw-bold text-center">REGISTER HERE</div>
  <!-- <br /> -->
  <form class="contactForm" method="POST" id="registrationForm">
    <div class="row">
      <div class="col-sm-6 mb-2">
        <input type="text" name="fname" class="form-control form-control-lg" placeholder="First Name" value="<?php echo $fnm ?>" />
        <label for="" class="text-danger"><?php echo $fnmError; ?></label>
      </div>
      <div class="col-sm-6">
        <input type="text" name="lname" class="form-control form-control-lg" placeholder="Last Name" value="<?php echo $lnm ?>" />
        <label for="" class="text-danger"><?php echo $lnmError; ?></label>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6 mb-2">
        <input type="text" name="email" class="form-control form-control-lg" placeholder="Email Address" value="<?php echo $em ?>" />
        <label for="" class="text-danger"><?php echo $emError; ?></label>
      </div>
      <div class="col-sm-6 mb-3 ">

        <input type="text" name="phno" id="number" class="form-control form-control-lg formInputColor py-2 " style="border: none;" placeholder="Phone No." value="<?php echo $phno ?>" />
        <label for="" class="text-danger"><?php echo $phnoError; ?></label>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 mb-2">
        <input type="password" id="sub" name="pw" class="form-control form-control-lg" placeholder="Password" value="<?php echo $pw ?>" />
        <label for="" class="text-danger"><?php echo $pwError; ?></label>
      </div>
      <div class="col-sm-6 mb-2">
        <input type="text" id="sub" name="cpw" class="form-control form-control-lg" placeholder="Confirm Password" value="<?php echo $cpw ?>" />
        <label for="" class="text-danger"><?php echo $cpwError; ?></label>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 fs-5 ">
        <span>Gender :</span>
        <input type="radio" id="sub" name="gen" <?php echo $gen == 'Male' ? 'checked' : ''; ?> value="Male" />
        Male
        <input type="radio" id="sub" name="gen" <?php echo $gen == 'Female' ? 'checked' : ''; ?> value="Female" />
        Female
        <input type="radio" id="sub" name="gen" <?php echo $gen == 'Other' ? 'checked' : ''; ?> value="Other" />
        Other
		<label for="" class="text-danger"><?php echo $genError; ?></label>
      </div>
      <div class="col-sm-6 d-flex align-items-center ">

        <span class="fs-5 px-1">Birthdate:</span>
        <input type="date" id="sub" name="birthdate" class="form-control flex-grow-1 formInputColor" value="<?php echo $bdate ?>" />

      </div>
      <div class="row">
        <div class="col-sm-6 fs-5 mb-4"></div>
        <div class="col-sm-6 fs-5 mb-4 "><label for="" class="text-danger px-1" style="margin-left:105px;font-size: 16px;"><?php echo $bdateError; ?></label></div>
      </div>

    </div>
    <div class="row">
      <div class="col-sm-12">
        <textarea class="form-control form-control-lg " name="address" id="msg" rows="5" placeholder="Address" value="<?php echo $address ?>"><?php echo $address; ?></textarea>
        <label for="" class="text-danger px-1"><?php echo $addressError; ?></label>
      </div>
    </div>
    <!-- <input type="checkbox" name="tc" id="tc" />
      <label for="tc"
        >Accept
        <a class="contactLink" href="../php/terms.php">Terms & Conditions</a>
        And Privacy Policy.</label
      ><br /><br /> -->

    <center>
      <label for="" id="err" class="text-danger"></label>
    </center>
    <center>
      <button type="submit" name="btnRegister" class="formBtn px-5 mb-2 fs-5">
        Sign Up
      </button>
      <p class="fs-5">
        Are You an NGO ?
        <span><a href="registerNGO.php" class="brownText ha fw-bold">Register NGO</a></span>
      </p>
    </center>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>