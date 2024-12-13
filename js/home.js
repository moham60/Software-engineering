let darkMode = document.querySelector(".darkMode");

darkMode.addEventListener("click", function () {
  document.body.classList.toggle("dark-Mode");
  document.querySelector("aside").classList.toggle("dark-Mode");
  document.querySelectorAll(".cart").forEach((e) => {
    e.classList.toggle("shadow-lg");
    e.style.boxShadow = "0 0 4px #eee";
  });
 document.querySelectorAll("ul li a").forEach(e=>{
     e.classlist.toggole("btn-outline-dark");
      e.classlist.toggole("btn-outline-primary");
    });
}
