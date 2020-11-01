@extends('layouts.default')

@section('content')

    <div class="card">
        <div class="card-header">
            <strong>
                Edit Barang
            </strong>
            <small>
                {{ $product->name }}
            </small>

        </div>
        <div class="card-body card-block">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="image" class="form-control-lable">Foto Barang</label>
                    <input type="file" accept="image/*" name="image" value="{{ old('image') }}"
                        class="form-control @error('image') is-invalid @enderror" />
                    @error('image')

                    <div class="text-muted">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name" class="form-control-lable">Nama Barang</label>
                    <input type="text" name="name" value="{{ old('name') ? old('name') : $product->name }}"
                        class="form-control @error('name') is-invalid @enderror" />
                    @error('name')

                    <div class="text-muted">{{ $message }}</div>

                    @enderror
                </div>
                <div class="form-group">
                    <label for="description" class="form-control-lable">Deskripsi Barang</label>
                    <textarea name="description"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description') ? old('description') : $product->description }}</textarea>
                    @error('description')

                    <div class="text-muted">{{ $message }}</div>

                    @enderror
                </div>
                <div class="form-group">
                    <label for="price" class="form-control-lable">Harga Barang</label>
                    <input type="number" name="price" value="{{ old('price') ? old('price') : $product->price }}"
                        class="form-control @error('price') is-invalid @enderror" />
                    @error('price')

                    <div class="text-muted">{{ $message }}</div>

                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity" class="form-control-lable">Stok Barang</label>
                    <input type="number" name="quantity" value="{{ old('quantity') ? old('quantity') : $product->quantity }}"
                        class="form-control @error('quantity') is-invalid @enderror" />
                    @error('quantity')

                    <div class="text-muted">{{ $message }}</div>

                    @enderror
                </div>

                <div class="form-group">
                    <label for="min_order" class="form-control-lable">Minimal Pembelian Barang</label>
                    <input type="number" name="min_order" value="{{ old('min_order') ? old('min_order') : $product->min_order }}"
                        class="form-control @error('min_order') is-invalid @enderror" />
                    @error('min_order')

                    <div class="text-muted">{{ $message }}</div>

                    @enderror
                </div>

                {{-- {{ Form::checkbox('isActive', array('true', 'false')) }}
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="isActive" value="true" name="isActive">
                    <label class="form-check-label" for="isActive" >Aktifkan Produk</label>
                    @error('isActive')

                    <div class="text-muted">{{ $message }}</div>

                    @enderror
                </div> --}}

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">
                        Tambah Barang
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
