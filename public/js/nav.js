//MENU
const btnSubmenu = document.getElementById('container_profil_thumbnail');
const submenu = document.getElementById('container_submenu');
const triangle = document.getElementById('triangle');

//show submenu navbar
btnSubmenu.addEventListener('click', function(){
    submenu.style.display = 'block';
    triangle.style.display = 'block';
});

//Hide submenu navbar
document.addEventListener('click', function(event) {
    var isClickInsideElement = btnSubmenu.contains(event.target);
    if (!isClickInsideElement) {
        submenu.style.display = 'none';
        triangle.style.display = 'none';
    }
});