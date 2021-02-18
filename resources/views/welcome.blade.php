<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <script src="https://js.braintreegateway.com/web/dropin/1.26.0/js/dropin.min.js"></script>
      </head>
      <body>
        <form id="payment-form" action="{{ route('pay') }}" method="post">
            <div id="dropin-container"></div>
            <input type="submit" />
            <input type="hidden" id="nonce" name="payment_method_nonce"/>
        </form>

      
        {{-- braintree script --}}
        <script type="text/javascript">

            const form = document.getElementById('payment-form');
            const clientToken = '@php echo($clientToken) @endphp';
            console.log(clientToken);
            braintree.dropin.create({
                authorization: clientToken,
                container: document.getElementById('dropin-container'),
            }, (error, dropinInstance) => {

                if (error) console.error(error);

                form.addEventListener('submit', event => {
                    event.preventDefault();

                    dropinInstance.requestPaymentMethod((error, payload) => {
                    if (error) {
                        console.error(error);
                    }
                    document.getElementById('nonce').value = payload.nonce;

                    form.submit();
                    });
                });
            });
        </script>
      </body>
</html>