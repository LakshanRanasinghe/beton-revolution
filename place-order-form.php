<?php 
/* Template Name: Place order form */ 

get_header(); 
?>
<div class="container py-5 overflow-hidden">
    <div class="row g-5">
        <!-- Left Form Section -->
        <div class="col-lg-8">
            <p class="poppins-400 text-12 text-custom-gray-4 mb-1 d-sm-none d-block">Step <strong>1/6</strong></p>
            <!-- First Section -->
            <div class="location-and-quantity-section px-sm-5 py-sm-4 box-shadow-no-bottom box-sm-white position-relative z-3">
                <div class="position-relative pb-4">
                    <div class="position-relative z-1 bg-sm-white bg-custom-gray-3 d-inline-block pe-3 py-sm-0 py-1">
                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative d-sm-inline-block d-none"></i> LOCATION AND CONCRETE QUANTITY</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="location-and-quantity-form text-sm-18 poppins-500" id="initialFormSection">
                    <form>
                        <div class="mb-4">
                            <label for="location" class="form-label text-dark-gray">Location</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" id="location" placeholder="Enter Postcode or City">
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="form-label text-dark-gray">Number of M³</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" id="quantity" placeholder="Enter Number of M³">
                        </div>
                        <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn" id="location-and-quantity-btn">Continue</button>
                    </form>
                </div>
            </div>

            <!-- Second Section -->
            <div class="type-and-kind-section px-sm-5 py-sm-4 box-shadow-no-bottom box-sm-white position-relative text-dark-gray z-2 ">
                <div class="position-relative pb-4 d-sm-block d-none">
                    <div class="position-relative z-1 bg-white d-sm-inline-block pe-3">
                        <h5 class="step-title text-custom-gray-4 oswald-600 text-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative d-sm-inline-block d-none"></i> TYPE AND KIND</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="type-and-kind-form text-16 poppins-500 " id="newFormSection">
                    <form>
                        <!-- Application, Compound, Release Method Section -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <h6 class="section-title text-18 poppins-600 mb-3 text-custom-black d-sm-block d-none">APPLICATION</h6>
                                <div class="position-relative pb-4 d-block d-sm-none">
                                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><i class="bi bi-arrow-left step-back-icon position-relative"></i> APPLICATION<i class="bi bi-info-circle step-exclamation-icon position-relative"></i></h5>
                                    </div>
                                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="application" id="roughConcrete" checked>
                                    <label class="form-check-label" for="roughConcrete">Rough Concrete Floor</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="application" id="foundation">
                                    <label class="form-check-label" for="foundation">Foundation</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="application" id="wall">
                                    <label class="form-check-label" for="wall">Wall</label>
                                </div>
                                <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn d-sm-none d-block mt-4" id="application-btn">Continue</button>
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-18 poppins-600 mb-3 text-custom-black d-sm-block d-none">COMPOUND</h6>
                                <div class="position-relative pb-4 d-block d-sm-none">
                                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><i class="bi bi-arrow-left step-back-icon position-relative"></i> COMPOUND<i class="bi bi-info-circle step-exclamation-icon position-relative"></i></h5>
                                    </div>
                                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="highlyLiquid" name="compound" checked>
                                    <label class="form-check-label" for="highlyLiquid">Highly Liquid</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="extraHighStrength" name="compound">
                                    <label class="form-check-label" for="extraHighStrength">Extra High Strength</label>
                                </div>
                                <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn d-sm-none d-block mt-4" id="compound-btn">Continue</button>
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-18 poppins-600 mb-3 text-custom-black d-sm-block d-none">RELEASE METHOD</h6>
                                <div class="position-relative pb-4 d-block d-sm-none">
                                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><i class="bi bi-arrow-left step-back-icon position-relative"></i> RELEASE METHOD<i class="bi bi-info-circle step-exclamation-icon position-relative"></i>
                                        </h5>
                                    </div>
                                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="releaseMethod" id="fromGutter">
                                    <label class="form-check-label" for="fromGutter">From The Gutter</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="releaseMethod" id="pump" checked>
                                    <label class="form-check-label" for="pump">Pump</label>
                                </div>
                            </div>
                        </div>

                        <!-- Select Pump Section -->
                        <div class="select-pump-section box-sm-shadow border-custom-gray border p-sm-3 p-0">
                            <h6 class="section-title poppins-600 text-sm-18 mb-3 text-dark-blue">SELECT PUMP</h6>
                            <div class="mb-4">
                                <div class="card-body">
                                    <div class="border-custom-gray border">
                                        <div class="form-check m-3">
                                            <input class="form-check-input" type="radio" name="pump" id="miniPump">
                                            <label class="form-check-label text-dark-gray" for="miniPump">Mini Concrete Pump</label>
                                        </div>
                                        <hr class="text-light-gray mt-3">
                                        <div class="p-sm-3 p-0 d-flex">
                                            <img src="<?php echo get_template_directory_uri() ?>/images/lorry1.png" alt="Mini Concrete Pump" class="img-fluid mb-2 w-sm-163">
                                            <ul class="list-unstyled text-custom-gray-2 text-12 poppins-400">
                                                <li><i class="icon-tick bi bi-check"></i> Thin, Handy Hoses</li>
                                                <li><i class="icon-tick bi bi-check"></i> Few Workers Needed</li>
                                                <li><i class="icon-cross bi bi-x"></i> Costs Advantageous</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="border-custom-gray border mt-3">
                                        <div class="d-flex justify-content-between m-3 align-items-center">
                                            <div class="form-check w-auto">
                                                <input class="form-check-input" type="radio" name="pump" id="boomPump" checked>
                                                <label class="form-check-label text-dark-gray" for="boomPump">Boom Pump</label>
                                            </div>
                                            <div class="d-flex w-precent-60 align-items-center">
                                                <label class="form-select-label w-100 d-sm-block d-none" for="">Pumping distance: </label>
                                                <select class="form-select form-select-sm border-light-gray border-radius-1 py-2 px-4 h-36" id="selectMeter">
                                                    <option>Select Meter</option>
                                                    <option>10 M</option>
                                                    <option>20 M</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr class="text-light-gray mt-3">
                                        <div class="p-sm-3 p-0 d-flex">
                                            <img src="<?php echo get_template_directory_uri() ?>/images/lorry2.png" alt="Boom Pump" class="img-fluid mb-2 w-sm-163">
                                            
                                            <ul class="list-unstyled text-custom-gray-2 text-12 poppins-400">
                                                <li><i class="icon-tick bi bi-check"></i> Thin, Handy Hoses</li>
                                                <li><i class="icon-tick bi bi-check"></i> Quickly Pumps Many Cubic Meters</li>
                                                <li><i class="icon-cross bi bi-x"></i> Can Also Pump Large Gravel</li>
                                            </ul>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                            <p class="text-sm-18 text-custom-gray-2 poppins-400">Not sure which one to choose? <a href="#" class="text-orange">Use our helper.</a></p>
                            <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn d-sm-none d-block" id="release-method">Continue</button>
                        </div>

                        <!-- Performance Section -->
                        <div class="performance-section mt-4">
                            <h6 class="section-title text-custom-black text-18 poppins-600 mb-3 d-sm-block d-none">PERFORMANCE</h6>
                            <div class="position-relative pb-4 d-block d-sm-none">
                                <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                    <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><i class="bi bi-arrow-left step-back-icon position-relative"></i> PERFORMANCE<i class="bi bi-info-circle step-exclamation-icon position-relative"></i>
                                    </h5>
                                </div>
                                <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                            </div>
                            <div class="form-check mb-sm-3">
                                <input class="form-check-input" type="radio" name="performance" id="performSelf">
                                <label class="form-check-label" for="performSelf">Perform Yourself</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="performance" id="allIn" checked>
                                <label class="form-check-label" for="allIn">All-in</label>
                            </div>
                        </div>

                        <!-- Execution Section -->
                        <div class="execution-section mt-4 p-sm-3 box-sm-shadow border border-custom-gray text-18">
                            <h6 class="execution-title poppins-600 text-18 text-dark-blue mb-3">EXECUTION 2</h6>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="surface" class="form-label">Surface</label>
                                    <select id="surface" class="form-select border-light-gray border-radius-1 py-2 px-4 h-46">
                                        <option>Select M2</option>
                                        <option>50 M2</option>
                                        <option>100 M2</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="layer-thickness" class="form-label">Layer Thickness</label>
                                    <select id="layer-thickness" class="form-select border-light-gray border-radius-1 py-2 px-4 h-46">
                                        <option>Select Thickness</option>
                                        <option>5 cm</option>
                                        <option>10 cm</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="num-rooms" class="form-label">Number of Rooms</label>
                                    <select id="num-rooms" class="form-select border-light-gray border-radius-1 py-2 px-4 h-46">
                                        <option>Select Number</option>
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                            </div>
                            <p class="form-label">Floor</p>
                            <div class="d-sm-flex">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="mezzanine-floor" name="compound" checked>
                                    <label class="form-check-label text-16 me-4" for="mezzanine-floor">Mezzanine Floor</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="butterfly-floor" name="compound">
                                    <label class="form-check-label text-16" for="butterfly-floor">Butterfly Floor</label>
                                </div>
                            </div>
                            <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn d-sm-none d-block mt-4" id="execution-btn">Continue</button>
                        </div>

                        <!-- Email and Buttons Section -->
                        <div class="my-4">
                            <div class="position-relative pb-4 d-block d-sm-none">
                                <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                    <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1 uppercase"><i class="bi bi-arrow-left step-back-icon position-relative"></i> Confirm Email<i class="bi bi-info-circle step-exclamation-icon position-relative"></i>
                                    </h5>
                                </div>
                                <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                            </div>
                            <label for="email" class="form-label text-18 text-dark-gray">Your Email Address</label>
                            <input type="email" id="email" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Enter Your Email Address">
                            <div class="btn-wrapper mt-4">
                                <button class="btn text-white bg-orange h-46 uppercase bg-orange-btn border border-0 rounded-0 text-white oswald-600 text-16 me-4 px-4" id="pay-btn">Pay via iDeal</button>
                                <button class="btn border-orange h-46 uppercase border rounded-0 border-orange-btn text-orange oswald-600 text-16 px-4">Quote in PDF</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Third Section -->
            <div class="confirm-and-pay-section px-sm-5 py-sm-4 box-shadow-no-top box-sm-white position-relative text-dark-gray z-1 ">
                <div class="position-relative pb-4 d-sm-inline-block d-none">
                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                        <h5 class="step-title text-custom-gray-4 oswald-600 text-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative"></i> CONFIRM ADDRESS AND PAY</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="position-relative pb-4 d-block d-sm-none">
                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1 uppercase"><i class="bi bi-arrow-left step-back-icon position-relative"></i> CONFIRM ADDRESS AND PAY</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="confirm-and-pay-form form-section third-section d-none" id="thirdFormSection">
                    <p><strong>Your Data</strong><br> Please fill in your personal details so we can check your payment and contact you.</p>
                    <form>
                    <?php
                        if ( function_exists( 'woocommerce_form_field' ) && WC()->checkout() ) {
                            $checkout = WC()->checkout();
                            $billing_fields = $checkout->get_checkout_fields( 'billing' );

                            // Remove labels from all billing fields
                            foreach ( $billing_fields as $key => &$field ) {
                                $field['label'] = ''; // Remove label
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <?php woocommerce_form_field( 'billing_first_name', $billing_fields['billing_first_name'], $checkout->get_value( 'billing_first_name' ) ); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <?php woocommerce_form_field( 'billing_last_name', $billing_fields['billing_last_name'], $checkout->get_value( 'billing_last_name' ) ); ?>
                                </div>
                            </div>

                            <!-- Row 2: Address and House Number -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Delivery Address</label>
                                    <?php woocommerce_form_field( 'billing_address_1', $billing_fields['billing_address_1'], $checkout->get_value( 'billing_address_1' ) ); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">House Number</label>
                                    <?php woocommerce_form_field( 'billing_address_2', $billing_fields['billing_address_2'], $checkout->get_value( 'billing_address_2' ) ); ?>
                                </div>
                            </div>

                            <!-- Row 3: Postal Code -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <?php woocommerce_form_field( 'billing_postcode', $billing_fields['billing_postcode'], $checkout->get_value( 'billing_postcode' ) ); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Residence</label>
                                    <?php woocommerce_form_field( 'billing_city', $billing_fields['billing_city'], $checkout->get_value( 'billing_city' ) ); ?>
                                </div>
                            </div>

                            <!-- Row 4: Phone and Email -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <?php woocommerce_form_field( 'billing_phone', $billing_fields['billing_phone'], $checkout->get_value( 'billing_phone' ) ); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <?php woocommerce_form_field( 'billing_email', $billing_fields['billing_email'], $checkout->get_value( 'billing_email' ) ); ?>
                                </div>
                            </div>

                            <!-- Optional Billing Address -->
                            <div class="mb-3">
                                <label class="form-label">Billing Address (If different from delivery address)</label>
                                <?php woocommerce_form_field( 'billing_address_optional', [
                                    'type' => 'text',
                                    'class' => array('form-control border-light-gray border-radius-1 py-2 px-4 h-46'),
                                    'placeholder' => 'Billing Address',
                                ], '' ); ?>
                            </div>

                            <!-- Terms & Conditions and Submit Button -->
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="agree">
                                <label class="form-check-label" for="agree">You Agree To Our <a href="#">Terms And Conditions</a></label>
                            </div>
                            <button type="submit" class="btn btn-danger w-100">Confirm and Pay</button>
                    <?php } ?>

                    </form>
                </div>

            </div>
        </div>

        <!-- Right Summary Section-->
        <div class="col-lg-4">
            <div class="sticky-summary">
                <div class="box-shadow bg-white">
                    <hr class="yellow pixel-p-8 opacity-100 no-border-top m-0">
                    <div class="oswald-600 text-32 px-4 pt-3 text-dark-blue">YOUR REQUEST</div>
                    <hr class="text-light-gray">
                    <div class="summary-content p-4 poppins-400 text-18 text-dark-gray">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Beton: 50 m³</span>
                            <span>€ 6690.50</span>
                        </div>
                        <hr class="text-light-gray">
                        <h6 class="text-20 poppins-500 text-custom-black">Concrete Composition</h6>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Fluidity</span>
                            <span>€ 12.50</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Release method <span class="text-15 text-light-gray">(From the gutter)</span></span>
                            <span>€ 12.50</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Fluidity</span>
                            <span>€ 12.50</span>
                        </div>
                        <hr class="text-light-gray">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="poppins-600 text-20 text-custom-black">Total</span>
                            <span>€ 6725.50</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="poppins-600 text-20 text-custom-black">Subtotal</span>
                            <span>€ 6982.50</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>VAT 21%</span>
                            <span>€ 120.00</span>
                        </div>
                        <hr class="text-light-gray">
                        <div class="d-flex justify-content-between poppins-600 text-20 text-custom-black">
                            <span>Total</span>
                            <span>€ 6982,50</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        if ($(window).width() >= 576) {
            $("#location-and-quantity-btn").on("click", function() {
                $(".location-and-quantity-section").addClass("inactive");
                $(".location-and-quantity-form").addClass("d-none");
                $(".type-and-kind-section").addClass("active");
                $(".type-and-kind-form").removeClass("d-none");
            });
        } else {
            $("#location-and-quantity-btn").on("click", function() {
                $(".location-and-quantity-section").addClass("d-none");
                $(".type-and-kind-section").removeClass("d-none");
                $(".type-and-kind-form").removeClass("d-none");
            });
        }  
        if ($(window).width() >= 576) {
            $("#pay-btn").on("click", function(e) {
                e.preventDefault();
                $(".type-and-kind-section").addClass("inactive");
                $(".type-and-kind-form").addClass("d-none");
                $(".confirm-and-pay-section").addClass("active");
                $(".confirm-and-pay-form").removeClass("d-none");
            });
        } else {
            $("#location-and-quantity-btn").on("click", function() {
                
            });
        }
    });
</script>

<?php
get_footer();
?>