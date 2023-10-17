    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Login</title>

    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #465573;">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">SIGPRO-CETAM</a>

            </button>
            
    </div>
    </div>
    </nav>

    <div class="container mt-4">
        <div class="row align-items-center"> 
        <div class="col-md-10 mx-auto col-lg-5">
        <form  class="p-4 p-md-5 border rounded-3 bg-light" action="login.php" method="POST">
            <h1>Login</h1>
            <div class=" mb-3">
                <label for="inputEmail" >E-mail</label>
                <input name="email" type="email" class="form-control" id="inputEmail" placeholder="exemplo@exemplo.com"/>
                </div>

                <div class=" mb-3">
                    <label for="inputSenha">Senha</label>
                    <input name="senha" type="password" id="inputSenha" class="form-control" >
                    
                </div>
                
                <div class=" mb-3">                   
                    <input  class="btn btn-primary" style="background-color: #4C5D73; border: 0;" type="submit" name="submit" value="Entrar">
                    </div>
                </form>
    </div>
    </div>
    </div>
                
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    </html>