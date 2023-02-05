<div class="pl-md-3">
<div class="pt-5 pb-4">
    <h2>Penjualan</h2>
</div>

<div class="row">
<div class="card card-info col-md-4 mr-md-5">
    <div class="card-header">
      <h3 class="card-title">Cari Barang</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label >Masukkan Id Barang / Nama Barang</label>
        <input type="search" wire:model="search" class="form-control">
      </div>

    </div>
  </div>

  <div class="card card-info col-lg-8 col-xl-6">
    <div class="card-header">
      <h3 class="card-title">Barang</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">ID Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Stock</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($barangs as $barang)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $barang->id_barang }}</td>
                  <td>{{ $barang->nama_barang }}</td>
                  <td>{{ $barang->stock }}</td>
                  <td>Rp. {{ number_format($barang->harga_jual) }}</td>
                  <td>
                      <button class="btn btn-warning" onclick="defineqty('{{ $barang->id }}','{{ $barang->harga_jual }}','{{ $barang->stock }}','{{ $barang->nama_barang }}')" ><i class="fas fa-shopping-cart"></i></button>
                  </td>
                </tr>
                @empty
                <tr>
                    <th>Barang Tidak Ada</th>
                </tr>
                @endforelse
            </tbody>
          </table>
          {{ $barangs->links() }}
    </div>
  </div>
</div>

@if (session()->has('message'))
<div class="alert alert-danger alert-dismissible fade show col-lg-10" role="alert">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<div class="card card-info col-lg-10 mt-3 mr-md-5">
    <div class="card-header">
      <h3 class="card-title">Keranjang</h3>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">ID Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Qty</th>
                <th scope="col">Harga</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($keranjangs as $keranjang)
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $keranjang->barang->id_barang }}</td>
                  <td>{{ $keranjang->barang->nama_barang }}</td>
                  <td class="d-flex">
                      @if ($keranjang->qty > 1)
                      <span class="btn btn-danger btn-sm" wire:click="decrement({{ $keranjang->id }})">-</span>
                      @endif
                      <input type="text" value="{{ $keranjang->qty }}" readonly  style="width: 50px">
                      <span class="btn btn-success btn-sm" wire:click="increment({{ $keranjang->id }})">+</span>
                  </td>
                  <td>Rp. {{ number_format($keranjang->barang->harga_jual) }}</td>
                  <td>Rp. {{ number_format($keranjang->barang->harga_jual*$keranjang->qty) }}</td>
                  <td>
                      <button class="btn btn-danger btn-sm" wire:click="hapusBarangCart({{ $keranjang->id }})">Hapus</button>
                  </td>
                </tr>
                @empty
                <tr>
                    <th>Barang belum ada di keranjang</th>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="font-weight-bold">
                    Total Pembelian
                </td>
                <td class="font-weight-bold">
                   Rp. {{ number_format($keranjangs->sum('total')) }}
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="font-weight-bold">
                  Pembayaran
                </td>
                <td>
                  <input type="number" value="{{ $pembayaran }}" wire:model="pembayaran">
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="font-weight-bold">
                  Kembalian
                </td>
                <td>
                    @if ($pembayaran != 0)
                    Rp. {{ number_format($pembayaran - $keranjangs->sum('total')) }}
                    @endif
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <button class="btn btn-primary" @if (($pembayaran - $keranjangs->sum('total')) < 0 ) disabled @endif wire:click="transaction">Bayar</button>
                </td>
              </tr>
            </tfoot>
          </table>
    </div>
  </div>

</div>

@push('scripts')
<script>

const defineqty = (id,harga_jual,stock,nama_barang) => {
    Swal.fire({
      title: `Masukkan jumlah ${nama_barang} yang mau dibeli`,
      position: 'top',
      input: 'number',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      confirmButtonText: 'Tambah ke keranjang',
      cancelButtonText: 'Batal',
      showLoaderOnConfirm: true,
      preConfirm: (inputqty) => {
        if (inputqty > 0 && inputqty <= stock) {
            @this.addtocart(id,harga_jual,inputqty)
        }else{
            Swal.fire({
            icon: 'error',
            position: 'top',
            title: 'Oops...',
            text: 'Sepertinya input belum di isi / stock tidak mencukupi!'
        })
        }
      }
    })
}
</script>
@endpush
