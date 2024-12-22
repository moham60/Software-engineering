let sendMessage = document.getElementById("sendMessage");
let arrMessages = [];
let inputMessage = document.getElementById("message");

if (localStorage.getItem("message")) {
  JSON.parse(localStorage.getItem("message")).forEach((e) => {
    document.querySelector(
      ".chat-messages"
    ).innerHTML += `<div class="message"><div class="avatar">
                    <img class="w-100" src="./images/avatar.png" alt="" />
                  </div>
                  <div class="text">${e}</div></div>`;
  });
}
sendMessage.addEventListener("click", function () {
  if (inputMessage.value !== "") {
    document.querySelector(
      ".chat-messages"
    ).innerHTML += `<div class="message"><div class="avatar">
                    <img class="w-100" src="./images/avatar.png" alt="" />
                  </div>
                  <div class="text">${inputMessage.value}</div></div>`;
    arrMessages.push(inputMessage.value);
    localStorage.setItem("message", JSON.stringify(arrMessages));
  }
  inputMessage.value = "";
});
