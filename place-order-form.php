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
                <div class="position-relative overflow-hidden pb-4">
                    <div class="position-relative z-1 bg-white d-inline-block pe-3">
                        <h5 class="step-title text-custom-black oswald-600 text-20 d-inline-block mt-1"><i class="bi bi-check-circle-fill step-title-icon position-relative"></i> LOCATION AND CONCRETE QUANTITY</h5>
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
            <div class="form-section new-section" id="newFormSection">
                <h5 class="step-indicator"><i class="bi bi-gear-fill step-title-icon"></i> TYPE AND KIND</h5>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Application</label><br>
                        <input type="radio" name="application" checked> Rough Concrete Floor
                        <input type="radio" name="application"> Foundation
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Compound</label><br>
                        <input type="radio" name="compound" checked> Highly Liquid
                        <input type="radio" name="compound"> Extra High Strength
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Release Method</label><br>
                        <input type="radio" name="release_method" checked> From the Gutter
                        <input type="radio" name="release_method"> Pump
                    </div>
                    <button type="button" class="btn btn-warning text-white w-100 mt-3" onclick="showThirdSection()">Continue</button>
                </form>
            </div>

            <!-- Third Section -->
            <div class="form-section third-section" id="thirdFormSection">
                <h5 class="step-current"><i class="bi bi-credit-card step-title-icon"></i> CONFIRM ADDRESS AND PAY</h5>
                <p><strong>Your Data</strong><br> Please fill in your personal details so we can check your payment and contact you.</p>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Your First Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Your Last Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Delivery Address</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Enter Your Address">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">House Number</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Enter Your House Number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Postal Code or City</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Your Postal Code or City">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Residence</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Your Residence">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Enter phone number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Enter Your Email Address">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Billing Address (If different from delivery address)</label>
                        <input type="text" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46" placeholder="Billing Address">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Requested Execution Date</label>
                            <input type="date" class="form-control border-light-gray border-radius-1 py-2 px-4 h-46">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bank</label>
                            <select class="form-select">
                                <option>Select Bank</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="agree">
                        <label class="form-check-label" for="agree">You Agree To Our <a href="#">Terms And Conditions</a></label>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Confirm and Pay</button>
                </form>
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

<style>
        .step-indicator {
            color: #28a745; /* Green color for completed steps */
            font-weight: bold;
            display: flex;
            align-items: center;
            font-size: 1.1rem;
        }

        
        
       
        .form-section {
            border: 1px solid #eee;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }
        .new-section, .third-section {
            display: none;
        }
    </style>
<script>
    function showNewSection() {
        document.getElementById('initialFormSection').style.display = 'none';
        document.getElementById('newFormSection').style.display = 'block';
    }

    function showThirdSection() {
        document.getElementById('newFormSection').style.display = 'none';
        document.getElementById('thirdFormSection').style.display = 'block';
    }
</script>

<?php
get_footer();
?>