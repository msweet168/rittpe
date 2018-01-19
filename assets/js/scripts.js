
// Handles the hamburger menu used in mobile view. 
function menuFunction() {
        var x = document.getElementById("mytopnav");
        if (x.className === "topnav") {
        x.className += " responsive";
        } else {
        x.className = "topnav";
    }
}
