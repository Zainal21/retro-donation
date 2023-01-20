@section('title', 'Welcome Retro Donation')

@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <section class="showcase">
                        <x-profile-update :user="$user"/>
                    </section>
                </div>
                <div class="col-md-12">
                    <section class="showcase">
                        <x-password-update :user="$user"/>
                    </section>
                </div>
                <div class="col-md-6">
                    <section class="showcase">
                        <x-social-media-update :user="$user"/>
                    </section>
                </div>
                <div class="col-md-6">
                    <section class="showcase">
                        <x-amount-setting-update :user="$user"/>
                    </section>
                </div>
            </div>
        </main>
    </div>
@endsection
