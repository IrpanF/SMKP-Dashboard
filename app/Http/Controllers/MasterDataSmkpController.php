<?php

namespace App\Http\Controllers;

use App\Models\SmkpElement;

class MasterDataSmkpController extends Controller
{
    public function index()
    {
        $elements = SmkpElement::with([
            'criteria' => function ($query) {
                $query->whereNull('parent_id')
                    ->where('is_active', true)
                    ->orderBy('sort_order');
            },
            'criteria.indicators',
            'criteria.children.indicators',
            'criteria.children.children.indicators',
            'criteria.children.children.children.indicators',
        ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('master-data.smkp', compact('elements'));
    }
}