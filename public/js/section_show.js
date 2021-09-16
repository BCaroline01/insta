
const btnSaved = document.querySelector('#save_show_btn');
const btnPostsUser = document.querySelector('#square_post_user');

const sectionSaved = document.querySelector('article.save_post_show');
const sectionPostUser = document.querySelector('article.post_user_show');

const SquareIcon = document.querySelector('.square_icon');
const SaveIcon = document.querySelector('.save_icon');

btnSaved.addEventListener('click',function(event){
    event.preventDefault();

    SquareIcon.style.background = "url('../assets/sprite2.png') no-repeat -160px -369px";
    SaveIcon.style.background = "url('../assets/sprite2.png') no-repeat -12px -389px";

    btnPostsUser.style.borderTop  = "none";
    btnPostsUser.style.color = "#8e8e8e";
    btnSaved.style.borderTop  = "1px solid #262626";
    btnSaved.style.color = "#262626";

    sectionPostUser.style.display = "none";
    sectionSaved.style.display = "flex";

});

btnPostsUser.addEventListener('click',function(event){
    event.preventDefault();

    SquareIcon.style.background = "url('../assets/sprite2.png') no-repeat -174px -369px";
    SaveIcon.style.background = "url('../assets/sprite2.png') no-repeat 0 -389px";

    btnSaved.style.borderTop  = "none";
    btnSaved.style.color = "#8e8e8e";
    btnPostsUser.style.borderTop  = "1px solid #262626";
    btnPostsUser.style.color = "#262626";

    sectionPostUser.style.display = "flex";
    sectionSaved.style.display = "none";

});
