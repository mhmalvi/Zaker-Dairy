
       //add menu cart item function
       function addtocart(product_id){
            
                    var qty = $(`#item-${product_id}`).val();
                    console.log(qty)
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });
            
                    $.ajax({
                        url: `/cart/${product_id}/add`,
                        method: "POST",
                        datatype: "json",
                        processData: true,
                        data: { quantity: qty },
                        beforeSend: function () {
                            $(`.item-card-${product_id}`).toggleClass(
                                "shopItems position-relative"
                            );
                        },
                        success: function (data) {
                            setTimeout(() => {
                                $(".totalItem").html(data.total);
                                $(".cart-item-wrapper").html(data.minicart);
                                $(`.item-card-${product_id}`).toggleClass(
                                    "shopItems position-relative"
                                );
                            }, 2000);
                        },
                    });
              
           
       }



$(document).ready(function () {

    //Item Slideshow
    $(".itemcard").slick({
        mobileFirst:true,
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 2,
                   slidesToScroll: 2,
                },
            },
            {
                breakpoint: 576,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 320,
                settings: {
                    arrows: false,
                    centerMode: false,
                    slidesToShow: 1,
                   slidesToScroll: 1,
                },
            },
        ],
         
    });
});
