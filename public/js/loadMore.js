document.addEventListener('DOMContentLoaded', function () {
    initializeSwipers();
});

function initializeSwipers() {
    const swipers = document.querySelectorAll('.swiper');
    swipers.forEach(swiper => {
        if (!swiper.swiper) {
            new Swiper(swiper, {
                pagination: {
                    el: swiper.querySelector('.swiper-pagination'),
                    clickable: true,
                },
                slidesPerView: 1,
                spaceBetween: 10,
            });
        }
    });
}

function loadMore() {
    const button = document.getElementById('load-more');
    const div = document.querySelector("#imoveis");
    let nextPage = button.getAttribute('data-next-page');

    if (!nextPage) return;

    fetch(nextPage,  {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(res => res.json())
    .then(data => {
        div.insertAdjacentHTML('beforeend', data.html);
        button.setAttribute('data-next-page', data.next_page || '');
        if (!data.next_page) {
            button.style.display = 'none';
        }
        initializeSwipers();
    })
    .catch(error => console.error('Erro ao carregar mais imóveis:', error));
}

document.getElementById('load-more').addEventListener('click', loadMore);
