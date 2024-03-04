<?php

/*require_once('header.php');

// Firebase Firestore configuration
$projectId = "lastt-93374";
$collection = "register";
$url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection:runQuery";

// Function to validate the input
function validateInput($data) {
    return htmlspecialchars(trim($data));
}

$fError = $em = $pw = $pwError = $emError = $fm = $id = "";

if (isset($_REQUEST['fm'])) {
    $fm = $_REQUEST['fm'];
}

if (isset($_POST['btn'])) {
    $em = validateInput($_POST['em']);
    $pw = validateInput($_POST['pw']);

    if (empty($pw)) {
        $pwError = "Required *";
    } else {
        if (strlen($pw) <= 6) {
            $pwError = "Password should be greater than 6 characters";
        }
    }
    if (empty($em)) {
        $emError = "Required *";
    } else {
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $emError = "Please enter a valid email address";
        }
    }
    
    // If there are no validation errors, proceed with login
    if (empty($emError) && empty($pwError)) {
        // Firestore query data
        $data = [
            "structuredQuery" => [
                "from" => [
                    [
                        "collectionId" => $collection
                    ]
                ],
                "where" => [
                    "fieldFilter" => [
                        "field" => [
                            "fieldPath" => "email"
                        ],
                        "op" => "EQUAL",
                        "value" => [
                            "stringValue" => $em
                        ]
                    ]
                ]
            ]
        ];

        // Send data to Firestore
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = curl_exec($ch);

        // Check if there was an error with the cURL request
        if ($response === false) {
            echo "cURL error: " . curl_error($ch);
            curl_close($ch);
            exit();
        }

        // Decode the response
        $responseData = json_decode($response, true);

        // Check if user exists
        if (!empty($responseData['documents'])) {
            // User found, redirect to appropriate page
            if ($fm == 'profile') {
                // Redirect to profile page
                header("Location: profile.php");
                exit();
            } elseif ($fm == 'donate') {
                // Extract user ID from Firestore document path
                $id = basename($responseData['documents'][0]['name']);
                // Redirect to donation page with user ID
                header("Location: donation.php?uid=$id");
                exit();
            }
        } else {
            // User not found, display error message
            $fError = "Invalid email address or password";
        }
        
        // Close cURL handle
        curl_close($ch);
    }
}
?>




<!-- Your HTML code for the login form goes here -->

<div class="container-fluid">
  <div class="row mt-2">
    <div class="col-md-6 mt-5">
      <img src="../images/forms/login.png" alt="" height="550px" />
    </div>


    <div class="col-md-6 d-flex justify-content-center align-items-center">
      <div class="login-form container px-4">
        <div class="brownText fw-bold fs-1 text-center">LOG IN</div>
        <form method="post">
          <div class="mb-3">
            <input type="text" class="form-control mt-4 formInputColor py-2" id="exampleInputEmail1" placeholder="Enter Your Email Address" style="border-color: #faefed;" name="em" value="<?php echo $em?>"/>
          <!--  <div class="text-danger"><?php echo $emError?></div>-->
          </div>
          <div class="mb-3">
            <input type="password" class="form-control formInputColor py-2" id="exampleInputPassword1" name="pw" placeholder="Enter Your Password" style="border-color: #faefed;" value="<?php echo $pw?>"/>
           <!--    <div class="text-danger"><?php echo $pwError?></div>-->
          </div>

          <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input " id="exampleCheck1" />
            <label class="form-check-label" for="exampleCheck1">Remeber Me</label>
          </div> -->
          <button type="submit" class="formBtn brownBackground whiteText px-4" name="btn">SIGN IN</button>
          <div class="text-danger"><?php echo $fError?></div>
          <div class="pt-3 ">Do not have account?<a href="./register.php?fm=<?php echo $fm?>" class="brownText mx-2 fw-bold link">Sign Up Now</a></div>
        </form>
      </div>
    </div>


  </div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>*/



require_once('header.php');

// Firebase Firestore configuration
$projectId = "lastt-93374";
$collection = "register";
$url = "https://firestore.googleapis.com/v1/projects/$projectId/databases/(default)/documents/$collection:runQuery";

// Function to validate the input
function validateInput($data) {
    return htmlspecialchars(trim($data));
}

$fError = $em = $pw = $pwError = $emError = $fm = $id = "";

if (isset($_REQUEST['fm'])) {
    $fm = $_REQUEST['fm'];
}

if (isset($_POST['btn'])) {
    $em = validateInput($_POST['em']);
    $pw = validateInput($_POST['pw']);

    if (empty($pw)) {
        $pwError = "Required *";
    } else {
        if (strlen($pw) <= 6) {
            $pwError = "Password should be greater than 6 characters";
        }
    }
    if (empty($em)) {
        $emError = "Required *";
    } else {
        if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
            $emError = "Please enter a valid email address";
        }
    }
    
    // If there are no validation errors, proceed with login
    if (empty($emError) && empty($pwError)) {
        // Firestore query data
        $data = [
            "structuredQuery" => [
                "from" => [
                    [
                        "collectionId" => $collection
                    ]
                ],
                "where" => [
                    "compositeFilter" => [
                        "op" => "AND",
                        "filters" => [
                            [
                                "fieldFilter" => [
                                    "field" => [
                                        "fieldPath" => "email"
                                    ],
                                    "op" => "EQUAL",
                                    "value" => [
                                        "stringValue" => $em
                                    ]
                                ]
                            ],
                            [
                                "fieldFilter" => [
                                    "field" => [
                                        "fieldPath" => "pw"
                                    ],
                                    "op" => "EQUAL",
                                    "value" => [
                                        "stringValue" => $pw
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Send data to Firestore
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = curl_exec($ch);

        // Check if there was an error with the cURL request
        if ($response === false) {
            echo "cURL error: " . curl_error($ch);
            curl_close($ch);
            exit();
        }

        // Decode the response
        $responseData = json_decode($response, true);

        // Check if user exists
        if (!empty($responseData['documents'])) {
            // User found, redirect to appropriate page
            if ($fm == 'profile') {
                // Redirect to profile page
                header("Location: profile.php");
                exit();
            } elseif ($fm == 'donate') {
                // Extract user ID from Firestore document path
                $id = basename($responseData['documents'][0]['name']);
                // Redirect to donation page with user ID
                header("Location: donation.php?uid=$id");
                exit();
            }
        } else {
            // User not found, display error message
            $fError = "Invalid email address or password";
        }
        
        // Close cURL handle
        curl_close($ch);
    }
}
?>

<!-- Your HTML code for the login form goes here -->

<div class="container-fluid">
  <div class="row mt-2">
    <div class="col-md-6 mt-5">
      <img src="../images/forms/login.png" alt="" height="550px" />
    </div>


    <div class="col-md-6 d-flex justify-content-center align-items-center">
      <div class="login-form container px-4">
        <div class="brownText fw-bold fs-1 text-center">LOG IN</div>
        <form method="post">
          <div class="mb-3">
            <input type="text" class="form-control mt-4 formInputColor py-2" id="exampleInputEmail1" placeholder="Enter Your Email Address" style="border-color: #faefed;" name="em" value="<?php echo $em?>"/>
            <div class="text-danger"><?php echo $emError?></div>
          </div>
          <div class="mb-3">
            <input type="password" class="form-control formInputColor py-2" id="exampleInputPassword1" name="pw" placeholder="Enter Your Password" style="border-color: #faefed;" value="<?php echo $pw?>"/>
            <div class="text-danger"><?php echo $pwError?></div>
          </div>

          <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input " id="exampleCheck1" />
            <label class="form-check-label" for="exampleCheck1">Remeber Me</label>
          </div> -->
          <button type="submit" class="formBtn brownBackground whiteText px-4" name="btn">SIGN IN</button>
          <div class="text-danger"><?php echo $fError?></div>
          <div class="pt-3 ">Do not have account?<a href="./register.php?fm=<?php echo $fm?>" class="brownText mx-2 fw-bold link">
