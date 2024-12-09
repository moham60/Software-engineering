let regsterName=document.getElementById("nameInpt");
let regsterEmail=document.getElementById("rEmailInpt");
let regsterPassword=document.getElementById("rPasswordInpt");
let forms=document.querySelectorAll("form");
let registerBtn=document.getElementById("registerBtn")
let arrOfUsers=[];
forms.forEach(e=>{
    e.addEventListener("submit",function(e){
        e.preventDefault()
    })
})
if(localStorage.getItem("user")){
    arrOfUsers=JSON.parse(localStorage.getItem("user"))
}
/**validation */

function validation(inpt){
    let regex={
        nameInpt:/^[A-Z][a-z]{2,}$/,
        rEmailInpt:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
        rPasswordInpt:/\S{10,}/
    }
    
    var isValid=regex[inpt.id].test(inpt.value);
    
    setValidationState(inpt,isValid)
    return isValid
}

function setValidationState(inpt,isValid){   
    if(isValid){
        inpt.nextElementSibling.classList.add("d-none")
        inpt.classList.remove("is-invalid");
        inpt.classList.add("is-valid");
        
     }
     else{
        inpt.nextElementSibling.classList.remove("d-none")
        inpt.classList.add("is-invalid");
     }
   
    
}
function existedEmail(email){
    var isExist;
   
    let arrOfUsersInLocal=JSON.parse(localStorage.getItem("user"));
    if(arrOfUsersInLocal&&arrOfUsersInLocal.length>0){
        arrOfUsersInLocal.forEach(e=>{
            if(e.email===email){
                isExist=true;
            }
            else{
                isExist=false;
            }
        })
    }
    else{
        isExist=false;
    }
    
   return isExist;
}
/** */
/*add newUser*/
registerBtn.addEventListener("click",function(e){
    e.preventDefault();
    
    if(validation(regsterEmail)&&validation(regsterName)&&validation(regsterPassword)){
        if(existedEmail(regsterEmail.value)===false){
            addUser();
            window.location.href="index.html"
        }
        else{
            Swal.fire({
                title: "Error!",
                text: `this email is already existed`,
                icon: "error",
                confirmButtonText: "Ok",
              });
        }
   
    }
    else{
        Swal.fire({
            title: "Error!",
            text: `please enter valid follow rules under inputs    `,
            icon: "error",
            confirmButtonText: "Ok",
          });
    }
    
})
function addUser(){
    let user={
        name:regsterName.value,
        email:regsterEmail.value,
        pass:regsterPassword.value,
        logIn:"",
    }
    arrOfUsers.push(user);
    addToLocal();
}

/** */
/**add to local storage */
function addToLocal(){
    localStorage.setItem("user",JSON.stringify(arrOfUsers));
}
/** */
