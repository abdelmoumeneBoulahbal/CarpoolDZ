
let dropbtn = document.getElementById("arrow");
                
dropbtn.onclick = function () {
    
    document.getElementById("myDropdown").classList.toggle("show");
    
    let currentSrc = dropbtn.getAttribute("src");

    if (currentSrc === "images/icons/angle-small-down.png") {
    
        dropbtn.setAttribute("src", "images/icons/angle-small-up.png");

    } else if (currentSrc === "images/icons/angle-small-up.png") {

        dropbtn.setAttribute("src", "images/icons/angle-small-down.png");
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
                if (currentSrc === "images/icons/angle-small-up.png") {
                    dropbtn.setAttribute("src", "images/icons/angle-small-down.png");
                }


            }
        }
    }


}


let signup = document.getElementById("signup");

signup.onclick = function () {

    document.getElementById("search-home-section").classList.add("hide");
    document.getElementById("review-home-section").classList.add("hide");

    document.getElementById("register-section").classList.add("show");

 
}

let sumbit = document.getElementById("submit");
 sumbit.onclick = function (){
    document.getElementById("search-home-section").classList.toggle("hide");
    document.getElementById("review-home-section").classList.toggle("hide");

    document.getElementById("register-section").classList.toggle("show");
 }


    var inputSpec = document.getElementById("carType");
    inputSpec.style.fontSize = "22px";

    var carName = document.getElementById("carName");
    carName.style.fontSize = "22px";

    var carYear = document.getElementById("carYear");
    carYear.style.fontSize = "22px";



function displayRadioValue() {
    var ele = document.getElementsByName('user-type');
    var userType;

    for (var i = 0; i < ele.length; i++) {
        if (ele[i].checked) {
            userType = ele[i].value;
            break; 
        }
    }

    console.log("Hello " + userType);

    if (userType == "Passenger") {
        document.getElementById("form-passenger").classList.toggle("show");

        if(document.getElementById("form-driver").classList.contains("show")) {
            document.getElementById("form-driver").classList.remove("show");
        }
    }
    if (userType == "Driver") {
        document.getElementById("form-driver").classList.toggle("show");

        if(document.getElementById("form-passenger").classList.contains("show")) {
            document.getElementById("form-passenger").classList.remove("show");
        }
    }
}


var searchBar = document.getElementById("search");
searchBar.style.color = 'white';