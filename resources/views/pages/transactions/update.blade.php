@extends('layouts.default')

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>
                Edit Pesanan
            </strong>

        </div>
        <div class="card-body card-block">
            <form action="{{ route('transactions.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <div class="form-group">
                    <label for="image" class="form-control-lable">Foto Barang</label>
                    <input type="file" accept="image/*" name="image" value="{{ old('image') }}"
                        class="form-control @error('image') is-invalid @enderror" />
                    @error('image')

                    <div class="text-muted">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div id="barang">
                    <div class="row list-barang">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-lable">Pilih Barang</label>
                                <select name="product_id[]" class="form-control @error('product_id') is-invalid @enderror">
                                    <option value="">Pilh barang</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}-{{ $product->price }}">
                                            <div style="margin:0 auto;">
                                                <i>{{ $product->name }}</i>

                                            </div>
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')

                                <div class="text-muted">{{ $message }}</div>

                                @enderror
                            </div>
                            <input type="text" class="d-none" hiddem id="harga[]">

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="min_order" class="form-control-lable">Jumlah</label>
                                <input type="number" name="min_order[]" value="{{ old('min_order') }}"
                                    class="form-control @error('min_order') is-invalid @enderror" />
                                @error('min_order')

                                <div class="text-muted">{{ $message }}</div>

                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" id="btn-tambah-barang" type="button">
                        Tambah Barang
                    </button>
                </div>
                {{-- lek iku didekek ng sebelah e dadi row ngunu yaopo ?
                --}}
                <div class="form-group">
                    <label for="amount" class="form-control-lable">Total Harga</label>
                    <input type="number" name="amount" value="{{ old('amount') }}"
                        class="form-control @error('amount') is-invalid @enderror" />
                    @error('amount')

                    <div class="text-muted">{{ $message }}</div>

                    @enderror
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="isScheduled" value="1" name="isScheduled">
                    <label class="form-check-label" for="isScheduled">Pesanan terjadwal</label>
                    @error('isScheduled')
                    {{-- lek iki dicentang --}}
                    <div class="text-muted">{{ $message }}</div>

                    @enderror
                </div>

                {{-- @if ($isScheduled === 1)
                    --}}
                    {{-- iki muncul --}}
                    {{-- lek iku ng js.e --}}
                    {{-- yaopo caran e aku gak gwe js e --}}
                    <div id="scheduled-form" class="d-none">
                        <div class="form-group row">
                            <label for="example-date-input" class="col-2 col-form-label">Date</label>
                            <div class="col-10">
                                <input class="form-control" type="date" name="scheduled_date" value="2020-10-01" id="example-date-input">
                            </div>
                        </div>
                        {{-- @endif --}}
                <div class="form-group row">
                    <label for="example-time-input" class="col-2 col-form-label">Time</label>
                    <div class="col-10">
                        <input class="form-control" type="time" name="scheduled_time" value="13:45:00" id="example-time-input">
                    </div>
                </div>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" value="1" name="isSelfPickup">
            <label class="form-check-label" for="isSelfPickup">Pesanan diambil sendiri</label>

            <small class="form-text text-muted">ini akan menambah biaya pada pengantaran</small>
            @error('isSelfPickup')
            {{-- lek iki dicentang --}}
            <div class="text-muted">{{ $message }}</div>
            @enderror
        </div>

        {{-- jadi iku bukan select tapi kyok form tambah barang iso nambah quantity pisan piye
        ? --}}

        {{-- gwe tmpilane disek ae --}}

        <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">
                Buat Pesanan
            </button>
        </div>
        </form>
    </div>
    </div>

@endsection


@section('js')
    <script>
        jQuery(document).on('change', '#isScheduled', function(e) {
            if (this.checked) {
                jQuery('#scheduled-form').removeClass('d-none')
            } else {
                jQuery('#scheduled-form').addClass('d-none')

            }
        })
        // lek nambah form maneh

        jQuery(document).on('click', '#btn-tambah-barang', function(e) {
            e.preventDefault()
            var output = `<div class="row list-barang">
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-lable">Pilih Barang</label>
                                <select name="product_id[]" class="form-control @error('product_id') is-invalid @enderror">
                                    <option value="">Pilh barang</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}-{{ $product->price }}">
                                            <div style="margin:0 auto;">
                                                <i>{{ $product->name }}</i>
            
                                            </div>
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
            
                                <div class="text-muted">{{ $message }}</div>
                                
                                @enderror
                            </div>
                            <input type="text" class="d-none" hiddem name="harga[]">
                           </div>
                           <div class="col-md-6">
                               
                            <div class="form-group">
                                <label for="min_order" class="form-control-lable">Minimal Pembelian Barang</label>
                                <input type="number" name="min_order[]" value="{{ old('min_order') }}"
                                    class="form-control @error('min_order') is-invalid @enderror" />
                                @error('min_order')
            
                                <div class="text-muted">{{ $message }}</div>
            
                                @enderror
                            </div> 
                           </div>
                       </div>`
            jQuery('#barang').append(output)
            jQuery('#barang').trigger('.add.barang')
        })

        jQuery(document).on('change','#barang select[name="product_id[]"]',function(e){
            jQuery('#barang').trigger('add.barang')
        })   

        jQuery(document).on('input','#barang input[name="min_order[]"]',function(e){
            jQuery('#barang').trigger('add.barang')
        })    

        jQuery(document).on('add.barang', '#barang', function(e) {
            var brg = jQuery(this).find('select[name="product_id[]"]')
            var total = 0
            brg.each(function(i,el){
                var _this = jQuery(el)
                var qty = _this.parents('.list-barang').find('input[name="min_order[]"]').val()
                var harga = _this.val().split('-')[1]
                total = total + (parseInt(harga) * qty)
            })
            jQuery('input[name="amount"]').val(total)
        })

    </script>
@endsection
