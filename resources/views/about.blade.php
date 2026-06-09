@include('partials.header')

<div class="content about-page">
    
    <div class="section-header">
        <p class="subtitle">Over deskdeal</p>
        <h2>De slimste marketplace voor kantoorartikelen</h2>
        <p class="body-lg grey">
            Wij verbinden bedrijven die bruikbaar kantoormateriaal over hebben met ondernemers die op zoek zijn naar betaalbare oplossingen.
        </p>
    </div>

    <div class="onze-missie">
        <p class="subtitle">onze missie</p>
        <h4>Waarom we dit doen? </h4>
        <p class="body-lg grey">
            Te veel bruikbaar kantoormateriaal belandt in opslag of wordt weggegooid, terwijl andere bedrijven net op zoek zijn naar betaalbare oplossingen. DeskDeal verbindt beide werelden. We maken het eenvoudig om overtollige bureaustoelen, verlichting en ander kantoorgerief een tweede leven te geven — goed voor je portemonnee én voor het milieu.
        </p>
    </div>

    <div class="hoe-werkt-het">
        <div class="section-header">
            <p class="subtitle">hoe werkt het</p>
            <h4>In 3 eenvoudige stappen</h4>
            <p class="body-lg grey">
                Wij verbinden bedrijven die bruikbaar kantoormateriaal over hebben met ondernemers die op zoek zijn naar betaalbare oplossingen.
            </p>
        </div>

        <div class="hoe-werkt-het-blocks">
            <div class="block">
                <div class="number-container">
                    <p class="body-lg">1</p>
                </div>
                <h5>Plaats een product</h5>
                <p class="body-md grey">
                    Maak in enkele minuten een advertentie aan met foto, beschrijving en prijs.
                </p>
            </div>

            <div class="block">
                <div class="number-container">
                    <p class="body-lg">2</p>
                </div>
                <h5>Ontvang en accepteer een reservering</h5>
                <p class="body-md grey">
                    Geïnteresseerde kopers reserveren je product. Als verkoper 
                    beoordeel je de aanvraag en beslis je of je de reservering 
                    accepteert.
                </p>
            </div>

            <div class="block">
                <div class="number-container">
                    <p class="body-lg">3</p>
                </div>
                <h5>Kies de levering en rond de verkoop af</h5>
                <p class="body-md grey">
                    De koper kiest tussen afhalen of levering via DeskDeal. 
                    Daarna wordt het product opgehaald of geleverd en is de 
                    verkoop voltooid.
                </p>
            </div>
        </div>
    </div>

    <div class="impact">
        <div class="section-header">
            <p class="subtitle">impact in cijfers</p>
            <h4>Wat we samen bereiken</h4>
        </div>

        <div class="impact-numbers">
        <div class="cijfers">
            <h2>{{ $registeredUsers }}</h2>
            <p class="body-md grey">Geregistreerde gebruikers</p>
        </div>

        <div class="cijfers">
            <h2>{{ $completedOrders }}</h2>
            <p class="body-md grey">Voltooide tansacties</p>
        </div>

        <div class="cijfers">
            <h2>{{ $activeProducts }}</h2>
            <p class="body-md grey">Actieve advertenties</p>
        </div>

        <div class="cijfers">
            <h2>0</h2>
            <p class="body-md grey">Geschatte CO2-besparing</p>
        </div>
        </div>
    </div>


     <div class="why-choose-deskdeal">
        <div class="section-header">
            <p class="subtitle">Waarom deskdeal</p>
            <h3>Waarom kiezen voor ons ?</h3>
        </div>
        <div class="cards">
            <div class="card">
                <div class="icon-container">
                    <img src="{{ asset('images/icons/savings.png') }}" alt="Bespaar slim icoon">
                </div>

                <h5>Bespaar slim</h5>
                <p class="body-sm">
                    Startups vinden kwalitatieve kantoorspullen voor een fractie van de prijs, zodat hun budget gaat naar wat écht telt.
                </p>
            </div>
            <div class="card">
                <div class="icon-container">
                    <img src="{{ asset('images/icons/rise.png') }}" alt="Efficiëntie icoon">
                </div>

                <h5>Efficiënt</h5>
                <p class="body-sm">
                    Bedrijven verkopen of geven overtollige kantoorinboedel weg, maken ruimte vrij en richten hun organisatie slimmer in.
                </p>
            </div>
            <div class="card">
                <div class="icon-container">
                    <img src="{{ asset('images/icons/recyclable.png') }}" alt="Duurzaamheidsicoon">
                </div>

                <h5>Duurzaam</h5>
                <p class="body-sm">
                    Door hergebruik verklein je de afvalberg, verlaag je CO₂-impact en bouw je mee aan een circulaire economie.            
                </p>
            </div>

            <div class="card">
                <div class="icon-container">
                    <img src="{{ asset('images/icons/delivery-truck.png') }}" alt="Snelle levering icoon">
                </div>

                <h5>Snel</h5>
                <p class="body-sm">
                    Van zoeken tot ophalen: alles verloopt soepel, zodat je meteen weer verder kunt met ondernemen            
                </p>
            </div>
        </div>
    </div>


    <div class="faq">
        <div class="section-header">
            <p class="subtitle">FAQ</p>
            <h3>Veelgestelde vragen</h3>
        </div>

        <div class="faq-question">
            <details>
                <summary>
                    <p class="body-lg">Is DeskDeal gratis?</p>
                    <img src="{{ asset('images/icons/down-arrow.png') }}" alt="">
                </summary>
                <p class="body-md grey">
                    Ja, het plaatsen van advertenties en het reserveren van producten is volledig gratis.
                </p>
            </details>

            <details>
                <summary>
                    <p class="body-lg">
                        Wie kan er een product plaatsen? 
                    </p>
                    <img src="{{ asset('images/icons/down-arrow.png') }}" alt="">
                </summary>
                <p class="body-md grey">
                    Elk geregistreerd bedrijf of zelfstandige in België kan producten aanbieden. We verifiëren je bedrijfsgegevens om betrouwbaarheid te waarborgen.
                </p>
            </details>

            <details>
                <summary>
                    <p class="body-lg">Hoe verloopt de afhaling? </p>
                    <img src="{{ asset('images/icons/down-arrow.png') }}" alt="">
                </summary>
                <p class="body-md grey">
                    Na acceptatie van de reservering kan de koper kiezen 
                    hoe hij of zij het product wil ontvangen: door het zelf 
                    af te halen of door gebruik te maken van de DeskDeal-transportservice, 
                    waarbij het product tegen een kleine vergoeding wordt opgehaald en 
                    geleverd.
                </p>
            </details>
            <details>
                <summary>
                    <p class="body-lg">Wat mag ik aanbieden?</p>
                    <img src="{{ asset('images/icons/down-arrow.png') }}" alt="">
                </summary>
                <p class="body-md grey">
                    Je kunt allerhande kantoormateriaal aanbieden: bureaustoelen, kasten, ... 
                    Producten moeten bruikbaar zijn en eerlijk worden beschreven. 
                </p>
            </details>
        </div>
    </div>


</div>

@include('partials.footer')