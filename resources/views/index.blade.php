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
    <title>Home - Login</title>
</head>

<body class="text-center">
    <header>
        <div style="height: 350px" class="mx-auto">
            <img src="images/logo.png" alt="">
        </div>
    </header>
    <main class="mt-5 container">
        <fieldset class="border p-2 mt-5">
            <legend class="w-auto p-1 text-left text-primary"><b>Login</b></legend>
            <form action="{{route('login')}}" class="form-group" method="POST">
                @csrf

                <div class="input-group mt-2 col-4 mx-auto">
                    <input type="text" name="username" class="form-control border-right-0 border" id="user"
                        placeholder="Usuário" required>
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fas fa-user "></i></div>
                    </span>
                </div>

                <div class="col-4 mx-auto input-group mt-2">
                    <input type="password" name="password" class="form-control border-right-0 border  "
                        placeholder="Senha" required>
                    <span class="input-group-append">
                        <div class="input-group-text bg-transparent"><i class="fas fa-key"></i></div>
                    </span>
                </div>
                <div class="col-4 mx-auto mt-2">
                    <select name="option" id="" required class="form-control custom-select">
                        <option value="" disabled selected>Tipo de Usuário</option>
                        <option value="admin">Administrador</option>
                        <option value="seller">Vendedor</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Entrar &nbsp;<span
                        class="fas fa-sign-in-alt"></span></button>
            </form>
        </fieldset>
        @if (Session::exists('error'))
        <p class="alert alert-danger col-4 mx-auto rounded-pill alert-dismissible">{{Session::get('error')}}</p>
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