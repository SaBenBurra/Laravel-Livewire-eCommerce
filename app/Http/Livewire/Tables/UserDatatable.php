<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class UserDatatable extends LivewireDatatable
{
    public $model = User::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('ID')->searchable()->defaultSort('asc'),
            Column::name('name')->label('Name')->searchable(),
            Column::name('email')->label('Email')->searchable(),
            DateColumn::name('created_at')->label('Creation Date'),
            Column::callback(['id', 'is_banned'], function($id, $isBanned) {
                return view('livewire.panel.ban-toggle-button', ['id' => $id, 'isBanned' => $isBanned]);
            })->label('ban'),
        ];
    }

    public function banUser($id) {
        $user = User::find($id);

        $user->is_banned = $user->is_banned ? 0 : 1;
        $user->save();
        $this->dispatchBrowserEvent('alert', ['text' => 'Success!']);
    }
}