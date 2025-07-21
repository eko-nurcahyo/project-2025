<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Midtrans</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
</head>
<body>
<div class="container mt-5">
    <h3>Silakan lanjutkan pembayaran pesanan Anda</h3>
    <p>Total Bayar: <b>Rp {{ number_format($total, 0, ',', '.') }}</b></p>
    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = "/checkout/success?order_id={{ $order_id }}";
            },
            onPending: function(result){
                window.location.href = "/checkout/pending?order_id={{ $order_id }}";
            },
            onError: function(result){
                alert('Transaksi gagal!');
            }
        });
    };
</script>
</body>
</html>
