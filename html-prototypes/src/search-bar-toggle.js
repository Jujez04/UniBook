const searchButton = document.querySelector('#searchActivator');
const searchCloseButton = document.querySelector('#searchCloseBtn');
const leftContainer = document.querySelector('nav > .container-fluid > div:first-child');
const rightContainer = document.querySelector('#right-container');
searchButton.addEventListener('click', () => {
    rightContainer.classList.toggle('d-none');
    leftContainer.classList.toggle('d-none');
});
searchCloseButton.addEventListener('click', () => {
    rightContainer.classList.toggle('d-none');
    leftContainer.classList.toggle('d-none');
});