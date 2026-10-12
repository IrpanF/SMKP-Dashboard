<?php

namespace App\Http\Controllers;

use App\Models\SmkpElement;

class AuditChecklistController extends Controller
{
    public function index()
    {
        $elements = SmkpElement::with([
            'criteria.indicators',
            'criteria.children.indicators',
            'criteria.children.children.indicators',
            'criteria.children.children.children.indicators',
            'criteria.children.children.children.children.indicators',
            'criteria.children.children.children.children.children.indicators',
        ])->get();

        return view('audit.checklist', compact('elements'));
    }
}