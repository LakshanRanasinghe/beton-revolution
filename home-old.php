<?php 
/* Template Name: HomePage */ 
get_header(); 
?>

<!-- first section -->
<div class="beton-hero-section bg-image container-fluid object-fit-cover position-relative p-0 background-img-adjust" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
    <div class="z-0 hero-section-overlay position-absolute h-100 container-fluid bg-black bg-opacity-50 top-0 left-0 p-0"></div>
    <div class="new-container-1400 container h-100 d-flex flex-column justify-content-center pixel-sm-p-30">
        <div class="row col-lg-4 col-9 z-1 position-relative p-2 mb-4" style="backdrop-filter: blur(8px); background-color: #FFFFFF1A;">
            <div class="d-flex align-items-center beton-hero-google-ratings">
                
                <?php echo do_shortcode( '[trustindex no-registration=google]'); ?>
                
            </div> 
            
        </div> 

        <div class="row col-lg-5 col-11 z-1 position-relative p-2 d-flex mb-4 padding-left-title" style="backdrop-filter: blur(25px); background-color: #FFFFFF1A;">
            <h1 class="oswald-500 display-3 text-56 m-0 text-white text-uppercase p-0 letter-spacing-four">Beton storten?</h1>
        </div>

        <div class="row col-lg-10 col-12 z-1 position-relative p-2 mb-4 padding-left-title" style="backdrop-filter: blur(25px); background-color: #FFFFFF1A;">
            <h1 class="oswald-600 display-3 text-76 m-0 text-white text-uppercase p-0 mb-1 d-sm-block d-none letter-spacing-four">Bereken hier uw prijs</h1>
            <h1 class="oswald-600 display-3 text-76 m-0 text-white text-uppercase p-0 mb-1 d-sm-none d-block letter-spacing-four">Binnen 24 uur</h1>
            <div class="p-1 d-sm-none d-block" style="background: linear-gradient(90deg, #FDD401 0%, rgba(253, 212, 1, 0) 100%);"></div>
            <h1 class="oswald-600 display-3 text-76 m-0 text-white text-uppercase p-0 mb-1 d-sm-none d-block letter-spacing-four">gratis offerte</h1>
            <div class="p-2 d-sm-block d-none" style="background: linear-gradient(90deg, #FDD401 0%, rgba(253, 212, 1, 0) 100%);"></div>
        </div>

        <!-- <div class="row gap-3 z-1 position-relative">
            <a href="#beton-calculate-prices-section" class="btn-hover-orange col-lg-2 col-sm-4 col-6 oswald-600 text-sm-20 text-white text-uppercase text-center border-2 border-white rounded-0 bg-transparent px-4 py-3 letter-spacing-four">Bereken Prijs</a>
            <a href="<?php //echo site_url(); ?>/offerte-aanvragen/" class="btn-hover col-lg-2 col-sm-4 col-5 oswald-600 text-sm-20 text-white text-uppercase text-center border-2 border-orange bg-orange rounded-0 px-6 py-3 letter-spacing-four">Gratis Offerte</a>
        </div> -->
    </div>
</div>

<!-- second section -->
<div class="bg-dark-blue container-fluid px-lg-5 px-3 py-3 py-lg-0 overflow-hidden" id="beton-calculate-prices-section">
    <div class="new-container-1400 container d-flex flex-lg-row flex-column align-items-center gap-lg-5 gap-0 px-0">
        <!-- Left Column -->
        <div class="row col-lg-3 col-12 d-block position-relative tilted-border overflow-hidden">
            <div class="py-lg-5 py-3 d-lg-block d-flex px-lg-3">
                <h2 class="oswald-500 text-sm-42 text-white letter-spacing-four text-uppercase">Bereken&nbsp</h2>
                <h2 class="oswald-500 text-sm-42 text-white letter-spacing-four text-uppercase">Betonprijs</h2>
            </div>       
        </div>
        <!-- Right Column -->
        <form class="row col-lg-9 " action="offerte-aanvragen" id="home-offerte-aanvragen-form">
            <div class="d-lg-flex d-block align-items-center gap-3 ps-4 pe-4 w-100 ps-sm-0 pe-sm-0">
                <div class="w-lg-70 d-flex gap-3 pb-lg-0 pb-3 position-relative">
                    <input type="text" class="form-control rounded-0 home-input ps-2 pe-2 ps-md-4 oswald-600 letter-spacing-four text-uppercase text-sm-20-2" placeholder="Postcode of Stad" aria-label="Postcode" id="postcode-input">
                    <input type="text" class="form-control rounded-0 home-input ps-2 pe-2 ps-md-4 oswald-600 letter-spacing-four text-uppercase text-sm-20-2" placeholder="Aantal M³" aria-label="Cubic meters of concrete" id="cubic-meters">
                </div>
                <button class="btn oswald-600 text-sm-20 text-white text-uppercase border-2 border-orange bg-orange rounded-0 px-6 py-md-4 py-3 w-lg-25 letter-spacing-four">Bereken Prijs</button>
            </div>
            <div class="d-flex align-items-center ps-sm-0 pe-sm-0 ps-4 pe-4">
                <p class="text-14 poppins-500 light-blue pt-3 letter-spacing-four mb-0">Bereken het aantal kubieke meters</p>
                <a href="<?php echo site_url(); ?>/bereken-het-aantal-kuub" class="pt-3 ps-2"><i class="bi bi-exclamation-circle-fill light-blue"></i></a>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid bg-white py-md-5 pt-4 px-0">
    <div class="container">
        <?php echo do_shortcode( '[grw id=704]'); ?>
    </div>
</div>

<!-- third section -->
<div class="bg-white container-fluid py-md-5 py-0 my-2 px-0">
    <div class="container pb-md-4 pb-0">
        <div class="row">
            <div class="col-lg-7 col-12 z-1 position-relative p-lg-2 p-4 mb-md-2 mb-0" style="backdrop-filter: blur(25px); background-color: rgba(255, 255, 255, 0.1);">
                <div class="pe-lg-5 pe-0">
                    <div class="col-lg-9 col-12">
                        <h1 class="oswald-600 display-3 text-40 m-0 text-black text-uppercase mb-1 letter-spacing-four text-dark-blue">Hoe stort je beton?</h1>
                        <div class="h-14" style="background: linear-gradient(90deg, #FDD401 0%, rgba(253, 212, 1, 0) 100%);"></div>
                    </div>
                    <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-3 mb-3">Beton zelf storten kan een mooie kostenbesparing opleveren, maar kan ook een grote mislukking worden. Wij laten u in het artikel <a href="https://www.betonstorten.nl/beton-storten-hoe-doe-je-dat">hoe stort ik beton? </a>De beste methode zien met de benodigde gereedschappen.&nbsp;</p>
                    
                    <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">Gaat u&nbsp;<strong>beton storten, beton bestellen of beton laten storten</strong>? Bijvoorbeeld voor een verbouwing aan uw huis voor een uitbouw, <a href="https://www.betonstorten.nl/betonvloer-garage">garage</a>, tuinhuis, schutting, noem maar op, dan is vaak hiervoor <a href="https://www.betonstorten.nl/fundering-storten">een fundering</a> nodig. Deze fundering wordt over het algemeen gemaakt van&nbsp;beton. Voor een echte “doe het zelver” volgt dan direct de vraag: ga ik zelf beton bestellen en beton storten of<a href="https://www.betonstorten.nl/beton-laten-storten"> laat ik beton storten</a>?&nbsp;Waar moet ik op letten bij het bestellen van beton? Wat komt er allemaal bij kijken? <a href="https://www.betonstorten.nl/beton-storten-hoe-doe-je-dat">Beton storten, hoe doe je dat?</a> Een aantal dingen zijn belangrijk, zoals bijvoorbeeld <a href="https://www.betonstorten.nl/dikte-betonvloer">de dikte van de betonvloer</a>&nbsp;en de <a href="https://www.betonstorten.nl/droogtijd-beton">droogtijd van beton</a>.</p>

                    <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">Op BetonStorten.nl vindt u alle informatie over beton bestellen en uw beton stort. Van&nbsp;<a href="https://www.betonstorten.nl/beton-storten-prijs/">prijs</a>&nbsp;tot uitvoering. Wij voorzien u graag van de benodigde informatie om te bepalen of u zelf uw beton gaat storten en hoe u dat het beste kunt doen.</p>
                    
                    <!-- <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">
                    Of je nu beton stort voor een huisrenovatie, een uitbouw, een garage, of zelfs een tuinhuis of schutting, een goede fundering is essentieel. Beton vormt de basis van bijna elk bouwproject, en vragen zoals "Ga ik zelf beton storten of huur ik professionals in?" komen vaak naar boven. Je moet rekening houden met zaken zoals de dikte van de betonlaag, de voorbereiding van de ondergrond en de droogtijd.
                    </p> -->
                    <!-- <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">
                    Op onze website vind je alle informatie die je nodig hebt, van het bestellen van het juiste type beton tot het succesvol uitvoeren van de stort. Leer over gereedschappen, technieken en prijzen, zodat je kunt beslissen of je het project zelf aanpakt of het aan experts overlaat.
                    </p> -->
                </div>  
            </div>
            <div class="col-lg-5 col-12 px-lg-0 px-4" >
                <!-- <img class="img-fluid" src="" alt="Concrete Pouring"> -->
                <div class="home-bg-image-h" style="background-image: url('https://images.unsplash.com/photo-1672748341520-6a839e6c05bb?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
                <div class="bg-orange p-4">
                    <h4 class="oswald-600 text-26 text-white m-0 letter-spacing-four">BELLEN: <a class="oswald-600 text-26 text-white m-0 letter-spacing-four" href="tel:06-27016082">06-27016082</a></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-md-5 pt-0">
        <div class="row d-flex flex-lg-row flex-column-reverse py-md-0 py-4" >
            <div class="col-lg-5 col-12 px-lg-0 px-4 " >
                <!-- <img class="img-fluid custom-550-image" src="" alt="Concrete Pouring"> -->
                <div class="home-bg-image-h" style="background-image: url('https://images.unsplash.com/photo-1603814929895-f68fc3d4c89d?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
                <div class="bg-orange p-4">
                    <h4 class="oswald-600 text-26 text-white m-0 letter-spacing-four">BELLEN: <a class="oswald-600 text-26 text-white m-0 letter-spacing-four" href="tel:06-27016082">06-27016082</a></h4>
                </div>
            </div>
            <div class="col-lg-7 col-12 z-1 position-relative px-lg-2 px-4 py-lg-2 pt-4 pb-4 mb-md-2 mb-0 d-flex align-items-center">
                <div class="ps-lg-5 ps-0">
                    <div class="row align-items-center col-12">
                        <div class="col-lg-8 col-12">
                            <!-- <h1 class="d-block d-sm-none oswald-600 text-dark-blue display-3 text-40 m-0 text-black text-uppercase mb-1 letter-spacing-four d-sm-flex flex-sm-row flex-column">
                                <span>Zie je jezelf nog niet</span> 
                                <div class="h-14 mt-sm-0 mt-1 mb-sm-0 mb-2" style="background: linear-gradient(90deg, #FDD401 0%, rgba(253, 212, 1, 0) 100%);"></div>
                                <span class="">beton storten?</span>
                            </h1>
                            <h1 class="d-sm-block d-none oswald-600 text-dark-blue display-3 text-40 m-0 text-black text-uppercase mb-1 letter-spacing-four d-sm-flex flex-sm-row flex-column">
                                <span>Zie je jezelf nog niet beton storten?</span>
                            </h1> -->
                            <div class="h-14 d-sm-block d-none" style="background: linear-gradient(90deg, #FDD401 0%, rgba(253, 212, 1, 0) 100%);"></div>
                        </div>

                        <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">Ziet u uzelf nog geen <strong>beton storten</strong>? Geen probleem! Voor een strak eindresultaat kunt u kiezen voor een <strong>all-in</strong> beton stort. In dat geval verzorgen wij het hele stortproces. En bent u verzekert van een geslaagde beton stort.</p>

                        <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">Bij Betonstorten.nl bespaart u tientallen euro’s op uw betonstort, want wij hebben korte lijnen met betoncentrales en bieden daardoor beton voor de scherpste prijs en dat tegen de beste kwaliteit. Profiteren van onze lage beton prijzen? Vraag dan een <a href="https://www.betonstorten.nl/offerte-aanvragen">gratis offerte</a> aan, of <a href="https://www.betonstorten.nl/offerte-aanvragen" title="Beton Prijs Berekenen">bereken uw beton prijs</a>.</p>
                        
                        <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">Wilt u een <a href="https://www.betonstorten.nl/betonpomp">betonpomp huren</a>&nbsp;Of beton bestellen met pomp? Bereken eenvoudig uw prijs met onze <a href="https://www.betonstorten.nl/betonpomp">betoncalculator</a>.</p>
                        
                        <!-- <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-3 mb-3">
                        Lijkt het idee van zelf beton storten overweldigend? Geen probleem—wij helpen je graag! Met onze all-in-one service kun je ontspannen terwijl wij het hele proces verzorgen, van begin tot eind, met een strak en kwalitatief eindresultaat als gevolg.
                        </p>
                        <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">
                        Bij BetonBestellen.nl bespaar je tijd én geld. Dankzij onze directe samenwerkingen met betonspecialisten bieden wij concurrerende prijzen zonder in te leveren op kwaliteit. Door voor ons te kiezen, ben je verzekerd van uitstekende service en de beste betonprijzen.
                        </p>
                        <p class="grey-text poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-md-3 mb-0">
                        Heb je een betonpomp nodig of wil je beton bestellen in combinatie met een pompservice? Onze handige betoncalculator maakt het eenvoudig om te plannen en de kosten te berekenen. Klaar voor een zorgeloos project? Vraag vandaag nog een gratis offerte aan en zet de eerste stap naar een perfect resultaat!
                        </p> -->
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>

<!-- fourth section -->
<div class="bg-dark-blue container-fluid py-5 px-md-0 px-lg-2 px-4">
    <div class="p-md-5 p-0"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6 p-0">
                <h1 class="oswald-600 display-3 text-sm-64 m-0 text-white text-uppercase letter-spacing-four">Getuigenissen</h1>
                <div class="h-14 mt-1" style="background: linear-gradient(90deg, #FDD401 0%, rgba(253, 212, 1, 0) 100%);"></div>
            </div>
        </div>

        <div class="row pt-md-5 pt-4 d-flex flex-lg-row flex-column padding7">
            <div class="col-lg-4 col-12 p-0">
                <div class="d-flex h-full">
                    <img class="image-fluid w-custom-70 p-0 pixel-me-10 ms-0" src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
                    <div class="w-custom-30 d-flex px-0">
                        <div class="pixel-w-10 h-100 pixel-me-10" style="background-color: #FDD401;"></div>
                        <div class="pixel-w-10 h-100 pixel-me-10" style="background-color: #FDD40199;"></div>
                        <div class="pixel-w-10 h-100 pixel-me-10" style="background-color: #FDD40166;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-12 p-0">
                <div class="row col-md-4 col-12 z-1 position-relative p-2 mb-4 mt-md-0 mt-4 mx-0" style="backdrop-filter: blur(25px); background-color: #FFFFFF1A;">
                    <div class="row col-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="col p-0" height="25" width="28" viewBox="0 0 576 512"><path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="col p-0" height="25" width="28" viewBox="0 0 576 512"><path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="col p-0" height="25" width="28" viewBox="0 0 576 512"><path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="col p-0" height="25" width="28" viewBox="0 0 576 512"><path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="col p-0" height="25" width="28" viewBox="0 0 576 512"><path fill="#FFD43B" d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                    </div>
                    <h2 class="oswald-600 fs-5 lh-sm text-white m-0 col-7 pe-0">klanten vertellen</h2>
                </div>
                <div>
                    <p class="poppins-300 text-sm-22 fst-italic text-white letterspace1 line-height-38">Prima geleverd zoals afgesproken. Ook willen ze prima met je meedenken. Wat wel beter kan is, wanneer ze beloven terug te bellen nav een email dat ze dit dan ook doen en het was fijn om vooraf te weten dat beton dat achterblijft in de pompwagen je zelf moet gebruiken of later verwijderen. Nu maar noodgedwongen beton op wat zand laten lozen en wanneer het droog is zal ik het wel breken en afvoeren</p>
                </div>
                <div>
                    <h3 class="oswald-500 text-sm-32-2 letterspace1 text-yellow text-uppercase">Hilde , Epse</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="p-md-5 p-0"></div>
</div>


<!-- fifth section -->
<div class="bg-offwhite container-fluid py-md-5 pt-4 pb-0 px-0">
    <div class="p-md-5 p-0"></div>
    <div class="container">
        <div class="row d-flex flex-md-row flex-column pixel-px-12">
            <div class="col-lg-4 col-sm-6 col-12 mb-3">
                <div class="col-12 p-0 me-md-2 me-0 bg-white h-full">
                    <div>
                        <img class="image-fluid image-post" src="<?php echo site_url(); ?>/wp-content/uploads/2024/12/Screenshot-2024-12-31-at-15.02.31.png" alt="">
                    </div>
                    <div class="p-3 home-post-shadow">
                        <h3 class="oswald-500 text-dark-blue text-20 letterspace1 post-title-margin-tb text-uppercase">Beton zelf mixen of bestellen?</h3>
                        <p class="poppins-400 text-16 paragraph-ash letterspace1">Wat is goedkoper beton zelf mixen of bestellen? Je leest het in het artikel goedkoop beton bestellen.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12 mb-3">
                <div class="col-12 p-0 me-md-2 me-0 bg-white h-full">
                    <div>
                        <img class="image-fluid image-post" src="<?php echo site_url(); ?>/wp-content/uploads/2024/12/Screenshot-2024-12-31-at-15.02.42.png" alt="">
                    </div>
                    <div class="p-3 home-post-shadow">
                        <h3 class="oswald-500 text-dark-blue text-20 letterspace1 post-title-margin-tb text-uppercase">Wat zijn de kosten voor beton?</h3>
                        <p class="poppins-400 text-16 paragraph-ash letterspace1">Ontdek wat de kosten van beton zijn in het artikel wat kost beton.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-12 mb-3">
                <div class="col-12 p-0 me-md-2 me-0 bg-white h-full">
                    <div>
                        <img class="image-fluid image-post" src="<?php echo site_url(); ?>/wp-content/uploads/2024/12/Screenshot-2024-12-31-at-15.02.54.jpg" alt="">
                    </div>
                    <div class="p-3 home-post-shadow">
                        <h3 class="oswald-500 text-dark-blue text-20 letterspace1 post-title-margin-tb text-uppercase">Beton zelf storten of laten storten?</h3>
                        <p class="poppins-400 text-16 paragraph-ash letterspace1">Zelf beton storten of laten storten? Ontdek wat er komt kijken bij het storten van beton.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-md-5 p-0"></div>
</div>

<!-- sixth section -->
<div class="beton-steps-content-right-wrapper bg-dark-blue container-fluid py-0 px-0">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row d-flex flex-lg-row flex-column">
                    <div class="col-lg-7 col-12 py-5">
                        <div class="row m-auto">
                            <div class="col-12 m-auto" >
                                <div class="p-lg-5 p-0"></div>
                                <h1 class="display-3 text-sm-40 m-0 text-white text-uppercase mb-1 letterspace4"><span class="oswald-300">Stap 1:</span><span class="oswald-600"> Prijs berekenen</span></h1>
                                <div class="h-14" style="background: linear-gradient(90deg, #FDD401 0%, rgba(253, 212, 1, 0) 100%);"></div>

                                <!-- <p class="text-white poppins-400 text-sm-18 line-height letterspace1 mt-3 mb-3">In order to process concrete, concrete is liquid during pouring. This is also called plastic. This means that the concrete has a slight tendency to level out and is easier to level. Therefore, the concrete to be poured must be enclosed, otherwise it will run away.</p> -->
                                <p class="text-white poppins-400 text-sm-18 line-height letterspace1 mt-3 mb-3">In stap 1 vult u in de betoncalculator de postcode en hoeveelheid beton in.</p>
                                <br>
                                <!-- <p class="text-white poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">Enclosing concrete can be done by means of existing walls or by applying a so-called formwork. Place the top of the formwork at the same height as the top of the concrete floor. Then the top of the formwork can be used as a guide to, for example, level the concrete floor by means of a row.</p> -->
                                <div class="p-lg-5 p-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="p-0 d-lg-none d-block mt-minus-3-5">
    <img class="h-full w-100" src="<?php echo site_url(); ?>/wp-content/uploads/2024/12/step01-img.png" alt="">
</div>

<div class="p-3 bg-white container-fluid"></div>

<!-- seventh section -->
<div class="beton-steps-content-left-wrapper bg-dark-blue container-fluid py-0 px-0">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row d-flex flex-lg-row flex-column">
                    <div class="col-lg-5 col-12"></div>
                    <div class="col-lg-7 col-12 py-5">
                        <div class="row m-auto">
                            <div class="col-12">
                                <div class="p-lg-5 p-0"></div>
                                <h1 class="display-3 text-sm-40 m-0 text-white text-uppercase mb-1 letterspace4"><span class="oswald-300">Stap 2:</span><span class="oswald-600 col-12"> Type en soort kiezen</span></h1>
                                <div style="background: linear-gradient(90deg, #FDD401 0%, rgba(253, 212, 1, 0) 100%); height: 8px; width: 100%;"></div>

                                <!-- <p class="text-white poppins-400 text-sm-18 line-height letterspace1 mt-3 mb-3">During hardening, concrete shrinks a little. To prevent cracks in the concrete, it is important to use concrete reinforcement. Preferably use a reinforcement mesh of 8 mm thick with a mesh width of 15 cm. Place the reinforcement on height blocks so that the concrete reinforcement is slightly above the middle at approximately 2/3, seen from the bottom of the concrete floor. </p> -->
                                <p class="text-white poppins-400 text-sm-18 line-height letterspace1 mt-3 mb-3">In stap 2 kan de beton stort verder worden gespecificeerd denk hierbij aan de loswijze, uitvoering en beton soort.</p>
                                <br>
                                <!-- <p class="text-white poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">For thick concrete floors from 16 cm it is wise to use double reinforcement. This is usually applicable when cars are going to drive over the concrete floor, such as for a driveway. With double reinforcement the concrete floor is better resistant to tensile and compressive stresses.</p> -->
                                <div class="p-lg-5 p-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="p-0 d-lg-none d-block mt-minus-3-5">
    <img class="h-full w-100" src="<?php echo site_url(); ?>/wp-content/uploads/2024/12/step01-img.png" alt="">
</div>

<div class="p-3 bg-white container-fluid"></div>


<!-- eightth section -->
<div class="beton-steps-content-right-wrapper-2 bg-dark-blue container-fluid py-0 px-0">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row d-flex flex-lg-row flex-column">
                    <div class="col-lg-7 col-12 py-5">
                        <div class="row m-auto">
                            <div class="col-12 m-auto" >
                                <div class="p-lg-5 p-0"></div>
                                <h1 class="display-3 text-sm-40 m-0 text-white text-uppercase mb-1 letterspace4"><span class="oswald-300">Stap 3:</span><span class="oswald-600"> Bevestig en betaal</span></h1>
                                <div class="h-14" style="background: linear-gradient(90deg, #FDD401 0%, rgba(253, 212, 1, 0) 100%);"></div>

                                <!-- <p class="text-white poppins-400 text-sm-18 line-height letterspace1 mt-3 mb-3">The concrete has been ordered and is ready to be poured. You distribute the concrete evenly over the floor during pouring and check the pouring height with a level instrument such as a laser. Finish the top layer of the concrete floor with a row. Wait a few hours after pouring the concrete before walking on the concrete floor.</p> -->
                                <p class="text-white poppins-400 text-sm-18 line-height letterspace1 mt-3 mb-3">In de laatste stap kan de beton stort worden ingepland in de agenda en betaalt u eenvoudig met IDEAL</p>
                                <br>
                                <!-- <p class="text-white poppins-400 text-sm-18 line-height letterspace1 mt-1 mb-3">In the summer this will be approximately between 4 and 8 hours after pouring the concrete. In the winter this can take up to the next day. Place foil over the poured concrete and leave it for preferably 2 weeks to prevent cracking. If necessary, the concrete floor can be kept wet with water instead of foil. Do this for the first 48 hours after the concrete floor has been poured. For more information about the drying time of concrete .</p> -->
                                <div class="p-lg-5 p-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="p-0 d-lg-none d-block mt-minus-3-5">
    <img class="h-full w-100" src="<?php echo site_url(); ?>/wp-content/uploads/2024/12/step01-img.png" alt="">
</div>

<div class="container-fluid bg-white py-md-5 px-0">
    <div class="py-4 py-md-5 padding7"></div>
    <div class="container">
        <h3 class="oswald-600 text-orange text-sm-24 text-center text-uppercase letter-spacing-four">Vraag nu een gratis offerte aan</h3>
        <h4 class="oswald-600 text-dark-blue text-sm-64 text-center text-uppercase letter-spacing-four">WILT U EEN BETONPOMP HUREN?</h4>
        <div class="row col-8 margin-right-left-auto">
            <div class="h-14" style="background: linear-gradient(90deg, rgba(253, 212, 1, 0.045) 0%, #FDD401 50.5%, rgba(253, 212, 1, 0) 100%);"></div>
        </div>
        <div class="row mt-3">
            <a href="<?php echo site_url(); ?>/offerte-aanvragen/" class="col-md-3 col-lg-2 col-6 oswald-600 text-white text-center border-2 border-orange bg-orange rounded-0 px-6 py-3 text-uppercase m-auto text-sm-20">Gratis Offerte</a>
        </div>
    </div>
    <div class="py-4 py-md-5 padding7"></div>
</div>

<?php
get_footer();
?>
