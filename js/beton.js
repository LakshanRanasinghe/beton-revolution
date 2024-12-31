jQuery(document).ready(function ($) {
   $(".dropdown-toggle").on("click", function (event) {
      location.href = $(this).attr("href");
   });
   if ($.cookie("selected_area_code") !== undefined && $.cookie("selected_area_code") !== "") {
      if ($.cookie("selected_city") !== undefined || $.cookie("selected_city") !== "") {
         $("#postcode-input").val($.cookie("selected_city"));
         enableSecondStep();
      }

      if ($.cookie("selected_cubic_meters") !== undefined || $.cookie("selected_cubic_meters") !== "") {
         $("#cubic-meters").val($.cookie("selected_cubic_meters"));
         enableSecondStep();
      }
   }

   $("#postcode-input").on("input", function () {
      const query = $(this).val();

      if (query.length >= 2) {
         // Filter results based on the input query
         const filteredResults = betonData.postcodes.filter((item) => {
            // Check if the city name or any zip code matches the query
            return item.city_name.toLowerCase().includes(query.toLowerCase()) || item.zip.split(",").some((zip) => zip.includes(query));
         });
         // Clear previous autocomplete suggestions
         $("#autocomplete-list").remove();

         // Create a dropdown list for suggestions
         const dropdown = $('<div id="autocomplete-list" class="dropdown-menu mt-1"></div>');
         filteredResults.forEach((item) => {
            const suggestion = $(
               `<a href="#" class="dropdown-item" data-postcodes="${item.zip}" data-id="${item.id}" data-area-code="${item.area_code}">${item.city_name}</a>`
            );
            dropdown.append(suggestion);
         });

         // Append dropdown to the input field
         $("#postcode-input").after(dropdown);
         dropdown.show();

         // Handle suggestion click
      } else {
         $("#autocomplete-list").remove(); // Clear suggestions for short queries
      }
      enableSecondStep();
   });

   function cubicMetersChange(value, step) {
      step || (step = 1.0);
      var inv = 1.0 / step;
      var rounded = Math.ceil(value * inv) / inv;
      return rounded;
   }

   $("#cubic-meters").on("change", function () {
      $(this).val(cubicMetersChange($(this).val(), 0.25));
      document.cookie = `selected_cubic_meters=${$(this).val()}; path=/`;
      enableSecondStep();
   });

   $(document).on("click", "#autocomplete-list .dropdown-item", function (e) {
      e.preventDefault();
      const selectedName = $(this).text();
      const selectedId = $(this).data("id");
      const selectedPostcodes = $(this).data("postcodes");
      const selectedAreaCode = $(this).data("area-code");
      // Set input value to selected suggestion
      $("#postcode-input").val(selectedName);

      if (selectedPostcodes == "") {
         return false;
      }
      // Store the selected ID in cookies
      document.cookie = `selected_city=${selectedName}; path=/`;
      document.cookie = `selected_area_code=${selectedAreaCode}; path=/`;

      var distance_data = {
         action: "calculate_travel_distance",
         city: selectedName,
      };
      $.post(betonData.ajax_url, distance_data, function (response) {
         if (response) {
            console.log(response);
         }
      });

      // Hide dropdown
      $("#autocomplete-list").remove();
   });

   // Hide suggestions if clicked outside
   $(document).on("click", function (e) {
      if (!$(e.target).closest("#search-input").length) {
         $("#autocomplete-list").remove();
      }
   });

   //   Place Order Form
   function enableSecondStep() {
      if ($("#postcode-input").val() == "" || $("#cubic-meters").val() == "" || $("#cubic-meters").val() <= 0) {
         $("#location-and-quantity-btn").prop("disabled", true);
         $(".location-and-quantity-section").addClass("pending").removeClass("filled");
      } else {
         $("#location-and-quantity-btn").prop("disabled", false);
         $(".location-and-quantity-section").removeClass("pending").addClass("filled");
         trigger_calculator();
      }
   }

   //  Jump to second step on reload
   if ($("#postcode-input").val() !== "" && $("#cubic-meters").val() !== "" && $("#cubic-meters").val() > 0) {
      $(".location-and-quantity-section").removeClass("active").addClass("inactive");
      $(".type-and-kind-section").addClass("active").removeClass("inactive");
   }

   $('input[name="application"]').on("change", function () {
      trigger_calculator();
   });
   $('input[name="compound"]').on("change", function () {
      trigger_calculator();
   });
   $('input[name="releaseMethod"]').on("change", function () {
      if(!$('input[name="pump-type"]').is(':checked')){
         $('#miniPump').click();
      }
      trigger_calculator();
   });
   $('input[name="pump-type"]').on("change", function () {
      if ($(this).val() == "boom") {
         $("#mini-pump-breakdown").addClass("d-none");
      } else {
         $("#mini-pump-breakdown").removeClass("d-none");
      }
      $('.pump-wrap').removeClass('active');
      $(this).parents('.pump-wrap').addClass('active');
      trigger_calculator();
   });
   $('select[name="mini_pumping_distance"]').on("change", function () {
      trigger_calculator();
      $("#extra_hose_length").text($(this).val() + "m");
   });
   $('select[name="boom_pumping_distance"]').on("change", function () {
      trigger_calculator();
   });
   $('select[name="surface"]').on("change", function () {
      trigger_calculator();
   });
   $('input[name="performance"]').on("change", function () {
      if ($('input[name="performance"]:checked').val() == "allIn") {
         $("#pump").click();
         $(".all-in-cost-wrapper").removeClass("d-none");
         $(".execution-section").addClass("d-sm-block").removeClass('d-none');
      } else {
         trigger_calculator();
         $(".all-in-cost-wrapper").addClass("d-none");
         $(".execution-section").addClass("d-none").removeClass('d-sm-block');
      }
   });
   $('select[name="num-rooms"]').on("change", function () {
      trigger_calculator();
   });
   $('select[name="layer-thickness"]').on("change", function () {
      trigger_calculator();
   });

   $("#mezzanine-floor").on("change", function () {
      trigger_calculator();
      if ($("#mezzanine-floor").is(":checked")) {
         $(".ground_floor_wrapper").removeClass("d-none");
      } else {
         $(".ground_floor_wrapper").addClass("d-none");
      }
   });
   $("#butterfly-floor").on("change", function () {
      trigger_calculator();
      if ($("#mezzanine-floor").is(":checked")) {
         $(".butterfly_floor_wrapper").removeClass("d-none");
      } else {
         $(".butterfly_floor_wrapper").addClass("d-none");
      }
   });

   $(".submit-btn").on("click", function (e) {
      e.preventDefault();
      if ($(this).val() == "quote") {
         send_to_quotation();
      } else {
         send_to_cart();
      }
      console.log($(this).val());
   });

   $('#email').on('change', function(){
      if($(this).val() !== ''){
         $('.submit-btn[value="quote"]').prop("disabled", false);
      }else{
         $('.submit-btn[value="quote"]').prop("disabled", true);
      }
   })

   function send_to_quotation() {
      let compositions = [];
      $('input[name="compound"]:checked').each(function () {
         compositions.push($(this).attr("value"));
      });

      var dataSet = {
         action: 'save_quotation',
         user_email: $("#email").val(),
         area_code: $.cookie("selected_area_code"),
         postalcode: $("#postcode-input").val(),
         cubic_meters: $("#cubic-meters").val(),
         application_product: $('input[name="application"]:checked').val(),
         composition: compositions,
         unloading: $('input[name="releaseMethod"]:checked').val(),
         pump_type: $('input[name="pump-type"]:checked').val(),
         pumping_distance: $('select[name="mini_pumping_distance"]').val(),
         boom_pumping_distance: $('select[name="boom_pumping_distance"]').val(),
         uitvoering: $('input[name="performance"]:checked').val(),
         "surace-sqm": $('select[name="surface"]').val(),
         "layer-thickness": $("#layer-thickness").val(),
         nos_rooms: $("#num-rooms").val(),
         flooring: $("#mezzanine-floor").is(":checked") ? 1 : 0,
         "butterfly-floor": $("#butterfly-floor").is(":checked") ? 1 : 0,
      };

      $.ajax({
         type: "post",
         url: betonData.ajax_url,
         data: dataSet,
         success: function (response) {
            if(response.data.status == 'mail-sent'){
               $(".confirm-and-pay-section").addClass("active");
               $(".type-and-kind-section").removeClass("pending");
               $(".type-and-kind-section").removeClass("active");
               $(".type-and-kind-section").addClass("inactive");
               $('.type-and-kind-form').addClass('d-none');

               $('.confirm-and-pay-section').find('.step-title').removeClass('disabled');
               $('#email').val('').trigger('change');
               window.location.href = "/beton2025/dank-u/";
            }
         }
      });
   }

   function send_to_cart() {
      let compositions = [];
      $('input[name="compound"]:checked').each(function () {
         compositions.push($(this).attr("value"));
      });

      var dataSet = {
         action: 'concrete_add_to_cart',
         user_email: $("#email").val(),
         area_code: $.cookie("selected_area_code"),
         postalcode: $("#postcode-input").val(),
         cubic_meters: $("#cubic-meters").val(),
         application_product: $('input[name="application"]:checked').val(),
         composition: compositions,
         unloading: $('input[name="releaseMethod"]:checked').val(),
         pump_type: $('input[name="pump-type"]:checked').val(),
         pumping_distance: $('select[name="mini_pumping_distance"]').val(),
         boom_pumping_distance: $('select[name="boom_pumping_distance"]').val(),
         uitvoering: $('input[name="performance"]:checked').val(),
         "surace-sqm": $('select[name="surface"]').val(),
         "layer-thickness": $("#layer-thickness").val(),
         nos_rooms: $("#num-rooms").val(),
         flooring: $("#mezzanine-floor").is(":checked") ? 1 : 0,
         "butterfly-floor": $("#butterfly-floor").is(":checked") ? 1 : 0,
      };

      $.ajax({
         type: "post",
         url: betonData.ajax_url,
         data: dataSet,
         success: function (response) {
            console.log(response);
            if(response.data.redirect !== undefined){
               window.location.href = response.data.redirect;
            }

            // $(".type-and-kind-section").addClass("inactive");
            // $(".type-and-kind-form").addClass("d-none");
            // $(".type-and-kind-form").removeClass("pending");
            // $(".type-and-kind-section").removeClass("pending");
            // $(".confirm-and-pay-section").addClass("active");
            // $(".confirm-and-pay-form").removeClass("d-none");
         }
      });
   }

   //  trigger_calculator();
   function trigger_calculator() {
      let compounds = [];
      $('input[name="compound"]:checked').each(function () {
         compounds.push($(this).attr("value"));
      });

      let release_method = "gutter";
      let pump_type = null;
      let pumping_distance = 0;
      $("#release_method_name").text("");
      if ($('input[name="releaseMethod"]:checked').val() == "pump") {
         release_method = "pump";
         console.log("pump");
         $(".release-method-pump-cost-wrapper").removeClass("d-none");
         $(".release-by-pump").removeClass("d-sm-none").addClass("d-sm-block");

         pump_type = $('input[name="pump-type"]:checked').val();

         if (pump_type == "mini") {
            pumping_distance = $('select[name="mini_pumping_distance"]').val();
            $("#release_method_name").text(": Mini");
         } else {
            pumping_distance = $('select[name="boom_pumping_distance"]').val();
            if (pump_type == "boom") {
               $("#release_method_name").text(": Boom");
            }
         }
      } else {
         console.log("no pump");
         $(".release-method-pump-cost-wrapper").addClass("d-none");
         $(".release-by-pump").removeClass("d-sm-block").addClass("d-sm-none");
         // $('select[name="mini_pumping_distance"]').val('');
         // $('input[name="pump-type"]').val('');
         // $('.release-by-pump').addClass('d-none d-sm-none');
      }

      let performance = $('input[name="performance"]:checked').val();
      let layer_thickness = $("#layer-thickness").val();
      let rooms_count = $("#num-rooms").val();
      let butterfly_floor = $("#butterfly-floor").is(":checked") ? 1 : 0;
      let surface = $('select[name="surface"]').val();
      let selected_floor = $("#mezzanine-floor").is(":checked") ? 1 : 0;

      let dataSet = {
         nonce: $("#beton_nonce").val(),
         action: "beton_calculator",
         city: $("#postcode-input").val(),
         cubic_meters: $("#cubic-meters").val(),
         area_code: $.cookie("selected_area_code"),
         application: $('input[name="application"]:checked').val(),
         compounds: compounds,
         release_method: release_method,
         pump_type: pump_type,
         pumping_distance: pumping_distance,
         performance: performance,
         layer_thickness: layer_thickness,
         rooms_count: rooms_count,
         butterfly_floor: butterfly_floor,
         surface: surface,
         selected_floor: selected_floor,
      };

      console.log(dataSet);
      if(!$(document.body).hasClass('home')){//don't run on home page
         $.ajax({
            type: "post",
            url: betonData.ajax_url,
            data: dataSet,
            success: function (response) {
               console.log(response);
               if (response.data) {
                  $(".dynamic-hide").removeClass("d-flex").addClass("d-none");
                  $(".hide-on-ajax").addClass("d-none");
                  $.each(response.data.dynamic_pricing, function (index, val) {
                     if ($("#" + index).length > 0) {
                        $("#" + index).html(val);

                        if ($("#" + index).hasClass("dynamic-hide")) {
                           $("#" + index)
                              .removeClass("d-none")
                              .addClass("d-flex");
                        }
                     }
                  });
               }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
               alert("Status: " + textStatus);
               alert("Error: " + errorThrown);
            },
         });
      }
   }

   $('.step-title').not('.disabled').on('click', function(){
      var clicked_section = $(this).parents('.section-wrap');
      let total_steps = 3;
      let clicked_step = $(clicked_section).data('step');

      let current_section = $('.section.active');
      let current_step = $(current_section).data('step');

      $(clicked_section).addClass('active').addClass('pending').removeClass('inactive').removeClass('filled');

      console.log(clicked_section);

      for (let index = 1; index <= total_steps; index++) {
         if(index == clicked_step){
            $('.section-wrap[data-step='+index+']').find('.form-section').removeClass('d-none');
            continue;
         }else{
            $('.section-wrap[data-step='+index+']').find('.form-section').addClass('d-none');
         }

         if(index == 1){
            if ($("#postcode-input").val() == "" || $("#cubic-meters").val() == "" || $("#cubic-meters").val() <= 0) {
               $("#location-and-quantity-btn").prop("disabled", true);
               $(".location-and-quantity-section").addClass("pending").removeClass("filled");
            }
         }
         console.log($('.section-wrap[data-step='+index+']'));

         $('.section-wrap[data-step='+index+']').removeClass('active').removeClass('pending').removeClass('inactive')
      }
      
   });
});
