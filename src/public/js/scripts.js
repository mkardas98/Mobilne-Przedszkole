$(document).ready(()=> {
    $('.load').addClass('-ready')
    setTimeout(()=> {
        $('.load').css('display', 'none')
    },1100)
})

const deleteItem = (route) => {
    const  answer = confirm('Czy chcesz usunąć ten element?')
    if (answer){
        window.location = route;
    }
}


