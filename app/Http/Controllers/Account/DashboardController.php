<?php

namespace WTG\Http\Controllers\Account;

use Illuminate\Http\Request;
use WTG\Http\Controllers\Controller;

/**
 * Dashboard controller
 *
 * @package     WTG\Customer
 * @subpackage  Controllers
 * @author      Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class DashboardController extends Controller
{
    /**
     * The account dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function getAction(Request $request)
    {
        $customer = $request->user();

        return view('pages.account.dashboard', compact('customer'));
    }
}