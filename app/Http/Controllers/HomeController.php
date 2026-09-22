<?php 
 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
 
class HomeController extends Controller 
{ 
    public function index() 
    { 
        $judul = 'Sistem Informasi Peminjaman Buku Perpustakaan Mini'; 
        return view('home', ['judul' => $judul]); 
    } 

    public function tentang()
    {
        $judul = 'Tentang Kami';
        return view('tentang', ['judul' => $judul]);
    }
}