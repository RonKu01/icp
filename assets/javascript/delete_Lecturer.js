const form3 = document.querySelector("#deleteEmployeeModal > div > div > form"),
continueBtn3 = form3.querySelector("#dltBtn"),
errorText3 = document.querySelector("#error-text");

form3.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn3.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/delete_Lecturer.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href="../view/manage_Lecturer.php";
              }else{
                  errorText3.style.display = "block";
                  errorText3.textContent = data;
              }
          }
      }
    }
    let formData = new FormData(form3);
    xhr.send(formData);
}
