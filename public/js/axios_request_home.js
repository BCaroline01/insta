
// When click on icon heart redirect url in axios to save like in database 
//and return the number of like for each post

function onClickBtnLike(event){
    event.preventDefault();

    const url = this.href;
    const count = document.querySelector('p.nb-js-like');
    const icon = this.querySelector('.heart');

    axios.get(url).then(function(response){
        //Change the number of likes//
        const likes = response.data.likes
        count.textContent = likes + ' J\'aime';
        
        //switch the icons if user like the post or not//
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

// function addEventListener click on icon //
const btnLike = document.querySelectorAll('a.js-like');
btnLike.forEach(function(linkLikes){
    linkLikes.addEventListener('click', onClickBtnLike);
})

// When click on icon save post redirect url in axios to save posts in database 

function onClickBtnSave(event) {
    event.preventDefault();

    const urlSave = this.href;
    const iconSave = this.querySelector('.save_icon');

    //switch the icons if user save the post or not
    axios.get(urlSave).then(function(){
        if(iconSave.classList.contains('full')){
            iconSave.classList.replace('full','empty');
        } else {
            iconSave.classList.replace('empty','full');
        }
    }).catch(function(error){
        if(error.response.status === 403){
            window.alert('Vous devez vous connecter pour sauvgarder un post')
        }
    });

}

// function addEventListener click on icon
const btnSave = document.querySelectorAll('a.save_post_Btn');
btnSave.forEach(function(linkSave){
    linkSave.addEventListener('click', onClickBtnSave);
})