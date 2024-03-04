function clickEvent(first, last, previous) {
  var verificationCode = "";
  if (first.value.length) {
    document.getElementById(last).focus();
    verificationCode += first.value;
    alert("verification : " + verificationCode);
  }

  if (!first.value) {
    document.getElementById(previous).focus();
    verificationCode -= first.value;
    alert(verificationCode);
    return;
  }
}
function showSuccessAlert() {
  var successModal = new bootstrap.Modal(
    document.getElementById("successModal")
  );
  successModal.show();

  // Hide the modal after 5 seconds
  setTimeout(function () {
    successModal.hide();
  }, 1000);
  return false;
}
