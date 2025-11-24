const jsSearch = document.querySelector('.js-search');
jsSearch.classList.remove('js-search');

const container = document.querySelector('.container');


const closeForm = document.querySelector('.close-form');
closeForm.classList.remove('close-form');

const filtersContainer = document.querySelector('.filters-container');

const dialog = document.createElement('dialog');

dialog.className = filtersContainer.className;

dialog.innerHTML = filtersContainer.innerHTML;

window.addEventListener('scroll', () => {
    const top = container.getBoundingClientRect().top;
    const left = container.getBoundingClientRect().left;
    dialog.style.top = `${top}px`;
    dialog.style.left = `${left}px`;
});


filtersContainer.replaceWith(dialog);

dialog.classList.add('filters-container-js');

dialog.classList.remove('filters-container');

const filtersContent = dialog.querySelector('.filters-content');
filtersContent.classList.add('filters-content-js');
filtersContent.classList.remove('filters-content');

const btnOpen = document.querySelector('.btn-open');
btnOpen.classList.remove('btn-open');

btnOpen.addEventListener('click', (e) => {
    e.preventDefault();
    dialog.showModal();
    window.addEventListener('scroll', (e) => {
        e.preventDefault();
    });
});
