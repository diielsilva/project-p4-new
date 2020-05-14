<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Carrinho de Compras - Vendedor</title>
</head>

<body class="text-center">
    <header>
        <nav class="navbar-nav navbar-expand-xl bg-light justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link"><button class="btn mt-3 text-primary">Home&nbsp;<span
                                class="fas fa-house-user"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('seller.list.product')}}" class="nav-link"><button
                            class="mt-3 btn text-primary">Listar Produtos&nbsp;<span
                                class="fas fa-clipboard-list"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('seller.search.product')}}" class="nav-link"><button
                            class="btn mt-3 text-primary">Pesquisar Produto&nbsp;<span
                                class="fas fa-search"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('seller.sale')}}" class="nav-link"><button class="btn mt-3 text-primary">Realizar
                            Venda&nbsp;<span class="fas fa-cash-register"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link"><button class="btn text-primary mt-3">Sair&nbsp;<span
                                class="fas fa-sign-out-alt"></span></button></a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <table class="table table-striped table-bordered container mt-5">
            <tr class="bg-primary">
                <td><b class="text-white">ID</b></td>
                <td><b class="text-white">Descrição</b></td>
                <td><b class="text-white">Preço</b></td>
                <td><b class="text-white">QTDE</b></td>
                <td><b class="text-white">Remover</b></td>
            </tr>
            @if (Session::exists('cart'))
            @foreach (Session::get('cart') as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->amount}}</td>
                <td><a href="http://localhost/prototype/seller/cart/remove/{{$item->id}}"><button
                            class="btn btn-primary">Remover &nbsp;<span class="fas fa-trash-alt"></span></button></a>
                </td>
            </tr>
            @endforeach
            @endif
        </table>
        <p> <b>Valor do Carrinho: </b>{{$priceCart}} </p>
        <div>
            <a href="{{route('add.sale')}}"><button class="btn btn-primary mt-2">Confirmar Venda&nbsp;<span
                        class="fas fa-cash-register"></span></button></a>
        </div>
        @if (Session::exists('discountedPrice'))
        <p><b>Valor com Desconto:</b>{{Session::get('discountedPrice')}}</p>
        @endif

        <fieldset class="border mt-5 container">
            <legend class="text-primary text-left p-1 w-auto"><b>Dar Desconto</b></legend>
            <form action="{{route('discount.cart')}}" method="get" class="form-group">
                <div class="mx-auto mt-2 col-4 input-group">
                    <input type="text" name="username" placeholder="Usuário do Administrador"
                        class="form-control border-right-0 border" required>
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fas fa-user "></i></div>
                    </span>
                </div>
                <div class="input-group mx-auto mt-2 col-4">
                    <input type="text" name="password" placeholder="Senha do Administrador"
                        class="form-control border-right-0 border" required>
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fas fa-key"></i></div>
                    </span>
                </div>
                <div class="input-group  mx-auto mt-2 col-4">
                    <input type="number" class="form-control border-right-0 border" name="discount"
                        placeholder="Quantidade do Desconto (%)" max="100" required>
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fas fa-percent"></i></div>
                    </span>
                </div>
                <div><button type="submit" class="btn btn-primary mt-2">Dar Desconto (Todo o Carrinho) &nbsp;
                        <span class="fas fa-hand-holding-usd"></span></button></div>
            </form>
        </fieldset>
        @if (Session::exists('error'))
        <p class="alert alert-danger mx-auto col-4 mt-4">{{Session::get('error')}}</p>
        @endif
        @if (Session::exists('success'))
        <p class="alert alert-success mx-auto colt-4 mt-4">{{Session::get('success')}}</p>
        @endif
    </main>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

</html>