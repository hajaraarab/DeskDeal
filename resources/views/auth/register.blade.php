@include('partials.header')

@if ($errors->any())
    <div class="errors">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<div class="content">

    <h1>Welcome to the Register Page</h1>
   <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="firstname" placeholder="Bv. Jan" value="{{ old('firstname') }}" required>
        <input type="text" name="lastname" placeholder="Bv. Peeters" value="{{ old('lastname') }}" required>

        <input type="text" name="companyname" placeholder="Bv. DeskDeal B.V." value="{{ old('companyname') }}" required>
        <input type="text" name="companyregisternumber" placeholder="Bv. 0123.456.789" value="{{ old('companyregisternumber') }}" required>

        <input type="email" name="email" placeholder="Bv. jan.peeters@deskdeal.be" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Minimaal 8 tekens" required>

        <button type="submit">Register</button>
        
    </form>
</div>

@include('partials.footer')