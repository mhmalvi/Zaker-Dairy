$(".itemcard").slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 2,
    dots: false,
    speed: 400,
    responsive: [
        {
            breakpoint: 1400,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 1100,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 700,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 3000,
            },
        },
    ],
});

var locked = false,
    page = 1,
    last_page = -1,
    loader_div = $("#other_products_loading_animation"),
    no_more_products = $("#no_more_products"),
    dairy_and_others_wrapper = $("#dairy_and_others_wrapper");

loader_div.css("display", "none");
no_more_products.css("display", "none");


function fetchProducts(page) {
    var base_uri = document.head.querySelector(
        'meta[name="api-base-url"]'
    ).content;

    locked = true;
    loader_div.css("display", "block");
    $.ajax({
        url: "/other_products",
        type: "GET",
        dataType: "json",
        data: {
            page: page,
        },
        success: function (data) {
            if (data.view != null) {
                $("#other_products").append(data.view);
                var uid = data.uid;
                locked = false;
              
            } else {
                if (page == 1) {
                    dairy_and_others_wrapper.css("display", "none");
                }
                no_more_products.css("display", "block");
            }

            loader_div.css("display", "none");
        },
        error: function (error) {
            if (error.status >= 400) {
                alert("Server error occured.");
                console.log(error);
            }
        },
    });
}

fetchProducts(1);

$(window).scroll(function () {
    if (!locked) {
        locked = true;
        setTimeout(function () {
            var target = $("#other_products_bottom")[0].offsetTop;

            var window_height = $(window).height();
            var scroll_position = $(window).scrollTop();

            if (
                target < window_height + scroll_position + 100 &&
                last_page != page
            ) {
                fetchProducts(++page);
            } else {
                locked = false;
            }
        }, 500);
    }
});

$(".show-category").click(function (e) {
    /*    $(".category-list").css("display", "block"); */
    $(".category-list").slideToggle();
});
