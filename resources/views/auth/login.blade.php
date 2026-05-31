@include('partials.header')

<div class="content">
    <form method="POST" action="{{ route('login') }}" >
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Bv. ">

        <label for="password">Wachtwoord</label>
        <input type="password" name="password" placeholder="Minimaal 8 tekens">
        
        <button type="submit">Login</button>
</div>

@include('partials.footer')