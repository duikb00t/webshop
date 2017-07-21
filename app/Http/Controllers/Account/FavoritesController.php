<?php

namespace WTG\Http\Controllers\Account;

use Illuminate\Support\Facades\Auth;
use WTG\Catalog\Interfaces\ProductInterface;
use WTG\Customer\Requests\AddFavoriteRequest;
use WTG\Customer\Interfaces\FavoriteInterface;
use WTG\Customer\Requests\CheckFavoriteRequest;
use WTG\Customer\Requests\DeleteFavoriteRequest;

/**
 * Favorites controller
 *
 * @package     WTG\Favorites
 * @subpackage  Controllers
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class FavoritesController extends Controller
{
    /**
     * List of favorites
     *
     * @return \Illuminate\View\View
     */
    public function view()
    {
        $favorites = [];

        app()->make(FavoriteInterface::class)
            ->customer(Auth::id())
            ->get()
            ->each(function ($favorite) use (&$favorites) {
                /** @var FavoriteInterface $favorite */
                /** @var ProductInterface $product */
                $product = app()->make(ProductInterface::class)
                    ->find($favorite->getProductId());

                $favorites[$product->getSeries()][] = $product;
            });

        $favorites = collect($favorites);

        return view('customer::favorites.index', compact('favorites'));
    }

    /**
     * Check if a product is in the users favorites
     *
     * @param  CheckFavoriteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function check(CheckFavoriteRequest $request)
    {
        $productId = $request->input('product');

        /** @var FavoriteInterface $favorite */
        $favorite = app()->make(FavoriteInterface::class)
            ->customer(Auth::id())
            ->get()
            ->first(function ($favorite) use ($productId) {
                /** @var FavoriteInterface $favorite */
                return $favorite->getProductId() === $productId;
            });

        if ($favorite === null) {
            return response([
                'success' => true,
                'toggle_url' => route('customer::account.favorites::add', ['product' => $productId]),
                'text' => trans('customer::button.add')
            ]);
        }

        return response([
            'success' => true,
            'toggle_url' => route('customer::account.favorites::delete', ['favorite' => $favorite->getId()]),
            'text' => trans('customer::button.delete')
        ]);
    }

    /**
     * Add a product to the favorites
     *
     * @param  AddFavoriteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function add(AddFavoriteRequest $request)
    {
        $productId = $request->input('product');

        /** @var FavoriteInterface $favorite */
        $favorite = app()->make(FavoriteInterface::class)
            ->add(
                Auth::id(),
                $productId
            );

        if ($favorite) {
            return response([
                'success' => true,
                'message' => trans('customer::favorite.added'),
                'toggle_url' => route('customer::account.favorites::delete', ['favorite' => $favorite->getId()]),
                'text' => trans('customer::button.delete')
            ]);
        }

        return response([
            'success' => false,
            'message' => trans('customer::favorite.already_added')
        ], 400);
    }

    /**
     * Remove a product from the users favorites
     *
     * @param  DeleteFavoriteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteFavoriteRequest $request)
    {
        $favoriteId = $request->input('favorite');

        /** @var FavoriteInterface $favorite */
        $favorite = app()->make(FavoriteInterface::class)
            ->customer(Auth::id())
            ->find($favoriteId);

        if ($favorite === null) {
            return response([
                'success' => false,
                'message' => trans('customer::favorite.not_found'),
                'toggle_url' => route('customer::account.favorites::delete', ['favorite' => $favoriteId]),
                'text' => trans('customer::favorite.delete'),
            ]);
        }

        $productId = $favorite->getProductId();
        $favorite->delete();

        return response([
            'success' => true,
            'message' => trans('customer::favorite.deleted'),
            'toggle_url' => route('customer::account.favorites::add', ['product' => $productId]),
            'text' => trans('customer::button.add')
        ]);
    }
}