const searchButton = document.querySelector('#searchActivator');
const searchCloseButton = document.querySelector('#searchCloseBtn');
const leftContainer = document.querySelector('nav > div > div:first-child');
const  middleContainer = document.querySelector('nav > div > div:nth-child(2)');
const rightContainer = document.querySelector('#right-container');
searchButton.addEventListener('click', () => {
    middleContainer.classList.remove('d-md-block');
    rightContainer.classList.toggle('d-none');
    leftContainer.classList.toggle('d-none');
});
searchCloseButton.addEventListener('click', () => {
    middleContainer.classList.add('d-md-block');
    rightContainer.classList.toggle('d-none');
    leftContainer.classList.toggle('d-none');
});