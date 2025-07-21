<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
</head>
<body>
<div class="container mt-5">
    <h2>Checkout</h2>
    <form id="manualCheckout" action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>No. HP</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Konfirmasi & Bayar Manual</button>
    </form>

    <div class="text-center my-3">
        <hr>
        <b>Atau Bayar dengan Google Pay</b>
    </div>
    <div id="container"></div>
</div>

<!-- Google Pay JS -->
<script async
    src="https://pay.google.com/gp/p/js/pay.js"
    onload="onGooglePayLoaded()"></script>

<script>
const baseRequest = {
    apiVersion: 2,
    apiVersionMinor: 0
};
const allowedCardNetworks = ["MASTERCARD", "VISA"];
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];
const tokenizationSpecification = {
    type: 'PAYMENT_GATEWAY',
    parameters: {
        'gateway': 'example', // Ganti dengan gateway asli, misal 'midtrans', 'stripe', dst
        'gatewayMerchantId': 'YOUR_GATEWAY_MERCHANT_ID'
    }
};
const baseCardPaymentMethod = {
    type: 'CARD',
    parameters: {
        allowedAuthMethods: allowedCardAuthMethods,
        allowedCardNetworks: allowedCardNetworks
    }
};
const cardPaymentMethod = Object.assign(
    {},
    baseCardPaymentMethod,
    {
        tokenizationSpecification: tokenizationSpecification
    }
);
function getGoogleIsReadyToPayRequest() {
    return Object.assign(
        {},
        baseRequest,
        {
            allowedPaymentMethods: [baseCardPaymentMethod]
        }
    );
}
function getGooglePaymentDataRequest() {
    const paymentDataRequest = Object.assign({}, baseRequest);
    paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
    paymentDataRequest.transactionInfo = {
        totalPriceStatus: 'FINAL',
        totalPrice: '99000', // Ubah dengan total pesanan, bisa inject dari backend pakai blade
        currencyCode: 'IDR'
    };
    paymentDataRequest.merchantInfo = {
        merchantId: 'BCR2DN7TZD4ZLTIJ', // <- Merchant ID Google Pay
        merchantName: 'Kebab Ngajubi'
    };
    return paymentDataRequest;
}
let paymentsClient = null;
function onGooglePayLoaded() {
    paymentsClient = new google.payments.api.PaymentsClient({ environment: 'TEST' }); // Ganti 'PRODUCTION' jika live
    paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
        .then(function(response) {
            if (response.result) {
                createAndAddButton();
            }
        })
        .catch(function(err) {
            console.error(err);
        });
}
function createAndAddButton() {
    const button = paymentsClient.createButton({ onClick: onGooglePaymentButtonClicked });
    document.getElementById('container').appendChild(button);
}
function onGooglePaymentButtonClicked() {
    paymentsClient.loadPaymentData(getGooglePaymentDataRequest())
        .then(function(paymentData) {
            // Kirim paymentData ke backend untuk proses lebih lanjut
            fetch("{{ route('checkout.process') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ paymentData: paymentData })
            })
            .then(response => response.json())
            .then(data => {
                alert('Pembayaran Google Pay berhasil!');
                // Bisa redirect ke halaman sukses
            })
            .catch(error => {
                alert('Pembayaran Google Pay gagal!');
                console.error(error);
            });
        })
        .catch(function(err) {
            console.error(err);
        });
}
</script>
</body>
</html>
