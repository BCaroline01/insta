
const btnSave = document.querySelectorAll('btn.save_post_Btn');
btnSave.forEach(function(link){
    link.addEventListener('click', onClickBtnLike);
})