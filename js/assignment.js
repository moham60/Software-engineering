let uploadAssignment=document.getElementById("uploadAssignment");
let addAssignment=document.getElementById("addAssignment");
let assignmentRow=document.querySelector(".assignmentsRow")
var countPng=0,countpdf=0,countppt=0;
var date=new Date();
 
addAssignment.addEventListener("click",function(){
    if(uploadAssignment.value!==""){
     var deadline=prompt("please enter deadline");
        var extension=uploadAssignment.files[0].name.slice(uploadAssignment.files[0].name.lastIndexOf(".")+1)
        if(extension==="pdf"||extension==="png"||extension==="ppt"||extension==="pptx"){
          assignmentRow.innerHTML+=`
          <div class="col-lg-4 col-md-6 text-center ">
      <div class="assignment shadow-lg bg-white px-2 pt-5 pb-4  position-relative">
    <i class="fa-solid fa-download position-absolute top-0 start-0 ms-2 mt-1"></i>
    <img width="55p" src="./images/${extension==="pptx"?"eps":extension}.svg" alt="">           
      <span class="d-block mt-2 num-assignment">${uploadAssignment.files[0].name} </span>
      <div class="info mt-2 border-top pt-3 d-flex align-items-center justify-content-between   ">
           <span class="text-secondary">deadline ${deadline?deadline:date.getFullYear/date.getMonth()+1/date.getDate()}</span>
      <span class="text-secondary">${(uploadAssignment.files[0].size / 1000000).toPrecision(2)}mb</span>
      </div>
          </div>
          </div>`
        }
        else{
          alert("please enter valid ppt or png or pdf files")
        }
      
        if(extension==="png"){
         countPng++;
         document.querySelector(".images-files").classList.remove("d-none");
            document.querySelector(".images-files").innerHTML=`<div class="d-flex w-100 align-items-center justify-content-between">
                    <span><i class="fa-regular fa-images fa-lg center-flex c-green icon text-success me-2"></i>png files</span>
                    <span>${countPng} files</span>
                </div>`
        }
        else if(extension==="ppt"||extension==="pptx"){
          icon=`<i class="fa-regular fa-file-powerpoint text-warningme-2"></i>`
          countppt++;
          document.querySelector(".pdf-powerPoint").classList.remove("d-none");
          document.querySelector(".pdf-powerPoint").innerHTML=`<div class="d-flex w-100 align-items-center justify-content-between">
          <span><i class="fa-regular fa-file-powerpoint me-2 text-warning"></i>png files</span>
          <span>${countppt} files</span>
      </div>`
        }
        else if(extension==="pdf"){
         
          countpdf++;
          document.querySelector(".pdf-files").classList.remove("d-none");
          document.querySelector(".pdf-files").innerHTML=`<div class="d-flex w-100 align-items-center justify-content-between">
          <span><i class="fa-regular fa-file-pdf fa-lg center-flex c-blue icon me-2 p-2 text-dangerme-2"></i>png files</span>

          <span>${countpdf} files</span>
         </div>`
        }
        
    }
})
