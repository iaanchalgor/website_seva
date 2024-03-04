<?php

// Firebase Firestore configuration
$projectId = "lastt-93374";
$collection = "contact";
$url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";

// Function to validate the input
function validateInput($data) {
    return htmlspecialchars(trim($data));
}


require_once('header.php');

//require_once('connection.php');
require_once('header.php');

$nm = $em = $phno = $sub = $msg = "";
$nmError = $emError = $phnoError = $subError = $msgError = "";
if (isset($_POST['btn'])) {
  $nm = validateInput($_POST['nm']);
    $em = validateInput($_POST['em']);
    $phno = validateInput($_POST['phno']);
    $sub = validateInput($_POST['sub']);
    $msg = validateInput($_POST['msg']);

  if (empty($nm)) {
    $nmError = "Required *";
  } else {
    if (!preg_match('/^[a-zA-Z]+$/', $nm)) {
      $nmError = "Please Enter Valid Value";
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
  if (empty($sub)) {
    $subError = "Required *";
  }
  if (empty($msg)) {
    $msgError = "Required *";
  }
  echo $phno;

  if ($nmError == "" && $emError == "" && $phnoError == "" && $subError == "" && $msgError == "") {
     // Construct the JSON data
    $data = [
        'fields' => [
            'nm' => ['stringValue' => $nm],
            'em' => ['stringValue' => $em],
            'phno' => ['stringValue' => $phno],
            'sub' => ['stringValue' => $sub],
            'msg' => ['stringValue' => $msg]
        ]
    ];

    // Send POST request to Firestore REST API
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
    ]);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Handle the response
    if ($httpcode == 200 || $httpcode == 201) {
        header("Location:navbar.php");
        exit;
    } else {
        echo "Error: Failed to store data in Firestore. HTTP Code: $httpcode";
    }
	
}
}

?>

<div id="bgOther">
  <!-- <img src="../images/about/about3.jpeg" alt="" width="100%" /> -->
  <h1 class="centered1 whiteText fw-bold">Contact</h1>
  <div class="centered2 whiteText">
    <a href="./navbar.php" class="whiteText">HOME</a> | CONTACT
  </div>
</div>
<br /><br />
<div class="text-center mb-5">
  <div class="brownText titleSize fs-1 fw-bold">
    Get in touch with us. <br />
    We'd love to hear from you.
  </div>
</div>
<br />
<div class="container text-center mb-5">
  <div class="row">
    <div class="col-sm-4">
      <div class="bgContact">
        <div class="icon mb-3">
          <i class="fa-solid fa-envelope fa-2x"></i>
        </div>
        <h4 class="fw-bold brownText">Send Email</h4>
        <div class="maroonTitle">info@sevasanskriti.com</div>
        <div class="maroonTitle">sevasanskriti@gmail.com</div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="bgContact">
        <div class="icon mb-3">
          <i class="fa-solid fa-phone-volume fa-2x"></i>
        </div>
        <h4 class="fw-bold brownText">Call Center</h4>
        <div class="maroonTitle">(91) 9682910737</div>
        <div class="maroonTitle">(91) 7945897388</div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="bgContact">
        <div class="icon mb-3">
          <i class="fa-solid fa-location-dot fa-2x"></i>
        </div>
        <h4 class="fw-bold brownText">Visit Anytime</h4>
        <div class="maroonTitle">
          123, ABC Apartment, XYZ Road, Vesu Gam, Surat
        </div>
      </div>
    </div>
  </div>
</div>
<br /><br />
<div class="container ">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14885.335435063273!2d72.75970111612675!3d21.13910795243902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be05276ea0507ad%3A0x73c16cff225b784!2sVesu%2C%20Surat%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1694086782544!5m2!1sen!2sin" width="100%" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<div id="frm"></div>
<br /><br /><br />
<div class="container">
  <div class="brownText fs-1 mb-4 text-center fw-bold">
    Do You’ve Any Question?
  </div>
  <br />
  <form class="contactForm" method="post">
    <div class="row mb-3">
      <div class="col-sm-6">
        <input type="text" id="name" name="nm" class="form-control form-control-lg" placeholder="Name" value="<?php echo $nm ?>" />
        <label class="text-danger"><?php echo $nmError ?></label>
      </div>
      <div class="col-sm-6">
        <input type="text" id="email" name="em" class="form-control form-control-lg" placeholder="Email" value="<?php echo $em ?>" />
        <label class="text-danger"><?php echo $emError ?></label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-sm-6">
        <input type="number" id="pno" name="phno" class="form-control form-control-lg" placeholder="Phone Number" value="<?php echo $phno ?>" />
        <label class="text-danger"><?php echo $phnoError ?></label>
      </div>
      <div class="col-sm-6">
        <input type="text" id="sub" name="sub" class="form-control form-control-lg" placeholder="Your Subject" value="<?php echo $sub ?>" />
        <label class="text-danger"><?php echo $subError ?></label>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-sm-12">
        <textarea class="form-control form-control-lg" name="msg" id="msg" rows="5" placeholder="Your Message"><?php echo $msg ?></textarea>
        <label class="text-danger"><?php echo $msgError ?></label>
      </div>
    </div>
    <!-- <input type="checkbox" name="tc" id="tc" />
        <label for="tc"
          >Accept
          <a class="contactLink" href="../php/terms.php">Terms & Conditions</a>
          And Privacy Policy.</label
        ><br /><br /> -->
    <button type="submit" name="btn" class="formBtn px-4 py-2 mb-4 fs-5">
      Send Message
    </button>
  </form>
  <br /><br /><br />
</div>
<?php require_once('footer.php'); ?>