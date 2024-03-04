<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="shortcut icon" href="../images/icon_logo.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/color.css" />
    <title>SevaSanskriti</title>
</head>

<body>
    <nav>
        <input type="checkbox" id="checkBox" />
        <label for="checkBox" id="checkBtn"><i class="fa-solid fa-bars"></i></label>
        <img class="logo" src="../images/website_logo.png" alt="Seva Sankriti" />

        <ul>
            <li><a href="./navbar.php">Home</a></li>
            <li><a href="./blog.php">Blog</a></li>
            <li><a href="./about.php">About</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                    Services
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="./ngos.php">NGOs</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./feedback.php">Feedback</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./contact.php">Contact</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../php/terms.php">Terms & Condition</a>
                    </li>
                </ul>
            </li>
            <li><a href="./login.php?fm=profile">Profile</a></li>
            <li>
                <a href="./login.php?fm=donate" class="formBtn mx-3 px-4 fs-5">Donate</a>
            </li>
        </ul>
    </nav>