<?php


// Firebase Firestore configuration
$projectId = "lastt-93374";
$collection = "registerNgo2";
$url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection";

// Function to validate the input
function validateInput($data) {
    return htmlspecialchars(trim($data));
}
require_once('header.php');


$pw = $cpw = $link = $upi = $des = $activity = "";
$arr=array();
$pwError = $cpwError = $linkError = $upiError = $addressError=$activityError = "";

if (isset($_POST['btn'])) {
    $link = validateInput($_POST['link']);
    $upi = validateInput($_POST['upi']);
    $pw = validateInput($_POST['pw']);
    $cpw = validateInput($_POST['cpw']);
    $des = validateInput($_POST['des']);
    $arr = isset($_POST['arr']) ? $_POST['arr'] : [];
    // $activity = $_POST['arr[]'];
    if(empty($arr)){
        $activityError="Required*";
    }
    
    if (empty($pw)) {
        $pwError = "Required *";
    } else {
        if (strlen($pw) <= 6) {
            $pwError = "Password should be greater than 6 characters";
        }
    }
    if (empty($cpw)) {
        $cpwError = "Required *";
    } else {
        if (strcmp($cpw, $pw) != 0) {
            $cpwError = "Both password should be same";
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
    if (empty($des)) {
        $addressError = "Required *";
    }
    if ($upiError == "" && $linkError == ""  && $pwError == "" && $cpwError == "" && $addressError == "") {
       // Prepare data for Firestore
        $data = [
            "fields" => [
                "link" => ["stringValue" => $link],
                "upi" => ["stringValue" => $upi],
                "password" => ["stringValue" => $pw],
                "description" => ["stringValue" => $des],
                "activities" => ["arrayValue" => ["values" => array_map(function($value) {
                    return ["stringValue" => $value];
                }, $arr)]]
            ]
        ];

        // Send data to Firestore
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Handle response
        if ($httpCode == 200) {
            // Data successfully stored in Firestore
            // Redirect user to a success page or display a success message
            header('Location: navbar.php');
            exit();
        } else {
            // Error occurred while storing data
            // Handle the error accordingly
            echo "Error: Unable to store data in Firestore. HTTP code: $httpCode";
        }
    }
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
    <br>
    <form class="contactForm" method="post">
        <div class="row">
            <div class="col-sm-6">
                <input type="text" name="link" class="form-control form-control-lg"
                    placeholder="Paste website/social media link of NGO" value="<?php echo $link ?>" />
                <label for="" class="text-danger">
                    <?php echo $linkError ?>
                </label>
            </div>
            <div class="col-sm-6">
                <input type="text" name="upi" class="form-control form-control-lg" placeholder="UPI I'd of NGO"
                    value="<?php echo $upi ?>" />
                <label for="" class=" text-danger">
                    <?php echo $upiError ?>
                </label>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <input type="password" id="sub" name="pw" class="form-control form-control-lg" placeholder="Password"
                    value="<?php echo $pw ?>" />
                <label for="" class=" text-danger">
                    <?php echo $pwError ?>
                </label>
            </div>
            <div class="col-sm-6 ">
                <input type="text" id="sub" name="cpw" class="form-control form-control-lg"
                    placeholder="Confirm Password" value="<?php echo $cpw ?>" />
                <label for="" class=" text-danger">
                    <?php echo $cpwError ?>
                </label>
            </div>
        </div>

        <div class="row mb-1">
            <label for="" class="brownText mb-2 fs-5">Select Activities of NGO :</label><br>
            <div class="col-sm-6 h5">
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Health & HealthCare">Health & HealthCare
                </span>
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Environment & Conservation">Environment & Conservation
                </span>


            </div>
            <div class="col-6 h5">
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Children & Youth">Children & Youth
                </span>
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Poverty Alleviation">Poverty Alleviation
                </span>


            </div>
        </div>
        <div class="row">
            <div class="col-6 h5">
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Food Distribution">Food Distribution
                </span>
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Drug Abuse & Addiction">Drug Abuse & Addiction
                </span>
            </div>
            <div class="col-6 h5">
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Global Development">Global Development
                </span>
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Orphanges">Orphanges
                </span>

            </div>

        </div>
        <div class="row">
            <div class="col-6 h5">
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Democracy & Governance">Democracy & Governance
                </span>
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Mental Health Counseling"> Mental Health Counseling
                </span>
            </div>
            <div class="col-6 h5">
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Animal Welfare">Animal Welfare
                </span>
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Old Age Home">Old Age Home
                </span>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-6 h5">
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Bird Welfare">Bird Welfare
                </span>
                <span class="mx-2">
                    <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Economic Development">Economic Development
                </span>
            </div>
            <div class="col-6">
                <span class="mx-2">
                <input type="checkbox" name="arr[]" id="" class="mx-1" VALUE="Other">Other
                </span>
            </div>
        </div>
<div class="row mb-2">
    <div class="col">
    <label for="" class="text-danger">
                    <?php echo $activityError ?>
                </label>
    </div>
</div>

        <div class="row">
            <div class="col-sm-12 mb-2">
                <textarea class="form-control form-control-lg " name="des" id="msg" rows="4"
                    placeholder="Description of NGO"><?php echo $des ?></textarea>
                <label for="" class="text-danger">
                    <?php echo $addressError ?>
                </label>
            </div>
        </div>
        <center>
            <button type="submit" name="btn" class="formBtn px-5 mb-2 fs-5">
                SignUp
            </button>
            <p class="fs-5">
                Are You a Normal User ?
                <span><a href="./register.html" class="brownText ha fw-bold">Register Here</a></span>
            </p>
        </center>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>