const form6 = document.querySelector("#assign"),
continueBtn5 = document.querySelector("#btnAssign"),
errorText5 = document.querySelector("#error-text");

form6.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn5.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/supervisor_assign.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href="../view/manage_Student.php";
              }
          }
      }
    }
    let formData = new FormData(form6);
    xhr.send(formData);
}
