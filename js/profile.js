let profileImg = document.querySelector(".profileImage");

let inptRadio = document.querySelectorAll("input[type=radio]");

let saveChangeImage = document.getElementById("saveChangeImage");

document.forms[0].addEventListener("submit", function (e) {
  e.preventDefault();
});
inptRadio.forEach((e) => {
  e.addEventListener("input", function () {
    var newImage = document.createElement("img");
    newImage.src = e.nextElementSibling.firstChild.src;
    newImage.width = 30;
    newImage.classList.add("rounded-circle");
    saveChangeImage.addEventListener("click", function () {
      profileImg.innerHTML = "";
      profileImg.append(newImage);
    });
  });
});
