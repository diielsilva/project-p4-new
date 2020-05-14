<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <title>Lista de Vendas - Admin</title>
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
    </header>
    <main class="mt-5">
        <fieldset class="border p-2 container">
            <legend class="w-auto p-1 text-left text-primary"><b>Ordenar Vendas</b></legend>
            <form action="{{route('order.sale.admin')}}">
                <div class=" mx-auto col-4 mt-2"><select name="order" required class="form-control custom-select">
                        <option value="" disabled selected>Ordenar Por</option>
                        <option value="month">Vendas do Mês (Atual)</option>
                        <option value="day">Vendas de Hoje</option>
                    </select></div>
                <div>
                    <button type="submit" class="btn btn-primary mt-2">Ordenar &nbsp;<span
                            class="fa fa-list"></span></button>
                </div>
        </fieldset>
        </form>

        <table class="table table-striped mt-2 table-bordered container">
            <tr class="bg-primary">
                <td><b class="text-light">ID Venda&nbsp;<span class="fa fa-address-book"></span></b></td>
                <td><b class="text-light">ID Vendedor&nbsp;<span class="fa fa-address-card"></span></b></td>
                <td><b class="text-light">Data da Venda&nbsp;<span class="far fa-calendar-alt"></span></b></td>
                <td><b class="text-light">Valor&nbsp;<span class="fas fa-money-bill-wave"></span></b></td>
                <td><b class="text-light">Forma PGMT.&nbsp;<span class="fas fa-hand-holding-usd"></span></b></td>
                <td><b class="text-light">Detalhes&nbsp;<span class="fas fa-eye"></span></b></td>
            </tr>
            @foreach ($result as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->id_seller}}</td>
                <td>{{$item->date_sale}}</td>
                <td>R${{$item->value}}</td>
                <td>{{$item->payment}}</td>
                <td><a href="http://localhost/prototype/admin/sale/{{$item->id}}/details"><button
                            class="btn btn-primary">Detalhes &nbsp;<span class="fas fa-eye"></span></button></a></td>
            </tr>
            @endforeach
        </table>
        @if (Session::exists('valueSales'))
        <p><b>Total das Vendas: </b>R${{Session::get('valueSales')}}</p>
        @endif
        
    </main>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

</html>