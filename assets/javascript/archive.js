const form = document.querySelector("#archive_form"),
continueBtn = document.querySelector("#btnArchive"),
errorText2 = document.querySelector("#error-text");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/confirm_archive.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success"){
                    location.href="archive_Lecturer.php";
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