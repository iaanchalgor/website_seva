<!-- donation.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Now</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<script>
  function showSuccessAlert() {
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    successModal.show();

    // Hide the modal after 5 seconds
    setTimeout(function() {
      successModal.hide();
      window.location.href = 'profile.php';
    }, 5000);
    return false;
  }
</script>

<?php
// Ensure that errors are displayed for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('header.php');

$projectId = "lastt-93374";
$collection = "donation";
$url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";

// Function to validate the input
function validateInput($data) {
    return htmlspecialchars(trim($data));
}

$fnm = $lnm = $em = $phno = $ngo = $type = $amount = $des = $add = "";
$fnmError = $lnmError = $emError = $phnoError = $ngoError = $typeError = $amountError = $desError = $addError ="" ;

if (isset($_POST['btn'])) {

    $fnm = validateInput($_POST['fname']);
    $lnm = validateInput($_POST['lname']);
    $em = validateInput($_POST['email']);
    $phno = validateInput($_POST['phno']);
    $ngo = validateInput($_POST['ngo']);
    $type = validateInput($_POST['don']);
    $amount = validateInput($_POST['amount']);
    $des = validateInput($_POST['des']);
    $add = validateInput($_POST['add']);

    // Validate inputs
    if (empty($fnm)) {
        $fnmError = "Required *";
    }
    if (empty($lnm)) {
        $lnmError = "Required *";
    }
    if (empty($em)) {
        $emError = "Required *";
    }
    if (empty($phno)) {
        $phnoError = "Required *";
    }
    if (empty($ngo)) {
        $ngoError = "Required *";
    }
    if (empty($amount)) {
        $amountError = "Required *";
    }
    if (empty($des)) {
        $desError = "Required *";
    }
    if(empty($add)){
        $addError ="Required *";
    }

    // If there are no validation errors, proceed to store data in Firestore
    if($fnmError =="" && $lnmError =="" && $emError =="" && $phnoError =="" && $ngoError =="" && $typeError =="" && $amountError =="" && $desError =="" && $addError =="") {

        // Construct data payload
        $data = [
            "fields" => [
                "fnm" => ["stringValue" => $fnm],
                "lnm" => ["stringValue" => $lnm],
                "em"  => ["stringValue" => $em],
                "phno"  => ["stringValue" => $phno],
                "ngo"  => ["stringValue" => $ngo],
                "type"  => ["stringValue" => $type],
                "amount" => ["stringValue" => $amount],
                "des" => ["stringValue" => $des],
                "add" => ["stringValue" => $add]
            ]
        ];

        // Encode data as JSON
        $jsonData = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            echo "Error: " . curl_error($ch);
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var successModal = new bootstrap.Modal(document.getElementById("successModal"));
                        successModal.show();

                        // Hide the modal after 5 seconds
                        setTimeout(function() {
                            successModal.hide();
                            window.location.href = "profile.php";
                        }, 4000);
                    });
                  </script>';
        }

        // Close cURL session
        curl_close($ch);
    }
}
?>

<!-- Your HTML code continues here -->

<div class="modal" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content model-success " style="background-color: #d4edda;">

      <div class="modal-body">
        Donation is requested to ngo successfully.
      </div>

    </div>
  </div>
</div>


<div class="container">
  <div class="brownText fs-1 my-1  mb-3 fw-bold text-center">DONATE NOW</div>
  <!-- <br /> -->
  <form class="contactForm" method="POST">
    <div class="row">
      <div class="col-sm-6 mb-3">
        <input type="text" name="fname" class="form-control form-control-lg" placeholder="First Name" value="<?php echo $fnm ?>" />
        <label style="color:red"><?php echo $fnmError ?></label>
      </div>

      <div class="col-sm-6 mb-3">
        <input type="text" name="lname" class="form-control form-control-lg" placeholder="Last Name" value="<?php echo $lnm ?>" />
        <label style="color:red"><?php echo $lnmError ?></label>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-6 mb-3">
        <input type="text" name="email" class="form-control form-control-lg" value="<?php echo $em?>" placeholder="Email Address" />
        <label style="color:red"><?php echo $emError ?></label>
      </div>
      <div class="col-sm-6 mb-2">
        <input type="text" id="sub" name="phno" class="form-control form-control-lg" placeholder="Phone No." value="<?php echo $phno?>"/>
        <label style="color:red"><?php echo $phnoError ?></label>
      </div>
    </div>

    <!--<div class="row">
      <div class="col-sm-6 fs-5 mb-1">
        <span class="mb-1">Type of Donation :</span>
        <span class="mx-3"><input type="radio" id="sub" name="don" checked  value="<?php echo $don?>"/> Money
        </span>
        <span class="mx-3">
          <input type="radio" id="sub" name="don" value="<?php echo $type?>" />
          Product
        </span>
        <span class="mx-3">
          <input type="radio" id="sub" name="don"  value="<?php echo $type?>"/>
          Food</span>
        <span class="mx-3">
          <input type="radio" id="sub" name="don" value="<?php echo $type?>" />
          Other
        </span>
      </div>-->
<div class="row">
  <div class="col-sm-6 fs-5 mb-1">
    <span class="mb-1">Type of Donation :</span>
    <span class="mx-3"><input type="radio" id="money" name="don" value="Money" <?php if ($type == 'Money') echo 'checked'; ?>/> Money</span>
    <span class="mx-3"><input type="radio" id="product" name="don" value="Product" <?php if ($type == 'Product') echo 'checked'; ?>/> Product</span>
    <span class="mx-3"><input type="radio" id="food" name="don" value="Food" <?php if ($type == 'Food') echo 'checked'; ?>/> Food</span>
    <span class="mx-3"><input type="radio" id="other" name="don" value="Other" <?php if ($type == 'Other') echo 'checked'; ?>/> Other</span>
  </div>


      <div class="col-sm-6 fs-5 mb-1">
        <select name="ngo" class="form-control" style="background-color: #faefed">
          <option value="">-----Select NGO-----</option>
          <option value="Vasudevakam" <?php echo $ngo == 'Vasudevakam' ? 'selected' : '' ?>>Vasudevakam</option>

          <option value="HariOm">HariOm</option>
          <option value="SevaSparsh">SevaSparsh</option>
          <option value="Jivanamasteya">Jivanamasteya</option>
        </select>
        <label style="color:red" class="h6 pt-0"><?php echo $ngoError ?></label>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 mb-3">
        <input type="text" name="amount" class="form-control form-control-lg" placeholder="If money, please mention the amount. If product or service, please mention its name." value="<?php echo $amount ?>" />
        <label style="color:red"><?php echo $amountError ?></label>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12 mb-3">
        <textarea class="form-control form-control-lg " name="des" id="msg" rows="5" placeholder="Description About Donation" ><?php echo $des ?></textarea>
        <label style="color:red"><?php echo $desError ?></label>
      </div>
    </div>
    <label><h4> Address :</h4></label>
    <div class="row">
      <div class="col-sm-12 mb-3">
        <textarea class="form-control form-control-lg" name="add" id="address" rows="5" placeholder="Flat, House No.,Building,Company,Apartment"><?php echo $add ?></textarea>
        <label style="color:red"><?php echo $addError ?></label>
    </div>
  </div>
  
      <button type="submit" name="btn" class="formBtn px-5 mb-3 fs-5" >
        Donate
      </button>

  </form>
</div>  

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS after jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
