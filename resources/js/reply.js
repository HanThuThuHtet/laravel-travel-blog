
const replyBtns = document.querySelectorAll('.reply-btn');
replyBtns.forEach(replyBtn => {
    replyBtn.addEventListener('click',function(){
        replyBtn.nextElementSibling.classList.toggle("d-none");
    })
})
