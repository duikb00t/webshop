<?php

namespace WTG\Http\Controllers\Account;

use Illuminate\Http\Request;
use WTG\Http\Controllers\Controller;

/**
 * Password controller.
 *
 * @author  Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class PasswordController extends Controller
{
    /**
     * Change password page.
     *
     * @return \Illuminate\View\View
     */
    public function getAction()
    {
        return view('pages.account.change-password');
    }

    /**
     * Change the password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAction(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'password_old' => 'required',
            'password'     => 'required|confirmed',
        ]);

        $user = \Auth::user();

        $user_details = [
            'username'   => $user->getUsername(),
            'company_id' => $user->getCompanyId(),
            'password'   => $request->input('password_old'),
        ];

        if ($validator->passes()) {
            if (\Auth::validate($user_details)) {
                $user->setPassword(bcrypt($request->input('password')));
                $user->save();

                \Log::info("[Password change] User with id '{$user->getId()}' changed their password.");

                return redirect()
                    ->back()
                    ->with('status', 'Uw wachtwoord is gewijzigd');
            } else {
                \Log::warning("[Password change] User with id '{$user->getId()}' failed to change their password. Reason: Credential validation failed");

                return redirect()
                    ->back()
                    ->withErrors('Het oude wachtwoord en uw huidige wachtwoord komen niet overeen.');
            }
        } else {
            \Log::warning("[Password change] User with id '{$user->getId()}' failed to change their password. Reason: ".$validator->errors());

            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }
    }
}
