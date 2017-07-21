<?php

namespace WTG\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AddressController
 *
 * @author  Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class AddressController extends Controller
{
    /**
     * The address list
     *
     * @return \Illuminate\View\View
     */
    public function view()
    {
        return view('account.addresses.index');
    }

    /**
     * Remove an address.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $address = Auth::user()->addresses()->findOrFail($id);

        if ($address->delete()) {
            return redirect()
                ->back()
                ->with("status", __("Het adres is verwijderd."));
        } else {
            return redirect()
                ->back()
                ->withErrors(__("Er is een fout opgetreden tijdens het verwijderen van het adres."));
        }
    }
}