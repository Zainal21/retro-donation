@section('title', 'Welcome Retro Donation')

@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <section class="showcase">
                        <section class="nes-container with-title">
                            <h3 class="title">List Donation</h3>
                            <div class="nes-table-responsive mt-4">
                                <table class="nes-table is-bordered is-centered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Donation Ammount</th>
                                            <th>Donation Date Time</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Thou hast had a good morning</td>
                                            <td>Thou hast had a good afternoon</td>
                                            <td>Thou hast had a good evening</td>
                                            <td>Thou hast had a good night</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </section>
                </div>
            </div>
        </main>
    </div>
@endsection
