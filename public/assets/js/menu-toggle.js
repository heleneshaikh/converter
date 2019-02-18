const menuIcon = document.querySelector('.menu-icon');
const navigation = document.querySelector('.navigation');
const navigationWrapper = document.querySelector('.navigation-wrapper');
const navigationList = document.querySelector('.navigation__list');
const items = [menuIcon, navigation, navigationList, navigationWrapper];

menuIcon.addEventListener('click', () => {
   items.forEach(item => item.classList.toggle('open'));
});