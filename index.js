$(document).ready(function(e){
    //banner owl carousel
    $("#banner-area .owl-carousel").owlCarousel({
        dots: true,
        items: 1
    });

    //top sale owl carousel
    $("#top-sale .owl-carousel").owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }

        }
    }); 

    //special price owl carousel
    $("#special-price .owl-carousel").owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }

        }
    }); 

    //isotope filter
    var $grid = $(".grid").isotope({
        itemSelector:'.grid-item',
        layoutMode:'fitRows'
    });

    //filter items on button click
    $(".button-group").on("click","button",function(){
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({filter: filterValue});
    }); 

    //new phones owl carousel
    $("#new-phones .owl-carousel").owlCarousel({
        loop:true,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }

        }
    });
    

    //product quantity section
    let $qty_up = $(".qty .qty-up");
    let $qty_down = $(".qty .qty-down");
    let $deal_price = $("#deal-price");

    //click on quantity up button
    $qty_up.click(function(e){

        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        let $price = $(`.product_price[data-id='${$(this).data("id")}']`);
        let $exchange_rate = $(`.exchange_rate[data-id='${$(this).data("id")}']`);

        // change product price using ajax call
        $.ajax({url: "template/ajax.php", type : 'post', data : { itemid : $(this).data("id")}, success: function(result){
                let obj = JSON.parse(result);
                let item_price = obj[0]['item_price'] *$exchange_rate.val();
                let item_stock = obj[0]['item_stock'];

                if($input.val() >= 1 && $input.val() <=(parseInt(item_stock)-1)){
                    $input.val(function(i, oldval){
                        return ++oldval;
                    });

                    // increase price of the product
                    $price.text(parseInt(item_price * $input.val()).toFixed(2));

                    // set subtotal price
                    let subtotal = parseInt($deal_price.text()) + parseInt(item_price);
                    $deal_price.text(subtotal.toFixed(2));
                }

            }}); // closing ajax request
    }); // closing qty up button

    

     //click on quantity down button
     $qty_down.click(function(e){
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        let $price = $(`.product_price[data-id='${$(this).data("id")}']`);
        let $exchange_rate = $(`.exchange_rate[data-id='${$(this).data("id")}']`);

         // change product price using ajax call
         $.ajax({url: "template/ajax.php", type : 'post', data : { itemid : $(this).data("id")}, success: function(result){
            let obj = JSON.parse(result);
            let item_price = obj[0]['item_price']*$exchange_rate.val();
            let item_stock = obj[0]['item_stock'];

            if($input.val() > 1 && $input.val() <=parseInt(item_stock)){
                $input.val(function(i, oldval){
                    return --oldval;
                });

                // decrease price of the product
                $price.text(parseInt(item_price * $input.val()).toFixed(2));

                // set subtotal price
                let subtotal = parseInt($deal_price.text()) - parseInt(item_price);
                $deal_price.text(subtotal.toFixed(2));
            }

        }}); // closing ajax request
    });

    
    
});




