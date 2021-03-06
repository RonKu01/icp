const form = document.querySelector("#editEmployeeModal > div > div > form");
continueBtn = document.querySelector("#updateBtn");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/supervisor_evaluate.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href="../view/list_student.php";
              }
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
