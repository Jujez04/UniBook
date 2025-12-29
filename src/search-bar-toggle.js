const searchButton = document.querySelector('#searchActivator');
const searchCloseButton = document.querySelector('#searchCloseBtn');
const leftContainer = document.querySelector('nav > div:first-child');

searchButton.addEventListener('click', () => {
    leftContainer.classList.toggle('d-none');
});
searchCloseButton.addEventListener('click', () => {
    leftContainer.classList.toggle('d-none');
});