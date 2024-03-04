<?php


// Firebase Firestore configuration
$projectId = "lastt-93374";
$collection = "feedback";
$url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";

// Function to validate the input
function validateInput($data) {
    return htmlspecialchars(trim($data));
}


require_once('header.php');
//require_once('connection.php');

$nm = $nmError = $msg = $msgError = "";

if (isset($_POST['btn'])) {
  $nm = validateInput($_POST['nm']);
  $msg = validateInput($_POST['msg']);
  
 // $msg = mysqli_real_escape_string($con, $msg);
  
  if (empty($nm)) {
    $nmError = "Required *";
  } else {
    if (!preg_match('/^[a-zA-Z]+$/', $nm)) {
      $nmError = "Please Enter Valid Value";
    }
  }
  if (empty($msg)) {
    $msgError = "Required *";
  }

  if ($nmError == "" && $msgError == "") {
	
	 $data = [
        'fields' => [
            'nm' => ['stringValue' => $nm],
            'msg' => ['stringValue' => $msg]
        ]
		];
		
   $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = curl_exec($ch);
        curl_close($ch);
    if ($response) {
      header("Location:navbar.php");
    } else {
      echo "Insertion failed";
    }
  }
}


?>
<div id="bgOther">
  <!-- <img src="../images/about/about3.jpeg" alt="" width="100%" /> -->
  <h1 class="centered1 whiteText fw-bold">Feedback</h1>
  <div class="centered2 whiteText">
    <a href="./navbar.php" class="whiteText">HOME</a> | FEEDBACK
  </div>
</div>
<br /><br />
<div class="box mx-auto">
  <h3 class="mb-4">FEEDBACK</h3>

  <form method="post" class="contactForm">
    <input class="form-control form-control-lg" type="text" name="nm" placeholder="Your Name" value="<?php echo $nm ?>" />
    <div class="text-danger mb-4"><?php echo $nmError ?></div>

    <textarea class="form-control form-control-lg" name="msg" id="msg" rows="5" placeholder="Your Message"><?php echo $msg ?></textarea>
    <div class=" text-danger mb-4"><?php echo $msgError ?></div>
    <button class="formBtn px-4 py-2 mt-2" name="btn">SUBMIT</button>
  </form>
</div>
<br /><br />
<?php
require_once('footer.php');
?>