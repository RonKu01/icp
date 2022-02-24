const form = document.querySelector("body > div > div > main > div > div > div > form");
updateBtn = document.querySelector("body > div > div > main > div > div > div > form > button");
msg_banner = document.querySelector("#msg_banner");

form.onsubmit = (e)=>{
    e.preventDefault();
}

updateBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/update_Student.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              let data = xhr.response;
              if(data === "success"){
                location.href="../view/profile_student.php";
                  msg_banner.style.display = "block";
                  msg_banner.textContent = data;
              }else{
                  msg_banner.style.display = "block";
                  msg_banner.textContent = data;
              }
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
