@section('title', 'Pay Donation')

@extends('layouts.donate-main')

@section('content')
    <div class="container-content">
        <main class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <section class="showcase">
                        <section class="nes-container with-title">
                            <h3 class="title">Donation Successfully</h3>
                            <p>Yeee Your Payment Donation was Created</p>
                            <i class="nes-mario text-center"></i> 
                            <a class="nes-btn" href="{{request()->segment(2) ?? '-';}}">Back to dashboard</a>
                        </section>
                    </section>
                </div>
            </div>
        </main>
    </div>
@endsection
