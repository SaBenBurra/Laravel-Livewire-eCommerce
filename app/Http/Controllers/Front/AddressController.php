<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', auth()->id())->get();
        return view('front.pages.addresses', compact('addresses'));
    }

    public function create()
    {
        return view('front.pages.address-create-page');
    }

    public function store(StoreAddressRequest $request)
    {
        $address = new Address();
        $address->fill($request->validated());

        $address->user_id = auth()->id();

        $address->save();

        return redirect()->route('front.address.index');
    }

    public function show(Address $address)
    {
        //
    }

    public function edit(Address $address)
    {
        return view('front.pages.address-edit-page', compact('address'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->validated());

        return redirect()->route('front.address.index');
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->back();
    }
}
