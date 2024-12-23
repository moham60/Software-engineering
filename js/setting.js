let changeEmail = document.getElementById("changeEmail");
changeEmail.addEventListener("click", function () {
  document.getElementById("userEmail").removeAttribute("disabled");
});

let changePass = document.getElementById("changePassword");
changePass.addEventListener("click", function () {
  document.getElementById("passwordUser").removeAttribute("disabled");
});


let deleteEmail = document.getElementById("deleteBtnEmail");

deleteEmail.addEventListener("click", function () {
  document.querySelector(".deleteEmail").classList.remove("d-none");
});
