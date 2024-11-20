<?php 
/* Template Name: Place order form */ 

get_header(); 
?>
<div class="container py-5">
    <div class="row g-5">
        <!-- Left Form Section -->
        <div class="col-lg-8">
            <!-- First Section -->
            <div class="location-and-quantity-section p-5 box-shadow bg-white position-relative">
                <div class="position-relative pb-4">
                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                        <h5 class="step-title text-dark-blue oswald-600 text-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative"></i> LOCATION AND CONCRETE QUANTITY</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="location-and-quantity-form text-18 poppins-500" id="initialFormSection">
                    <form>
                        <div class="mb-4">
                            <label for="location" class="form-label text-dark-gray">Location</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" id="location" placeholder="Enter Postcode or City">
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="form-label text-dark-gray">Number of M³</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" id="quantity" placeholder="Enter Number of M³">
                        </div>
                        <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25" onclick="showNewSection()">Continue</button>
                    </form>
                </div>
            </div>
            

            <!-- Second Section -->
            <div class="type-and-kind-section p-5 box-shadow bg-white position-relative text-dark-gray">
                <div class="position-relative pb-4">
                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                        <h5 class="step-title text-dark-blue oswald-600 text-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative"></i> TYPE AND KIND</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="type-and-kind-form text-16 poppins-500" id="newFormSection">
                    <form>
                        <!-- Application, Compound, Release Method Section -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <h6 class="section-title text-18 poppins-600 mb-3 text-custom-black">APPLICATION</h6>
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
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-18 poppins-600 mb-3 text-custom-black">COMPOUND</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="compound" id="highlyLiquid" checked>
                                    <label class="form-check-label" for="highlyLiquid">Highly Liquid</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="compound" id="extraHighStrength">
                                    <label class="form-check-label" for="extraHighStrength">Extra High Strength</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-18 poppins-600 mb-3 text-custom-black">RELEASE METHOD</h6>
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
                        <div class="select-pump-section box-shadow border-custom-gray border p-3">
                            <h6 class="section-title poppins-600 text-18 mb-3 text-dark-blue">SELECT PUMP</h6>
                            <div class="mb-4">
                                <div class="card-body">
                                    <div class="border-custom-gray border">
                                        <div class="form-check m-3">
                                            <input class="form-check-input" type="radio" name="pump" id="miniPump">
                                            <label class="form-check-label text-dark-gray" for="miniPump">Mini Concrete Pump</label>
                                        </div>
                                        <hr class="text-light-gray mt-3">
                                        <div class="p-3 d-flex">
                                            <img src="<?php echo get_template_directory_uri() ?>/images/lorry1.png" alt="Mini Concrete Pump" class="img-fluid mb-2 w-163">
                                            <ul class="list-unstyled text-custom-gray-2 text-12 poppins-400">
                                                <li>✓ Thin, Handy Hoses</li>
                                                <li>✓ Few Workers Needed</li>
                                                <li>✓ Costs Advantageous</li>
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
                                                <label class="form-select-label w-100" for="">Pumping distance: </label>
                                                <select class="form-select form-select-sm border-light-gray border-radius-1 py-2 px-4 h-36" id="selectMeter">
                                                    <option>Select Meter</option>
                                                    <option>10 M</option>
                                                    <option>20 M</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr class="text-light-gray mt-3">
                                        <div class="p-3 d-flex">
                                            <img src="<?php echo get_template_directory_uri() ?>/images/lorry2.png" alt="Boom Pump" class="img-fluid mb-2 w-163">
                                            
                                            <ul class="list-unstyled text-custom-gray-2 text-12 poppins-400">
                                                <li>✓ Quickly Pumps Many Cubic Meters</li>
                                                <li>✓ Can Also Pump Large Gravel</li>
                                            </ul>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>

                        <!-- Performance Section -->
                        <div class="performance-section mt-4">
                            <h6 class="section-title text-custom-black text-18 poppins-600 mb-3">PERFORMANCE</h6>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="performance" id="performSelf">
                                <label class="form-check-label" for="performSelf">Perform Yourself</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="performance" id="allIn" checked>
                                <label class="form-check-label" for="allIn">All-in</label>
                            </div>
                        </div>

                        <!-- Execution Section -->
                        <div class="execution-section mt-4 p-3 box-shadow border border-custom-gray text-18">
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
                            <div class="toggle-switch">
                                <input type="checkbox" id="mezzanine-floor">
                                <label for="mezzanine-floor" class="text-16 me-4">Mezzanine Floor</label>
                                <input type="checkbox" id="butterfly-floor">
                                <label for="butterfly-floor" class="text-16">Butterfly Floor</label>
                            </div>
                        </div>

                        <!-- Email and Buttons Section -->
                        <div class="my-4">
                            <label for="email" class="form-label text-18 text-dark-gray">Your Email Address</label>
                            <input type="email" id="email" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Enter Your Email Address">
                            <div class="btn-wrapper mt-4">
                                <button class="btn text-white bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 me-4 px-4">Pay via iDeal</button>
                                <button class="btn border-orange h-46 uppercase border rounded-0 text-orange oswald-600 text-16 px-4">Quote in PDF</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Third Section -->
            <div class="type-and-kind-section p-5 box-shadow bg-white position-relative text-dark-gray">
                <div class="position-relative pb-4">
                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                        <h5 class="step-title text-dark-blue oswald-600 text-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative"></i> CONFIRM ADDRESS AND PAY</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="confirm-and-pay-form form-section third-section" id="thirdFormSection">
                    <p><strong>Your Data</strong><br> Please fill in your personal details so we can check your payment and contact you.</p>
                    <form>
                        <?php
                        if ( function_exists( 'woocommerce_form_field' ) && WC()->checkout() ) {
                            $checkout = WC()->checkout();
                        ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <?php woocommerce_form_field( 'billing_first_name', $checkout->get_checkout_fields( 'billing' )['billing_first_name'], $checkout->get_value( 'billing_first_name' ) ); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <?php woocommerce_form_field( 'billing_last_name', $checkout->get_checkout_fields( 'billing' )['billing_last_name'], $checkout->get_value( 'billing_last_name' ) ); ?>
                                </div>
                            </div>

                            <!-- Row 2: Address and House Number -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Delivery Address</label>
                                    <?php woocommerce_form_field( 'billing_address_1', $checkout->get_checkout_fields( 'billing' )['billing_address_1'], $checkout->get_value( 'billing_address_1' ) ); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">House Number</label>
                                    <?php woocommerce_form_field( 'billing_address_2', $checkout->get_checkout_fields( 'billing' )['billing_address_2'], $checkout->get_value( 'billing_address_2' ) ); ?>
                                </div>
                            </div>

                            <!-- Row 3: Postal Code -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <?php woocommerce_form_field( 'billing_postcode', $checkout->get_checkout_fields( 'billing' )['billing_postcode'], $checkout->get_value( 'billing_postcode' ) ); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Residence</label>
                                    <?php woocommerce_form_field( 'billing_city', $checkout->get_checkout_fields( 'billing' )['billing_city'], $checkout->get_value( 'billing_city' ) ); ?>
                                </div>
                            </div>

                            <!-- Row 4: Phone and Email -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <?php woocommerce_form_field( 'billing_phone', $checkout->get_checkout_fields( 'billing' )['billing_phone'], $checkout->get_value( 'billing_phone' ) ); ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <?php woocommerce_form_field( 'billing_email', $checkout->get_checkout_fields( 'billing' )['billing_email'], $checkout->get_value( 'billing_email' ) ); ?>
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
    function showNewSection() {
        // document.getElementById('initialFormSection').style.display = 'none';
        // document.getElementById('newFormSection').style.display = 'block';
    }

    function showThirdSection() {
        document.getElementById('newFormSection').style.display = 'none';
        document.getElementById('thirdFormSection').style.display = 'block';
    }
</script>

<?php
get_footer();
?>