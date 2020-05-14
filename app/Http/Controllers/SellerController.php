<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ItensSale;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function homeSeller()
    {
        if (Session::exists('seller') == true && Session::exists('logado') == true) {
            return view('home-seller');
        } else if (Session::exists('seller') == false && Session::exists('logado') == true) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function listProd()
    {
        if (Session::exists('seller') == true && Session::exists('logado') == true) {
            $product = new Product();
            $result = $product->all();
            return view('list-prod-seller', compact('result'));
        } else if (Session::exists('logado') == true && Session::exists('seller') == false) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function searchProd()
    {
        if (Session::exists('seller') == true && Session::exists('logado') == true) {
            return view('search-prod-seller');
        } else if (Session::exists('logado') && Session::exists('seller') == false) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function searchResult(Request $request)
    {
        if (Session::exists('seller') == true && Session::exists('logado') == true) {
            $product = new Product();
            $result = $product->where('description', 'LIKE', '%' . $request->description . '%')->get();

            if (sizeof($result) > 0) {
                return view('list-search-seller', compact('result'));
            } else {
                $request->session()->flash('error', 'Produto Não Encontrado');
                return redirect('/seller/search/product');
            }
        } else if (Session::exists('logado') == true && Session::exists('seller') == false) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function initSale()
    {
        if (Session::exists('seller') && Session::exists('logado')) {
            if (Session::exists('cart') == false) {
                Session::put('cart', []);
            }
            return view('sale-prod-seller');
        } else if (Session::exists('logado') && Session::exists('seller') == false) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function addProduct(Request $request)
    {
        if (Session::exists('seller') && Session::exists('logado')) {

            $product = new Product();
            $productSale = $product->find($request->id);
            $aux = $productSale;

            if ($productSale == null) {
                $request->session()->flash('error', 'Produto Não Encontrado');
                return redirect()->route('seller.sale');
            } else if (sizeof(Session::get('cart')) == 0) {
                if ($request->quantity <= 0) {
                    $request->session()->flash('error', 'Quantidade Inválida, Somente Permitidas Acima de 1');
                    return redirect()->route('seller.sale');
                } else if ($request->quantity > $productSale->amount) {
                    $request->session()->flash('error', 'Impossível Inserir, Quantidade no Estoque Insuficiente');
                    return redirect()->route('seller.sale');
                } else {
                    $aux->amount = $request->quantity;
                    Session::push('cart', $aux);
                    $request->session()->flash('success', 'Produto Inserido no Carrinho');
                    return redirect()->route('seller.sale');
                }
            } else if (sizeof(Session::get('cart')) > 0) {
                if ($request->quantity <= 0) {
                    $request->session()->flash('error', 'Quantidade Inválida, Somente Permitidas Acima de 1');
                    return redirect()->route('seller.sale');
                } else {
                    foreach (Session::get('cart') as $item) {
                        if ($request->id == $item->id) {
                            $qty = $item->amount + $request->quantity;
                            if ($qty > $productSale->amount) {
                                $request->session()->flash('error', 'Quantidade Inválida, Somente Permitidas Acima de 1');
                                return redirect()->route('seller.sale');
                            } else {
                                $item->amount = $qty;
                                $request->session()->flash('success', 'Produto Inserido no Carrinho');
                                return redirect()->route('seller.sale');
                            }
                        }
                    }

                    if ($request->quantity > $productSale->amount) {
                        $request->session()->flash('error', 'Impossível Inserir, Quantidade no Estoque Insuficiente');
                        return redirect()->route('seller.sale');
                    } else {
                        $aux->amount = $request->quantity;
                        Session::push('cart', $aux);
                        $request->session()->flash('success', 'Produto Inserido no Carrinho');
                        return redirect()->route('seller.sale');
                    }
                }
            }
        } else if (Session::exists('logado') && Session::exists('seller') == false) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function listCart()
    {
        if (Session::exists('seller') && Session::exists('logado')) {
            if (Session::exists('cart') == false) {
                Session::put('cart', []);
            }
            $priceCart = 0;
            foreach (Session::get('cart') as $item) {
                $priceCart = $priceCart + ($item->price * $item->amount);
            }
            Session::put('originalPrice', number_format($priceCart, 2, '.', ''));
            return view('cart-list-seller', compact('priceCart'));
        } else if (Session::exists('logado') && Session::exists('seller') == false) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function removeCart($id)
    {
        if (Session::exists('seller') && Session::get('logado')) {
            for ($x = 0; $x < sizeof(Session::get('cart')); $x++) {
                $array = Session::get('cart');
                for ($y = 0; $y < sizeof($array); $y++) {
                    if ($array[$y]['id'] == $id) {
                        unset($array[$y]);
                        $reorded = array_values($array);
                        break;
                    }
                }
            }
            if (Session::exists('discountedPrice')) {
                Session::forget('discountedPrice');
            }
            Session::put('cart', $reorded);
            return redirect()->route('list.cart');
        } else if (Session::exists('logado') && Session::exists('seller') == false) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function discountCart(Request $request)
    {
        if (Session::exists('logado') && Session::exists('seller')) {
            if (sizeof(Session::get('cart')) == 0) {
                $request->session()->flash('error', 'Carrinho Vazio, Impossível Dar Desconto');
                return redirect()->route('list.cart');
            } else if ($request->discount <= 0 || $request->discount > 100) {
                $request->session()->flash('error', 'Impossível Dar Desconto, Insira a Porcentagem Corretamente');
                return redirect()->route('list.cart');
            } else {
                $discountAdmin = new Admin();
                $result = $discountAdmin->where('username', '=', $request->username)->where('password', '=', md5($request->password))->get();
                if (sizeof($result) == 0) {
                    $request->session()->flash('error', 'Usuário ou Senha Incorreto (a)');
                    return redirect()->route('list.cart');
                } else {
                    $discount = Session::get('originalPrice') - (($request->discount / 100) * Session::get('originalPrice'));
                    Session::put('discountedPrice', number_format($discount, 2, '.', ''));
                    $request->session()->flash('success', 'Disconto Dado com Sucesso (Sobre o Valor Total do Carrinho) ');
                    return redirect()->route('list.cart');
                }
            }
        } else if (Session::exists('logado') && Session::exists('logado') == false) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function confirmSale(Request $request)
    {
        if (Session::exists('logado') && Session::exists('seller')) {
            if (sizeof(Session::get('cart')) == 0) {
                $request->session()->flash('error', 'Carrinho Vazio, Impossível Concluir Venda');
                return redirect()->route('seller.sale');
            } else {
                $dateSale = date('Y:m:d');
                $sale = new Sale();
                $sale->id_seller = Session::get('idSeller');
                $sale->payment = $request->payment;
                $sale->date_sale = $dateSale;
                if (Session::exists('discountedPrice')) {
                    $sale->value = Session::get('discountedPrice');
                } else {
                    if (Session::exists('originalPrice') == false) {
                        $priceCart = 0;
                        foreach (Session::get('cart') as $item) {
                            $priceCart = $priceCart + ($item->price * $item->amount);
                        }
                        $sale->value = number_format($priceCart, 2, '.', '');
                    } else {
                        $sale->value = Session::get('originalPrice');
                    }
                }
                $insertSaleResult = $sale->save();
                $idSale = DB::getPdo()->lastInsertId();
                if ($insertSaleResult == true) {
                    foreach (Session::get('cart') as $item) {
                        $item_sale = new ItensSale();
                        $item_sale->id_sale = $idSale;
                        $item_sale->id_product = $item->id;
                        $item_sale->amount = $item->amount;
                        $insertItemSale = $item_sale->save();

                        if ($insertItemSale == true) {
                            $updateProduct = new Product();
                            $aux = $updateProduct->find($item->id);
                            $aux->amount = $aux->amount - $item->amount;
                            $aux->save();
                        }
                    }
                    $request->session()->flash('success', 'Venda Cadastrada com Sucesso');
                } else {
                    $request->session()->flash('error', 'Erro ao Cadastrar Venda, Tente Novamente');
                }
                Session::forget('discountedPrice');
                Session::forget('originalPrice');
                Session::forget('cart');
                return redirect()->route('list.cart');
            }
        } else if (Session::exists('logado') && Session::exists('seller') == false) {
            return redirect('/admin');
        } else {
            return redirect('/');
        }
    }

    public function addSale()
    {
        return view('conf-sale-seller');
    }
}
