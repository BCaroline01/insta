
//check if all the inputs are filled to move to the DOB form and change     
window.addEventListener('change', function(){
    
    const btnNext = document.getElementById('next')
    const email = document.getElementById("users_email")
    const name = document.getElementById("users_name")
    const username = document.getElementById("users_username")
    const password = document.getElementById("users_password")

    if(email.value.length != 0 && name.value.length != 0 && username.value.length != 0 && password.value.length > 8){

        btnNext.style.backgroundColor = '#0095f6';

        btnNext.addEventListener('click', function(){
            let user = document.getElementById('form_sign');
            let dob =  document.getElementById('dob_sign');

            user.style.display = 'none';
            dob.style.display = 'flex';
        });
    }  
}); 

//check if one select is change for the dob form

const text = document.getElementById('enter_date')
const btnSubmit = document.getElementById('submit')
const month = document.getElementById("users_dob_month")
const day = document.getElementById("users_dob_day")
const year = document.getElementById("users_dob_year")

month.addEventListener('change', function () {
    btnSubmit.style.backgroundColor = '#0095f6'
    text.style.display = 'none'
    btnSubmit.disabled = false
});

day.addEventListener('change', function () {
    btnSubmit.style.backgroundColor = '#0095f6'
    text.style.display = 'none'
    btnSubmit.disabled = false
});

year.addEventListener('change', function () {
    btnSubmit.style.backgroundColor = '#0095f6'
    text.style.display = 'none'
    btnSubmit.disabled = false
});

//modal DOb form
const btnModal = document.getElementById('btn_birthday')
const modal = document.getElementById("Modal_dob");

btnModal.addEventListener('click', function () {

    document.body.style['overflow-y'] = 'hidden';

    var modalbackground = document.createElement("div");
    modalbackground.setAttribute("id", "background");
    modal.prepend(modalbackground);

    var modalcontainer = document.createElement("div");
    modalcontainer.setAttribute("id", "container");
    modalbackground.prepend(modalcontainer);

    var modalheader = document.createElement("div");
    modalheader.setAttribute("id", "modal_header");
    modalcontainer.append(modalheader);

    var modalempty = document.createElement("div");
    modalheader.append(modalempty);

    var modalh1 = document.createElement("h1");
    modalh1.innerHTML = 'Anniversaires';
    modalheader.append(modalh1);

    var span = document.createElement("span");
    span.setAttribute("id", "close");
    span.innerHTML = "&times;";
    modalheader.append(span);
   
    var modalContent = document.createElement("div");
    modalContent.setAttribute("id", "modal_content");
    modalcontainer.append(modalContent);

    var img = document.createElement("img");
    img.src = "/assets/birthday_cake.png"
    modalContent.append(img);

    var modalh3= document.createElement("h3");
    modalh3.innerHTML = 'Dates de naissance sur Instagram';
    modalContent.append(modalh3);

    var modaltext= document.createElement("p");
    modaltext.innerHTML = 'En indiquant votre date de naissance, vous améliorez les fonctionnalités ainsi que les publicités que vous voyez, et vous nous aidez à protéger la communauté Instagram. Vous retrouverez votre date de naissance dans les informations personnelles des paramètres de votre compte.';
    modalContent.append(modaltext);

    var modalfooter = document.createElement("div");
    modalfooter.setAttribute("id", "modal_footer");
    modalcontainer.append(modalfooter);

    var modala= document.createElement("button");
    modala.innerHTML = 'En savoir plus';
    modalfooter.append(modala);

    let close = document.getElementById("close");
    close.addEventListener('click', function () {
        modalbackground.remove();  
        document.body.style['overflow-y'] = 'auto';
    });

});
