jQuery(document).ready(function ($) {
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

   $(document).on("click", ".dropdown-item", function (e) {
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
   $('input[name="pump-type"]').on("change", function () {
      trigger_calculator();
   });
   $('select[name="mini_pumping_distance"]').on("change", function () {
      trigger_calculator();
      $("#extra_hose_length").text($(this).val() + "m");
   });
   $('input[name="performance"]').on("change", function () {
      trigger_calculator();
   });
   $('select[name="num-rooms"]').on("change", function () {
      trigger_calculator();
   });
   $("#mezzanine-floor").on("change", function () {
      trigger_calculator();
   });
   $("#butterfly-floor").on("change", function () {
      trigger_calculator();
   });

   //  trigger_calculator();
   function trigger_calculator() {
      let compounds = [];
      $('input[name="compound"]:checked').each(function () {
         compounds.push($(this).attr("value"));
      });

      let release_method = "gutter";
      let pump_type = null;
      let pumping_distance = 0;
      if ($('input[name="releaseMethod"]:checked').val() == "pump") {
         release_method = "pump";
         pump_type = $('input[name="pump-type"]:checked').val();

         if (pump_type == "mini") {
            pumping_distance = $('select[name="mini_pumping_distance"]').val();
         } else {
            pumping_distance = $('select[name="boom_pumping_distance"]').val();
         }
      }

      let performance = $('input[name="performance"]:checked').val();
      let layer_thickness = $("#layer-thickness").val();
      let rooms_count = $("#num-rooms").val();
      let butterfly_floor = $("#butterfly-floor").val();
      let surface = $('select[name="surface"]').val();
      let selected_floor = $("#mezzanine-floor").val();

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

      $.ajax({
         type: "post",
         url: betonData.ajax_url,
         data: dataSet,
         success: function (response) {
            console.log(response);
            if (response.data) {
               $(".dynamic-hide").removeClass("d-flex").addClass("d-none");

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
});
