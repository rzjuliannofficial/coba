
//   AOS.init();
  AOS.init({
    once: false,
    duration: 1500, // Durasi animasi 1 detik
    easing: 'ease-out',
    offset: 0,    // Jarak trigger dari bawah layar
  });
  
    // Dapatkan elemen yang dibutuhkan
const bottomBlur = document.querySelector('.bottom-blur-overlay');
const footer = document.querySelector('.target-hidden'); // Asumsi elemen footer Anda menggunakan tag <footer>
const blurHeight = bottomBlur ? bottomBlur.offsetHeight : 0; // Tinggi blur (2rem)

if (bottomBlur && footer) {
    
    // Fungsi untuk memeriksa posisi
    function checkVisibility() {
        // Mendapatkan posisi footer relatif terhadap viewport
        const footerRect = footer.getBoundingClientRect();

        // Kondisi: Apakah bagian atas footer (footerRect.top)
        // sudah berada di atas posisi "bottom of the viewport MINUS tinggi blur"?
        // Jika footer sudah "naik" melewati batas blur, sembunyikan blur.
        if (footerRect.top <= (window.innerHeight - blurHeight)) {
            // Sembunyikan blur saat footer mulai menyentuh area blur
            bottomBlur.classList.add('is-hidden');
        } else {
            // Tampilkan kembali blur saat footer sudah jauh di bawah
            bottomBlur.classList.remove('is-hidden');
        }
    }

    // Panggil saat scroll dan saat halaman dimuat
    window.addEventListener('scroll', checkVisibility);
    window.addEventListener('resize', checkVisibility);
    checkVisibility(); // Panggil sekali saat dimuat
} else {
    console.error("Elemen '.bottom-blur-overlay' atau 'footer' tidak ditemukan.");
}

//for NEWS IN HOMEPAGE
$(document).ready(function() {
    const $items = $('.carousel-item-3d');
    const $btnNext = $('#btnNext');
    const $btnPrev = $('#btnPrev');
    const totalItems = $items.length;
    let currentIndex = 0;
    const autoSlideInterval = 5000;

    function updateCarousel() {
        $items.removeClass('active prev next hidden');
        
        $items.each(function(index) {
            const $item = $(this);
            let relativePosition = index - currentIndex;

            if (relativePosition < 0) {
                relativePosition += totalItems;
            }
            
            if (relativePosition === 0) {
                $item.addClass('active');
            } else if (relativePosition === 1) {
                $item.addClass('next');
            } else if (relativePosition === totalItems - 1) {
                $item.addClass('prev');
            } else {
                $item.addClass('hidden');
            }
        });
    }
    
    function goToSlide(direction) {
        if (direction === 'next') {
            currentIndex = (currentIndex + 1) % totalItems;
        } else {
            currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        }
        updateCarousel();
    }

    $btnNext.on('click', function() {
        goToSlide('next');
    });
    $btnPrev.on('click', function() {
        goToSlide('prev');
    });
    
    $items.on('click', function() {
        const $clickedItem = $(this);
        const itemIndex = parseInt($clickedItem.data('index'));
        
        if (itemIndex !== currentIndex) {
            const nextIndex = (currentIndex + 1) % totalItems;
            
            if (itemIndex === nextIndex) {
                goToSlide('next');
            } else {
                goToSlide('prev');
            }
        }
    });

    updateCarousel();

    setInterval(() => {
        goToSlide('next');
    }, autoSlideInterval);
});
