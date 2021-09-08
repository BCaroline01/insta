//Modal to change or delete the profile picture

const btnModal = document.getElementById('profil_img')
const img = document.getElementById('img_thumbnail')
const thumbnailModal = document.getElementById('thumbnail_modal')
const containerModal = document.getElementById('container_thumbnail_modal')
const btnClose = document.getElementById('cancel')

if( img !== 'assets/profil/default_picture.jpg' ){
    btnModal.addEventListener('click', function(){
        thumbnailModal.style.display = 'flex';
    });

    //Hide modal when click you click outside of the modal
    document.addEventListener('click', function(event) {
        let isClickInsideContainerModal = containerModal.contains(event.target);
        let isClickInsideImg = img.contains(event.target);
        if (!isClickInsideImg && !isClickInsideContainerModal){
            thumbnailModal.style.display = 'none';
        }
    });

    //Hide modal when click you click btn Annuler
    btnClose.addEventListener('click', function(){
        thumbnailModal.style.display = 'none';
    });

  
}