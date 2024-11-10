var myCarousel = document.getElementById('vinCarousel');
    let carousel = new bootstrap.Carousel(myCarousel, {
        interval: 2000,  // Intervalle entre les slides en millisecondes (ici, 2 secondes)
        ride: 'carousel' // Lancer automatiquement le carousel au chargement
    });

