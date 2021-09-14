
function onClickBtnLike(event){
    event.preventDefault();

    const url = this.href;
    const count = document.querySelector('p.nb-js-like');
    const icon = this.querySelector('.heart');

    axios.get(url).then(function(response){
        const likes = response.data.likes
        count.textContent = likes + ' J\'aime';

        if(icon.classList.contains('like_icon_red')){
            icon.classList.replace('like_icon_red','like_icon');
        } else {
            icon.classList.replace('like_icon','like_icon_red');
        }
    }).catch(function(error){
        if(error.response.status === 403){
            window.alert('Vous devez vous connecter pour liker un post')
        }
    });

}


const btnLike = document.querySelectorAll('a.js-like');
btnLike.forEach(function(link){
    link.addEventListener('click', onClickBtnLike);
})