<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Payment</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{URL::to('landing/assets/img/favicon.png')}}" rel="icon">
  <link href="{{URL::to('landing/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{URL::to('landing/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{URL::to('landing/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{URL::to('landing/assets/css/cart_btn.css')}}" rel="stylesheet">

</head>


<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>

<body x-data="getData">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  @include('front.header')

    <main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Inner Page</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Inner Page</li>
          </ol>
        </div>

      </div>
    </section>
  
    <section class="inner-page">
      <div class="container">
        <form method="POST" action="{{ route('purchase', $orderid ) }}" class="card-form mt-3 mb-3">
    @csrf
    <input type="hidden" name="payment_method" class="payment-method">
    <input class="StripeElement mb-3" name="card_holder_name" placeholder="Card holder name" required>
    <div class="col-lg-4 col-md-6">
        <div id="card-element"></div>
    </div>
    <div id="card-errors" role="alert"></div>
    <input class="StripeElement mb-3" type="time" name="time" placeholder="" required>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary pay">
            Purchase
        </button>
    </div>
</form>
      </div>
    </section>

  </main><!-- End #main -->

  @include('front.footer')
  <!-- Vendor JS Files -->
  <script src="{{URL::to('landing/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{URL::to('landing/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{URL::to('landing/assets/js/main.js')}}"></script>
  <script src="{{URL::to('landing/assets/js/cart_btn.js')}}"></script>
  <script  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script defer src="https://unpkg.com/alpinejs@3.9.0/dist/cdn.min.js"></script>
 
  
  @yield('script')

</body>
<script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe = Stripe("{{ env('STRIPE_KEY') }}")
    let elements = stripe.elements()
    let style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    }
    let card = elements.create('card', {style: style})
    card.mount('#card-element')
    let paymentMethod = null
    $('.card-form').on('submit', function (e) {
        $('button.pay').attr('disabled', true)
        if (paymentMethod) {
            return true
        }
        stripe.confirmCardSetup(
            "{{ $intent->client_secret }}",
            {
                payment_method: {
                    card: card,
                    billing_details: {name: $('.card_holder_name').val()}
                }
            }
        ).then(function (result) {
            if (result.error) {
                $('#card-errors').text(result.error.message)
                $('button.pay').removeAttr('disabled')
            } else {
                paymentMethod = result.setupIntent.payment_method
                $('.payment-method').val(paymentMethod)
                $('.card-form').submit()
            }
        })
        return false
    })
</script>
<script type="text/javascript">
  var token = '{{Session::token()}}' ;
  var exist = '{{Session::has('msg')}}';
  if (exist){
    alert('{{Session::get('msg')}}');
  }
</script>
</html>