let changeEmail = document.getElementById("changeEmail");
changeEmail.addEventListener("click", function () {
  document.getElementById("userEmail").removeAttribute("disabled");
});

let changePass = document.getElementById("changePassword");
changePass.addEventListener("click", function () {
  document.getElementById("passwordUser").removeAttribute("disabled");
});
