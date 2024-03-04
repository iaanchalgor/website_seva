window.onload = function () {
  render();
};
function render() {
  window.recaptchVerifier = new firebase.auth.RecaptchaVerifier(
    "recaptcha-container"
  );
  recaptchVerifier.render();
}
var coderesult;

function phoneAuth() {
  //get number
  var phoneNumber = document.getElementById("number").value;
  var appVerifier = window.recaptchVerifier;
  firebase
    .auth()
    .signInWithPhoneNumber(phoneNumber, appVerifier)
    .then(function (confirmationResult) {
      window.confirmationResult = confirmationResult;
      coderesult = confirmationResult;
      alert("Msg sent please verify your phone no.");
    })
    .catch(function (error) {
      alert(error.message);
    });
}

function codeverify() {
  var code = document.getElementById("verificationCode").value;
  if (coderesult) {
    coderesult
      .confirm(code)
      .then(function (result) {
        alert("Successfully registered");
        var user = result.user;
        console.log(user);
      })
      .catch(function (error) {
        alert(error.message);
      });
  }
}
