
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
}

function contract() {
	document.getElementById("memCont").style.marginLeft = "80px";
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