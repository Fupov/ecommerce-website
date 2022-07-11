    $(document).ready(function () {

        $('#filtre_bar').click(function (e) {
            e.preventDefault();
            $('#side_panel_filtre').animate({width:'toggle'}, 350);

        });

         $('.filtre_item_submit').click(function (e) {
             e.preventDefault();
             $('#side_panel_filtre').animate({width:'toggle'}, 350);

         });

        $('#filtre_close').click(function (e) {
            e.preventDefault();
            $('#side_panel_filtre').animate({width:'toggle'}, 350);

        });

        $('#cart_button').click(function (e) {
            e.preventDefault();
            $('#cart_panel').animate({width:'toggle'}, 150);

        });

        $('#cart_close').click(function (e) {
            e.preventDefault();
            $('#cart_panel').animate({width:'toggle'}, 150);

        });

        $('#color_button').click(function (e) {
            e.preventDefault();
            $('#color_container_show').toggle();

        });

        $('#price_button').click(function (e) {
            e.preventDefault();
            $('#price_container').toggle();

        });

        if(document.querySelector('#filtre_bar') !== null){

          document.querySelector('.color_filtre_box.b').addEventListener('change',function (evt){
            updateProductView("blanc", evt.target.checked);
          });
          document.querySelector('.color_filtre_box.p').addEventListener('change',function (evt){
            updateProductView("rouge", evt.target.checked);
          });
          document.querySelector('.color_filtre_box.c').addEventListener('change',function (evt){
            updateProductView("bleu", evt.target.checked);
          });

          $('#min_input').bind("change keyup", function (evt){

            updatePrice();

          });

          $('#max_input').bind("change keyup", function (evt){

            updatePrice();

          });


        }

        load_cart_data();
        load_cart_total_price();

        $('.add_to_cart_button_main').click(function(){
            var product_id = "";
            var product_name = "";
            var product_price = "";
            var action = "add";

            product_id = ($(this).parents().data('product_id'));
            product_name=($(this).parents().data('product_name'));
            product_price=($(this).parents().data('product_price'));
            product_image=($(this).parents().data('product_image'));
            product_descr=($(this).parents().data('product_descr'));

            $.ajax({
              url: "../../private/action.php",
              method: "POST",
              data:{product_id:product_id, product_name:product_name, product_price:product_price,product_image:product_image,product_descr:product_descr,action:action},
              success:function(data){
                load_cart_data();
              }

            });

            $.ajax({
              url: "../../private/total_cart.php",
              method: "POST",
              success:function(data){
                 $('#total_price').replaceWith(data);
              }

            });



        });


        $('#add_to_cart_button').click(function(){
            var product_id = "";
            var product_name = "";
            var product_price = "";
            var action = "add";

            product_id = ($(this).parents().data('product_id'));
            product_name=($(this).parents().data('product_name'));
            product_price=($(this).parents().data('product_price'));
            product_image=($(this).parents().data('product_image'));
            product_descr=($(this).parents().data('product_descr'));

            $.ajax({
              url: "https://loyaltycard.ovh/private/action.php",
              method: "POST",
              data:{product_id:product_id, product_name:product_name, product_price:product_price,product_image:product_image,product_descr:product_descr,action:action},
              success:function(data){
                load_cart_data();
              }

            });

            $.ajax({
              url: "https://loyaltycard.ovh/private/total_cart.php",
              method: "POST",
              success:function(data){
                 $('#total_price').replaceWith(data);
              }

            });


        });

        $(document).on('click', '.delete_cart', function(){
          var product_id = $(this).attr('id');
          var action = "remove";

          $.ajax({
            url: "https://loyaltycard.ovh/private/action.php",
            method: "POST",
            data:{product_id:product_id,action:action},
            success:function(data){
              load_cart_data();
            }

          });

          $.ajax({
            url: "https://loyaltycard.ovh/private/total_cart.php",
            method: "POST",
            success:function(data){
               $('#total_price').replaceWith(data);
            }

          });


        });


    });

    function load_cart_total_price(){
      $.ajax({
        url: "https://loyaltycard.ovh/private/total_cart.php",
        method: "POST",
        success:function(data){
           $('#total_price').replaceWith(data);
        }

      });
    }

    function load_cart_data(){

      $.ajax({
        url: "https://loyaltycard.ovh/private/fetch_cart.php",
        method: "POST",
        success:function(data){
          $('#shopping_cart').html(data);
        }

      });
    }


    function updatePrice(){
      var min = $('#min_input').val();
      var max = $('#max_input').val();

      $('.item_grid').show();

      $('.item_grid').each(function() {

        var price = $(this).data('product_price');
        if((price < $('#min_input').val() || price > $('#max_input').val()) && $('#max_input').val().length !== 0 )
          $(this).hide();

        else if ( $('#max_input').val().length === 0) {
             if(price < $('#min_input').val())
                 $(this).hide();
        }


      });
    }

    function updateProductView(productColor, bVisible){

      var dataSelectorVal = "";
      switch (productColor) {
        case "blanc":
          dataSelectorVal = "h2[data-type='blanc']";
          break;
        case "rouge":
          dataSelectorVal = "h2[data-type='rouge']";
          break;
        case "bleu":
          dataSelectorVal = "h2[data-type='bleu']"
          break;
      }

      //var notdataSelectorVal = ":not("+dataSelectorVal+")";
      $(".item_grid").not(dataSelectorVal).css('display',"none");
      $(".item_grid").has(dataSelectorVal).css('display', bVisible ? "" : "none");
      if(!$(".color_filtre_box").is(":checked"))
            $(".item_grid").css('display',"");
    }



function openNav() {
    document.getElementById("mySidepanel").style.width = "550px";
   }

   function closeNav() {
     document.getElementById("mySidepanel").style.width = "0";
    }
    function on() {
     document.getElementById("overlay").style.display = "block";
    }

    function off() {
     document.getElementById("overlay").style.display = "none";
    }

    function inscri() {
     var x = document.getElementById("login-container");
     x.style.display = "none";
     document.getElementById("signup-container").style.display = "flex";
     document.getElementById("inscription-button").style.borderBottom =  ".125rem solid black";
     document.getElementById("compte-button").style.borderBottom =  "none";
     }

     function sign_in () {
      document.getElementById("login-container").style.display = "flex";
      document.getElementById("signup-container").style.display = "none";
      document.getElementById("inscription-button").style.borderBottom =  "none";
      document.getElementById("compte-button").style.borderBottom =  ".125rem solid black";
     }



     var prevScrollpos = window.pageYOffset;
     //var height = document.body.offsetHeight;
     window.onscroll = function() {
     var currentScrollPos = window.pageYOffset;
      if (currentScrollPos > 1000) {

        document.getElementById("header-bar").style.zIndex = "0";
        /*document.getElementById("header-bar").style.animation = " fadein 2s ease-in  ";*/
         }

      else {
       document.getElementById("header-bar").style.zIndex = "2";

       }

       prevScrollpos = currentScrollPos;
    }
