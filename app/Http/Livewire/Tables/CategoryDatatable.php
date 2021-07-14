<?php

namespace App\Http\Livewire\Tables;

use App\Models\Category;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class CategoryDatatable extends LivewireDatatable
{
    public $model = Category::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->searchable(),
            Column::name('name')->label('Name')->searchable(),
            Column::callback(['id'], function ($id) {
                return view('livewire.panel.category-datatable-actions', ['id' => $id]);
            })
        ];
    }

    public function delete($id) {
        Category::destroy($id);
    }
}