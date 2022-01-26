  
const toggleSubMenu = (menu, subMenuShowing) => {
    menu.parentElement.addEventListener('click', (event) => {
        if(subMenuShowing.length > 0 && !event.target.matches('.sub-menu li')) {
            subMenuShowing[0].parentElement.classList.remove('sub-menu-active');
            subMenuShowing[0].classList.remove('show-menu');
        } else if(event.target.matches('.sub-menu-active')) {
            event.target.querySelector('.sub-menu').classList.remove('show-menu');
            event.target.classList.remove('sub-menu-active');
            event.stopPropagation();
        } else {
            event.target.querySelector('.sub-menu').classList.add('show-menu');
            event.target.classList.add('sub-menu-active');
            event.stopPropagation();
        }
    })
    // TODO: Look into way of rendering chevron directly server-side in template.
    let menuLink = menu.parentElement.querySelector('a');
    menuLink.innerHTML = menuLink.innerHTML + "<svg class='menu-chevron' width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M5 7.5L10 12.5L15 7.5' stroke='#FFF' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/></svg>";
}

// const toggleMobileMenu = (mainMenu, mobileMenuToggle) => {
//     if (mainMenu.classList.contains('hidden')) {
//         mainMenu.classList.remove('hidden');
//         mainMenu.classList.add('flex');
//         mobileMenuToggle.classList.add('isOpen');
//     } else {
//         mainMenu.classList.remove('flex');
//         mainMenu.classList.add('hidden');
//         mobileMenuToggle.classList.remove('isOpen');
//     }
// }

const closeMenus = (e, mainMenu, mobileMenuToggle) => {
    if (!e.target.matches('.main-menu-container') && !e.target.matches('.main-menu-container li') && !e.target.matches('.di-hamburger') && !e.target.matches('.sub-menu.show-menu li')) {
        let active = document.getElementsByClassName('show-menu');
        let mobileActive = mainMenu.classList.contains('flex');
        let toggles = document.querySelectorAll('.sub-menu');

        if(active && mobileActive) {
            toggles.forEach(toggle => {
                toggle.classList.remove('show-menu');
           });
            mainMenu.classList.add('hidden');
            mainMenu.classList.remove('flex');
            mobileMenuToggle.classList.remove('isOpen');
        }  else if(active) {
            toggles.forEach(toggle => {
                toggle.classList.remove("show-menu");
           });
        } else if(mobileActive) {
            mainMenu.classList.add('hidden');
            mainMenu.classList.remove('flex');
            mobileMenuToggle.classList.remove('isOpen');
        }
       
        
    }
}

document.addEventListener('DOMContentLoaded', () => {
    let subMenu = document.querySelectorAll('.sub-menu');
    let subMenuShowing = document.getElementsByClassName('show-menu');
    subMenu.forEach(menu => toggleSubMenu(menu, subMenuShowing));

    // let mobileMenuToggle = document.querySelector('.di-hamburger');
    // let mainMenu = document.querySelector('.main-menu-container');
    // mobileMenuToggle.addEventListener('click', () => toggleMobileMenu(mainMenu, mobileMenuToggle));

    // window.onclick = (e) => closeMenus(e, mainMenu, mobileMenuToggle)
})
