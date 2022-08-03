<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('charge') }}" method="post">
        <input type="text" name="amount" />
        {{ csrf_field() }}
        <input type="submit" name="submit" value="Pay Now">
    </form>
    <form id="paymentForm">
  <div class="form-group">
    <label for="email">Email Address</label>
    <input type="email" id="email-address" required />
  </div>
  <div class="form-group">
    <label for="amount">Amount</label>
    <input type="tel" id="amount" required />
  </div>
  <div class="form-submit">
    <button type="submit" onclick="payWithPaystack()"> Pay </button>
  </div>
</form>
    <form action="{{ url('charge') }}" method="post">
    @csrf
    <input type="email" id="email" required />
    <input type="text" id="amount" required />

    <button type="submit" > Pay </button>

</form>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    let paymentForm = document.getElementById("paymentForm");
    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(e)
    {
        e.preventDefault();

        let handler = PaystackPop.setup({
            key: 'pk_test_0fa95f5a93d7cb968a0b071d74945c0ef8893e46', // Replace with your public key
            email: document.getElementById("email-address").value,
            amount: document.getElementById("amount").value * 100,
            ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            onClose: function(){
            alert('Window closed.');
            },
            callback: function(response)
            {
                let reference = response.reference;

                $.ajax({
                    type: "GET",
                    url: "{{URL::to('verify-payment')}}/"+response,
                    // data: {

                    // },
                    // dataType: "datatype",
                    success: function(response){
                        console.log(response);
                        if (response[0].status == true) {
                            $('form').prepend('<h2>Payment Successfull</h2>');
                        }else{
                            $('form').prepend('<h2>Fail to verify payment</h2>');
                        }
                    }
                });
                //verify the payment
                // let message = 'Payment complete! Reference: ' + response.reference;
                // alert(message);
             }
        });

    handler.openIframe();
    }

</script>
</body>
</html>
