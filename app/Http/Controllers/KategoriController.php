<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\MasterItem;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategoris.index.index');
    }

    public function show($id)
    {
        return response()->json(Kategori::findOrFail($id));
    }

    public function search(Request $request)
    {
        $kode = $request->kode;
        $nama = $request->nama;

        $data_search = Kategori::query();

        if (!empty($kode))
            $data_search = $data_search->where('kode', $kode);
        if (!empty($nama))
            $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');

        $data_search = $data_search->select('kode', 'nama')->orderBy('id')->get();


        return json_encode([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $kategori = [];
        } else {
            $kategori = Kategori::find($id);
        }
        $data['kategori'] = $kategori;
        $data['method'] = $method;
        return view('kategoris.form.index', $data);
    }

    public function singleView($kode)
    {
        $data['data'] = Kategori::with('master_items')->where('kode', $kode)->first();
        return view('kategoris.single.index', $data);
    }

    public function formSubmit(Request $request, $method, $id = 0)
    {
        if ($method == 'new') {
            $kategori = new Kategori();
            $kode = Kategori::count('id');
            $kode = $kode + 1;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);
            sleep(3);
        } else {
            $kategori = Kategori::find($id);
            $kode = $kategori->kode;
        }

        $kategori->nama = $request->nama;
        $kategori->kode = $kode;
        $kategori->save();

        return redirect('kategoris');
    }

    public function delete($id)
    {
        MasterItem::find($id)->delete();
        return redirect('kategoris');
    }

    public function list()
    {
        return response()->json(Kategori::select('id', 'nama')->get());
    }
}
