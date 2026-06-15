jQuery(document).ready(function ($) {
    console.log('beton-revolution.js loaded');

    // Only execute the calculator logic if the calculator is present on the page
    if ($('#postcode-input').length === 0) {
        return;
    }

    // Helper function to handle both comma and period decimals
    function parseInput(value) {
        if (!value) return 0; // Return 0 if the field is empty
        // Replace comma with dot, then convert to a float
        const parsedValue = parseFloat(value.toString().replace(',', '.'));
        // If the result is Not a Number (NaN), return 0 to prevent calculation errors
        return isNaN(parsedValue) ? 0 : parsedValue; 
    }

    // Helper to check if postcode is filled, selected, and enabled
    function checkIsVolumeFilled() {
        const $postcode = $('#postcode-input');
        if ($postcode.length === 0) {
            return false;
        }
        const isPostcodeEnabled = $postcode.attr('data-is-enable') !== '0';
        const postcodeVal = $postcode.val();
        return parseInput($('#cubic-meters').val()) > 0 && 
               postcodeVal && 
               postcodeVal.trim() !== "" && 
               $postcode.hasClass('selected') && 
               isPostcodeEnabled;
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

        // Populate the calculated value into the main cubic-meters input field and trigger change
        if (result > 0) {
            $('#cubic-meters').val(formattedResult).trigger('change');
        }
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
    //toggleBTW();

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

     // Helper to set cookie
    function setCookie(name, value, days = 7) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + encodeURIComponent(value) + "; path=/" + expires;
    }

    // Save cookies helper for Vlindervloer
    function saveVlindervloerCookies() {
        let performance = $('input[name="performance"]:checked').val();
        if (performance === 'performSelf') {
            setCookie('selected_butterfly_floor', '', -1);
            setCookie('selected_surface', '', -1);
            setCookie('selected_num_rooms', '', -1);
            setCookie('selected_layer_thickness', '', -1);
            setCookie('selected_mezzanine_floor', '', -1);
            return;
        }
        setCookie('selected_butterfly_floor', $('#butterfly-floor').is(':checked') ? '1' : '0', 2 / 24);
        setCookie('selected_surface', $('select[name="surface"]').val(), 2 / 24);
        setCookie('selected_num_rooms', $('select[name="num-rooms"]').val(), 2 / 24);
        setCookie('selected_layer_thickness', $('select[name="layer-thickness"]').val(), 2 / 24);
        setCookie('selected_mezzanine_floor', $('#mezzanine-floor').is(':checked') ? '1' : '0', 2 / 24);
    }

    // Save cookies helper for pump distance
    function savePumpDistanceCookies() {
        let releaseMethod = $('input[name="releaseMethod"]:checked').val();
        if (releaseMethod !== 'pump') {
            setCookie('selected_pumping_distance', '', -1);
            setCookie('selected_pump_type', '', -1);
            return;
        }
        let pumpType = $('input[name="pump-type"]:checked').val();
        if (pumpType) {
            setCookie('selected_pump_type', pumpType, 2 / 24);
            let distance = (pumpType === 'mini') ? $('select[name="mini_pumping_distance"]').val() : $('select[name="boom_pumping_distance"]').val();
            if (distance) {
                setCookie('selected_pumping_distance', distance, 2 / 24);
            }
        }
    }

    // Restore calculator state from cookies sequentially
    function restoreCalculatorState() {
        const isVolumeFilled = checkIsVolumeFilled();
        if (!isVolumeFilled) {
            return;
        }

        // 1. Restore Beton type (application)
        let savedApp = getCookie('selected_application');
        if (savedApp) {
            let $appInput = $(`input[name="application"][value="${savedApp}"]`);
            if ($appInput.length) {
                $appInput.prop('checked', true);
                $('#bpc-section-toepassing').addClass('is-interacted');
                applyApplicationLogic();
                trigger_calculator();
            }
        } else {
            return;
        }

        // 2. Restore Extra opties (compounds)
        let savedCompoundsStr = getCookie('selected_compounds');
        if (savedCompoundsStr !== null) {
            let savedCompounds = savedCompoundsStr ? savedCompoundsStr.split(',') : [];
            $('input[name="compound"]').prop('checked', false);
            if (savedCompounds.length > 0) {
                savedCompounds.forEach(val => {
                    $(`input[name="compound"][value="${val}"]`).prop('checked', true);
                });
            }
            $('#bpc-section-samenstelling').addClass('is-interacted');
            trigger_calculator();
        } else {
            return;
        }

        // 3. Restore Uitvoering (performance)
        let savedPerformance = getCookie('selected_performance');
        if (savedPerformance) {
            let $perfInput = $(`input[name="performance"][value="${savedPerformance}"]`);
            if ($perfInput.length) {
                $perfInput.prop('checked', true);
                $('#bpc-section-uitvoering').addClass('is-interacted');
                $perfInput.trigger('change', [true]);
            }
        } else {
            return;
        }

        // 4. Restore Loswijze (releaseMethod)
        let savedReleaseMethod = getCookie('selected_release_method');
        if (savedReleaseMethod) {
            let $releaseInput = $(`input[name="releaseMethod"][value="${savedReleaseMethod}"]`);
            if ($releaseInput.length) {
                $releaseInput.prop('checked', true);
                
                // If it's pump, also restore pump-type and distance
                if (savedReleaseMethod === 'pump') {
                    let savedPumpType = getCookie('selected_pump_type');
                    if (savedPumpType) {
                        let $pumpTypeInput = $(`input[name="pump-type"][value="${savedPumpType}"]`);
                        if ($pumpTypeInput.length) {
                            $pumpTypeInput.prop('checked', true);
                        }
                    }
                    
                    let savedDistance = getCookie('selected_pumping_distance');
                    if (savedDistance) {
                        $('select[name="mini_pumping_distance"]').val(savedDistance);
                        $('select[name="boom_pumping_distance"]').val(savedDistance);
                        $('#extra_hose_length').text(savedDistance + 'm');
                    }
                }
                $releaseInput.trigger('change');
            }
        }

        // 5. Restore Vlindervloer (only if performance is allIn and not isHiddenApp)
        const selectedApp = $('input[name="application"]:checked').val();
        const isHiddenApp = (selectedApp === 'stampbeton' || selectedApp === 'vloerenspecie');
        const isAllIn = $('input[name="performance"]:checked').val() === "allIn";
        
        if (!isHiddenApp && isAllIn) {
            let savedButterfly = getCookie('selected_butterfly_floor');
            if (savedButterfly !== null) {
                let butterflyChecked = savedButterfly === '1';
                $('#butterfly-floor').prop('checked', butterflyChecked);
                
                let savedSurface = getCookie('selected_surface');
                if (savedSurface) {
                    $('select[name="surface"]').val(savedSurface).removeClass("blink-shadow");
                }
                let savedRooms = getCookie('selected_num_rooms');
                if (savedRooms) {
                    $('select[name="num-rooms"]').val(savedRooms).removeClass("blink-shadow");
                }
                let savedThickness = getCookie('selected_layer_thickness');
                if (savedThickness) {
                    $('select[name="layer-thickness"]').val(savedThickness);
                }
                let savedMezzanine = getCookie('selected_mezzanine_floor');
                if (savedMezzanine !== null) {
                    $('#mezzanine-floor').prop('checked', savedMezzanine === '1');
                }
                
                $('#bpc-section-vlindervloer').addClass('is-interacted');
                applyButterflyFloorState();
            } else {
                return;
            }
        }

        // 6. Restore Date picker
        let savedDateVal = getCookie('ddm_selected_date');
        if (savedDateVal) {
            $('.dayz-date-mapper-date-picker').val(savedDateVal);
            $('#dayz_date_mapper_date').val(savedDateVal);
        }

        handleSectionLocking();
        updateStepper();
    }

    // DATE CHANGE
    $('.dayz-date-mapper-date-picker').on('change', function() {
        let selectedDate = $(this).val();

        // also update hidden field if needed
        $('#dayz_date_mapper_date').val(selectedDate);
        setCookie('ddm_selected_date', selectedDate, 2 / 24);

        // Clear timeslot selection on date change
        $('#dayz_date_mapper_timeslots').val(null).trigger('change');
        $('#dayz_date_mapper_timeslots_collection').val('');
        setCookie('ddm_selected_timeslots', '', 2 / 24);
        $('input[name="dayz_date_mapper_timeslots[]"]').prop('checked', false);

        updateStepper();
    });


    // Listen for changes to the collection field (if updated externally)
    // $('#dayz_date_mapper_timeslots_collection, #dayz_date_mapper_date').on('change input', function() {
    //     updateStepper();
    // });

    $(document).on('change', 'input[name="dayz_date_mapper_timeslots[]"]', function() {
     
        // convert array to string
        let slotsString = $('#dayz_date_mapper_timeslots_collection').val();
        setCookie('ddm_selected_timeslots', slotsString, 2 / 24);

        if ($('input[name="dayz_date_mapper_timeslots[]"]:checked').length > 0) {
            const checkmark = `
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 16C0 7.16344 7.16344 0 16 0C24.8366 0 32 7.16344 32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16Z" fill="#009966" />
                    <path d="M10 16L14 20L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>`;
            const $step6 = $('.bpc-step').eq(5);
            $step6.removeClass('is-active is-upcoming').addClass('is-completed');
            $step6.find('.bpc-step-circle').html(checkmark);
        }
        checkAndHighlightCheckout();
    });

    // Restore Date and Timeslots from cookies if available
    function getCookie(name) {
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        if (match) return decodeURIComponent(match[2]);
        return null;
    }

    let savedDate = getCookie('ddm_selected_date');
    if (savedDate) {
        $('.dayz-date-mapper-date-picker').val(savedDate);
        $('#dayz_date_mapper_date').val(savedDate);
    }

    // Always clear timeslot selection on page load of the calculator to prevent validation bypass with cached/stale values
    if ($('#postcode-input').length > 0) {
        setCookie('ddm_selected_timeslots', '');
        $('#dayz_date_mapper_timeslots_collection').val('');
        $('#dayz_date_mapper_timeslots').val(null).trigger('change');
        $('input[name="dayz_date_mapper_timeslots[]"]').prop('checked', false);
    }


    // Remove error class when user types
    $('.bpc-text-input, .dayz-date-mapper-date-picker').on('input change', function () {
        if ($(this).val().trim() !== '') {
            $(this).removeClass('bpc-input-error');
        }
    });

    // Remove error class and save timeslots to cookies when user selects timeslots
    $('#dayz_date_mapper_timeslots').on('change', function () {
        let selectedSlots = $(this).val(); // array or string
        let container = $(this).next('.select2-container');

        container.find('.select2-selection').removeClass('bpc-input-error');

        if (selectedSlots && (Array.isArray(selectedSlots) ? selectedSlots.length > 0 : selectedSlots.trim() !== "")) {
            container.find('.select2-selection').addClass('valid');
        } else {
            container.find('.select2-selection').removeClass('valid');
        }

        // convert array/string to string and save to cookie
        let slotsString = Array.isArray(selectedSlots) ? selectedSlots.join(',') : (selectedSlots ? selectedSlots : '');
        setCookie('ddm_selected_timeslots', slotsString, 2 / 24);
        checkAndHighlightCheckout();
    });

    // Mark sections as interacted when user interacts with inputs
    $(document).on('click change input', '.bpc-section input, .bpc-section select', function() {
        const $sec = $(this).closest('.bpc-section');
        $sec.addClass('is-interacted');
        handleSectionLocking();
        updateStepper();
    });


    /**===========================================
     * Main functions
     *===========================================*/

    // Global variable
    window.currentCubicMeters = window.currentCubicMeters || 0;
    let appliedCouponCode = "";
    let isProgrammaticVolumeChange = false;

    // Restoring values from cookies if set
    let savedAreaCode = $.cookie("selected_area_code");
    let savedCity = $.cookie("selected_city");
    let savedCubicMeters = $.cookie("selected_cubic_meters");
    let savedIsEnable = $.cookie("selected_is_enable");

    if (savedAreaCode && savedCity) {
        $("#postcode-input").val(savedCity).addClass("selected");
        if (savedIsEnable !== undefined && savedIsEnable !== null) {
            $("#postcode-input").attr("data-is-enable", savedIsEnable);
        }
    }
    if (savedCubicMeters) {
        currentCubicMeters = parseInput(savedCubicMeters);
        $("#cubic-meters").val(savedCubicMeters);
    }
    
    // Always validate on load to ensure proper disabled state
    enableSecondStep();
    applyApplicationLogic();

   
    // Postcode autocomplete
    $("#postcode-input").on("keyup", function (e) {
        const query = $(this).val();
        $("#postcode-input").removeClass("selected").removeAttr("data-is-enable");
        // Clear previous autocomplete suggestions
        $("#autocomplete-list").remove();
        $("#invalid-region-banner").remove();

        // For numeric postcodes require 4 digits; for city names keep the 2-char threshold
        const isPostcode = /^\d+$/.test(query);
        const minLength = isPostcode ? 4 : 2;

        if (query.length >= minLength) {
            // Filter results based on the input query
            const filteredResults = betonData.postcodes.filter((item) => {
                // Check if the city name or any zip code matches the query
                return item.city_name.toLowerCase().includes(query.toLowerCase()) || item.zip.split(",").some((zip) => zip.includes(query));
            });
            

            // Create a dropdown list for suggestions
            const dropdown = $('<div id="autocomplete-list" class="dropdown-menu mt-1"></div>');
            if (filteredResults.length === 0) {
                const errorMsg = $(
                    `<div style="padding: 12px 20px; font-family: 'Public Sans', sans-serif; font-size: 14px; font-weight: 500; color: #DC2626; line-height: 1.4; pointer-events: none; white-space: normal;">` +
                    `Ingevoerde regio is ongeldig. U kunt geen beton bestellen voor deze regio. Ga naar <a href="https://betonstorten.nl" target="_blank" style="color: #009966; text-decoration: underline; font-weight: 600; pointer-events: auto;">betonstorten.nl</a>` +
                    `</div>`
                );
                dropdown.append(errorMsg);
            } else {
                filteredResults.forEach((item) => {
                    const suggestion = $(
                    `<a href="#" class="dropdown-item" data-postcodes="${item.zip}" data-id="${item.id}" data-area-code="${item.area_code}" data-is-enable="${item.is_enable}">${item.city_name}</a>`
                    );
                    dropdown.append(suggestion);
                });
            }

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
        const selectedIsEnable = $(this).data("is-enable");

        // Set is_enable status
        if (selectedIsEnable !== undefined && selectedIsEnable !== null) {
            $("#postcode-input").attr("data-is-enable", selectedIsEnable);
            setCookie('selected_is_enable', selectedIsEnable, 2 / 24);
        } else {
            $("#postcode-input").removeAttr("data-is-enable");
            setCookie('selected_is_enable', '', -1);
        }

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
        handleSectionLocking();
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

        // Only intercept actual user interactions to prevent programmatic triggers (like on page load) from focusing inputs
        if (!e.originalEvent) {
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

    function cubicMetersChange(value, step) {
        step || (step = 1.0);

        value = parseFloat(value.toString().replace(',', '.')) || 0;

        var inv = 1.0 / step;
        var rounded = Math.ceil(value * inv) / inv;

        // Clean up floating point representation issues
        rounded = Math.round(rounded * 100) / 100;

        return rounded;
    }

   // Cubic meters change
   $("#cubic-meters").on("change", function () {
        $(this).removeClass("bpc-input-error");

        if (!isProgrammaticVolumeChange && appliedCouponCode) {
            appliedCouponCode = '';
            $('#bpc-coupon-code').val('').prop('disabled', false);
            $('#bpc-apply-coupon').prop('disabled', false);
            $('#bpc-coupon-message').addClass('d-none').html('');
            alert("De hoeveelheid beton is gewijzigd. Voer de kortingscode opnieuw in.");
        }

        let rawValue = $(this).val();
        let rounded = cubicMetersChange(rawValue, 0.05);

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
        let rawValue = $(this).val();
        currentCubicMeters = cubicMetersChange(rawValue, 0.05);
        enableSecondStep();
    });

    // Adjust volume (Arrow keys / buttons)
    function adjustVolume(direction) {
        let $input = $('#cubic-meters');
        let rawValue = $input.val();
        let value = parseFloat(rawValue.toString().replace(',', '.')) || 0;
        
        let rounded;
        if (direction === 'up') {
            rounded = Math.floor((value + 0.05 + 0.0001) * 20) / 20;
        } else {
            rounded = Math.ceil((value - 0.05 - 0.0001) * 20) / 20;
        }
        
        // Clean up floating point representation issues
        rounded = Math.round(rounded * 100) / 100;
        
        if (rounded < 0) {
            rounded = 0;
        }
        
        let formatted = rounded.toString();
        if (rawValue.includes(',')) {
            formatted = formatted.replace('.', ',');
        }
        
        $input.val(formatted).trigger('change');
    }

    // Keyboard Arrow Keys support
    $('#cubic-meters').on('keydown', function (e) {
        if (e.key === 'ArrowUp') {
            e.preventDefault();
            adjustVolume('up');
        } else if (e.key === 'ArrowDown') {
            e.preventDefault();
            adjustVolume('down');
        }
    });

    // Click on Arrow Buttons support
    $(document).on('click', '.bpc-input-arrow-up', function () {
        adjustVolume('up');
    });
    $(document).on('click', '.bpc-input-arrow-down', function () {
        adjustVolume('down');
    });


    //  trigger_calculator();
    function trigger_calculator() {
        // Check if selected city is disabled
        let isEnableVal = $("#postcode-input").attr("data-is-enable");
        
        // Remove any existing invalid region banner
        $("#invalid-region-banner").remove();

        if (isEnableVal === "0" || isEnableVal === 0) {
            const bannerHtml = `<div id="invalid-region-banner" class="bpc-notice-box is-error">` +
                               `<div class="bpc-notice-box-icon">` +
                               `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">` +
                               `<path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z" fill="currentColor"/>` +
                               `</svg>` +
                               `</div>` +
                               `<div class="bpc-notice-box-content">` +
                               `Ingevoerde regio is ongeldig. U kunt geen beton bestellen voor deze regio. Ga naar <a href="https://betonstorten.nl" target="_blank" style="color: #009966; text-decoration: underline; font-weight: 600; pointer-events: auto;">betonstorten.nl</a>` +
                               `</div>` +
                               `</div>`;
            $("#bpc-section-volume .bpc-step-info-row").before(bannerHtml);
            
            // Set all prices to €0,00
            const zeroPriceHtml = '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&euro;</span>0,00</bdi></span>';
            $('#sub_total_formatted, #btw_formatted, #total_formatted, #total_formatted_price').html(zeroPriceHtml);
            
            $(".summary-content").removeClass("loading");
            handleSectionLocking();
            updateStepper();
            return;
        }

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

            const selectedApp = $('input[name="application"]:checked').val();
            const isHiddenApp = (selectedApp === 'stampbeton' || selectedApp === 'vloerenspecie');

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
                if (!isHiddenApp) {
                    $('#hoog-vloeibaar_input').prop('disabled', false);
                    $('#fijn-grind_input').prop('disabled', false);
                }
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
            coupon_code: appliedCouponCode
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
                handleSectionLocking();
                updateStepper();
            }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
            },
        });
    }

    // Restore calculator state from cookies sequentially on load
    restoreCalculatorState();

    // Trigger calculator after page load
    setTimeout(function(){
        trigger_calculator();
    }, 250);

    // Application change
    $('input[name="application"]').on("change", function () {
        setCookie('selected_application', $(this).val(), 2 / 24);
        applyApplicationLogic();
        trigger_calculator();
    });

    // Compound change
    $('input[name="compound"]').on("change", function () {
        let compounds = [];
        $('input[name="compound"]:checked').each(function () {
            compounds.push($(this).attr("value"));
        });
        setCookie('selected_compounds', compounds.join(','), 2 / 24);
        trigger_calculator();
    });

    // Release method change
    $('input[name="releaseMethod"]').on("change", function () {
        const selectedApp = $('input[name="application"]:checked').val();
        const isHiddenApp = (selectedApp === 'stampbeton' || selectedApp === 'vloerenspecie');

        let val = $('input[name="releaseMethod"]:checked').val();
        setCookie('selected_release_method', val, 2 / 24);

        if (val === "pump") {
            $("#kies-pomp-section").show();
            if(!$('#miniPump').is(':checked')){
                $('#miniPump').prop('checked', true).trigger('change');
                $('select[name="mini_pumping_distance"]').addClass('blink-shadow');
            }
        } else {
            $("#kies-pomp-section").hide();
            $('#miniPump').prop('checked', false).trigger('change');

            if (!isHiddenApp) {
                $('#hoog-vloeibaar_input').prop('disabled', false);
                $('#fijn-grind_input').prop('disabled', false);

                $('#hoog-vloeibaar_input').prop('checked', false).trigger('change');
                $('#fijn-grind_input').prop('checked', false).trigger('change');
            }
        }
        savePumpDistanceCookies();
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
        const selectedApp = $('input[name="application"]:checked').val();
        const isHiddenApp = (selectedApp === 'stampbeton' || selectedApp === 'vloerenspecie');
      
        if ($(this).val() == "boom") {
            $("#mini-pump-breakdown").addClass("d-none");
            //$('.pump-horse').addClass('d-none');
            if (!isHiddenApp) {
                $('#hoog-vloeibaar_input').prop('disabled', false);
                $('#fijn-grind_input').prop('disabled', false);
            }

            $('#extra_hose_length').text($('select[name="boom_pumping_distance"]').val() + 'm');

            $('.mini-pump-breakdown-properties').addClass('d-none');
        } else {
            $("#mini-pump-breakdown").removeClass("d-none");
            $('.mini-pump-breakdown-properties').removeClass('d-none');
            //$('.pump-horse').removeClass('d-none');

            //Mini Pump must have below selections
            if (!isHiddenApp) {
                $('#hoog-vloeibaar_input').prop('checked', true).trigger('change').prop('disabled', true);
                $('#fijn-grind_input').prop('checked', true).trigger('change').prop('disabled', true);
            }

            $('#extra_hose_length').text($('select[name="mini_pumping_distance"]').val() + 'm');
        }

        $('.custom-select-box').removeClass('blink-shadow');
        $(this).parents('.pump-wrap').find('.custom-select-box').addClass('blink-shadow');

        $('.pump-wrap').removeClass('active');
        $(this).parents('.pump-wrap').addClass('active');
        savePumpDistanceCookies();
        trigger_calculator();
    });

    $('select[name="mini_pumping_distance"]').on("change", function () {
        $(this).removeClass('blink-shadow');
        savePumpDistanceCookies();
        trigger_calculator();
        $("#extra_hose_length").text($(this).val() + "m");
    });
    
    $('select[name="boom_pumping_distance"]').on("change", function () {
        $(this).removeClass('blink-shadow');
        savePumpDistanceCookies();
        trigger_calculator();
        $("#extra_hose_length").text($(this).val() + "m");
    });
    $('select[name="surface"]').on("change", function () {
        if ($(this).val() != 0) {
            $(this).removeClass("blink-shadow");
        } else {
            $(this).addClass("blink-shadow");
        }
        saveVlindervloerCookies();
        trigger_calculator();
    });

    // Performance change
    $('input[name="performance"]').on("change", function (e, isProgrammatic) {
        applyApplicationLogic();
        const $vlinderSection = $('.bpc-vlinder-row').closest('.bpc-section');

        let val = $('input[name="performance"]:checked').val();
        setCookie('selected_performance', val, 2 / 24);

        if (val == "allIn") {
            $("#pump").prop("checked", true).trigger("change");
            $('#fromGutter').prop('disabled', true);
            $('#fromGutter').closest('.bpc-option-card').css({
                'opacity': '0.5',
                'pointer-events': 'none'
            });
            $(".all-in-cost-wrapper").removeClass("d-none");
            $(".execution-section").addClass("d-block").removeClass('d-none');
            // $("#miniPump").click(); // Removed to prevent conflict with our click interceptor
            $('.release-method-pump-wrapper').find('.section-title').text('Pompafstand');
            let savedDistance = getCookie('selected_pumping_distance');
            var defaultValue = savedDistance || $('select[name="mini_pumping_distance"] option[selected]').val();
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
            
            $('.bpc-notice-box').hide();

        } else {
            $('#fromGutter').prop('disabled', false);
            $('#fromGutter').closest('.bpc-option-card').css({
                'opacity': '',
                'pointer-events': ''
            });
            $("#surface").removeClass("blink-shadow");
            $("#num-rooms").removeClass("blink-shadow");

            const selectedApp = $('input[name="application"]:checked').val();
            const isHiddenApp = (selectedApp === 'stampbeton' || selectedApp === 'vloerenspecie');
            if (isHiddenApp) {
                $('.bpc-notice-box').hide();
            } else {
                $('.bpc-notice-box').show();
            }

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
        
        saveVlindervloerCookies();
    
    });

    $('input[name="performance"]:checked').trigger('change', [true]);

    // Handle form restore when navigating back from checkout
    $(window).on('pageshow', function() {
        if ($('#postcode-input').length > 0) {
            setTimeout(function() {
                $('input[name="application"]:checked').trigger('change');
                $('input[name="releaseMethod"]:checked').trigger('change');
                $('input[name="pump-type"]:checked').trigger('change');
                $('input[name="performance"]:checked').trigger('change', [true]);

                // Always clear timeslot selection on pageshow to prevent validation bypass with stale cached values
                setCookie('ddm_selected_timeslots', '');
                $('#dayz_date_mapper_timeslots_collection').val('');
                $('#dayz_date_mapper_timeslots').val(null).trigger('change');
                $('input[name="dayz_date_mapper_timeslots[]"]').prop('checked', false);
            }, 150);
        }
    });

    $('select[name="num-rooms"]').on("change", function () {
        if ($(this).val() != 0) {
            $(this).removeClass("blink-shadow");
        } else {
            $(this).addClass("blink-shadow");
        }
        saveVlindervloerCookies();
        trigger_calculator();
    });
    $('select[name="layer-thickness"]').on("change", function () {
        saveVlindervloerCookies();
        trigger_calculator();
    });

    $("#mezzanine-floor").on("change", function () {
        saveVlindervloerCookies();
        trigger_calculator();
    });

    // Submit to checkout button
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
            
            if (!validateFields()) {
                return false; // HARD STOP
            }
           
            if ($('input[name="performance"]:checked').val() == "allIn") {
                if (($("#num-rooms").val() != 0) && ($("#surface").val() != 0)) {
                    $('.submit-btn[value="checkout"] span.loader-wrapper').addClass('dayz-loader');
                    send_to_cart();
                } else {
                    alert("Gelieve zowel oppervlak als aantal Kamers in te vullen."); 
                    $('#surface').focus(); 
                }
            } else {
                $('.submit-btn[value="checkout"] span.loader-wrapper').addClass('dayz-loader');
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

    // Send to cart
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
            coupon_code: appliedCouponCode
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
            }
        });
    }

    // Helper to validate email
    function isValidEmail(pdfEmail) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(pdfEmail);
    }

    // Send to quotation
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
            coupon_code: appliedCouponCode
        };

        $.ajax({
            type: "post",
            url: betonData.ajax_url,
            data: dataSet,
            beforeSend: function () {
                $('.summary-content').addClass('loading');
            },
            success: function (response) {
                if(response.data && response.data.status == 'mail-sent'){
                    window.location.href = response.data.redirect;
                }
            }
        });
    }

    // Validate fields
    function validateFields() {
        let isValid = true;
        let firstInvalid = null;
        let isRegionDisabled = false;

        // Remove all previous errors
        $('.bpc-input-error').removeClass('bpc-input-error');

        // Fields
        let cubic = $('#cubic-meters');
        let postcode = $('#postcode-input');
        let date = $('#dayz_date_mapper_date'); // hidden input

        // --- cubic meters ---
        let cubicVal = cubic.val();
        if (!cubicVal || !cubicVal.trim() || parseInput(cubicVal) <= 0) {
            cubic.addClass('bpc-input-error');
            firstInvalid = firstInvalid || cubic;
            isValid = false;
            console.log('cubic meters error');
        }

        // --- postcode ---
        let postcodeVal = postcode.val();
        if (!postcodeVal || !postcodeVal.trim()) {
            postcode.addClass('bpc-input-error');
            firstInvalid = firstInvalid || postcode;
            isValid = false;
            console.log('postcode error');
        } else {
            let isEnableVal = postcode.attr("data-is-enable");
            if (isEnableVal === "0" || isEnableVal === 0) {
                postcode.addClass('bpc-input-error');
                firstInvalid = firstInvalid || postcode;
                isValid = false;
                isRegionDisabled = true;
                console.log('postcode disabled error');
            }
        }

        // --- date (IMPORTANT: hidden field) ---
        let dateVal = date.val();
        if (!dateVal || !dateVal.trim()) {
            $('.dayz-date-mapper-date-picker').addClass('bpc-input-error');
            firstInvalid = firstInvalid || $('.dayz-date-mapper-date-picker');
            isValid = false;
            console.log('date error');
        }

        // --- timeslots validation ---
        let hasTimeslot = false;
        
        // Check Select2 dropdown value
        let timeslotsSelect = $('#dayz_date_mapper_timeslots');
        if (timeslotsSelect.length) {
            let val = timeslotsSelect.val();
            if (val && (Array.isArray(val) ? val.length > 0 : val.trim() !== "")) {
                hasTimeslot = true;
            }
        }
        
        // Check Checkbox inputs
        if (!hasTimeslot) {
            if ($('input[name="dayz_date_mapper_timeslots[]"]:checked').length > 0) {
                hasTimeslot = true;
            }
        }
        
        // Check Collection Hidden Input
        if (!hasTimeslot) {
            let timeslotsCollection = $('#dayz_date_mapper_timeslots_collection');
            if (timeslotsCollection.length && timeslotsCollection.val() && timeslotsCollection.val().trim() !== "") {
                hasTimeslot = true;
            }
        }

        if (!hasTimeslot) {
            let select2Box = $('#dayz_date_mapper_timeslots').next('.select2-container').find('.select2-selection');
            if (select2Box.length) {
                select2Box.addClass('bpc-input-error');
            } else {
                $('#dayz_date_mapper_timeslots').addClass('bpc-input-error');
                $('input[name="dayz_date_mapper_timeslots[]"]').addClass('bpc-input-error');
            }

            firstInvalid = firstInvalid || ($('#dayz_date_mapper_timeslots').length ? $('#dayz_date_mapper_timeslots') : $('.dayz-date-mapper-date-picker'));
            isValid = false;
            console.log('timeslots error');
        }

        // --- show alert once ---
        if (!isValid) {
            if (isRegionDisabled) {
                alert("Ingevoerde regio is ongeldig. U kunt geen beton bestellen voor deze regio.");
            } else {
                alert("Gelieve alle verplichte velden in te vullen.");
            }

            if (firstInvalid) {
                firstInvalid.focus();
            }
        }

        return isValid;
    }

    /**
     * Hide steps 3, 4, 5 and Loswijze on specific Applications
     */
    function applyApplicationLogic() {
        const selectedApp = $('input[name="application"]:checked').val();
        const isHiddenApp = (selectedApp === 'stampbeton' || selectedApp === 'vloerenspecie');

        if (isHiddenApp) {
            // Select performance performSelf if not already checked
            if (!$('#performSelf').is(':checked')) {
                $('#performSelf').prop('checked', true).trigger('change');
            }
            // Select gutter if not already checked
            if (!$('#fromGutter').is(':checked')) {
                $('#fromGutter').prop('checked', true).trigger('change');
            }
            // Deselect and disable all compounds
            $('input[name="compound"]').prop('checked', false).prop('disabled', true);

            // Hide sections
            $('#bpc-section-loswijze').hide();
            $('#kies-pomp-section').hide();
            $('#bpc-section-samenstelling').hide();
            $('#bpc-section-uitvoering').hide();
            $('#bpc-section-vlindervloer').hide();
            $('.bpc-notice-box').hide();

            // Dynamic Step Title update
            $('#bpc-section-datum').find('.bpc-step-head-title').text('STAP 3');

            // Hide steps in stepper
            $('.bpc-step').eq(2).hide();
            $('.bpc-step').eq(3).hide();
            $('.bpc-step').eq(4).hide();

            $('.bpc-stepper').addClass('bpc-stepper-3-steps');
        } else {
            // Enable compounds
            $('input[name="compound"]').prop('disabled', false);
            // If no compounds are checked, select 'standaard' by default
            if ($('input[name="compound"]:checked').length === 0) {
                $('#standaard_input').prop('checked', true).trigger('change');
            }

            // Show sections
            $('#bpc-section-loswijze').show();
            if ($('input[name="releaseMethod"]:checked').val() === "pump") {
                $('#kies-pomp-section').show();
            } else {
                $('#kies-pomp-section').hide();
            }
            $('#bpc-section-samenstelling').show();
            $('#bpc-section-uitvoering').show();
            $('#bpc-section-vlindervloer').show();
            if ($('input[name="performance"]:checked').val() === "allIn") {
                $('.bpc-notice-box').hide();
            } else {
                $('.bpc-notice-box').show();
            }

            // Dynamic Step Title update
            $('#bpc-section-datum').find('.bpc-step-head-title').text('STAP 6');

            // Show steps in stepper
            $('.bpc-step').eq(2).show();
            $('.bpc-step').eq(3).show();
            $('.bpc-step').eq(4).show();

            $('.bpc-stepper').removeClass('bpc-stepper-3-steps');
        }
    }

    /**
     * Handle visual locking of sections until Step 1 is complete
     */
    function handleSectionLocking() {
        const isVolumeFilled = checkIsVolumeFilled();
        
        const sectionIds = [
            '#bpc-section-volume',
            '#bpc-section-toepassing',
            '#bpc-section-loswijze',
            '#kies-pomp-section',
            '#bpc-section-samenstelling',
            '#bpc-section-uitvoering',
            '#bpc-section-vlindervloer',
            '#bpc-section-datum'
        ];

        // Reset: All locked initially (except Volume)
        $('.bpc-section').addClass('bpc-section-locked');
        $('#bpc-section-volume').removeClass('bpc-section-locked');

        // Step 1 complete?
        if (!isVolumeFilled) return;
        
        // Step 2 unlocks
        $('#bpc-section-toepassing').removeClass('bpc-section-locked');

        const selectedApp = $('input[name="application"]:checked').val();
        const isHiddenApp = (selectedApp === 'stampbeton' || selectedApp === 'vloerenspecie');

        if (isHiddenApp) {
            if ($('#bpc-section-toepassing').hasClass('is-interacted')) {
                $('#bpc-section-datum').removeClass('bpc-section-locked');
            }
            return;
        }

        $('#bpc-section-loswijze').removeClass('bpc-section-locked');
        $('#kies-pomp-section').removeClass('bpc-section-locked');

        // Step 3 unlocks ONLY if Step 2 interacted
        if (!$('#bpc-section-toepassing').hasClass('is-interacted')) return;
        $('#bpc-section-samenstelling').removeClass('bpc-section-locked');

        // Step 4 unlocks ONLY if Step 3 interacted
        if (!$('#bpc-section-samenstelling').hasClass('is-interacted')) return;
        $('#bpc-section-uitvoering').removeClass('bpc-section-locked');

        // Step 5 unlocks ONLY if Step 4 interacted
        if (!$('#bpc-section-uitvoering').hasClass('is-interacted')) return;
        
        const performanceValue = $('input[name="performance"]:checked').val();
        if (performanceValue === 'allIn') {
             $('#bpc-section-vlindervloer').removeClass('bpc-section-locked');
             
             // Step 6 unlocks if Step 5 interacted
             if ($('#bpc-section-vlindervloer').hasClass('is-interacted')) {
                 $('#bpc-section-datum').removeClass('bpc-section-locked');
             }
        } else {
             // If DIY, Step 5 is skipped, Step 6 unlocks immediately after Step 4 interaction
             $('#bpc-section-datum').removeClass('bpc-section-locked');
        }
    }

    /**
     * Update Stepper UI based on current form state
     */
    function updateStepper() {
        const $steps = $('.bpc-step');
        let completedCount = 0;

        const isVolumeFilled = checkIsVolumeFilled();
        const isToepassingFilled = isVolumeFilled && $('#bpc-section-toepassing').hasClass('is-interacted');
        
        const selectedApp = $('input[name="application"]:checked').val();
        const isHiddenApp = (selectedApp === 'stampbeton' || selectedApp === 'vloerenspecie');

        let isSamenstellingFilled = false;
        let isUitvoeringFilled = false;
        let isVlindervloerFilled = false;

        if (!isHiddenApp) {
            isSamenstellingFilled = isToepassingFilled && $('#bpc-section-samenstelling').hasClass('is-interacted');
            isUitvoeringFilled = isSamenstellingFilled && $('#bpc-section-uitvoering').hasClass('is-interacted');
            
            const performanceValue = $('input[name="performance"]:checked').val();
            if (performanceValue === 'allIn') {
                isVlindervloerFilled = isUitvoeringFilled && $('#bpc-section-vlindervloer').hasClass('is-interacted');
            } else {
                isVlindervloerFilled = isUitvoeringFilled; // Skipped
            }
        }

        const stepStatus = [
            isVolumeFilled,
            isToepassingFilled,
            isSamenstellingFilled,
            isUitvoeringFilled,
            isVlindervloerFilled,
            // isDatumFilled
        ];

        let activeStepIndex = -1;
        let visibleStepIndex = 1;

        $steps.each(function (index) {
            const $step = $(this);
            const $circle = $step.find('.bpc-step-circle');
            
            if ($step.is(':hidden')) {
                return; // Skip hidden steps
            }

            // Checkmark SVG for completed steps
            const checkmark = `
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 16C0 7.16344 7.16344 0 16 0C24.8366 0 32 7.16344 32 16C32 24.8366 24.8366 32 16 32C7.16344 32 0 24.8366 0 16Z" fill="#009966" />
                    <path d="M10 16L14 20L22 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>`;

            if (stepStatus[index]) {
                $step.removeClass('is-active is-upcoming').addClass('is-completed');
                $circle.html(checkmark);
                completedCount++;
            } else {
                if (activeStepIndex === -1) {
                    activeStepIndex = index;
                    $step.removeClass('is-completed is-upcoming').addClass('is-active');
                    $circle.text(visibleStepIndex);
                } else {
                    $step.removeClass('is-completed is-active').addClass('is-upcoming');
                    $circle.text(visibleStepIndex);
                }
            }
            visibleStepIndex++;
        });

        // Update progress bar width
        const totalSteps = $steps.filter(':visible').length;
        const progressPercentage = completedCount * (83.333 / (totalSteps - 1));
        $('.bpc-stepper-track-progress').css('width', progressPercentage + '%');
        checkAndHighlightCheckout();
    }


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

        saveVlindervloerCookies();
        trigger_calculator();
    }

    function syncAllInOnePriceChange() {
        allInOnePriceClone = $('#allIn_formatted').html();
        if(allInOnePriceClone) {
            $('#allIn_formatted_clone').html(allInOnePriceClone);
        }
    }

    // Initial sync
    syncAllInOnePriceChange();

    // Watch for changes
    const allInFormattedEl = document.getElementById('allIn_formatted');
    if (allInFormattedEl) {
        const allInOnePriceObserver = new MutationObserver(function () {
            syncAllInOnePriceChange();
        });

        allInOnePriceObserver.observe(allInFormattedEl, {
            childList: true,
            subtree: true,
            characterData: true
        });
    }

    // Toggle Beton Kuub Calculator Dropdown
    $('.bpc-step-calc-row').on('click', function () {
        const $dropdown = $('.bpc-calculator-dropdown');
        const $row = $(this);
        
        $dropdown.slideToggle(300);
        $row.toggleClass('open');
    });

    // Highlight (blink) the checkout button when all steps are completed (including Step 6)
    function checkAndHighlightCheckout() {
        const isVolumeFilled = checkIsVolumeFilled();
        const isToepassingFilled = isVolumeFilled && $('#bpc-section-toepassing').hasClass('is-interacted');
        
        const selectedApp = $('input[name="application"]:checked').val();
        const isHiddenApp = (selectedApp === 'stampbeton' || selectedApp === 'vloerenspecie');

        let stepsCompleted = false;

        if (isHiddenApp) {
            stepsCompleted = isVolumeFilled && isToepassingFilled;
        } else {
            const isSamenstellingFilled = isToepassingFilled && $('#bpc-section-samenstelling').hasClass('is-interacted');
            const isUitvoeringFilled = isSamenstellingFilled && $('#bpc-section-uitvoering').hasClass('is-interacted');
            
            const performanceValue = $('input[name="performance"]:checked').val();
            if (performanceValue === 'allIn') {
                const isVlindervloerFilled = isUitvoeringFilled && $('#bpc-section-vlindervloer').hasClass('is-interacted');
                stepsCompleted = isVolumeFilled && isToepassingFilled && isSamenstellingFilled && isUitvoeringFilled && isVlindervloerFilled;
            } else {
                stepsCompleted = isVolumeFilled && isToepassingFilled && isSamenstellingFilled && isUitvoeringFilled;
            }
        }

        // Date selection
        const dateVal = $('#dayz_date_mapper_date').val();
        const isDateFilled = dateVal && dateVal.trim() !== "";

        // Timeslot selection
        let hasTimeslot = false;
        const timeslotsSelect = $('#dayz_date_mapper_timeslots');
        if (timeslotsSelect.length) {
            const val = timeslotsSelect.val();
            if (val && (Array.isArray(val) ? val.length > 0 : val.trim() !== "")) {
                hasTimeslot = true;
            }
        }
        if (!hasTimeslot) {
            if ($('input[name="dayz_date_mapper_timeslots[]"]:checked').length > 0) {
                hasTimeslot = true;
            }
        }
        if (!hasTimeslot) {
            const timeslotsCollection = $('#dayz_date_mapper_timeslots_collection');
            if (timeslotsCollection.length && timeslotsCollection.val() && timeslotsCollection.val().trim() !== "") {
                hasTimeslot = true;
            }
        }

        const allStepsCompleted = stepsCompleted && isDateFilled && hasTimeslot;

        if (allStepsCompleted) {
            $('.bpc-checkout-btn').addClass('bpc-blink');
        } else {
            $('.bpc-checkout-btn').removeClass('bpc-blink');
        }

        if (stepsCompleted) {
            $('.bpc-coupon-toggle-container').removeClass('d-none');
            if (!appliedCouponCode) {
                $('#bpc-coupon-code').prop('disabled', false);
                $('#bpc-apply-coupon').prop('disabled', false);
            }
        } else {
            if (!appliedCouponCode) {
                $('.bpc-coupon-toggle-container').addClass('d-none');
                $('.bpc-coupon-wrap').addClass('d-none');
                $('#bpc-coupon-toggle').removeClass('active');
                $('#bpc-coupon-code').prop('disabled', true).val('');
                $('#bpc-apply-coupon').prop('disabled', true);
                $('#bpc-coupon-message').addClass('d-none').html('');
            }
        }
    }

    // Handle coupon toggle click
    $(document).on('click', '#bpc-coupon-toggle', function (e) {
        e.preventDefault();
        const $wrap = $('.bpc-coupon-wrap');
        if ($wrap.hasClass('d-none')) {
            $wrap.hide().removeClass('d-none').slideDown(300);
        } else {
            $wrap.slideUp(300, function () {
                $wrap.addClass('d-none');
            });
        }
        $(this).toggleClass('active');
    });

    // Handle Enter key inside coupon input field
    $(document).on('keypress', '#bpc-coupon-code', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#bpc-apply-coupon').trigger('click');
        }
    });

    // Coupon application logic
    $(document).on('click', '#bpc-apply-coupon', function () {
        const couponCode = $('#bpc-coupon-code').val().trim();
        const $msg = $('#bpc-coupon-message');

        if (!couponCode) {
            $msg.removeClass('d-none success').addClass('error').text('Voer een kortingscode in.');
            return;
        }

        $msg.removeClass('d-none error success').addClass('info').text('Controleren...');

        $.ajax({
            type: 'post',
            url: betonData.ajax_url,
            data: {
                action: 'beton_validate_coupon',
                coupon_code: couponCode
            },
            success: function (response) {
                if (response.success) {
                    appliedCouponCode = couponCode;
                    
                    trigger_calculator();

                    // Update UI
                    $('#bpc-coupon-code').prop('disabled', true);
                    $('#bpc-apply-coupon').prop('disabled', true);
                    $msg.removeClass('d-none error info').addClass('success').html(
                        `Kortingscode '<strong>${couponCode}</strong>' toegepast! 1 m³ gratis beton is verrekend. ` +
                        `<a href="#" id="bpc-remove-coupon" style="color: #991B1B; text-decoration: underline; font-weight: 600; margin-left: 8px;">Verwijderen</a>`
                    );
                } else {
                    $msg.removeClass('d-none success info').addClass('error').text(response.data.message || 'Ongeldige kortingscode.');
                }
            },
            error: function () {
                $msg.removeClass('d-none success info').addClass('error').text('Er is een fout opgetreden bij het valideren.');
            }
        });
    });

    // Coupon removal logic
    $(document).on('click', '#bpc-remove-coupon', function (e) {
        e.preventDefault();
        if (!appliedCouponCode) return;

        appliedCouponCode = '';
        $('#bpc-coupon-code').val('').prop('disabled', false);
        $('#bpc-apply-coupon').prop('disabled', false);
        $('#bpc-coupon-message').addClass('d-none').html('');
        
        trigger_calculator();
    });

    // Stepper click handler to scroll to and focus the clicked step's section
    $(document).on('click', '.bpc-step', function () {
        const stepIndex = $('.bpc-step').index($(this));
        const stepToSectionIdMap = {
            0: '#bpc-section-volume',
            1: '#bpc-section-toepassing',
            2: '#bpc-section-samenstelling',
            3: '#bpc-section-uitvoering',
            4: '#bpc-section-vlindervloer',
            5: '#bpc-section-datum'
        };

        const targetId = stepToSectionIdMap[stepIndex];
        if (targetId) {
            const $targetSection = $(targetId);
            if ($targetSection.length) {
                if ($targetSection.hasClass('bpc-section-locked')) {
                    // Find the last unlocked step and scroll to it instead
                    const $unlockedSections = $('.bpc-section:not(.bpc-section-locked)');
                    const $activeSection = $unlockedSections.last();
                    
                    if ($activeSection.length) {
                        $('html, body').animate({
                            scrollTop: $activeSection.offset().top - 120
                        }, 600);
                        const $input = $activeSection.find('input, select, textarea').filter(':visible').first();
                        if ($input.length) {
                            $input.focus();
                        }
                    }
                } else {
                    // Scroll to target step
                    $('html, body').animate({
                        scrollTop: $targetSection.offset().top - 120
                    }, 600);
                    const $input = $targetSection.find('input, select, textarea').filter(':visible').first();
                    if ($input.length) {
                        $input.focus();
                    }
                }
            }
        }
    });

    // Focus "Hoeveel beton" field when "Start Configuratie" button is clicked
    $('.bpc-hero-btn, .bpc-cta-btn-primary').on('click', function (e) {
        e.preventDefault();
        const $target = $('#bpc-section-volume');
        if ($target.length) {
            $('html, body').animate({
                scrollTop: $target.offset().top - 120
            }, 600, function() {
                $('#cubic-meters').focus();
            });
        } else {
            $('#cubic-meters').focus();
        }
    });

    // Focus coupon code section on redirect from checkout
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('focus_coupon')) {
        setTimeout(function() {
            const $toggleContainer = $('.bpc-coupon-toggle-container');
            const $toggle = $('#bpc-coupon-toggle');
            const $wrap = $('.bpc-coupon-wrap');
            const $input = $('#bpc-coupon-code');
            
            if ($toggleContainer.length && !$toggleContainer.hasClass('d-none')) {
                $('html, body').animate({
                    scrollTop: $toggleContainer.offset().top - 120
                }, 600);
                
                if (!$toggle.hasClass('active')) {
                    $toggle.addClass('active');
                    $wrap.hide().removeClass('d-none').slideDown(300, function() {
                        $input.focus();
                    });
                } else {
                    $input.focus();
                }
            }
        }, 500);
    }
});