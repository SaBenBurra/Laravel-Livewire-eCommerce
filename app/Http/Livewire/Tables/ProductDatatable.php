<?php

namespace App\Http\Livewire\Tables;

use App\Models\Category;
use App\Models\Product;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ProductDatatable extends LivewireDatatable
{
    public function builder() {
        return Product::query()
            ->leftJoin('categories', 'categories.id', 'products.category_id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->searchable(),
            Column::name('name')->label('Name')->searchable(),
            Column::name('categories.name')
                ->label('Category')
                ->searchable(),
            NumberColumn::name('price')->label('Price'),
            NumberColumn::name('slug')->label('Slug')->searchable(),
            Column::name('serial_number')->label('Serial Number')->searchable(),
            NumberColumn::name('stock')->label('Stock'),
            NumberColumn::name('rating_average')->label('Rating'),
            Column::callback(['id'], function ($id) {
                return view('livewire.panel.product-datatable-actions', ['id' => $id]);
            })
        ];
    }

    public function delete($id) {
        Product::destroy($id);
    }
}