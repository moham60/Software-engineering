let darkMode = document.querySelector(".darkMode");

darkMode.addEventListener("click", function () {
  document.body.classList.toggle("dark-Mode");
  document.querySelector("aside").classList.toggle("dark-Mode");
  document.querySelectorAll(".cart").forEach((e) => {
    e.classList.toggle("shadow-lg");
    e.style.boxShadow = "0 0 4px #eee";
  });
});
