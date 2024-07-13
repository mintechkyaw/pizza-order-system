function toggleEdit() {
    var normalPage = document.getElementById("normalPage");
    var editPage = document.getElementById("editPage");
    let err = false;
    if (normalPage.style.display === "block") {
        normalPage.style.display = "none";
        editPage.style.display = "block";
    } else if (editPage.style.display === "block") {
        editPage.style.display = "none";
        normalPage.style.display = "block";
    }
}
