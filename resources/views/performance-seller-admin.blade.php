<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Performance do Vendedor - Admin</title>
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
    <main>
        <table class="table table-bordered table-striped container mt-5">
            <tr>
                <td class="bg-primary text-white"><b>Total de Vendas do Ano&nbsp;<span class="fas fa-boxes"></span></b></td>
                <td class="bg-primary text-white"><b>Valor das Vendas do Ano&nbsp;<span class="fas fa-money-bill-wave"></span></b></td>
                <td class="bg-primary text-white"><b>Total de Vendas do Mês&nbsp;<span class="fas fa-boxes"></span></b></td>
                <td class="bg-primary text-white"><b>Valor das Vendas do Mês&nbsp;<span class="fas fa-money-bill-wave"></span></b></td>
                <td class="bg-primary text-white"><b>Total das Vendas do Dia&nbsp;<span class="fas fa-boxes"></span></b></td>
                <td class="bg-primary text-white"><b>Valor das Vendas do Dia&nbsp;<span class="fas fa-money-bill-wave"></span></b></td>
            </tr>
            <tr>
                <td>{{$totalSalesYear}}</td>
                <td>R${{$valuesYear}}</td>
                <td>{{$totalSalesMonth}}</td>
                <td>R${{$valuesMonth}}</td>
                <td>{{$totalSalesDay}}</td>
                <td>R${{$valuesDay}}</td>
            </tr>
        </table>
    </main>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>

</html>