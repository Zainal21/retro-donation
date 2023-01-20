@section('title', 'Welcome Retro Donation')

@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="main-content">
            <section class="showcase">
                <section class="nes-container with-title">
                    <h3 class="title">Login</h3>
                    <form action="{{ route('login.post') }}" method="post">
                        @csrf
                        <div id="inputs" class="item">
                            <div class="nes-field form-group">
                                <label for="email">Email</label>
                                <input type="text" id="email" class="nes-input" name="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div id="inputs" class="item">
                            <div class="nes-field form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="nes-input" name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="nes-btn is-primary">Sign In</button>
                        <a href="{{ url('auth/github') }}"class="nes-btn is-dark">SignIn With Github</a>
                    </form>
                </section>
            </section>
        </main>
    </div>
@endsection
