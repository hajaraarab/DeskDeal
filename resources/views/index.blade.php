@include('partials.header')

<div class="content homepage">
    <div class="hero-section">
        <div class="hero-section-info">
            <h2>Besparen</h2>
            <h1>Begint bij doorgeven</h1>
            <p class="body-lg grey">
                Help de circulaire economie vooruit. Door kantoorspullen te hergebruiken besparen we geld, grondstoffen en ruimte. Samen maken we ondernemen toegankelijker én groener.
            </p>

            <div class="count">
                <div class="count-down">
                    <h1>{{ $userCount }}</h1>
                    <p class="subtitle">Gebruikers</p>
                </div>
                <div class="count-down">
                    <h1>{{ $soldProductsCount }}</h1>
                    <p class="subtitle">Transacties</p>
                </div>
            </div>
        </div>
        <div class="hero-section-img">
            <img src="{{ asset('images/homepage-image.png') }}" alt="DeskDeal homepage afbeelding">
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

    <div class="zo-werkt-het">
        <div class="section-header">
            <p class="subtitle">zo werkt het</p>
            <h3>Van plaatsen tot ophalen in vier stappen</h3>
        </div>

        <div class="zo-werkt-het-steps">
            <div class="zo-werkt-het-step">
                <h2>01</h2>
                <h6>Product plaatsen</h6>
                <p class="body-sm grey">
                    Plaats gratis je product met foto's, een beschrijving en alle nodige informatie zodat geïnteresseerden precies weten wat je aanbiedt.
                </p>
            </div>
            <div class="zo-werkt-het-step">
                <h2>02</h2>
                <h6>Reservaties ontvangen</h6>
                <p class="body-sm grey">
                    Ontvang reserveringen en berichten van geïnteresseerde kopers die jouw product graag willen overnemen.
                </p>
            </div>
            <div class="zo-werkt-het-step">
                <h2>03</h2>
                <h6>Bevestig de reservatie</h6>
                <p class="body-sm grey">
                    Keur de reservatie goed om verder te gaan. Daarna kun je de leveringswijze doorgeven: de koper kan het product zelf ophalen of gebruikmaken van onze leveringsservice.
                </p>
            </div>
            <div class="zo-werkt-het-step">
                <h2>04</h2>
                <h6>Ophalen of leveren</h6>
                <p class="body-sm grey">
                    Het product wordt opgehaald of geleverd volgens de gekozen optie. Na een succesvolle overdracht is de verkoop afgerond.
                </p>
            </div>
        </div>
    </div>

    <div class="go-to-marketplace">
        <div class="go-to-marketplace-info">
            <h2>Ontdek de marketplace</h2>
            <p class="body-lg">
                Bekijk het actuele aanbod van kantooritems en vind precies wat jouw bedrijf nodig heeft — snel, simpel en duurzaam.
            </p>
        </div>
        <a class="round-btn white body-lg" href="{{ route('marketplace') }}">Ga naar marketplace</a>
    </div>
</div>

@include('partials.footer')