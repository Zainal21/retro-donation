@section('title', 'Pay Donation')

@extends('layouts.donate-main')

@section('content')
    <div class="container-content">
        <main class="main-content">
            <div class="row">
                <div class="col-md-12">
                    <section class="showcase">
                        <section class="nes-container with-title">
                            <h3 class="title">Donate</h3>
                            <form action="@" method="post" id="donate-form">
                                <section class="nes-container is-dark ">
                                    <div class="avatar"><img data-src="https://github.com/BcRikko.png?size=80"
                                            alt="Core Member B.C.Rikko" class=""
                                            src="https://github.com/BcRikko.png?size=80"></div>
                                    <div class="profile">
                                        <h4 class="name">{{ $user->name . '| @' . $user->username }}</h4>
                                        <p>{{ $user->tagline }}</p>
                                    </div>
                                </section>
                                <div class="nes-container is-rounded my-3">
                                    <p>Total Amount</p>
                                    <div class="row my-2">
                                        <div class="nes-field">
                                            <input type="hidden" id="user_id" class="nes-input"
                                                value="{{ $user->id }}">
                                            <input type="hidden" id="user_name" class="nes-input"
                                                value="{{ $user->name }}">
                                            <input type="text" id="amount" class="nes-input money-mask">
                                        </div>
                                    </div>
                                </div>
                                <div class="nes-container is-rounded my-3">
                                    <p>Pleasse Choice Your Donation Amount</p>
                                    <div class="row my-2">
                                        <button class="nes-btn btn-amount-type is-success my-2" type="button"
                                            data-amount="{{ \App\Helpers\Helper::numberToPrice($user->amount_setting->amount_1) ?? 0 }}">{{ isset($user->amount_setting->amount_1) ? \App\Helpers\Helper::numberToPrice($user->amount_setting->amount_1) : 0 }}</button>
                                        <button class="nes-btn btn-amount-type is-warning my-2" type="button"
                                            data-amount="{{ \App\Helpers\Helper::numberToPrice($user->amount_setting->amount_2) ?? 0 }}">{{ isset($user->amount_setting->amount_2) ? \App\Helpers\Helper::numberToPrice($user->amount_setting->amount_2) : 0 }}</button>
                                        <button class="nes-btn btn-amount-type is-error my-2" type="button"
                                            data-amount="{{ \App\Helpers\Helper::numberToPrice($user->amount_setting->amount_3) ?? 0 }}">{{ isset($user->amount_setting->amount_3) ? \App\Helpers\Helper::numberToPrice($user->amount_setting->amount_3) : 0 }}</button>
                                    </div>
                                </div>
                                <div class="nes-container is-rounded my-3">
                                    <p>Send Your Message</p>
                                    <div class="row my-2">
                                        <div class="nes-field">
                                            <input type="text" id="message" name="message" class="nes-input">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="nes-btn is-primary">Pay Now</button>
                            </form>
                        </section>
                    </section>
                </div>
            </div>
        </main>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-amount-type').on('click', function() {
                $('#amount').val($(this).data('amount'))
            });

            $('#donate-form').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "For your Donate!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, donate it !!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let data = {
                            amount: $('#amount').val(),
                            message: $('#message').val(),
                            user_id: $('#user_id').val(),
                            user_name: $('#user_name').val(),
                        };
                        let route = "{{ route('donation.pay') }}";
                        ajaxRequest(data, route)
                            .then(res => {
                                Swal.fire({
                                    title: "Success",
                                    text: "Payment Method Created Succesfully",
                                    icon: 'success',
                                }).then(() => {
                                    window.open(res.results.paymentUrl, '_blank');
                                })
                            })
                            .catch(err => {
                                Swal.fire({
                                    title: 'Failed',
                                    text: "Failed for Donate",
                                    icon: 'Failed',
                                })
                            });
                    }
                })

            })
        })

        function clearField() {
            $('#amount').val('')      
            $('#message').val('')     
        }
    </script>
@endpush
