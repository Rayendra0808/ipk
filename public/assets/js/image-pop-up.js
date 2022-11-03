document.addEventListener('DOMContentLoaded', function () {
    let imagePopUps = document.querySelectorAll('.image-pop-up')
    let body = document.querySelector('body')
    // image pop up modal
    let imagePopUpModal = document.querySelector('.image-pop-up-modal')
    let modalImage = imagePopUpModal.querySelector('.modal-image')
    let modalCaption = imagePopUpModal.querySelector('.modal-caption')
    imagePopUps.forEach(function (imagePopUp) {
        imagePopUp.addEventListener('click', function () {
            imagePopUpModal.style.display = 'flex'
            modalImage.src = imagePopUp.getAttribute('src')
            modalCaption.textContent = imagePopUp.getAttribute('alt')
            body.style.overflowY = 'hidden'
        })
    })

    // close button
    let btnClose = imagePopUpModal.querySelector('.close');
    btnClose.addEventListener('click', function () {
        closeModal()
    })

    // outside modal
    imagePopUpModal.addEventListener('click', function (e) {
        if (e.target.matches(".image-pop-up-modal .close") || !e.target.closest(".modal-image")) {
            closeModal()
        }
    })

    function closeModal() {
        imagePopUpModal.style.display = "none";
        body.style.overflowY = 'visible'
    }
});