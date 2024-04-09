var radlog = document.getElementById("radlog");
var radsig = document.getElementById("radsig");

function showforms(){

    var loginform = document.getElementById("loginform");
    var signform = document.getElementById("signupform");

    if (radlog.checked){
        loginform.style.display = "flex";
        signform.style.display = "none";
    }
    else if(radsig.checked){
        loginform.style.display = "none";
        signform.style.display = "flex";
    }
    else{
        console.log("No one form is checked");
    }
}

radlog.addEventListener("change", showforms);
radsig.addEventListener("change", showforms);

console.log("Script is work");