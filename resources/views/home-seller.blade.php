<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Home - Vendedor</title>
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
                    <a href="{{route('seller.list.product')}}" class="nav-link"><button class="mt-3 btn text-primary">Listar Produtos&nbsp;<span
                                class="fas fa-clipboard-list"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('seller.search.product')}}" class="nav-link"><button class="btn mt-3 text-primary">Pesquisar Produto&nbsp;<span
                                class="fas fa-search"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('seller.sale')}}" class="nav-link"><button class="btn mt-3 text-primary">Realizar Venda&nbsp;<span
                                class="fas fa-cash-register"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link"><button class="btn text-primary mt-3">Sair&nbsp;<span
                                class="fas fa-sign-out-alt"></span></button></a>
                </li>
            </ul>
        </nav>
    </header>
    <main>

        <div class="mt-3">
            <img src="images/logo.png" alt="" class="">
        </div>
        {{-- <div>
            <a href="{{route('seller.list.product')}}"><button class="btn btn-primary  mt-2 col-3">Listar Produtos
            &nbsp;<span class="fas fa-clipboard-list"></span></button></a>
        </div>
        <div>
            <a href="{{route('seller.search.product')}}"><button class="btn btn-primary col-3 mt-2">Pesquisar
                    Produto &nbsp;<span class="fas fa-search"></span></button></a>
        </div>
        <div>
            <a href="{{route('seller.sale')}}"><button class="btn btn-primary col-3 mt-2">Realizar Venda &nbsp;<span
                        class="fas fa-cash-register"></span></button></a>
        </div>
        <div>
            <a href="{{route('logout')}}"><button class="btn btn-primary  mt-2">Sair
                    &nbsp;<span class="fas fa-sign-out-alt"></span></button></a>
        </div> --}}
    </main>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

</html>