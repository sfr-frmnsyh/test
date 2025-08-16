<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<form method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'edit')
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" class="form-control" name="kode_barang" required readonly value="{{$item->kode ?? ''}}">
        </div>
    @endif

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required value="{{$item->nama ?? ''}}">
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" required value="{{$item->harga_beli ?? ''}}">
    </div>

    <div class="form-group">
        <label>Laba (dalam persen)</label>
        <input type="number" class="form-control" name="laba" required value="{{$item->laba ?? ''}}">
    </div>

    @php $selected = $item->supplier ?? ''; @endphp
    <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" required name="supplier">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Tokopaedi') selected @endif>Tokopaedi</option>
            <option @if($selected == 'Bukulapuk') selected @endif>Bukulapuk</option>
            <option @if($selected == 'TokoBagas') selected @endif>TokoBagas</option>
            <option @if($selected == 'E Commurz') selected @endif>E Commurz</option>
            <option @if($selected == 'Blublu') selected @endif>Blublu</option>
        </select>
    </div>

    @php $selected = $item->jenis ?? ''; @endphp
    <div class="form-group">
        <label>Jenis</label>
        <select class="form-control" required name="jenis">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Obat') selected @endif>Obat</option>
            <option @if($selected == 'Alkes') selected @endif>Alkes</option>
            <option @if($selected == 'Matkes') selected @endif>Matkes</option>
            <option @if($selected == 'Umum') selected @endif>Umum</option>
            <option @if($selected == 'ATK') selected @endif>ATK</option>
        </select>
    </div>

    @php
        $selected = isset($item) && $item instanceof \App\Models\MasterItem
            ? $item->kategoris->pluck('id')->toArray()
            : [];
    @endphp
    <div class="form-group">
        <label>Kategori</label>
        <select class="form-control" name="kategori_id[]" id="kategori_id" multiple></select>
    </div>

    <div class="form-group">
        <label>Upload Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>

    <button class="btn btn-primary mt-3">Submit</button>

</form>
<script>
    $(document).ready(function () {
        let selectedKategori = @json($selected);

        $('#kategori_id').select2({
            ajax: {
                url: "{{ url('kategoris/list') }}",
                processResults: function (data) {
                    return {
                        results: data.map(k => ({ id: k.id, text: k.nama }))
                    };
                }
            }
        });

        // set selected ketika edit
        if (selectedKategori.length > 0) {
            selectedKategori.forEach(id => {
                $.ajax({
                    url: "{{ url('kategoris') }}/show/" + id,
                    success: function (kategori) {
                        let option = new Option(kategori.nama, kategori.id, true, true);
                        $('#kategori_id').append(option).trigger('change');
                    }
                });
            });
        }
    });
</script>