// code for the countdown as well as the carousell to keep rotating the images

const carouselSlide = document.querySelector('.carousel-slide');
const carouselArrows = document.querySelectorAll('.carousel-arrow');

function startCarousel() {
  const slideWidth = carouselSlide.firstElementChild.clientWidth;

  setInterval(() => {
    carouselSlide.style.transition = 'transform 1s ease-in-out';
    carouselSlide.style.transform = `translateX(-${slideWidth}px)`;

    setTimeout(() => {
      carouselSlide.appendChild(carouselSlide.firstElementChild);
      carouselSlide.style.transition = '';
      carouselSlide.style.transform = 'translateX(0)';
    }, 1000);
  }, 4000); // the speed of the rotation
}

function handleArrowClick(event) {
  const direction = event.target.classList.contains('carousel-arrow-left') ? -1 : 1;
  const slideWidth = carouselSlide.firstElementChild.clientWidth;

  carouselSlide.style.transition = 'transform 1s ease-in-out';
  carouselSlide.style.transform = `translateX(-${direction * slideWidth}px)`;

  setTimeout(() => {
    if (direction === 1) {
      carouselSlide.appendChild(carouselSlide.firstElementChild);
    } else {
      carouselSlide.prepend(carouselSlide.lastElementChild);
    }
    carouselSlide.style.transition = '';
    carouselSlide.style.transform = 'translateX(0)';
  }, 1000);
}

startCarousel();

carouselArrows.forEach((arrow) => {
  arrow.addEventListener('click', handleArrowClick);
});

 // Countdown function
 function countdown() {
    var countDownDate = new Date("Jun 20, 2023 00:00:00").getTime();

    var x = setInterval(function() {
      var now = new Date().getTime();
      var distance = countDownDate - now;

      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById("countdown").innerHTML = days + "d " + hours + "h " +
        minutes + "m " + seconds + "s ";

      if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "Event has ended";
      }
    }, 1000);
  }

  countdown();
