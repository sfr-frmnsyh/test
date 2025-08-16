@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group mb-2">
                    <a href="{{url('kategoris')}}" class="btn btn-secondary">Kembali ke Daftar Kategori</a>
                </div>
                <div class="card">
                    <div class="card-header">Kategori</div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td>{{$data->nama}}</td>
                            </tr>
                            <tr>
                                <th>Kode</th>
                                <td>:</td>
                                <td>{{$data->kode}}</td>
                            </tr>
                        </table>
                        <a class="btn btn-info" href="{{url('kategoris/form/edit')}}/{{$data->id}}">Edit</a>
                        <a class="btn btn-danger" href="{{url('kategoris/delete')}}/{{$data->id}}"
                            onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-header">List Item</div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Harga Beli</th>
                                <th>Laba</th>
                                <th>Supplier</th>
                                <th>Foto</th>
                            </tr>
                            @foreach ($data->master_items ?? [] as $item)
                                <tr>
                                    <th>{{ $item->kode ?? '' }}</th>
                                    <th>{{ $item->nama ?? '' }}</th>
                                    <th>{{ $item->jenis ?? '' }}</th>
                                    <th>{{ $item->harga_beli ?? '' }}</th>
                                    <th>{{ $item->laba ?? '' }}%</th>
                                    <th>{{ $item->supplier ?? '' }}</th>
                                    <th>
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" style="height: 50px; width: auto;" />
                                        @else
                                            -
                                        @endif
                                    </th>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection