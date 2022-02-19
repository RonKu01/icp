const form = document.querySelector("body > div > div > main > div > div > div > form"),
updateBtn = document.querySelector("body > div > div > main > div > div > div > form > button");

form.onsubmit = (e)=>{
    e.preventDefault();
}

updateBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/update_Lecturer.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href="../view/profile_lecturer.php";
              }else{
                  errorText2.style.display = "block";
                  errorText2.textContent = data;
              }
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
