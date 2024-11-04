var mode = document.getElementById("icone");

mode.onclick = function() {
    document.body.classList.toggle('dark');
    //++++++++++++++++++
    if(document.body.classList.contains('dark')) {
        icone.classList = "fa-solid fa-sun";
    } else {
        icone.classList = "fa-solid fa-moon";
    }
}