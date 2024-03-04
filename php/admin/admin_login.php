<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #edbda3;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#753e20,
                    #b07554);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right,
            #4d2008,
            #bf6c43);
            right: -30px;
            bottom: -80px;
        }

        form {
            height: 520px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #080710;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: #f5d7c6;
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 2px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #999999;
        }

        button {
            margin-top: 20px;
            width: 100%;
            background-color:#9c5936;
            color: #fff;
            opacity: 0.7;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .err {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    $em = $pw = $emError = $pwError = $fError = "";
    require_once('../connection.php');
    if (isset($_POST['btn'])) {

        $em = $_POST['em'];
        $pw = $_POST['pw'];
        if (empty($em)) {
            $emError = "Required *";
        } else {
            if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                $emError = "Please Enter Valid Value";
            }
        }
        if (empty($pw)) {
            $pwError = "Required *";
        } else {
            if (strlen($pw) <= 6) {
                $pwError = "Password shoud be greater than 6 characters";
            }
        }
        if ($emError == "" && $pwError == "") {
            $qry = "select * from admins where email = '$em' and pw='$pw'";
            $res = mysqli_query($con, $qry);
            
            if ($res) {
                $row_count = mysqli_num_rows($res);
        
                if ($row_count > 0) {
                    // Valid login credentials, redirect to profile page
                    header("Location: admin.php");
                    exit(); 
                } else {
                    $fError = "Invalid email address or password";
                }
            } else {
                // Handle query execution error
                echo "Query execution error: " . mysqli_error($con);
            }

            //     header("Location:admin.php");
            // } else {
            //     $fError = "Invalid Email Or Password";
            // }
        }
    }
    ?>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post">
        <h3>Login Here</h3>

        <label for="username">Email Address</label>
        <input type="text" name="em" placeholder="Email Address" id="username" value="<?php echo $em ?>">
        <div for="" class="err"><?php echo $emError ?></div>
        <label for="password">Password</label>
        <input type="password" name="pw" placeholder="Password" id="password" value="<?php echo $pw ?>">
        <div for="" class="err"><?php echo $pwError ?></div>
        <button name="btn">Log In</button>
        <div for="" class="err" style="text-align:center;margin-top:5px"><?php echo $fError ?></div>
    </form>
</body>

</html>