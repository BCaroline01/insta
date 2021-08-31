
document.getElementById('next').addEventListener('click', function(){
    let user = document.getElementById('form_sign');
    let dob =  document.getElementById('dob_sign');

    user.style.display = 'none';
    dob.style.display = 'flex';
});
