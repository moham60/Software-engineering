
    

let darkMode=document.querySelector(".darkMode");


darkMode.addEventListener("click",function(){
    document.body.children[0].classList.toggle("dark-Mode")
    var arr=Array.from(document.body.children[0].children)
    console.log(arr)
    arr.forEach(e=>{
        if(e.classList.contains("bg-white")||e.classList.contains("bg-white")&&e.classList.contains("text-black")){
            e.classList.remove("bg-white");
            e.classList.remove("text-black");
            e.classList.add("dark-Mode");
        }
        else{
            e.classList.remove("dark-Mode");
            e.classList.add("bg-white");
            e.classList.add("text-black");
            
        }
        
    })
    document.querySelectorAll("li a").forEach(e=>{
        e.classList.toggle("btn-outline-dark");
        e.classList.toggle("btn-outline-primary");
    })
    console.log(document.querySelector(".name").nextSibling)

    
})

