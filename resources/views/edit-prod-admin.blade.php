<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Editar Produto - Admin</title>
</head>

<body class="text-center">
    <header>
        <nav class="navbar navbar-expand-xl bg-light justify-content-center">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link"><button class="btn mt-3 text-primary"
                            data-toggle="tooltip" title="Home" data-placement="bottom">Home&nbsp;<span
                                class="fas fa-house-user"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.add')}}" class="nav-link"><button class="btn mt-3 text-primary">Cadastrar
                            Produto &nbsp;<span class="fas fa-briefcase"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.list.products')}}" class="nav-link"><button
                            class="btn mt-3 text-primary">Menu de Produtos&nbsp;<span
                                class="fas fa-clipboard-list"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.search')}}" class="nav-link"><button class="btn mt-3 text-primary">Pesquisar
                            Produto&nbsp;<span class="fas fa-search"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list.sales.admin')}}" class="nav-link"><button class="btn mt-3 text-primary">Lista
                            de Vendas&nbsp;<span class="fas fa-chart-line"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('list.seller')}}" class="nav-link"><button class="btn mt-3 text-primary">Análise de
                            Vendedores&nbsp;<span class="fas fa-chart-pie"></span></button></a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link"><button class="btn mt-3 text-primary">Sair&nbsp;<span
                                class="fas fa-sign-out-alt"></span></button></a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="container mt-5">
        <fieldset class="border p-2">
            <legend class="text-primary text-left p-1 w-auto"><b>Editar Produto</b></legend>
            <form action="http://localhost/prototype/admin/update/product/{{$id}}" method="POST" class="form-group">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="mt-2 col-4 mx-auto input-group">
                    <input type="text" name="description" placeholder="Descrição"
                        class="form-control border-right-0 border" id="">
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fas fa-file-alt"></i></div>
                    </span>
                </div>
                <div class="mt-2 col-4 mx-auto input-group">
                    <input type="number" name="price" placeholder="Preço" step="0.01"
                        class="form-control border-right-0 border " id="">
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fas fa-piggy-bank"></i></div>
                    </span>
                </div>
                <div class="input-group col-4 mx-auto mt-2">
                    <input type="number" name="amount" placeholder="Quantidade"
                        class="form-control border-right-0 border" id="">
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fas fa-boxes"></i></div>
                    </span>
                </div>
                <button type="submit" class="btn btn-primary  mt-2">Confirmar &nbsp; <span
                        class="fas fa-check"></span></button>
            </form>
        </fieldset>
        <a href="{{route('admin.list.products')}}"><button class="btn btn-primary  mt-3">Voltar &nbsp;<span
                    class="fas fa-reply"></span></button></a>


        @if (Session::exists('error'))
        <p class="alert alert-danger col-4 mx-auto mt-3">{{Session::get('error')}}</p>
        @endif
        @if (Session::exists('success'))
        <p class="alert alert-success col-4 mx-auto mt-3">{{Session::get('success')}}</p>
        @endif
    </main>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

</html>