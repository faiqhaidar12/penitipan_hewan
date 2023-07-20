<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalamanController extends Controller
{
    public function index()
    {
        $title = "ini index loh";
        return view('halaman/index')->with('title', $title);
    }
    public function kontak()
    {
        $data = [
            "nama" => "Fa'iq Haidar",
            "umur" => 23,
            "skill" => [
                "web" => "PHP",
                "mobile" => "kotlin"
            ]
        ];
        return view('halaman/kontak')->with($data);
    }
    public function tentang()
    {
        return view('halaman/tentang');
    }
}
