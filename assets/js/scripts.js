
// Handles the hamburger menu used in mobile view. 
function menuFunction() {
        var x = document.getElementById("mytopnav");
        if (x.className === "topnav") {
        x.className += " responsive";
        } else {
        x.className = "topnav";
    }
}

function expand() {
	document.getElementById("memCont").style.marginLeft = "200px";
	document.getElementsByClassName("sideBar")[0].style.width = "200px";
	document.getElementsByClassName("memberNav")[0].style.width = "200px";
}

function contract() {
	document.getElementById("memCont").style.marginLeft = "80px";
	document.getElementsByClassName("sideBar")[0].style.width = "80px";
	document.getElementsByClassName("memberNav")[0].style.width = "80px";
}

function showEdit() {
	var editWindow = document.getElementById("editPopup");

	if (editWindow.style.display == "block") {
		editWindow.style.display = "none";
		editWindow.style.top = "-30%";
	}
	else {
		editWindow.style.display = "block";
		setTimeout(function(){editWindow.style.top = "50%";}, 10); 
	}

}

function quoteValidate() {
	var quote = document.getElementById("quoteField"); 
	var quotee = document.getElementById("quoteeField");
	var problem = false; 

	if (!quote.value) {
		quote.style.borderColor = "red";
		problem = true;
	}

	if (!quotee.value) {
		quotee.style.borderColor = "red";
		problem = true;
	}

	if (problem == true) {
		return false;
	}
	else {
		return true;
	}
}