const form = document.querySelector("#upload_form"),
continueBtn = document.querySelector("#btnSubmit"),
errorText2 = document.querySelector("#error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/archive_Student.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "Successfully Uploaded!"){
                    alert(data);
                    location.href="archive_Student.php";
                } else if (data === "Successfully Resubmitted!"){
                    alert(data);
                    location.href="archive_Student.php";
                } else {
                    errorText2.style.display = "block";
                    errorText2.textContent = data;
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}