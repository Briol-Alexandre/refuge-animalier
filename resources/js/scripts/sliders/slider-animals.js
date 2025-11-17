let sliderButtons = document.querySelectorAll('.animal-slider-button');

const prevBtn = document.querySelector('[data-action="animal-prev"]');
const nextBtn = document.querySelector('[data-action="animal-next"]');

let sliderInit = document.querySelector('.slider-init-animal');
sliderInit.classList.add('slider-class-animal');
const slider = document.querySelector('.slider-class-animal');

const sliderItem = document.querySelector('.slider-item-animal');
const sliderItemStyles = window.getComputedStyle(sliderItem);
console.log(sliderItemStyles);
const marginLeft = parseFloat(sliderItemStyles.marginLeft);
const marginRight = parseFloat(sliderItemStyles.marginRight);
const itemW = sliderItem.getBoundingClientRect().width + marginLeft + marginRight;
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

        if (action === 'animal-prev') {
            translate += itemW;
        }

        if (action === 'animal-next') {
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
