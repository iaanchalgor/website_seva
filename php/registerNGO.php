<?php

// Firebase Firestore configuration
$projectId = "lastt-93374";
$collection = "registerNgo";
$url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";

// Function to validate the input
function validateInput($data) {
    return htmlspecialchars(trim($data));
}
require_once('header.php');
//require_once("connection.php");

$nm = $fn = $vol = $yr = $phno = $em = $pw = $cpw = $link = $upi = $address = "";
$nmError = $fnError = $volError = $yrError = $phnoError = $emError = $pwError = $cpwError = $linkError = $upiError = $addressError = "";

if (isset($_POST['btn'])) {
  $nm = validateInput($_POST['nm']);
  $fn = validateInput($_POST['fn']);
  $vol =  validateInput($_POST['vol']);
  $yr =  validateInput($_POST['yr']);
  $phno =  validateInput($_POST['phno']);
  $em =  validateInput($_POST['em']);
  $address = validateInput($_POST['address']);

  if (empty($nm)) {
    $nmError = "Required *";
  } else {
    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $nm)) {
      $nmError = "Please Enter Valid Value";
    } else {
      $nmError = "";
    }
  }
  if (empty($fn)) {
    $fnError = "Required *";
  } else {
    if (!preg_match('/^[a-zA-Z\s,]+$/', $fn)) {
      $fnError = "Please Enter Valid Value";
    }
  }
  if (empty($vol)) {
    $volError = "Required *";
  }
  if (empty($yr)) {
    $yrError = "Required *";
  }else{
    echo countTime($yr);
    if(abs(countTime($yr))<6){
      echo countTime($yr);
      $yrError ="NGO should be established before 6 month";
    }
  }
  if (empty($phno)) {
    $phnoError = "Required *";
  } else {
    if (strlen($phno) != 10) {
      $phnoError = "Please Enter Valid Value";
    }
  }
 
  if (empty($em)) {
    $emError = "Required *";
  } else {
    if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
      $emError = "Please Enter Valid Value";
    }
  }
  if (empty($link)) {
    $linkError = "Required *";
  } else {
    if (!filter_var($link, FILTER_VALIDATE_URL)) {
      $linkError = "Please Enter Valid URL";
    }
  }
  if (empty($upi)) {
    $upiError = "Required *";
  }
  if (empty($address)) {
    $addressError = "Required *";
  }
  if ($nmError == "" && $fnError == "" && $volError == "" && $yrError == "" && $phnoError == "" && $emError == ""  && $addressError == "") {
    
	$data = [
            "fields" => [
                "nm" => ["stringValue" => $nm],
                "fn" => ["stringValue" => $fn],
                "vol" => ["stringValue" => $vol],
                "yr" => ["stringValue" => $yr],
                "phno" => ["stringValue" => $phno],
                "em" => ["stringValue" => $em],
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
function countTime($date)
{
    $birthdate = new DateTime($date);
    $currentDate = new DateTime();
    $interval = $currentDate->diff($birthdate);
    $yearsDifference = $interval->y;
    $monthsDifference = $yearsDifference * 12 + $interval->m;
    
    return $monthsDifference;
}




?>
<div class="modal" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content model-success " style="background-color: #d4edda;">

      <div class="modal-body">
        Your request is submitted Successfully.We'll send you mail in a week for further proccess.
      </div>

    </div>
  </div>
</div>
<div class="container">
  <div class="brownText fs-1 my-1 mb-2 fw-bold text-center">
    NGO REGISTERATION
  </div>
  <!-- <br /> -->
  <form class="contactForm" method="post">
    <div class="row">
      <div class="col-sm-6">
        <input type="text" name="nm" class="form-control form-control-lg" placeholder="Name of NGO" value="<?php echo $nm ?>" />
        <label for="" class="text-danger"><?php echo $nmError ?></label>
      </div>
      <div class="col-sm-6">
        <input type="text" name="fn" class="form-control form-control-lg" placeholder="Full name of Founder/s of NGO" value="<?php echo $fn ?>" />
        <label for="" class=" text-danger"><?php echo $fnError ?></label>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6 mb-2">
        <input type="number" name="vol" class="form-control form-control-lg mt-4" placeholder="Approx volunteers of NGO" value="<?php echo $vol ?>" />
        <label for="" class=" text-danger"><?php echo $volError ?></label>
      </div>
      <div class="col-sm-6 ">
        <div>Date of Establishment :</div>
        <input type="date" name="yr" class="form-control form-control-lg formInputColor" value="<?php echo $yr ?>" />
        <label for="" class=" text-danger"><?php echo $yrError ?></label>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6 mb-2">
        <input type="number" name="phno" class="form-control form-control-lg" placeholder="Contact No. of NGO" value="<?php echo $phno ?>" />
        <label for="" class=" text-danger"><?php echo $phnoError ?></label>
      </div>
      <div class="col-sm-6 mb-2">
        <input type="text" name="em" class="form-control form-control-lg" placeholder="Email Address of NGO" value="<?php echo $em ?>" />
        <label for="" class=" text-danger"><?php echo $emError ?></label>
      </div>
    </div>
    

    <!-- <div class="row">
      <div class="col-sm-6 mb-2">
        <input type="text" name="link" class="form-control form-control-lg" placeholder="Paste the link of NGO's website/Social Media Link of NGO" value="<?php echo $link ?>" />
        <label for="" class=" text-danger"><?php echo $linkError ?></label>
      </div>
      <div class="col-sm-6 mb-2">
        <input type="text" name="upi" class="form-control form-control-lg" placeholder="UPI I'd of NGO" value="<?php echo $upi ?>" />
        <label for="" class="text-danger"><?php echo $upiError ?></label>
      </div>
    </div> -->

    <div class="row">
      <div class="col-sm-12 mb-2">
        <textarea class="form-control form-control-lg " name="address" id="msg" rows="4" placeholder="Address of NGO"><?php echo $address ?></textarea>
        <label for="" class="text-danger"><?php echo $addressError ?></label>
      </div>
    </div>
    <!-- <input type="checkbox" name="tc" id="tc" />
        <label for="tc"
          >Accept
          <a class="contactLink" href="../php/terms.php">Terms & Conditions</a>
          And Privacy Policy.</label
        ><br /><br /> -->
    <center>
      <button type="submit" name="btn" class="formBtn px-5 mb-2 fs-5">
        Next
      </button>
      <p class="fs-5">
        Are You a Normal User ?
        <span><a href="./register.php" class="brownText ha fw-bold">Register Here</a></span>
      </p>
    </center>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>