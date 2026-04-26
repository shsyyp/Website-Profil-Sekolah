<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\PMB;
use App\Models\Alumni;
use App\Models\Chatbot; // Tambahkan ini

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $berita_terbaru = Berita::latest()->take(5)->get();
        
        $statusPMB = PMB::first() ? 'Aktif' : 'Kosong';
        $totalAlumni = Alumni::count();

        // Ganti mock data dengan query ke database
        $totalChatbot = Chatbot::count();
        $chatbotData = Chatbot::latest()->take(5)->get(); // Ambil 5 FAQ terbaru

        return view('admin.dashboard', [
            'totalBerita'    => $totalBerita,
            'berita_terbaru' => $berita_terbaru,
            'statusPMB'      => $statusPMB,
            'totalAlumni'    => $totalAlumni,
            'totalChatbot'   => $totalChatbot, // Lempar ke view
            'chatbot'        => $chatbotData   // Lempar ke view
        ]);
    }
}