jQuery(document).ready(function ($) {

   let currentCubicMeters = 0;

	window.dataLayer = window.dataLayer || [];
	
	$('#quoteButton').on('click', function () {
		window.dataLayer.push({
		   'event': 'gaEvent',
			'eventAction': 'quoteRequested',
		   'timestamp': new Date().toISOString()
	  	});
	});
	
   const googleReviewUrl = 'https://www.google.com/search?sca_esv=3d29f91817f8e566&sxsrf=AHTn8zqICKpJnBpHQXGlqjQsqVVu6qRLRA:1743999989762&si=APYL9bs7Hg2KMLB-4tSoTdxuOx8BdRvHbByC_AuVpNyh0x2KzRam88Sq14J9Tyhv7AFoN6bo3klXzjbOGaYhm854YpZdttAISuqHi71cxNXA0C_2HXYUVmJGidsjZ7QhnHeOV0a4RtgXOGIYXtmqkrzRY5GvKumX6g%3D%3D&q=BetonBestellen.nl+Reviews&sa=X&ved=2ahUKEwjw64KfisWMAxUCR2wGHRVcLjQQ0bkNegQINBAE&biw=1920&bih=844&dpr=1#cobssid=s';

   $(document).on('click', '.ti-review-item.source-Google', function () {
   	window.open(googleReviewUrl, '_blank');
   });


   $(".dropdown-toggle").on("click", function (event) {
      location.href = $(this).attr("href");
   });

   if ($.cookie("selected_area_code") !== undefined && $.cookie("selected_area_code") !== "" && $(document).width() >= 767) {
      if ($.cookie("selected_city") !== undefined || $.cookie("selected_city") !== "") {
         $("#postcode-input").val($.cookie("selected_city"));
         enableSecondStep();
      }

      if ($.cookie("selected_cubic_meters") !== undefined || $.cookie("selected_cubic_meters") !== "") {
         currentCubicMeters = $.cookie("selected_cubic_meters");
         $("#cubic-meters").val(currentCubicMeters);
         enableSecondStep();
      }
   } else {
      if ($.cookie("selected_city") !== undefined || $.cookie("selected_city") !== "") {
         $("#postcode-input").val($.cookie("selected_city"));
      }
      if ($.cookie("selected_cubic_meters") !== undefined || $.cookie("selected_cubic_meters") !== "") {
         currentCubicMeters = $.cookie("selected_cubic_meters");
         $("#cubic-meters").val(currentCubicMeters);
      }
      if ($.cookie("selected_area_code") !== undefined && $.cookie("selected_area_code") !== "") {
         $("#location-and-quantity-btn").prop("disabled", false);
      }
   }

   //Home page calculator form handle
   $("#home-offerte-aanvragen-form").on("submit", function(e) {
      e.preventDefault(); 
  
      if ( locationQuntityValidation() ) {
         this.submit();
      }

      dataLayer.push({
          'event': 'gaEvent',
			'eventAction': 'homeClickQuoteBtn',
         'timestamp': new Date().toISOString()
      });

   });

   setTimeout(function(){
      trigger_calculator()
   }, 250);

   function locationQuntityValidation() {
      console.log('Running locationQuntityValidation')
      if ($.cookie("selected_area_code") !== undefined && $.cookie("selected_area_code") !== "") {
         $("#postcode-input").addClass("selected");
      }
      const postcodeInput = $("#postcode-input");
      const cubicMeters = getNormalizedCubicMeters();
      const isPostcodeValid = postcodeInput.hasClass("selected");
      const isCubicMetersValid = cubicMeters > 0;
  
      if (!isPostcodeValid) {
        alert("Selecteer een geldige postcode!");
        postcodeInput.focus();
        return false;
      }
  
      if (!isCubicMetersValid) {
        alert("Kubieke meters moeten groter zijn dan nul!");
        $("#cubic-meters").focus();
        return false;
      }
      return true;
   }

   $("#postcode-input").on("keyup", function (e) {
      const query = $(this).val();
      $("#postcode-input").removeClass("selected");
      // Clear previous autocomplete suggestions
      $("#autocomplete-list").remove();

      if (query.length >= 2) {
         // Filter results based on the input query
         const filteredResults = betonData.postcodes.filter((item) => {
            // Check if the city name or any zip code matches the query
            return item.city_name.toLowerCase().includes(query.toLowerCase()) || item.zip.split(",").some((zip) => zip.includes(query));
         });
         

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

         // Auto-click if only 1 result or exact match
         if (filteredResults.length === 1) {

            if (e.key === "Backspace") {
               return;
            }

            setTimeout(() => {
               $("#autocomplete-list .dropdown-item").first().trigger("click");
            }, 100);

            $("#postcode-input").addClass("selected");
            console.log('length equals');
         } else {
            // Check for exact match only
            const exactMatch = filteredResults.find(item => 
               item.city_name.toLowerCase() === query.toLowerCase() ||
               item.zip.split(",").includes(query) ||
               item.area_code === query
            );
            
            if (exactMatch) {
               setTimeout(() => {
                  $("#autocomplete-list .dropdown-item").filter(function() {
                           return $(this).text().trim().toLowerCase() === exactMatch.city_name.toLowerCase();
                        }).first().trigger("click");
               }, 100);

               $("#postcode-input").addClass("selected");
               console.log('length not equals');
            }
         }

         
      } else {
         $("#autocomplete-list").remove(); // Clear suggestions for short queries
      }

   });

   $("#postcode-input").on("change", function (e) {
      dataLayer.push({
         'event': 'gaEvent',
			'eventAction': 'locationQtyEntered',
         'timestamp': new Date().toISOString()
      });
   });

   function getNormalizedCubicMeters() {
      let raw = $("#cubic-meters").val();

      if (!raw) return 0;
      return parseFloat(raw.replace(',', '.')) || 0;
   }

   // function cubicMetersChange(value, step) {
   //    step || (step = 1.0);
   //    var inv = 1.0 / step;
   //    var rounded = Math.ceil(value * inv) / inv;
   //    return rounded;
   // }

   function cubicMetersChange(value, step) {
      step || (step = 1.0);

      value = parseFloat(value.toString().replace(',', '.')) || 0;

      var inv = 1.0 / step;
      var rounded = Math.ceil(value * inv) / inv;

      return rounded;
   }

   // $("#cubic-meters").on("change", function () {
   //    $(this).val(cubicMetersChange($(this).val(), 0.25));
   //    document.cookie = `selected_cubic_meters=${$(this).val()}; path=/`;
   //    enableSecondStep();

   //    dataLayer.push({
   //        'event': 'gaEvent',
	// 		'eventAction': 'locationQtyEntered',
   //       'timestamp': new Date().toISOString()
   //    });

   // });

   $("#cubic-meters").on("change", function () {

      let rawValue = $(this).val();
      let rounded = cubicMetersChange(rawValue, 0.25);

      currentCubicMeters = rounded;

      if (rawValue.includes(',')) {
         $(this).val(rounded.toString().replace('.', ','));
      } else {
         $(this).val(rounded);
      }

      document.cookie = `selected_cubic_meters=${rounded}; path=/`;
      enableSecondStep();

      dataLayer.push({
          'event': 'gaEvent',
			'eventAction': 'locationQtyEntered',
         'timestamp': new Date().toISOString()
      });
   });

   $(document).on("click", "#autocomplete-list .dropdown-item", function (e) {
      e.preventDefault();
      $("#postcode-input").addClass("selected");
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
      enableSecondStep();
   });

   // Hide suggestions if clicked outside
   $(document).on("click", function (e) {
      if (!$(e.target).closest("#search-input").length) {
         $("#autocomplete-list").remove();
      }
   });

   //   Place Order Form
   function enableSecondStep() {
      if ($("#postcode-input").val() == "" || currentCubicMeters == "" || currentCubicMeters <= 0) {
         $("#location-and-quantity-btn").prop("disabled", true);
         $(".location-and-quantity-section").addClass("pending").removeClass("filled");
      } else {
         $("#location-and-quantity-btn").prop("disabled", false);
         $(".location-and-quantity-section").removeClass("pending").addClass("filled");
         trigger_calculator();
      }
   }

   //  Jump to second step on reload
   if ($("#postcode-input").val() !== "" && currentCubicMeters !== "" && currentCubicMeters > 0) {
      $(".location-and-quantity-section").removeClass("active").addClass("inactive");
      $(".type-and-kind-section").addClass("active").removeClass("inactive");
   }

   $('input[name="application"]').on("change", function () {
      trigger_calculator();

      dataLayer.push({
          'event': 'gaEvent',
			'eventAction': 'typeKindChose',
         'timestamp': new Date().toISOString()
      });
   });
   $('input[name="compound"]').on("change", function () {
      trigger_calculator();

      dataLayer.push({
          'event': 'gaEvent',
			'eventAction': 'typeKindChose',
         'timestamp': new Date().toISOString()
      });
   });
   $('input[name="releaseMethod"]').on("change", function () {
      if(!$('input[name="pump-type"]').is(':checked')){
         $('#miniPump').click();
         $('select[name="mini_pumping_distance"]').addClass('blink-shadow');
      }else{
         $('#hoog-vloeibaar_input').prop('disabled', false);
         $('#fijn-grind_input').prop('disabled', false);

         $('#hoog-vloeibaar_input').prop('checked', true).trigger('change');
         $('#fijn-grind_input').prop('checked', true).trigger('change');
      }
      trigger_calculator();

      dataLayer.push({
          'event': 'gaEvent',
			'eventAction': 'typeKindChose',
         'timestamp': new Date().toISOString()
      });
   });
   $('input[name="pump-type"]').on("change", function () {
      
      if ($(this).val() == "boom") {
         $("#mini-pump-breakdown").addClass("d-none");
         //$('.pump-horse').addClass('d-none');
         $('#hoog-vloeibaar_input').prop('disabled', false);
         $('#fijn-grind_input').prop('disabled', false);

         $('#extra_hose_length').text($('select[name="boom_pumping_distance"]').val() + 'm');

         $('.mini-pump-breakdown-properties').addClass('d-none');
      } else {
         $("#mini-pump-breakdown").removeClass("d-none");
         $('.mini-pump-breakdown-properties').removeClass('d-none');
         //$('.pump-horse').removeClass('d-none');

         //Mini Pump must have below selections
         $('#hoog-vloeibaar_input').prop('checked', true).trigger('change').prop('disabled', true);
         $('#fijn-grind_input').prop('checked', true).trigger('change').prop('disabled', true);

         $('#extra_hose_length').text($('select[name="mini_pumping_distance"]').val() + 'm');
      }

      $('.custom-select-box').removeClass('blink-shadow');
      $(this).parents('.pump-wrap').find('.custom-select-box').addClass('blink-shadow');

      $('.pump-wrap').removeClass('active');
      $(this).parents('.pump-wrap').addClass('active');
      trigger_calculator();
   });

   $('.release-method-pump-wrapper .pump-wrap').on("click", function () {
      var pumpCheckbox = $(this).find('input[name="pump-type"]');
      pumpCheckbox.prop('checked', true);
      pumpCheckbox.trigger('change');
   });

   $(document).on("click", '.custom-select-box', function () {
      $('.custom-select-box').removeClass('blink-shadow');
         console.log('fsfsd');
   });
   
   $('select[name="mini_pumping_distance"]').on("change", function () {
      $(this).removeClass('blink-shadow');
      trigger_calculator();
      $("#extra_hose_length").text($(this).val() + "m");
   });
   
   $('select[name="boom_pumping_distance"]').on("change", function () {
      $(this).removeClass('blink-shadow');
      trigger_calculator();
      $("#extra_hose_length").text($(this).val() + "m");
   });
   $('select[name="surface"]').on("change", function () {
      if ($(this).val() != 0) {
         $(this).removeClass("blink-shadow");
      } else {
         $(this).addClass("blink-shadow");
      }
      trigger_calculator();
   });
   $('input[name="performance"]').on("change", function () {
      if ($('input[name="performance"]:checked').val() == "allIn") {
         $('.release-method-section-1').removeClass('d-sm-block');
         $("#pump").click();
         $(".all-in-cost-wrapper").removeClass("d-none");
         $(".execution-section").addClass("d-block").removeClass('d-none');
         $("#miniPump").click();
         //$('.pump-wrap').addClass('show-pump-distance');
         $('.release-method-pump-wrapper').find('.section-title').text('Pompafstand');
         var defaultValue = $('select[name="mini_pumping_distance"] option[selected]').val();
         $('select[name="mini_pumping_distance"]').val(defaultValue).trigger('change');

         $(".giekpomp-continer").addClass("d-none");
         $(".pump-continer .custom-select-box").addClass("blink-shadow");

         if ($("#surface").val() == 0) {
            $("#surface").addClass("blink-shadow");
         } else {
            $("#surface").removeClass("blink-shadow");
         }

         if ($("#num-rooms").val() == 0) {
            $("#num-rooms").addClass("blink-shadow");
         } else {
            $("#num-rooms").removeClass("blink-shadow");
         }

         // if ($(document).width() <= 576) {
         //    $(".release-method-pump-wrapper").removeClass('d-none').addClass("d-block");
         //    $(".release-method-section-2-wrapper").removeClass('d-none').addClass("d-block");
         // }
         //$(".pompafstand-section").addClass("all-in-one-selected");

         $('#butterfly-floor').prop('checked', false);

      } else {
         $("#surface").removeClass("blink-shadow");
         $("#num-rooms").removeClass("blink-shadow");

         $('#fromGutter').click();
         $('.release-method-section-1').addClass('d-sm-block');
         $('.pump-wrap').removeClass('show-pump-distance');
         $('.release-method-pump-wrapper').find('.section-title').text('KIES POMP');

         trigger_calculator();
         $(".all-in-cost-wrapper").addClass("d-none");
         $(".execution-section").addClass("d-none").removeClass('d-sm-block');
         
         $(".giekpomp-continer").removeClass("d-none");
         if ($(document).width() <= 576) {
            $(".release-method-pump-wrapper").removeClass('d-block').addClass("d-none");
            $(".release-method-section-2-wrapper").removeClass('d-block').addClass("d-none");
         }  

         $(".pompafstand-section").removeClass("all-in-one-selected");

         $('#snelhardend_input, #vlinderbeton_input').each(function () {
            this.disabled = false;

            this.dispatchEvent(
                  new Event('change', { bubbles: true })
            );
         });
      }
      dataLayer.push({
         'event': 'gaEvent',
		 'eventAction': 'typeKindChose',
         'timestamp': new Date().toISOString()
      });
   });
   $('select[name="num-rooms"]').on("change", function () {
      if ($(this).val() != 0) {
         $(this).removeClass("blink-shadow");
      } else {
         $(this).addClass("blink-shadow");
      }
      trigger_calculator();
   });
   $('select[name="layer-thickness"]').on("change", function () {
      trigger_calculator();
   });

   $("#mezzanine-floor").on("change", function () {
      trigger_calculator();
      // if ($("#mezzanine-floor").is(":checked")) {
      //    $(".ground_floor_wrapper").removeClass("d-none");
      // } else {
      //    $(".ground_floor_wrapper").addClass("d-none");
      // }
   });
   // $("#butterfly-floor").on("change", function () {
   //    trigger_calculator();
   //    // if ($("#mezzanine-floor").is(":checked")) {
   //    //    $(".butterfly_floor_wrapper").removeClass("d-none");
   //    // } else {
   //    //    $(".butterfly_floor_wrapper").addClass("d-none");
   //    // }
   //    $(".butterfly_floor_wrapper").toggleClass("d-none");

   //    if ($('input[name="performance"]:checked').val() == "allIn") {
   //       if ($('#snelhardend_input').is(':checked') && $('#vlinderbeton_input').is(':checked')) {
   //          $('#snelhardend_input').prop('checked', false).trigger('change').prop('disabled', false);
   //          $('#vlinderbeton_input').prop('checked', false).trigger('change').prop('disabled', false);
   //       } else {
   //          $('#snelhardend_input').prop('checked', true).trigger('change').prop('disabled', true);
   //          $('#vlinderbeton_input').prop('checked', true).trigger('change').prop('disabled', true);
   //       }
   //    } 
   // });

   $("#butterfly-floor").on("change", applyButterflyFloorState);

   function applyButterflyFloorState() {
      const isChecked = $('#butterfly-floor').is(':checked');
      const isAllIn = $('input[name="performance"]:checked').val() === "allIn";

      // UI visibility
      $(".butterfly_floor_wrapper").toggleClass("d-none", !isChecked);

      // Default: enable inputs
      $('#snelhardend_input, #vlinderbeton_input').prop('disabled', false);

      // Only force + disable when BOTH conditions true
      if (isChecked && isAllIn) {
         $('#snelhardend_input, #vlinderbeton_input').each(function () {
               this.checked = true;
               this.disabled = true;
         });
      }

      trigger_calculator();
   }

   $(".submit-btn").on("click", function (e) {
      e.preventDefault();
      if ($(this).val() == "quote") {
         const pdfEmail = $('#email').val().trim();

         e.stopPropagation();
         $('.voer-uw-e-mailadres-wrapper').removeClass('d-none');

         if ($('.voer-uw-e-mailadres-wrapper').hasClass('selected')) {
            if (isValidEmail(pdfEmail)) {

               if ($('input[name="performance"]:checked').val() == "allIn") {
                  if (($("#num-rooms").val() != 0) && ($("#surface").val() != 0)) {
                     $('.submit-btn[value="quote"] span').addClass('dayz-loader');
                     send_to_quotation();
                  } else {
                     alert("Gelieve zowel oppervlak als aantal Kamers in te vullen."); 
                     $('#surface').focus(); 
                  }
               } else {
                  $('.submit-btn[value="quote"] span').addClass('dayz-loader');
                  send_to_quotation();
               }

               var orderTotalExclTax = $('#sub_total_formatted bdi').text().replace('€', '').trim();
               var orderTotalInclTax = $('#total_formatted bdi').text().replace('€', '').trim();

               dataLayer.push({
                  'event': 'gaEvent',
					   'eventAction': 'quoteRequestSend',
                  'orderTotalExclTax': orderTotalExclTax,
                  'orderTotalInclTax': orderTotalInclTax,
                  'timestamp': new Date().toISOString()
               });

            } else {
               alert("Vul alstublieft uw e-mailadres in."); 
               $('#email').focus(); 
            }
         } else {
            $('.voer-uw-e-mailadres-wrapper').addClass('selected');
            $(this).addClass('selected');
         }

         var orderTotalExclTax = $('#sub_total_formatted bdi').text().replace('€', '').trim();
         var orderTotalInclTax = $('#total_formatted bdi').text().replace('€', '').trim();

         dataLayer.push({
            'event': 'gaEvent',
			   'eventAction': 'quoteRequestBtnClick',
            'timestamp': new Date().toISOString()
         });

      } else {
         
         if ($('input[name="performance"]:checked').val() == "allIn") {
            if (($("#num-rooms").val() != 0) && ($("#surface").val() != 0)) {
               $('.submit-btn[value="checkout"] span').addClass('dayz-loader');
               send_to_cart();
            } else {
               alert("Gelieve zowel oppervlak als aantal Kamers in te vullen."); 
               $('#surface').focus(); 
            }
         } else {
            $('.submit-btn[value="checkout"] span').addClass('dayz-loader');
            send_to_cart();
         }

         dataLayer.push({
            'event': 'gaEvent',
			   'eventAction': 'orderBtnClick',
            'timestamp': new Date().toISOString()
         });
      }
      console.log($(this).val());
   });

   function isValidEmail(pdfEmail) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(pdfEmail);
   }

   //$('#email').on('change', function(){
      // if($(this).val() !== ''){
      //    $('.submit-btn[value="quote"]').prop("disabled", false);
      // }else{
      //    $('.submit-btn[value="quote"]').prop("disabled", true);
      // }
   //})


   $(document).on('click', function(e) {
      if (!$(e.target).closest('.voer-uw-e-mailadres-wrapper, .offerte-in-pdf-btn').length) {
         $('.voer-uw-e-mailadres-wrapper').addClass('d-none');
         $('.voer-uw-e-mailadres-wrapper').removeClass('selected');
         $('.submit-btn[value="quote"]').removeClass('selected');
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
         cubic_meters: currentCubicMeters,
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
         beforeSend: function () {
            $('.summary-content').addClass('loading');
         },
         success: function (response) {
            if(response.data.status == 'mail-sent'){
               window.location.href = response.data.redirect;
               // $(".confirm-and-pay-section").addClass("active");
               // $(".type-and-kind-section").removeClass("pending");
               // $(".type-and-kind-section").removeClass("active");
               // $(".type-and-kind-section").addClass("inactive");
               // $('.type-and-kind-form').addClass('d-none');

               // $('.confirm-and-pay-section').find('.step-title').removeClass('disabled');
               // $('#email').val('').trigger('change');
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
         cubic_meters: currentCubicMeters,
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
         $(".release-by-pump").removeClass("d-none").addClass("d-block");

         pump_type = $('input[name="pump-type"]:checked').val();

         if (pump_type == "mini") {
            pumping_distance = $('select[name="mini_pumping_distance"]').val();
            $("#release_method_name").text(": Pomp");
            $('#hoog-vloeibaar_input').prop('disabled', true);
            $('#fijn-grind_input').prop('disabled', true);
            // $('#hoog-vloeibaar_input').prop('checked', true).prop('disabled', true);
            // $('#fijn-grind_input').prop('checked', true).prop('disabled', true).trigger('change');
         } else {
            pumping_distance = $('select[name="boom_pumping_distance"]').val();
            if (pump_type == "boom") {
               $("#release_method_name").text(": Giekpomp");
            }
            $('#hoog-vloeibaar_input').prop('disabled', false);
            $('#fijn-grind_input').prop('disabled', false);
         }
      } else {
         console.log("no pump");
         $(".release-method-pump-cost-wrapper").addClass("d-none");
         $(".release-by-pump").removeClass("d-block").addClass("d-none");
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
         cubic_meters: currentCubicMeters,
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
            beforeSend: function () {
               $(".summary-content").addClass("loading");
            },
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
                  $(".summary-content").removeClass("loading");
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

      //console.log(clicked_section);

      for (let index = 1; index <= total_steps; index++) {
         if(index == clicked_step){
            $('.section-wrap[data-step='+index+']').find('.form-section').removeClass('d-none');
            continue;
         }else{
            $('.section-wrap[data-step='+index+']').find('.form-section').addClass('d-none');
         }

         if(index == 1){
            if ($("#postcode-input").val() == "" || currentCubicMeters == "" || currentCubicMeters <= 0) {
               $("#location-and-quantity-btn").prop("disabled", true);
               $(".location-and-quantity-section").addClass("pending").removeClass("filled");
            }
         }
         console.log($('.section-wrap[data-step='+index+']'));

         $('.section-wrap[data-step='+index+']').removeClass('active').removeClass('pending').removeClass('inactive')
      }
      
   });

   $("#orddd_datepicker").addClass("display-hide-calendar");

   $(document).on('click', '.orddd-checkout-fields', function() {
      console.log('date-picker opened');
      $("#orddd_datepicker").removeClass("display-hide-calendar");
      $("#orddd_datepicker").addClass("display-show-calendar");
   });

   $('.type-and-kind-section2').on('click', function() {
      window.history.back(); 
   });

   jQuery(document).ready(function ($) {
      $('.location-and-quantity-section2').on('click', function () {
        const targetUrl = '/beton2025/offerte-aanvragen/?step=location';
        window.location.href = targetUrl;
      });
  
      const step = new URL(window.location.href).searchParams.get('step');
  
      if (step === 'location') {
         console.log('location');
         console.log($('.location-and-quantity-section'));
        $('.location-and-quantity-section')
          .addClass('active pending')
          .removeClass('filled inactive');
  
        $('.type-and-kind-section')
          .removeClass('active pending')
          .addClass('inactive');
      }
    });

   //Google Review custom js
   $('.grw-review-inner').each(function(index) {
      const $container = $(this);
      const $svgs = $container.find('svg');
      const $trigger = $svgs.last();
      const $link = $container.find('a.wp-google-name');

      if ($trigger.length && $link.length) {
         $trigger.on('click', function() {
            const href = $link.attr('href');
            if (href) {
               window.open(href, '_blank');
            }
         });
      }
   });

   //Tag event run when quotation page load
   if (window.location.pathname === '/offerte-aanvragen') {
      
      //console.log('The quotation page is loaded.');
      setTimeout(function(){
         var orderTotalExclTax = $('#sub_total_formatted bdi').text().replace('€', '').trim();
         var orderTotalInclTax = $('#total_formatted bdi').text().replace('€', '').trim();

         dataLayer.push({
            'event': 'gaEvent',
            'eventAction': 'quotePageLoaded',
            'orderTotalExclTax': orderTotalExclTax,
            'orderTotalInclTax': orderTotalInclTax,
            'timestamp': new Date().toISOString()
         });
      }, 5000);
      
   } 

   //Tag event run when checkout page load
   // if (window.location.pathname === '/checkout') {
   //    var orderTotalExclTax = $('.beton-checkout-subtotal bdi').text().replace('€', '').trim();
   //    var orderTotalInclTax = $('.beton-checkout-total bdi').text().replace('€', '').trim();
   //    // console.log('The checkout page is loaded.');
   //    // console.log(orderTotalExclTax + ' / ' + orderTotalInclTax);
   //    dataLayer.push({
   //        'event': 'gaEvent',
	// 		'eventAction': 'checkoutPageLoaded',
   //       'orderTotalExclTax': orderTotalExclTax,
   //       'orderTotalInclTax': orderTotalInclTax,
   //       'timestamp': new Date().toISOString()
   //    });
   // } 

   // const isOrderReceived = /(?:^|\/)checkout\/order-received(?:\/|$)/.test(window.location.pathname);

   // if (isOrderReceived) {
   //    console.log('The order received page is loaded.');
   //    dataLayer.push({
   //        'event': 'gaEvent',
   //       'eventAction': 'orderReceivedPageLoaded', 
   //       'timestamp': new Date().toISOString()
   //    });
   // }

});
