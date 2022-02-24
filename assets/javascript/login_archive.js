const form = document.querySelector("body > div > div > main > div > div > form"),
    signInBtn = document.querySelector("body > div > div > main > div > div > form > button"),
    errorText = document.querySelector("body > div > div > main > div > div > form > div.error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

signInBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/login.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "Student"){
                    window.open("../view/archive_Student.php", "_blank");
                }else if(data === "Lecturer") {
                    window.open("../view/archive_Lecturer.php", "_blank");
                }else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        } else {
            alert("error");
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

