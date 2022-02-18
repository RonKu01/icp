const form = document.querySelector("body > main > form"),
    signInBtn = form.querySelector("body > main > form > button"),
    errorText = form.querySelector("body > main > form > div.error-text");

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
                    location.href = "../view/dashboard_Student.php";
                }else if(data === "Lecturer"){
                    location.href = "../view/dashboard_Lecturer.php";
                }else if(data === "Admin"){
                    location.href = "../view/dashboard_Admin.php";
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

