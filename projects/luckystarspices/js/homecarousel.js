// Function for carousel
$('.homecarousel').slick({
    infinite: false,
    prevArrow: $('.prev'),
    nextArrow: $('.next'),
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    mobilefirst: true,
    responsive: [
        { breakpoint: 576, 
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        { breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true
            }
        },
        { breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                autoplay: true
            }
        },
        { breakpoint: 1200,
            setting: {
                slidesToShow: 4,
                slidesToScroll: 4,
                autoplay: true
            }
        },
        { breakpoint: 1400,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4
            }

        }
    ]});