let emailInpt=document.getElementById("emailInpt");

let passInpt=document.getElementById("passwordInpt");

let logInBtn=document.getElementById("logIn");

/**validation of correct inpt */

function validation(email,pass){
   let users=JSON.parse(localStorage.getItem("user"));
    if(users&&users.length>0){
        for (let i = 0; i < users.length; i++) { 
            if(users[i].email==email&&users[i].pass==pass){
                window.location.href="home.html";
                users[i].logIn="true";
                addToLocal(users);
                break;
            }
            else if(email===""||pass===""){
                Swal.fire({
                    title: "Error!",
                    text: `please fill values of email and password`,
                    icon: "error",
                    confirmButtonText: "Ok",
                  });
            }
            else if(i===users.length-1&&users[i].email!=email||users[i].pass!=pass){
                Swal.fire({
                    title: "Error!",
                    text: `incorrect email or password`,
                    icon: "error",
                    confirmButtonText: "Ok",
                  });
            }
        }
        
    }
      else{
        if(email===""||pass===""){
            Swal.fire({
                title: "Error!",
                text: `please fill values of email and password`,
                icon: "error",
                confirmButtonText: "Ok",
              });
        }
        else{
            Swal.fire({
                title: "Error!",
                text: `email is not exist`,
                icon: "error",
                confirmButtonText: "Ok",
        });
        }

       
      }

}

logInBtn.addEventListener("click",function(e){
    e.preventDefault();
   validation(emailInpt.value,passInpt.value);

});
/** */

/**add to local storage */
function addToLocal(user){
    localStorage.setItem("user",JSON.stringify(user))
}
/** */
