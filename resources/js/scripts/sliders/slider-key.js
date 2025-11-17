let sliderButtons = document.querySelectorAll('.key-slider-button');

const prevBtn = document.querySelector('[data-action="key-prev"]');
const nextBtn = document.querySelector('[data-action="key-next"]');

let sliderInit = document.querySelector('.slider-init');
sliderInit.classList.add('slider-class');
const slider = document.querySelector('.slider-class');

const sliderItem = document.querySelector('.slider-item');
const itemW = sliderItem.offsetWidth;
console.log(itemW);


let translate = 0;

const sliderWidth = slider.scrollWidth;
const containerWidth = slider.parentElement.clientWidth;

const maxTranslate = 0;
const minTranslate = -(sliderWidth - containerWidth);
prevBtn.classList.add('opacity-20');
sliderButtons.forEach((button) => {
    button.classList.remove('hidden')
    button.addEventListener('click', (e) => {
        let action = e.currentTarget.dataset.action;

        if (action === 'key-prev') {
            translate += itemW;
        }

        if (action === 'key-next') {
            translate -= itemW;
        }

        prevBtn.classList.remove('opacity-20');
        nextBtn.classList.remove('opacity-20');
        if (translate === maxTranslate) {
            prevBtn.classList.add('opacity-20');
        }
        if (translate === minTranslate) {
            nextBtn.classList.add('opacity-20');
        }

        if (translate < minTranslate) {
            translate = minTranslate;
        }
        if (translate > maxTranslate) {
            translate = maxTranslate;
        }

        slider.style.transform = `translateX(${translate}px)`;
    });
});
