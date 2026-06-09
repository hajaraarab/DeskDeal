@include('partials.header')

<div class="content contact">

  <div class="auth-container">
        
        <div class="background">
            <img src="{{ asset('/images/contact-background.png') }}" alt="Login Background">    
        </div>

        <div class="form-container">

            <div class="section-header">
                <h2>Contacteer ons</h2>
                <p class="body-sm">
                    Heb je een vraag over DeskDeal, een probleem met een reservatie 
                    of een suggestie om het platform te verbeteren? Neem gerust 
                    contact met ons op. We bekijken elke vraag persoonlijk en proberen 
                    zo snel mogelijk te antwoorden.
                </p>
            </div>

            <form class="login-form" method="POST" action="{{ route('contact.send') }}" >
                @csrf
                <div class="form-group">
                <div class="form-field required">
                    <label for="name">Naam</label>
                    <input type="text" name="name" placeholder="Naam" required>
                </div>

                <div class="form-field required">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="E-mailadres" required>
                </div>
                </div>

                <div class="form-field required">
                    <label for="text">Onderwerp</label>
                    <input type="text" name="subject" placeholder="Onderwerp" required>
                </div>

                <div class="form-field required">
                    <label for="text">Bericht</label>
                    <textarea name="message" placeholder="Bericht" required></textarea>
                </div>

                
                <button class="round-btn darkblue body-lg"type="submit">Versturen</button>
            </form>
        </div>
    </div>

</div>

@include('partials.footer')