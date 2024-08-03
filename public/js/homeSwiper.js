document.addEventListener('DOMContentLoaded', () => {
    const swiperOuter = new Swiper('.mySwiper', {
        nested: true, 
        allowTouchMove: false,
        pagination: {
            el: '.swiper-pagination-outer',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        slidesPerView: 'auto',
        spaceBetween: 20,
});

const swiperInners = document.querySelectorAll('.mySwiperInner');
    swiperInners.forEach((swiperInner) => {
        new Swiper(swiperInner, {
        pagination: {
            el: swiperInner.querySelector('.swiper-pagination-inner'),
            clickable: true,
        },
        spaceBetween: 10,
        });
    });
});