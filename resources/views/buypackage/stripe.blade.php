@extends('layouts.app')

@section('content')

<div class="container">
    @if (Session::has('success'))
    <div class="alert alert-success text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        <p>{{ Session::get('success') }}</p>
    </div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
        <p>{{Session::get('error')}}</p>
    </div>
    @endif
    <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation pt-3"
        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
        @csrf

        <div class="row">
            <div class="mb-3 col-12">
                <label for="inputCity" class="form-label">City</label>
                <select id="inputCity" class="form-select form-control cities" aria-label="Default select" name="city">
                    @if(Auth::user()->hasRole('Super-Admin'))
                    <option selected disabled>Select a City</option>
                    @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                    @elseif(Auth::user()->hasRole('city_manager'))
                    <option value="{{Auth::user()->city->id}}">{{Auth::user()->city->name}}</option>
                    @elseif(Auth::user()->hasRole('gym_manager'))
                    @php
                        $city = Auth::user()->gymManger->first()->city;
                    @endphp
                    <option value={{$city->id}}>{{$city->name}}</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-12">
                <label for="inputGym" class="form-label">Gym</label>
                <select id="inputGym" class="form-select form-control gyms" aria-label="Default select" name="gym">

                    @if(Auth::user()->hasRole('city_manager') || Auth::user()->hasRole('Super-Admin'))
                    <option selected disabled>Select a Gym</option>
                    @endif

                    @if(Auth::user()->hasRole('city_manager'))
                    @foreach (Auth::user()->city->gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                    @endforeach
                    @elseif(Auth::user()->hasRole('gym_manager'))
                        @php
                        $gym = Auth::user()->gymManger->first();
                        @endphp
                        <option id={{$gym->id}}>{{$gym->name}}</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-12">
                <label for="inputUserName" class="form-label">User Name</label>
                <select id="inputUserName" class="form-select form-control users" aria-label="Default select"
                    name="user">
                    @if(Auth::user()->hasRole('gym_manager'))
                    @php
                        $users = Auth::user()->gymManger->first()->users;
                    @endphp
                    @foreach($users as $user)
                    <option value={{$user->id}}>{{$user->name}}</option>
                    @endforeach
                    @else
                    <option selected disabled>Select a user name</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-12">
                <label for="inputPackage" class="form-label">Package</label>
                <select id="inputPackage" class="form-select form-control packages " aria-label="Default select"
                    name="training_package">
                    <option selected>Select a package</option>
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

        @if(Auth::user() -> hasRole('Super-Admin'))
        // Handle City
        $('.cities').on('change', function () {
            $.ajax({
                type: 'get',
                headers: {
                    'Accept': 'application/json'
                },
                url: `http://127.0.0.1:8000/cities/${$(this).val()}/gyms`,
                success: function (response) {
                    console.log(response);
                    $('.gyms').empty();
                    $('.gyms').append(`<option value="" disabled selected hidden>Select a Gym</option>`);
                    if(response.gyms.length > 0) {
                        response.gyms.forEach(gym => {
                            $('.gyms').append(
                                `<option value="${gym.id}">${gym.name}</option>`);
                        })
                    }
                }
            })
        });
        @endif

        @if(Auth::user()->hasRole('Super-Admin') || Auth::user()->hasRole('city_manager'))
        $('.gyms').on('change', function () {
            $.ajax({
                type: 'get',
                headers: {
                    'Accept': 'application/json'
                },
                url: `http://127.0.0.1:8000/gyms/${$(this).val()}/users`,
                success: function (response) {
                    $('.users').empty();
                    $('.users').append(`<option value="" disabled selected hidden>Select a user name</option>`);
                    response.users.forEach(user => {

                        $('.users').append(`<option value="${user.id}">
                            <span>${user.name}</span>
                        </option>`);
                    })
                }
            })
        });
        @endif

        $('.gyms').on('change', function () {
            getGymPackages($(this).val())
        });

        @role('gym_manager')
        let id = {{Auth::user()->gymManger->first()->id}}
        getGymPackages(id)
        @endrole

        function getGymPackages(gymId) {
            $.ajax({
                type: 'get',
                headers: {
                    'Accept': 'application/json'
                },
                url: `http://127.0.0.1:8000/gyms/${gymId}/packages`,
                success: function (response) {
                    $('.packages').empty();
                    $('.packages').append(`<option value="" disabled selected hidden>Select a Package</option>`);
                    response.packages.forEach(package => {
                        $('.packages').append(`<option value="${package.id}">
                            <span>${package.name}  $${package.price}</span>
                        </option>`);
                    })
                }
            })
        }

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
                Stripe.setPublishableKey($forms.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val(),
                    user: $('.users:selected').val(),
                    gym: $('.gyms:selected').val(),
                    training_package: $('.training_package:selected').val()
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
