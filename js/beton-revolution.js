jQuery(document).ready(function ($) {
    console.log('beton-revolution.js loaded');

    // Helper function to handle both comma and period decimals
    function parseInput(value) {
        if (!value) return 0; // Return 0 if the field is empty
        // Replace comma with dot, then convert to a float
        const parsedValue = parseFloat(value.toString().replace(',', '.'));
        // If the result is Not a Number (NaN), return 0 to prevent calculation errors
        return isNaN(parsedValue) ? 0 : parsedValue; 
    }

    // Calculate Cubic Meters
    $('#bpc-kuub-result-calc-btn').on('click', function () {
        // Read the raw values
        const lengthRaw = $('#bpc-kuub-length-input').val();
        const widthRaw = $('#bpc-kuub-width-input').val();
        const heightRaw = $('#bpc-kuub-height-input').val();

        // Sanitize and parse the values
        const length = parseInput(lengthRaw);
        const width = parseInput(widthRaw);
        const height = parseInput(heightRaw);

        // Calculate the result
        const result = length * width * height;

        // Format the result to a maximum of 2 decimal places and display it
        // Note: Using replace('.', ',') to show the output in Dutch format
        const formattedResult = result.toFixed(2).replace('.00', '').replace('.', ',');

        $('#bpc-kuub-result-value').text(formattedResult);
    });

    // Toggle BTW
    function toggleBTW() {
        if ($('#bpc-btw-toggle').is(':checked')) {
            $('#total_formatted').show();
            $('#sub_total_formatted').hide();
            $('.bpc-btw-label').text('Incl. btw');
        } else {
            $('#total_formatted').hide();
            $('#sub_total_formatted').show();
            $('.bpc-btw-label').text('Excl. btw');
        }
    }

    // Run on load
    toggleBTW();

    // Run on change
    $('#bpc-btw-toggle').on('change', toggleBTW);

    // Price update on the checkout button
    var $sourcePrice = $('#sub_total_formatted');
    var $targetButtonPrice = $('#total_formatted_price');

    // Make sure both elements exist on the page before running
    if ($sourcePrice.length && $targetButtonPrice.length) {
        
        // 2. Create the observer callback
        var observer = new MutationObserver(function() {
            // Update the button's HTML with the source's HTML using jQuery's .html()
            $targetButtonPrice.html($sourcePrice.html());
        });

        // 3. Start observing the source element 
        // Note: We use [0] to pass the raw DOM element to the observer
        observer.observe($sourcePrice[0], { 
            childList: true, 
            characterData: true, 
            subtree: true 
        });
        
        // 4. (Optional) Sync the initial value on page load
        $targetButtonPrice.html($sourcePrice.html());
    }

    // Initialize Select2 on the timeslot dropdown
    $('#dayz_date_mapper_timeslots').select2({
        placeholder: "Select timeslots",
        allowClear: true,
        width: '100%'
    });


    /**===========================================
     * Main functions
     *===========================================*/

    // Global variable
    let currentCubicMeters = 0;

    // Check if the user has already selected a postcode and cubic meters
    if ($.cookie("selected_area_code") !== undefined && $.cookie("selected_area_code") !== "") {
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
    }
    
    // Always validate on load to ensure proper disabled state
    enableSecondStep();

    
    // Postcode autocomplete
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

    $("#postcode-input").on("input change blur", function () {
        $(this).removeClass("bpc-input-error");
        enableSecondStep();
    });

    // Postcode autocomplete click
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
        if (!$(e.target).closest("#postcode-input").length) {
            $("#autocomplete-list").remove();
        }
    });

    // Enable second step
    function enableSecondStep() {
        if ($("#postcode-input").val() == "" || currentCubicMeters == "" || currentCubicMeters <= 0) {
           // Do nothing
        } else {
           if (typeof trigger_calculator === "function") {
               trigger_calculator();
           }
        }
    }

    // Intercept interactions on the rest of the form if location/kuub aren't filled
    $(".bpc-card").on("click change focusin", "input, select, button, label", function (e) {
        let $target = $(e.currentTarget);
        
        let $parentSection = $target.closest(".bpc-section");
        let $checkout = $target.closest(".bpc-checkout");
        
        // Allow interactions if inside the first section or not in a subsequent module
        if (($parentSection.length && $parentSection.is($(".bpc-card .bpc-section").first())) || (!$parentSection.length && !$checkout.length)) {
            return;
        }

        let isLocationFilled = $("#postcode-input").val() && $("#postcode-input").val().trim() !== "";
        let isKuubFilled = currentCubicMeters && currentCubicMeters > 0;

        if (!isKuubFilled || !isLocationFilled) {
            e.preventDefault();
            e.stopPropagation();

            if (e.type === "focusin") {
                $target.blur();
            }

            if (!isLocationFilled && isKuubFilled) {
                $("#postcode-input").focus().addClass("bpc-input-error");
            } else {
                // Focus cubic-meters if both empty, or if only it is empty
                $("#cubic-meters").focus().addClass("bpc-input-error");
            }
        }
    });

    // Cubic meters change function
    function cubicMetersChange(value, step) {
        step || (step = 1.0);

        value = parseFloat(value.toString().replace(',', '.')) || 0;

        var inv = 1.0 / step;
        var rounded = Math.ceil(value * inv) / inv;

        return rounded;
    }

   // Cubic meters change
   $("#cubic-meters").on("change", function () {
        $(this).removeClass("bpc-input-error");

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

    });

    $("#cubic-meters").on("keyup input", function () {
        $(this).removeClass("bpc-input-error");
        currentCubicMeters = parseFloat($(this).val().toString().replace(',', '.')) || 0;
        enableSecondStep();
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

    // Trigger calculator after page load
    setTimeout(function(){
        trigger_calculator();
    }, 250);

    // Application change
    $('input[name="application"]').on("change", function () {
        trigger_calculator();
    });

    // Compound change
    $('input[name="compound"]').on("change", function () {
        trigger_calculator();
    });

    // Release method change
    $('input[name="releaseMethod"]').on("change", function () {
        if ($('input[name="releaseMethod"]:checked').val() === "pump") {
            $("#kies-pomp-section").show();
            if(!$('#miniPump').is(':checked')){
                $('#miniPump').prop('checked', true).trigger('change');
                $('select[name="mini_pumping_distance"]').addClass('blink-shadow');
            }
        } else {
            $("#kies-pomp-section").hide();
            $('#miniPump').prop('checked', false).trigger('change');

            $('#hoog-vloeibaar_input').prop('disabled', false);
            $('#fijn-grind_input').prop('disabled', false);

            $('#hoog-vloeibaar_input').prop('checked', true).trigger('change');
            $('#fijn-grind_input').prop('checked', true).trigger('change');
        }
        trigger_calculator();
    });

    // Prevent deselecting miniPump if pump is selected
    $("#miniPump").on("click", function(e) {
        if ($('input[name="releaseMethod"]:checked').val() === "pump") {
            e.preventDefault();
        }
    });

    // Run on load
    if ($('input[name="releaseMethod"]:checked').val() === "pump") {
        $("#kies-pomp-section").show();
        if(!$('#miniPump').is(':checked')){
            $('#miniPump').prop('checked', true);
        }
    } else {
        $("#kies-pomp-section").hide();
    }

    // Pump type change
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

    // Performance change
    $('input[name="performance"]').on("change", function () {
        const $vlinderSection = $('.bpc-vlinder-row').closest('.bpc-section');

        if ($('input[name="performance"]:checked').val() == "allIn") {
            $("#pump").prop("checked", true).trigger("change");
            $(".all-in-cost-wrapper").removeClass("d-none");
            $(".execution-section").addClass("d-block").removeClass('d-none');
            // $("#miniPump").click(); // Removed to prevent conflict with our click interceptor
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


            $('#butterfly-floor').prop('checked', false);

            $vlinderSection.removeClass('bpc-section-disabled');
            $vlinderSection.find('input, select').prop('disabled', false);

        } else {
            $("#surface").removeClass("blink-shadow");
            $("#num-rooms").removeClass("blink-shadow");

            $('#fromGutter').prop("checked", true).trigger("change");
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

            $vlinderSection.addClass('bpc-section-disabled');
            $vlinderSection.find('input, select').prop('disabled', true);
            
            // Optional: Reset the fields when disabled so hidden values aren't submitted
            $vlinderSection.find('input[type="checkbox"]').prop('checked', false);
            $vlinderSection.find('select').val('0'); // Resets selects to their default "0" value
            $('#layer-thickness').val('5-10'); // Resets laagdikte to its default
        }
    
    });

    $('input[name="performance"]:checked').trigger('change');

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
    });


   
});