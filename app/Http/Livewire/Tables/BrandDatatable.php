<?php

namespace App\Http\Livewire\Tables;

use App\Models\Brand;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class BrandDatatable extends LivewireDatatable
{
    public $model = Brand::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->searchable(),
            Column::name('name')->label('Name')->searchable(),
            Column::callback(['id'], function ($id) {
                return view('livewire.panel.brand-datatable-actions', ['id' => $id]);
            })
        ];
    }

    public function delete($id) {
        Brand::destroy($id);
    }
}