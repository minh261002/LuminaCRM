<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function provinces(Request $request)
    {
        $items = Province::query()
            ->orderBy('name')
            ->get(['province_code', 'name']);

        return response()->json([
            'results' => $items->map(fn ($p) => [
                'id' => $p->province_code,
                'text' => $p->name,
            ]),
            'pagination' => ['more' => false],
        ]);
    }

    public function wards(Request $request)
    {
        $provinceCode = $request->input('province_code');
        if (!$provinceCode) {
            return response()->json([
                'results' => [],
                'pagination' => ['more' => false],
            ]);
        }

        $items = Ward::query()
            ->where('province_code', $provinceCode)
            ->orderBy('name')
            ->get(['ward_code', 'name']);

        return response()->json([
            'results' => $items->map(fn ($w) => [
                'id' => $w->ward_code,
                'text' => $w->name,
            ]),
            'pagination' => ['more' => false],
        ]);
    }
}
