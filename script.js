let prevScrollPos = window.pageYOffset; 

window.onscroll = function() {
    let currentScrollPos = window.pageYOffset;

    if (prevScrollPos < currentScrollPos) {
        document.getElementById("navbar").style.top = "-150px";
    } 
    else {
        document.getElementById("navbar").style.top = "0";
    }
    
    prevScrollPos = currentScrollPos;
}
