<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Lista de Produtos - Vendedor</title>
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
    <table class="table table-striped table-bordered container mt-5">
        <tr class="bg-primary">
            <td><b class="text-white">ID&nbsp;<span class="fa fa-address-book"></span></b></td>
            <td><b class="text-white">Descrição&nbsp;<span class="fas fa-clipboard-list"></b></td>
            <td><b class="text-white">Preço&nbsp;<span class="fas fa-money-bill-wave"></b></td>
            <td><b class="text-white">QTDE&nbsp;<span class="fas fa-boxes"></span></b></td>
        </tr>

        @foreach ($result as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->description}}</td>
            <td>R${{$item->price}}</td>
            <td>{{$item->amount}}</td>
        </tr>
        @endforeach
    </table>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

</html>