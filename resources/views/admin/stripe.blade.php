@extends('layouts.app')




@section('content')

<div class="container">
    @if (Session::has('success'))
    <div class="alert alert-success text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <p>{{ Session::get('success') }}</p>
    </div>
    @endif
    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation pt-3"
        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
        @csrf

        <div class="row">
            <div class="mb-3 col-12">
                <label for="inputCity" class="form-label">City</label>
                <select id="inputCity" class="form-select form-control city" aria-label="Default select">
                    <option selected>Select a City</option>
                    @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-12">
                <label for="inputGym" class="form-label">Gym</label>
                <select id="inputGym" class="form-select form-control gym" aria-label="Default select">
                    <option selected>Select a Gym</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-12">
                <label for="inputUserName" class="form-label">User Name</label>
                <select id="inputUserName" class="form-select form-control username" aria-label="Default select">
                    <option selected>Select a user name</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12">
                <label for="inputCardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control card-number" id="inputCardNumber" placeholder="5105105105105100"
                    autocomplete="false">
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <label for="inputCVC" class="form-label">CVC</label>
                <input type="text" class="form-control card-cvc" id="inputCVC" placeholder="cvc" />
            </div>
            <div class="col-4">
                <label for="inputExpirationMonth" class="form-label">Expireation Month</label>
                <input type="text" class="form-control card-expiry-month" id="inputExpirationMonth" placeholder="MM" />
            </div>
            <div class="col-4">
                <label for="inputExpirationYear" class="form-label">Experiation Year</label>
                <input type="text" class="form-control card-expiry-year" id="inputExpirationYear" placeholder="YYYY">
            </div>
        </div>

        <div class='row mt-3'>
            <div class='col-md-12 error d-none error'>
                <div class='alert alert-danger'>Please correct the errors and try
                    again.</div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <button type="submit" class="btn btn-primary d-block w-100">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function () {

        // Handle City
        $('.city').on('change', function () {
            $.ajax({
                type: 'get',
                headers: {
                    'Accept': 'application/json'
                },
                url: 'http://127.0.0.1:8000/cities',
                success: function (response) {
                    response.data.forEach(gym => {
                        $('.gym').append(`<option value="${gym.id}">${gym.name}</option>`);
                    })
                }
            })
        });

        $('.gym').on('change', function () {
            $.ajax({
                type: 'get',
                headers: {
                    'Accept': 'application/json'
                },
                url: `http://127.0.0.1:8000/gyms/${$(this).val()}`,
                success: function (response) {
                    console.log(response);
                }
            })
        });

        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function (e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });

</script>

@endsection
