{{-- resources/views/frontend/cart.blade.php --}}
<!DOCTYPE html>
<html>
<head>
  <title>Keranjang Belanja</title>
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>
<body>
  <div class="container mt-4">
    <h2>Keranjang Belanja</h2>
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Menu</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Total</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php $grandTotal = 0; @endphp
        @foreach($cart as $id => $item)
        @php $total = $item['price'] * $item['qty']; $grandTotal += $total; @endphp
        <tr>
          <td>{{ $item['name'] }}</td>
          <td>
            <form action="{{ route('cart.update') }}" method="POST" style="display:inline;">
              @csrf
              <input type="hidden" name="menu_id" value="{{ $id }}">
              <button name="action" value="decrement" class="btn btn-sm btn-secondary" {{ $item['qty'] == 1 ? 'disabled' : '' }}>-</button>
            </form>
            <span class="mx-2">{{ $item['qty'] }}</span>
            <form action="{{ route('cart.update') }}" method="POST" style="display:inline;">
              @csrf
              <input type="hidden" name="menu_id" value="{{ $id }}">
              <button name="action" value="increment" class="btn btn-sm btn-secondary">+</button>
            </form>
          </td>
          <td>Rp{{ number_format($item['price'],0,',','.') }}</td>
          <td>Rp{{ number_format($total,0,',','.') }}</td>
          <td>
            <form action="{{ route('cart.remove') }}" method="POST">
              @csrf
              <input type="hidden" name="menu_id" value="{{ $id }}">
              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3"><strong>Grand Total</strong></td>
          <td colspan="2"><strong>Rp{{ number_format($grandTotal,0,',','.') }}</strong></td>
        </tr>
      </tbody>
    </table>
    <a href="{{ route('checkout.index') }}" class="btn btn-success">Checkout</a>
    @else
      <div class="alert alert-warning">Keranjang masih kosong.</div>
      <a href="{{ route('menu.index') }}" class="btn btn-primary">Lihat Menu</a>
    @endif
  </div>
</body>
</html>
