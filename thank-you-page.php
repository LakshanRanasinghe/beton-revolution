<?php 
/* Template Name: Thank you page */ 

get_header(); 
?>
<div class="container thank-you-section">
    <div>
        <!-- Success Icon -->
        <div class="success-icon mb-4">
            <img src="<?php echo get_template_directory_uri() ?>/images/thank-you-icon.png" alt="">
        </div>

        <!-- Thank You Message -->
        <h3 class="thank-you-header">THANK YOU FOR REQUESTING THE QUOTE!</h3>
        <p class="mb-4">You will receive an email with your quote within a few minutes. Do you have any questions? Please feel free to contact us.</p>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-custom-orange me-2 px-4">CALCULATE ANOTHER PRICE</a>
            <a href="#" class="btn btn-custom-outline px-4">GO TO HOMEPAGE</a>
        </div>
    </div>
</div>
<style>
    /* Centering the content */
    .thank-you-section {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }
    /* Success icon styling */
    .success-icon {
        font-size: 4rem;
        color: #28a745; /* Green color */
        position: relative;
    }
    .success-icon::after {
        content: '';
        position: absolute;
        width: 0.5rem;
        height: 0.5rem;
        background-color: #28a745;
        border-radius: 50%;
        top: -0.75rem;
        left: 1rem;
    }
    /* Header styling */
    .thank-you-header {
        color: #1E3A8A; /* Dark blue */
        font-weight: bold;
        font-size: 1.5rem;
        margin-top: 20px;
    }
    /* Button styling */
    .btn-custom-orange {
        background-color: #ff6b35;
        color: white;
        border: none;
    }
    .btn-custom-outline {
        border: 2px solid #ff6b35;
        color: #ff6b35;
    }
    .btn-custom-outline:hover {
        background-color: #ff6b35;
        color: white;
    }
</style>
<?php
get_footer();
?>