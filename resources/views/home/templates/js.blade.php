<script src="js/jquery/jquery-2.2.4.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.pixelentity.shiner.min.js"></script>
<script src="owlcarousel2/owl.carousel.js"></script>
<script src="bootstrap/bootstrap.js"></script>
<script src="slick/slick.js"></script>
<script src="js/app.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="accset/fotorama/fotorama.js"></script>
<script src="js/numscroller-1.0.js"></script>
<script src="js/lazysizes.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="magiczoomplus/magiczoomplus.js"></script>

<script>
const progressCircle = document.querySelector(".autoplay-progress svg");
const progressContent = document.querySelector(".autoplay-progress span");
var swiper = new Swiper(".swiper-tintuc", {
    slidesPerView: 3,
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
    },
});
</script>
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.async = true;
    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";

    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>