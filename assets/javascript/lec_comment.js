const form = document.querySelector("#editEmployeeModal > div > div > form");
continueBtn = document.querySelector("#updateBtn");
errorText = document.querySelector("#error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/lec_comment.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "Update Successfully"){
                location.href="../view/lec_view_logbook.php";
              }else{
                  errorText.style.display = "block";
                  errorText.textContent = data;
              }
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
