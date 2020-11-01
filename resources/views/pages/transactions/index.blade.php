@extends('layouts.default')

@section('content')
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Daftar Transaksi</h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Invoice</th>
                                        <th>Nama Pembeli</th>
                                        <th>Total Harga</th>
                                        <th>Status Pesanan</th>
                                        <th>Tanggal Pesanan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $id += 1 }}</td>
                                            <td>{{ $transaction->invoice }}</td>
                                            <td>Admin</td>
                                            <td>{{ $transaction->order_subtotal }}</td>
                                            <td>{{ $transaction->order_status < '5' ? 'Diproses' : 'Selesai' }}</td>
                                            <td>{{ $transaction->order_created }}</td>
                                            <td>
                                                <a href="{{ route('transactions.update', $transaction->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="#" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center p-5">Belum ada Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
