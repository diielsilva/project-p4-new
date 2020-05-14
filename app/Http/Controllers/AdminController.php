<?php

namespace App\Http\Controllers;

use App\ItensSale;
use App\Product;
use App\Sale;
use App\Seller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function homeAdmin()
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            return view('home-admin');
        } else if (Session::exists('logado') == true && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function formAdd()
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            return view('cad-prod-admin');
        } else if (Session::exists('logado') == true && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function confirmAdd(Request $request)
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            if ($request->price <= 0 || $request->amount <= 0) {
                $request->session()->flash('error', 'Impossível Inserir Valores Abaixo ou Igual a 0, Tente Novamente');
                return redirect('/admin/add');
            } else {
                $product = new Product();
                $product->id = null;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->amount = $request->amount;
                $result = $product->save();

                if ($result == true) {
                    $request->session()->flash('success', 'Produto Cadastro com Sucesso');
                    return redirect('/admin/add');
                } else {
                    $request->session()->flash('error', 'Erro ao Cadastrar Produto, Tente Novamente');
                    return redirect('/admin/add');
                }
            }
        } else if (Session::exists('logado') == true && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function listProducts()
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            $product = new Product();
            $result = $product->all();
            return view('list-prod-admin', compact('result'));
        } else if (Session::exists('logado') == true && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function deleteProduct(Request $request, $id)
    {

        if (Session::exists('admin') && Session::exists('logado')) {
            try {
                $product = new Product();
                $result = $product->where('id', $id)->delete();
                if ($result > 0) {

                    $request->session()->flash('success', 'Produto Removido com Sucesso');
                    return redirect('/admin/list/product');
                }
            } catch (QueryException $ex) {
                $request->session()->flash('error', 'Erro ao Remover, Produto Registrado em Venda');
                return redirect('/admin/list/product');
            }
        } else if (Session::exists('logado') == true && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function editProduct($id)
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            return view('edit-prod-admin', compact('id'));
        } else if (Session::exists('logado') == true && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function updateProduct(Request $request, $id)
    {
        if (Session::exists('admin') && Session::exists('logado')) {

            if ($request->description == "" && $request->price == "" && $request->amount == "") {
                $request->session()->flash('error', 'Impossível Editar, Formulário Vazio, Preencha ao Menos 1 Campo');
                return redirect()->route('admin.edit.product', $id);
            } else if ($request->description == '' && $request->price == '' && $request->amount != '') {

                if ($request->amount <= 0) {
                    $request->session()->flash('error', 'Impossível Editar, Insira Valores Maiores que 0');
                    return redirect()->route('admin.edit.product', $id);
                } else {
                    $product = new Product();
                    $update = $product->find($id);
                    $update->amount = $request->amount;
                    $result = $update->save();

                    if ($result == true) {
                        $request->session()->flash('success', 'Produto Editado com Sucesso');
                        return redirect()->route('admin.edit.product', $id);
                    } else {
                        $request->session()->flash('error', 'Erro ao Editar Produto, Tente Novamente');
                        return redirect()->route('admin.edit.product', $id);
                    }
                }
            } else if ($request->description == '' && $request->price != '' && $request->amount == '') {
                if ($request->price <= 0) {
                    $request->session()->flash('error', 'Impossível Editar, Insira Valores Maiores que 0');
                    return redirect()->route('admin.edit.product', $id);
                } else {
                    $product = new Product();
                    $update = $product->find($id);
                    $update->price = $request->price;
                    $result = $update->save();

                    if ($result == true) {
                        $request->session()->flash('success', 'Produto Editado com Sucesso');
                        return redirect()->route('admin.edit.product', $id);
                    } else {
                        $request->session()->flash('error', 'Erro ao Editar Produto, Tente Novamente');
                        return redirect()->route('admin.edit.product', $id);
                    }
                }
            } else if ($request->description != '' && $request->price == '' && $request->amount == '') {
                $product = new Product();
                $update = $product->find($id);
                $update->description = $request->description;
                $result = $update->save();

                if ($result == true) {
                    $request->session()->flash('success', 'Produto Editado com Sucesso');
                    return redirect()->route('admin.edit.product', $id);
                } else {
                    $request->session()->flash('error', 'Erro ao Editar Produto, Tente Novamente');
                    return redirect()->route('admin.edit.product', $id);
                }
            } else if ($request->description == '' && $request->price != '' && $request->amount != '') {
                if ($request->price <= 0 || $request->amount <= 0) {
                    $request->session()->flash('error', 'Impossível Editar, Insira Valores Maiores que 0');
                    return redirect()->route('admin.edit.product', $id);
                } else {
                    $product = new Product();
                    $update = $product->find($id);
                    $update->price = $request->price;
                    $update->amount = $request->amount;
                    $result = $update->save();

                    if ($result == true) {
                        $request->session()->flash('success', 'Produto Editado com Sucesso');
                        return redirect()->route('admin.edit.product', $id);
                    } else {
                        $request->session()->flash('error', 'Erro ao Editar Produto, Tente Novamente');
                        return redirect()->route('admin.edit.product', $id);
                    }
                }
            } else if ($request->description != '' && $request->price == '' && $request->amount != '') {
                if ($request->amount <= 0) {
                    $request->session()->flash('error', 'Impossível Editar, Insira Valores Maiores que 0');
                    return redirect()->route('admin.edit.product', $id);
                } else {
                    $product = new Product();
                    $update = $product->find($id);
                    $update->description = $request->description;
                    $update->amount = $request->amount;
                    $result = $update->save();

                    if ($result == true) {
                        $request->session()->flash('success', 'Produto Editado com Sucesso');
                        return redirect()->route('admin.edit.product', $id);
                    } else {
                        $request->session()->flash('error', 'Erro ao Editar Produto, Tente Novamente');
                        return redirect()->route('admin.edit.product', $id);
                    }
                }
            } else if ($request->description != '' && $request->price != '' && $request->amount == '') {
                if ($request->price <= 0) {
                    $request->session()->flash('error', 'Impossível Editar, Insira Valores Maiores que 0');
                    return redirect()->route('admin.edit.product', $id);
                } else {
                    $product = new Product();
                    $update = $product->find($id);
                    $update->description = $request->description;
                    $update->price = $request->price;
                    $result = $update->save();

                    if ($result == true) {
                        $request->session()->flash('success', 'Produto Editado com Sucesso');
                        return redirect()->route('admin.edit.product', $id);
                    } else {
                        $request->session()->flash('error', 'Erro ao Editar Produto, Tente Novamente');
                        return redirect()->route('admin.edit.product', $id);
                    }
                }
            } else if ($request->description != '' && $request->price != '' && $request->amount != '') {
                if ($request->price <= 0 || $request->amount <= 0) {
                    $request->session()->flash('error', 'Impossível Editar, Insira Valores Maiores que 0');
                    return redirect()->route('admin.edit.product', $id);
                } else {
                    $product = new Product();
                    $update = $product->find($id);
                    $update->description = $request->description;
                    $update->price = $request->price;
                    $update->amount = $request->amount;
                    $result = $update->save();

                    if ($result == true) {
                        $request->session()->flash('success', 'Produto Editado com Sucesso');
                        return redirect()->route('admin.edit.product', $id);
                    } else {
                        $request->session()->flash('error', 'Erro ao Editar Produto, Tente Novamente');
                        return redirect()->route('admin.edit.product', $id);
                    }
                }
            }
        } else if (Session::exists('logado') == true && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function searchProd()
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            return view('search-prod-admin');
        } else if (Session::exists('logado') == true && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }


    public function resultSearch(Request $request)
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            $product = new Product();
            $result = $product->where('description', 'LIKE', '%' . $request->description . '%')->get();
            if (sizeof($result) > 0) {
                return view('list-search-admin', compact('result'));
            } else {
                $request->session()->flash('error', 'Produto Não Encontrado');
                return redirect('/admin/search');
            }
        } else if (Session::exists('logado') == true && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function listSalesAdmin()
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            $values = 0;
            $sale = new Sale();
            $result = $sale->all();
            foreach ($result as $item) {
                $values = $values + $item->value;
            }
            Session::put('valueSales', $values);
            return view('list-sale-admin', compact('result'));
        } else if (Session::exists('logado') && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function orderSalesAdmin(Request $request)
    {
        if (Session::exists('admin') && Session::exists('logado')) {
            if ($request->order == 'month') {
                $values = 0;
                $sale = new Sale();
                $date = date('m');
                strval($date);
                $result = $sale->whereMonth('date_sale', '=', $date)->get();
                foreach ($result as $item) {
                    $values = $values + $item->value;
                }
                Session::put('valueSales', $values);
                return view('list-sale-admin', compact('result'));
            } else {
                $values = 0;
                $sale = new Sale();
                $date = date('Y:m:d');
                strval($date);
                $result = $sale->where('date_sale', '=', $date)->get();
                foreach ($result as $item) {
                    $values = $values + $item->value;
                }
                Session::put('valueSales', $values);
                return view('list-sale-admin', compact('result'));
            }
        } else if (Session::exists('logado') && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function saleDetailsAdmin($id)
    {
        if (Session::exists('logado') && Session::exists('admin')) {
            Session::put('descProduct', []);
            $itens = new ItensSale();
            $result = $itens->where('id_sale', '=', $id)->join('products', 'products.id', '=', 'itens_sale.id_product')->get(['itens_sale.amount', 'itens_sale.id_sale', 'itens_sale.id_product', 'products.description']);
            return view('details-sale-admin', compact('result'));
        } else if (Session::exists('logado') && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }



    public function analyseSeller()
    {
        if (Session::exists('logado') && Session::exists('admin')) {
            $seller = new Seller();
            $seller = $seller->all();
            return view('list-seller-admin', compact('seller'));
        } else if (Session::exists('logado') && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }

    public function performanceSeller($id)
    {
        if (Session::exists('logado') && Session::exists('admin')) {
            $totalSalesYear = 0;
            $totalSalesMonth = 0;
            $totalSalesDay = 0;
            $valuesYear = 0;
            $valuesMonth = 0;
            $valuesDay = 0;
            $sale = new Sale();
            $date = date('m');
            $date2 = date('Y:m:d');
            $date3 = date('Y');
            strval($date);
            strval($date2);
            strval($date3);
            $resultYear = $sale->where('id_seller', '=', $id)->whereYear('date_sale','=', $date3)->get();
            $resultMonth = $sale->where('id_seller', '=', $id)->whereMonth('date_sale', '=', $date)->get();
            $resultDay = $sale->where('id_seller', '=', $id)->where('date_sale', '=', $date2)->get();
            $totalSalesMonth = sizeof($resultMonth);
            $totalSalesDay = sizeof($resultDay);
            $totalSalesYear = sizeof($resultYear);

            foreach ($resultYear as $item) {
                $valuesYear = $valuesYear + $item->value;
            }

            foreach ($resultMonth as $item) {
                $valuesMonth = $valuesMonth + $item->value;
            }

            foreach ($resultDay as $item) {
                $valuesDay = $valuesDay + $item->value;
            }

            return view('performance-seller-admin', compact(['totalSalesYear', 'valuesYear', 'totalSalesMonth', 'totalSalesDay', 'valuesMonth', 'valuesDay']));
        } else if (Session::exists('logado') && Session::exists('admin') == false) {
            return redirect('/seller');
        } else {
            return redirect('/');
        }
    }
}
