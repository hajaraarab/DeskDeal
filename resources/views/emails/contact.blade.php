
<!-- resources/views/emails/contact.blade.php -->

<h2>Nieuw contactverzoek</h2>

<p><strong>Naam:</strong> {{ $data['name'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Onderwerp:</strong> {{ $data['subject'] }}</p>

<p><strong>Bericht:</strong></p>
<p>{{ $data['message'] }}</p>