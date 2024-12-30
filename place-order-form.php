<?php
/* Template Name: Place order form */

get_header();
?>
<div class="container py-5 overflow-hidden">
    <div class="row g-5">
        <!-- Left Form Section -->
        <div class="col-lg-8">
            <p class="step-number-container poppins-400 text-12 text-custom-gray-4 mb-1 d-sm-none d-block ms-4 ps-1">Step <strong><span id="step-number">1</span>/6</strong></p>
            <p class="step-text-container poppins-400 text-12 text-custom-gray-4 mb-1 d-none d-block ms-4 ps-1">Be patient you are on the last</p>
            <!-- First Section -->
            <div class="location-and-quantity-section section-wrap px-sm-5 py-sm-4 box-shadow-no-bottom box-sm-white position-relative z-3 pending" data-step="1">
                <div class="position-relative pb-4 d-sm-block">
                    <div class="position-relative z-1 bg-sm-white bg-custom-gray-3 d-inline-block pe-3 py-sm-0 py-1">
                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative d-sm-inline-block d-none"></i> LOCATION AND CONCRETE QUANTITY</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="position-relative pb-4 d-block d-sm-none">
                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><a class="step-back"><i class="bi bi-arrow-left step-back-icon position-relative"></i></a>LOCATION AND CONCRETE QUANTITY</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="location-and-quantity-form form-section text-sm-18 poppins-500" id="initialFormSection">
                    <form>
                        <div class="mb-4">
                            <label for="location" class="form-label text-dark-gray">Location</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" id="postcode-input" placeholder="Enter Postcode or City">
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="form-label text-dark-gray">Number of M³</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" id="cubic-meters" placeholder="Enter Number of M³">
                        </div>
                        <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn" id="location-and-quantity-btn" data-next="2" disabled>Continue</button>
                    </form>
                </div>
            </div>

            <!-- Second Section -->
            <div class="type-and-kind-section section-wrap px-sm-5 py-sm-4 box-shadow-no-bottom box-sm-white position-relative text-dark-gray z-2 pending" data-step="2">
                <div class="position-relative pb-4 d-sm-block d-none">
                    <div class="position-relative z-1 bg-white d-sm-inline-block pe-3">
                        <h5 class="step-title text-custom-gray-4 oswald-600 text-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative d-sm-inline-block d-none"></i> TYPE AND KIND</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="type-and-kind-form text-16 poppins-500 form-section" id="newFormSection">
                    <form>
                        <input type="hidden" name="nonce" id="beton_nonce" value="<?php echo wp_create_nonce("beton_calculator_nonce"); ?>">
                        <!-- Application, Compound, Release Method Section -->
                        <div class="row mb-sm-4">
                            <div class="application-section col-md-4 d-sm-block d-none">
                                <h6 class="section-title text-18 poppins-600 mb-3 text-custom-black d-sm-block d-none">APPLICATION</h6>
                                <div class="position-relative pb-4 d-block d-sm-none">
                                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><a class="step-back"><i class="bi bi-arrow-left step-back-icon position-relative"></i></a> APPLICATION<i class="bi bi-info-circle step-exclamation-icon position-relative"></i></h5>
                                    </div>
                                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                                </div>
                                <?php $pricingData = get_field('application', 'option'); ?>
                                <?php foreach ($pricingData['application_items'] as $index => $application_item) { ?>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="application" id="<?php echo sanitize_title($application_item['product_name']); ?>" value="<?php echo sanitize_title($application_item['product_name']); ?>" <?php echo $index == 0 ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="<?php echo sanitize_title($application_item['product_name']); ?>"><?php echo $application_item['product_name']; ?></label>
                                    </div>
                                <?php } ?>
                                <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn d-sm-none d-block mt-4" id="application-btn" data-next="3">Continue</button>
                            </div>
                            <div class="compound-section col-md-4 d-sm-block d-none">
                                <h6 class="section-title text-18 poppins-600 mb-3 text-custom-black d-sm-block d-none">COMPOUND</h6>
                                <div class="position-relative pb-4 d-block d-sm-none">
                                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><a class="step-back"><i class="bi bi-arrow-left step-back-icon position-relative"></i></a> COMPOUND<i class="bi bi-info-circle step-exclamation-icon position-relative"></i></h5>
                                    </div>
                                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                                </div>
                                <?php foreach ($pricingData['compound_items'] as $index => $compound_item) { ?>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="<?php echo sanitize_title($compound_item['product_name']); ?>_input" name="compound" value="<?php echo sanitize_title($compound_item['product_name']); ?>" <?php echo $index == 0 ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="<?php echo sanitize_title($compound_item['product_name']); ?>_input"><?php echo $compound_item['product_name'] ?></label>
                                    </div>
                                <?php } ?>
                                <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn d-sm-none d-block mt-4" id="compound-btn" data-next="4">Continue</button>
                            </div>
                            <div class="release-method-section-1 col-md-4 d-sm-block d-none">
                                <h6 class="section-title text-18 poppins-600 mb-3 text-custom-black d-sm-block d-none">RELEASE METHODS</h6>
                                <div class="position-relative pb-4 d-block d-sm-none">
                                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><a class="step-back"><i class="bi bi-arrow-left step-back-icon position-relative"></i></a> RELEASE METHOD<i class="bi bi-info-circle step-exclamation-icon position-relative"></i>
                                        </h5>
                                    </div>
                                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="releaseMethod" value="gutter" id="fromGutter" checked>
                                    <label class="form-check-label" for="fromGutter">From The Gutter</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="releaseMethod" value="pump" id="pump">
                                    <label class="form-check-label" for="pump">Pump</label>
                                </div>
                            </div>
                        </div>

                        <!-- Select Pump Section -->
                        <div class="release-method-pump-wrapper release-method-section-2 release-by-pump select-pump-section box-sm-shadow border-custom-gray border p-sm-3 p-0 d-sm-none d-none">
                            <h6 class="section-title poppins-600 text-sm-18 mb-3 mt-sm-0 mt-3 text-dark-blue">SELECT PUMP</h6>
                            <div class="mb-4">
                                <div class="card-body">
                                    <div class="border-custom-gray border">
                                        <div class="d-flex justify-content-between m-3 align-items-center">
                                            <div class="form-check m-3">
                                                <input class="form-check-input" type="radio" name="pump-type" id="miniPump" value="mini">
                                                <label class="form-check-label text-dark-gray" for="miniPump">Mini Concrete Pump</label>
                                            </div>
                                            <div class="d-flex w-precent-60 align-items-center">
                                                <label class="form-select-label w-100 d-sm-block d-none" for="">Pumping distance: </label>
                                                <select class="form-select form-select-sm border-light-gray border-radius-1 py-2 px-4 h-36" name="mini_pumping_distance">
                                                    <?php
                                                    for ($i = 5; $i <= 300; $i = $i + 5) {
                                                        echo "<option value='$i' " . ($i == 5 ? 'selected' : '') . ">$i m</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <hr class="text-light-gray mt-3"> -->
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
                                                <input class="form-check-input" type="radio" name="pump-type" id="boomPump" value="boom">
                                                <label class="form-check-label text-dark-gray" for="boomPump">Boom Pump</label>
                                            </div>
                                            <div class="d-flex w-precent-60 align-items-center">
                                                <label class="form-select-label w-100 d-sm-block d-none" for="">Pumping distance: </label>
                                                <select class="form-select form-select-sm border-light-gray border-radius-1 py-2 px-4 h-36" name="boom_pumping_distance">
                                                    <option>Select Meter</option>
                                                    <option value="20" selected>20 m</option>
                                                    <option value="30">30 m</option>
                                                    <option value="38">38 m</option>
                                                    <option value="48">48 m</option>
                                                    <option value="54">54 m</option>
                                                    <option value="59">59 m</option>
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
                            <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn d-sm-none d-block" id="release-method" data-next="5">Continue</button>
                        </div>

                        <!-- Performance Section -->
                        <div class="performance-section mt-sm-4 d-sm-block d-none">
                            <h6 class="section-title text-custom-black text-18 poppins-600 mb-3 d-sm-block d-none">PERFORMANCE</h6>
                            <div class="position-relative pb-4 d-block d-sm-none">
                                <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                    <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1"><a class="step-back"><i class="bi bi-arrow-left step-back-icon position-relative"></i></a> PERFORMANCE<i class="bi bi-info-circle step-exclamation-icon position-relative"></i>
                                    </h5>
                                </div>
                                <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                            </div>
                            <div class="form-check mb-sm-3">
                                <input class="form-check-input" type="radio" name="performance" value="performSelf" id="performSelf" checked>
                                <label class="form-check-label" for="performSelf">Perform Yourself</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="performance" id="allIn" value="allIn">
                                <label class="form-check-label" for="allIn">All-in</label>
                            </div>
                        </div>

                        <!-- Execution Section -->
                        <div class="execution-section mt-4 p-sm-3 box-sm-shadow border border-custom-gray text-18 d-none">
                            <h6 class="execution-title poppins-600 text-18 text-dark-blue mb-3">EXECUTION 2</h6>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="surface" class="form-label">Surface</label>
                                    <select id="surface" name="surface" class="form-select border-light-gray border-radius-1 py-2 px-4 h-46">
                                        <?php foreach(get_field('oppervlakte', 'option') as $i => $surface_option){
                                            echo '<option value="'.$surface_option['size'].'" '. ($i <= 0 ? 'selected' : '') .'>'.$surface_option['size'].' m2</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="layer-thickness" class="form-label">Layer Thickness</label>
                                    <select id="layer-thickness" name="layer-thickness" class="form-select border-light-gray border-radius-1 py-2 px-4 h-46">
                                        <option value="5-10" selected>5-10 cm</option>
                                        <option value="11-15">11-15 cm</option>
                                        <option value="15-20">15-20 cm</option>
                                        <option value="20-9999">&gt;20 cm</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="num-rooms" class="form-label">Number of Rooms</label>
                                    <select id="num-rooms" name="num-rooms" class="form-select border-light-gray border-radius-1 py-2 px-4 h-46">
                                        <?php for ($i = 0; $i < 11; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <p class="form-label">Floor</p>
                            <div class="d-sm-flex">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="mezzanine-floor" name="floor_selection" value="1">
                                    <label class="form-check-label text-16 me-4" for="mezzanine-floor">Mezzanine Floor</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="butterfly-floor" name="butterfly-floor" value="1">
                                    <label class="form-check-label text-16" for="butterfly-floor">Butterfly Floor</label>
                                </div>
                            </div>
                            <button type="button" class="btn bg-orange h-46 uppercase border border-0 rounded-0 text-white oswald-600 text-16 w-25 w-precent-50 bg-orange-btn d-sm-none d-block mt-4" id="execution-btn" data-next="6">Continue</button>
                        </div>

                        <!-- Email and Buttons Section -->
                        <div class="verify-email-section my-sm-4 d-sm-block d-none">
                            <div class="position-relative pb-4 d-block d-sm-none">
                                <div class="position-relative z-1 bg-white d-inline-block pe-3">
                                    <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1 uppercase"><a class="step-back"><i class="bi bi-arrow-left step-back-icon position-relative"></i></a> Confirm Email<i class="bi bi-info-circle step-exclamation-icon position-relative"></i>
                                    </h5>
                                </div>
                                <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                            </div>
                            <label for="email" class="form-label text-18 text-dark-gray">Your Email Address</label>
                            <input type="email" id="email" name="user_email" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Enter Your Email Address">
                            <div class="btn-wrapper mt-4">
                                <button class="submit-btn btn text-white bg-orange h-46 uppercase bg-orange-btn border border-0 rounded-0 text-white oswald-600 text-16 me-4 px-4" type="button" value="checkout" id="pay-btn" data-next="Be patient you are on the last">Pay via iDeal</button>
                                <button class="submit-btn btn border-orange h-46 uppercase border rounded-0 border-orange-btn text-orange oswald-600 text-16 px-4" type="button" value="quote" disabled require>Quote in PDF</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Third Section -->
            <div class="confirm-and-pay-section section-wrap px-sm-5 py-sm-4 box-shadow-no-top box-sm-white position-relative text-dark-gray z-1" data-step="3">
                <div class="position-relative pb-4 d-sm-inline-block d-none">
                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                        <h5 class="step-title text-custom-gray-4 oswald-600 text-20 d-inline-block mt-1 disabled"><i class="bi bi-check-circle-fill step-title-icon position-relative"></i> CONFIRM ADDRESS AND PAY</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="confirm-and-pay-section-title position-relative pb-4 d-none">
                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                        <h5 class="step-title text-dark-blue oswald-600 text-sm-20 d-inline-block mt-1 uppercase"><a class="step-back"><i class="bi bi-arrow-left step-back-icon position-relative"></i></a> CONFIRM ADDRESS AND PAY</h5>
                    </div>
                    <hr class="text-light-gray position-absolute w-100 top-0 mt-3">
                </div>
                <div class="confirm-and-pay-form form-section third-section d-none" id="thirdFormSection">
                    <p><strong>Your Data</strong><br> Please fill in your personal details so we can check your payment and contact you.</p>


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
                                <span>Beton: <span id="cubic_meters_formatted">0</span> m³</span>
                                <span id="beton_price_formatted"><?php wc_price(0) ?></span>
                            </div>
                            <hr class="text-light-gray">
                            <h6 class="text-20 poppins-500 text-custom-black">Concrete Composition</h6>
                            <div class="d-flex justify-content-between" id="application_price_formatted"></div>
                            <div class="d-flex justify-content-between dynamic-hide" id="hoog-vloeibaar_formatted"></div>
                            <div class="d-flex justify-content-between dynamic-hide" id="snelhardend_formatted"></div>
                            <div class="d-flex justify-content-between dynamic-hide" id="fijn-grind_formatted"></div>
                            <div class="d-flex justify-content-between dynamic-hide" id="extra-hoge-sterkte_formatted"></div>
                            <div class="d-flex justify-content-between" id="application_compound_total_formatted"><?php wc_price(0) ?></div>

                            <hr class="text-light-gray">

                            <div class="release-method-pump-cost-wrapper d-flex justify-content-between mt-3 mb-3" >
                                <span>Release method <span class="text-15 text-light-gray" id="release_method_name"></span></span>
                                <span id="pump_cost_formatted"><?php wc_price(0) ?></span>
                            </div>
                            <div id="mini-pump-breakdown" class="release-method-pump-cost-wrapper">
                                <div class="d-flex justify-content-between mt-3 mb-3">
                                    <span>Callout Fees</span>
                                    <span id="pump_callout_cost_formatted"><?php wc_price(0) ?></span>
                                </div>
                                <div class="d-flex justify-content-between mt-3 mb-3">
                                    <span>Pumping Cost</span>
                                    <span id="pumping_cost_formatted"><?php wc_price(0) ?></span>
                                </div>

                                <div class="d-flex justify-content-between mt-3 mb-3 ">
                                    <span>Pumping Extra Hose Cost <span id="extra_hose_length"></span></span>
                                    <span id="pumping_extra_hose_cost_formatted" class="dynamic-hide"><?php wc_price(0) ?></span>
                                </div>
                            </div>
                            <hr class="release-method-pump-cost-wrapper text-light-gray">
                            <div id="allIn-breakdown" class="all-in-cost-wrapper d-none">
                                <div class="d-flex justify-content-between mt-3 mb-3">
                                    <span>All-in Cost</span>
                                    <span id="allIn_formatted"><?php wc_price(0) ?></span>
                                </div>
                                <div class="d-flex justify-content-between mt-3 mb-3 ground_floor_wrapper d-none">
                                    <span>Ground Floor Cost</span>
                                    <span id="ground_floor_formatted"><?php wc_price(0) ?></span>
                                </div>
                                <div class="d-flex justify-content-between mt-3 mb-3 butterfly_floor_wrapper d-none">
                                    <span>Butterfly Floor Cost</span>
                                    <span id="butterfly_floor_formatted"><?php wc_price(0) ?></span>
                                </div>
                            </div>
                            <hr class="all-in-cost-wrapper text-light-gray d-none">
                            <!-- <div class="d-flex justify-content-between mb-3">
                                <span class="poppins-600 text-20 text-custom-black">Total</span>
                                <span id="sub_total">€ 6725.50</span>
                            </div> -->
                            <div class="d-flex justify-content-between mb-3">
                                <span class="poppins-600 text-20 text-custom-black">Subtotal</span>
                                <span id="sub_total_formatted"><?php wc_price(0) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>VAT 21%</span>
                                <span id="btw_formatted"><?php wc_price(0) ?></span>
                            </div>
                            <hr class="text-light-gray">
                            <div class="d-flex justify-content-between poppins-600 text-20 text-custom-black">
                                <span>Total</span>
                                <span id="total_formatted"><?php wc_price(0) ?></span>
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
                $(".location-and-quantity-section").addClass("active");
                $("#location-and-quantity-btn").on("click", function() {
                    $(".location-and-quantity-section").removeClass("active");
                    $(".location-and-quantity-section").addClass("inactive");
                    $(".location-and-quantity-form").addClass("d-none");
                    $(".type-and-kind-section").addClass("active");
                    $(".type-and-kind-form").removeClass("d-none");
                });
                $("#pay-btn").on("click", function(e) {
                    e.preventDefault();
                    $(".type-and-kind-section").addClass("inactive");
                    $(".type-and-kind-form").addClass("d-none");
                    $(".type-and-kind-form").removeClass("pending");
                    $(".confirm-and-pay-section").addClass("active");
                    $(".confirm-and-pay-form").removeClass("d-none");
                });
            } else {
                $(".location-and-quantity-section").addClass("active");
                let currentStep = 1;

                $("#location-and-quantity-btn").on("click", function() {
                    $("#step-number").html($(this).data("next"));
                    currentStep = 2;
                    $(".location-and-quantity-section").removeClass("active").addClass("inactive d-none");
                    $(".type-and-kind-form").removeClass("d-none");
                    $(".application-section").addClass("active").removeClass("d-none");
                });

                $("#application-btn").on("click", function() {
                    $("#step-number").html($(this).data("next"));
                    currentStep = 3;
                    $(".application-section").removeClass("active").addClass("inactive d-none");
                    $(".compound-section").addClass("active").removeClass("d-none");
                });

                $("#compound-btn").on("click", function() {
                    $("#step-number").html($(this).data("next"));
                    currentStep = 4;
                    $(".compound-section").removeClass("active").addClass("inactive d-none");
                    $(".release-method-section-1, .release-method-section-2").addClass("active").removeClass("d-none");
                });

                $("#release-method").on("click", function() {
                    $("#step-number").html($(this).data("next"));
                    currentStep = 5;
                    $(".release-method-section-1, .release-method-section-2").removeClass("active").addClass("inactive d-none");
                    $(".performance-section, .execution-section").addClass("active").removeClass("d-none");
                });

                $("#execution-btn").on("click", function() {
                    $("#step-number").html($(this).data("next"));
                    currentStep = 6;
                    $(".performance-section, .execution-section").removeClass("active").addClass("inactive d-none");
                    $(".verify-email-section").addClass("active").removeClass("d-none");
                });

                $("#pay-btn").on("click", function(e) {
                    e.preventDefault();
                    currentStep = 7;
                    $(".verify-email-section").removeClass("active").addClass("inactive d-none");
                    $(".confirm-and-pay-form").addClass("active").removeClass("d-none");
                    $(".confirm-and-pay-section-title").removeClass("d-none");
                });

                $(".step-back").on("click", function() {
                    if (currentStep > 1) {
                        $("#step-number").html(currentStep - 1);
                        switch (currentStep) {
                            case 2:
                                $(".location-and-quantity-section").removeClass("inactive d-none").addClass("active");
                                $(".application-section").removeClass("active").addClass("inactive d-none");
                                break;
                            case 3:
                                $(".application-section").removeClass("inactive d-none").addClass("active");
                                $(".compound-section").removeClass("active").addClass("inactive d-none");
                                break;
                            case 4:
                                $(".compound-section").removeClass("inactive d-none").addClass("active");
                                $(".release-method-section-1, .release-method-section-2").removeClass("active").addClass("inactive d-none");
                                break;
                            case 5:
                                $(".release-method-section-1, .release-method-section-2").removeClass("inactive d-none").addClass("active");
                                $(".performance-section, .execution-section").removeClass("active").addClass("inactive d-none");
                                break;
                            case 6:
                                $(".performance-section, .execution-section").removeClass("inactive d-none").addClass("active");
                                $(".verify-email-section").removeClass("active").addClass("inactive d-none");
                                break;
                            case 7:
                                $(".verify-email-section").removeClass("inactive d-none").addClass("active");
                                $(".confirm-and-pay-form").removeClass("active").addClass("inactive d-none");
                                $(".confirm-and-pay-section-title").addClass("d-none");
                                break;
                        }
                        currentStep--;
                    }
                });

            }

        });
    </script>

    <?php
    get_footer();
    ?>