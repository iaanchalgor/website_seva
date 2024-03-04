<?php
require_once('header.php');
$a = $b = $c = $d = $e = $f = $ootp = "";
$fmValue = $phnoValue = "";

if (isset($_REQUEST['fm'])) {
  $fmValue = $_REQUEST['fm'];
  $phno = "+91" . $_REQUEST['phno'];
}
echo $fmValue;




?>

<body>
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
        <form method="post" class="contactForm">
          <div class="formcontainer">

            <div class="container">
              <div class="brownText fs-4 mx-5 mb-1">Phone no.</div>
              <input type="text" id="number" class="form-control form-control-lg formInputColor mx-5 py-2 mb-3" style="border: none;" placeholder="Phone No." value="<?php echo $phno ?>">
            </div>
            <center>
              <div class="recaptcha-container mb-2" id="recaptcha-container"></div>
              <button type="button" onclick="phoneAuth()" name="btnPHno" class="formBtn mt-1 mb-2 px-4">Send OTP</button>
            </center>
          </div>
        </form>
        <form method="post" class="contactForm">
          <div class="formcontainer">
            <hr>
            <div class="container">
              <center>
                <div class="brownText fs-4 mx-5 mb-1">Verification Code</div>
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
              <input type="text" id="verificationCode" placeholder="Enter Your Verification Code" required>
            </div>
            <center>
              <!-- <button class="formBtn mt-3 px-4" name="btnOTP" onclick="codeVerify()">VERIFY </button> -->
              <button type="button" class="formBtn mt-1 mb-2 px-4" onclick="codeverify()">Verify OTP</button>
            </center>
          </div>
        </form>
      </div>
    </div>
    <script src="../js/index.js"></script>
    <script>

    </script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>
    <script src="../js/firebaseConnection.js"></script>
    <script src="../js/firebase.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>