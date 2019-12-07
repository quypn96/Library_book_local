<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Book\BookRepositoryInterface;
use App\Models\Cart;
use Session;

class CartController extends Controller
{
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->middleware('checkLogin');
        $this->middleware('auth');
        $this->bookRepository = $bookRepository;
    }

    public function addItem(Request $request)
    {
        $book = $this->bookRepository->getByIdAndColumsName(['id', 'title', 'image', 'quantity'], $request->id);

        $listItems = $request->session()->has('cart') ? $request->session()->get('cart') : null;

        $cart = new Cart($listItems);

        if ($cart->add($book, $book->id)) {
            $request->session()->put('cart', $cart->items);

            return response()->json([
                'cart' => $cart->items,
                'status' => true
            ]);
        } else {

            return response()->json([
                'cart' => $cart->items,
                'status' => false
            ]);
        }
    }

    public function showListItems(Request $request)
    {
        $listItems = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        if ($listItems == null) {

            return redirect()->route('home');
        }

        return view('client.list-cart', ['listItems' => $listItems]);
    }

    public function deleteItem(Request $request)
    {
        $listItems = $request->session()->has('cart') ? $request->session()->get('cart') : null;

        $cart = new Cart($listItems);
        $cart->removeItem((int)$request->id);
        $request->session()->put('cart', $cart->items);

        return response()->json([
            'cart' => $cart->items
        ]);
    }
}
