// NAVBAR
function toggleMenu() {
    const menu = document.querySelector('.Nav-menu');
    menu.classList.toggle('active');
}

// BOTÃO DE ROLAGEM
const backToTopButton = document.querySelector("#voltar");

backToTopButton.onclick = () =>
    document.documentElement.scroll({
        top: 0,
        behavior: "smooth"
    })

window.onscroll = () => {
    backToTopButton.hidden = !(document.documentElement.scrollTop > 200)
}