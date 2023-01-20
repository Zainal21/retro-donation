@section('title', 'Welcome Retro Donation')

@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="main-content">
            <section class="showcase">
                <section class="nes-container with-title">
                    <h3 class="title">Dashboard</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <section class="nes-container is-dark member-card">
                                <div class="avatar"><img data-src="https://github.com/BcRikko.png?size=80" alt="Core Member B.C.Rikko"
                                        class="" src="https://github.com/BcRikko.png?size=80"></div>
                                <div class="profile">
                                    <h4 class="name">Donation Amount</h4>
                                    <p class="fs-2 font-bold">12</p>
                                </div>
                            </section>
                        </div>
                         <div class="col-md-5">
                            <section class="nes-container is-dark member-card">
                                <div class="avatar"><img data-src="https://github.com/BcRikko.png?size=80" alt="Core Member B.C.Rikko"
                                        class="" src="https://github.com/BcRikko.png?size=80"></div>
                                <div class="profile">
                                    <h4 class="name">Donation Send</h4>
                                    <p class="fs-2 font-bold">12</p>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <section class="nes-container is-dark member-card">
                                <div class="avatar"><img data-src="https://github.com/BcRikko.png?size=80" alt="Core Member B.C.Rikko"
                                        class="" src="https://github.com/BcRikko.png?size=80"></div>
                                <div class="profile">
                                    <h4 class="name">Donation Unpaid</h4>
                                    <p class="fs-2 font-bold">12</p>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </section>
        </main>
    </div>
@endsection
