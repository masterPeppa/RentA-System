
/* MOBILE NAVIGATION */
const btnNavEl = document.querySelector(".btn-mobile-nav");
const headerEl = document.querySelector(".header");
//remove loading
$(document).ready(function(){
  $('.loadBackground').click(function(){
    $('.loadBackground').fadeOut(0);
  }).delay(6000).trigger("click");
  //query for choosing landlord or renter
  $('.btnRenter').click(function(){
    window.location.href = "rentersPage/starterPage.php";
  });
  $('.btnLandlord').click(function(){
    window.location.href = "LandlordPage/starterPage.php";
  });
});
//
btnNavEl.addEventListener("click", function () {
  headerEl.classList.toggle("nav-open");
});

// Sticky navigation

const sectionHeroEl = document.querySelector(".hero-section");

const obs = new IntersectionObserver(
  function (entries) {
    const ent = entries[0];
    console.log(ent);

    if (ent.isIntersecting === false) {
      document.body.classList.add("sticky");
    }

    if (ent.isIntersecting === true) {
      document.body.classList.remove("sticky");
    }
  },
  {
    // In the viewport
    root: null,
    threshold: 0,
    rootMargin: "-80px",
  }
);
obs.observe(sectionHeroEl);

