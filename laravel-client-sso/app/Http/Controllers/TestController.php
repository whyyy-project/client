<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class TestController extends Controller
{
    //

        public function terbaru()
    {
        try {
            // Cache 5 menit agar tidak selalu request ke API eksternal
            $data = Cache::remember('berita_unugiri_terbaru', 300, function () {
                $response = Http::timeout(10)->get("https://unugiri.ac.id/?rest_route=/monitor/v1/posts&per_page=10");
    
                if (!$response->successful()) {
                    throw new \Exception('Gagal mengambil data dari server eksternal. Status: ' . $response->status());
                }
    
                $result = $response->json();
    
                if (!isset($result['data']) || !is_array($result['data'])) {
                    throw new \Exception('Format data tidak sesuai');
                }
    
                // Format ulang data agar sesuai dengan struktur front-end
                return collect($result['data'])->map(function ($item) {
                    return [
                        'title' => $item['title'],
                        'tanggal' => $item['date'],
                        'subtitle' => $item['excerpt'],
                        'link' => $item['link'],
                    ];
                })->toArray();
            });
    
            return response()->json([
                'success' => true,
                'pengumuman' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    
    }
}
