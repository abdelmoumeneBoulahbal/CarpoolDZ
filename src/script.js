
let dropbtn = document.getElementById("arrow");
                
dropbtn.onclick = function () {
    
    document.getElementById("myDropdown").classList.toggle("show");
    
    let currentSrc = dropbtn.getAttribute("src");

    if (currentSrc === "../img/icons/angle-small-down.png") {
    
        dropbtn.setAttribute("src", "../img/icons/angle-small-up.png");

    } else if (currentSrc === "../img/icons/angle-small-up.png") {

        dropbtn.setAttribute("src", "../img/icons/angle-small-down.png");
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {

                openDropdown.classList.remove('show');


                let currentSrc = dropbtn.getAttribute("src");
                if (currentSrc === "../img/icons/angle-small-up.png") {
                    dropbtn.setAttribute("src", "../img/icons/angle-small-down.png");
                }


            }
        }
    }


}


let signup = document.getElementById("signup");

signup.onclick = function () {
 
}




let eyeicon = document.getElementById("eyeicon");
let password = document.getElementById("password");

eyeicon.onclick = function() {
    if(password.type == 'password'){
        password.type = "text";
        eyeicon.src = "../../img/icons/hide.png";
    }else{
        password.type = "password";
        eyeicon.src = "../../img/icons/show.png";
    }
}



