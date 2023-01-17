@section('title', 'Welcome Retro Donation')

@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="main-content">
            <section class="showcase">
                <section class="nes-container with-title">
                    <h3 class="title">Login</h3>
                    <div id="inputs" class="item">
                        <div class="nes-field">
                            <label for="name_field">Email</label>
                            <input type="text" id="name_field" class="nes-input">
                        </div>
                    </div>
                    <div id="inputs" class="item">
                        <div class="nes-field">
                            <label for="name_field">Password</label>
                            <input type="text" id="name_field" class="nes-input">
                        </div>
                    </div>

                    <button type="button" class="nes-btn is-primary">Sign In</button>
                    <button type="button" class="nes-btn is-dark">SignIn With Github</button>
                </section>
            </section>
        </main>
    </div>
@endsection
