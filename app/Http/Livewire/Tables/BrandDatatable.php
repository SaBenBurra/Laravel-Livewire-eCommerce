<?php

namespace App\Http\Livewire\Tables;

use App\Models\Brand;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class BrandDatatable extends LivewireDatatable
{
    public $model = Brand::class;

    public function columns()
    {
        //
    }
}