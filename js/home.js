let darkMode = document.querySelector(".darkMode");

if (JSON.parse(localStorage.getItem("darkMode")) == "true") {
  document.body.classList.toggle("dark-Mode");
  document.querySelector("aside").classList.toggle("dark-Mode");
  document.querySelectorAll("aside li a").forEach((e) => {
    e.classList.toggle("btn-outline-dark");
    e.classList.toggle("btn-outline-primary");
  });
  document.querySelectorAll(".cart").forEach((e) => {
    e.classList.add("shadow-lg");
    e.style.boxShadow = "0 0 4px #eee";
  });
}

darkMode.addEventListener("click", function () {
  document.body.classList.toggle("dark-Mode");
  document.querySelector("aside").classList.toggle("dark-Mode");
  document.querySelectorAll("aside li a").forEach((e) => {
    e.classList.toggle("btn-outline-dark");
    e.classList.toggle("btn-outline-primary");
  });
  document.querySelectorAll(".cart").forEach((e) => {
    e.classList.toggle("shadow-lg");
    e.style.boxShadow = "0 0 4px #eee";
  });
  if (localStorage.getItem("darkMode")) {
    localStorage.clear();
  } else {
    localStorage.setItem("darkMode", JSON.stringify("true"));
  }
});

let logOut = document.getElementById("logOut");

logOut.addEventListener("click", function () {
  window.location.href = "index.html";
});

let links = document.querySelectorAll("li a");

links.forEach((e) => {
  e.classList.add("active");
  if (window.location.href != e.href) {
    e.classList.remove("active");
  } else {
    e.classList.add("active");
  }
});
