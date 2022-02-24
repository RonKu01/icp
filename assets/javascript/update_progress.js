const form2 = document.querySelector("#editEmployeeModal > div > div > form"),
continueBtn2 = form2.querySelector("#updateBtn");
errorText2 = document.querySelector("#error-text");

form2.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn2.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/update_Progress.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "Update Successfully"){
                location.href="../view/list_supervisee.php";
              }else{
                  errorText2.style.display = "block";
                  errorText2.textContent = data;
              }
          }
      }
    }
    let formData = new FormData(form2);
    xhr.send(formData);
}
