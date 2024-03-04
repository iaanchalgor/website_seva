<?php
require_once('header.php');

// Firebase Firestore configuration
$projectId = "lastt-93374";
$collection = "otp"; // Change this to your desired collection name
$url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";

$fmValue = "";
$phno = ""; // Initialize $phno variable
$phnoError = "";

if (isset($_REQUEST['fm'])) {
    $fmValue = $_REQUEST['fm'];
}

if (isset($_POST['btnOTP'])) {
    $phno = $_POST['phno'];
    $ootp = $_POST['a'] . $_POST['b'] . $_POST['c'] . $_POST['d'] . $_POST['e'] . $_POST['f'];

    // Construct the JSON data to store in Firestore
    $data = [
        'fields' => [
            'phno' => ['stringValue' => $phno],
            'otp' => ['stringValue' => $ootp]
        ]
    ];

    // Send POST request to Firestore REST API to store the data
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
        header("Location:navbar.php"); // Redirect user after successful verification
        exit;
    } else {
        echo "Error: Failed to store data in Firestore. HTTP Code: $httpcode";
    }
}
?>

<div class="container">
    <div class="fs-1 text-center my-1  fw-bold brownText">
        Phone No. Verification
    </div>
    <div class="row">
        <div class="col-6">
            <center class="mb-3">
                <img src="../images/otp/otp.png" height="550px" width="700px" />
            </center>
        </div>
        <div class="col-6 mt-5">
            <form method="post">
                <div class="brownText fs-4 mx-5 mb-1">Phone no.</div>
                <input type="text" name="phno" id="number" class="form-control form-control-lg formInputColor mx-5 py-2 mb-1" style="border: none;" placeholder="Phone No." value="<?php echo $phno ?>" />
                <label for="" class="text-danger"><?php echo $phnoError; ?></label>
                <center>
                    <div class="recaptcha-container" id="recaptcha-container"></div>
                </center>
                <center>
                    <button class="formBtn mt-1 mb-3 px-4" name="btnOTP" onclick="phoneAuth()">GET OTP </button>
                </center>
                <div class="userInput">
                    <input type="text" id="ist" class="otp formInputColor" maxlength="1" name="a" onkeyup="clickEvent(this,'sec',this)" />
                    <input type="text" id="sec" class="otp formInputColor" maxlength="1" name="b" onkeyup="clickEvent(this,'third','ist')" />
                    <input type="text" id="third" maxlength="1" class="otp formInputColor" name="c" onkeyup="clickEvent(this,'fourth','sec')" />
                    <label for="" style="font-size: 20px;" class="text-center my-4">-</label>
                    <input type="text" id="fourth" maxlength="1" class="otp formInputColor" name="d" onkeyup="clickEvent(this,'fifth','third')" />
                    <input type="text" id="fifth" maxlength="1" class="otp formInputColor" name="e" onkeyup="clickEvent(this,'sixth','fourth')" />
                    <input type="text" id="sixth" maxlength="1" class="otp formInputColor" name="f" onkeyup="clickEvent(this,this,'fifth')" />
                </div>
                <input type="hidden" name="verificationCode" id="verificationCode" value="<?php echo $ootp ?>">
                <center>
                    <button class="formBtn mt-3 px-4" name="btnOTP" onclick="codeVerify()">VERIFY </button>
                </center>
            </form>
        </div>
    </div>
</div>
<script src="../js/index.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>
<script src="../js/firebaseConnection.js"></script>
<script src="../js/firebase.js"></script>
</body>
</html>
