<?php

namespace WTG\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WTG\Checkout\Interfaces\OrderInterface;

/**
 * Class OrderHistoryController
 *
 * @author Thomas Wiringa <thomas.wiringa@gmail.com>
 */
class OrderHistoryController extends Controller
{
    /**
     * Add the items from a previous order to the cart again
     *
     * @param  Request  $request
     * @param  OrderInterface  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addOrderToCart(Request $request, OrderInterface $order)
    {
        if ($order->User_id !== Auth::user()->company_id) {
            return redirect()->back();
        }

        $errorProducts = [];

        foreach ($order->products as $item) {
            $product = $item->product;

            if ($product === null) {
                $errorProducts[] = $item->product_number;

                continue;
            }

            $cartData = [
                'id'      => $product->number,
                'name'    => $product->name,
                'qty'     => $item['qty'],
                'price'   => $product->real_price,
                'options' => [
                    'special' => false,
                    'korting' => app('helper')->getProductDiscount(Auth::user()->login, $product->group, $product->number),
                ],
            ];

            // Add the product to the cart
            Cart::add($cartData);
        }

        if ($errorProducts) {
            return redirect('cart')
                ->withErrors('Niet alle producten zijn toegevoegd aan uw winkelmandje. De volgende producten zijn niet toegevoegd: ' . join(", ", $errorProducts));
        } else {
            return redirect('cart')
                ->with('status', 'De order producten zijn in uw winkelmandje geplaatst.');
        }
    }
}