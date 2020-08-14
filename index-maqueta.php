<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de camiseta</title>
    <link rel="stylesheet" href="assets/css/styles.css"/>
</head>
<body>
<div id="container">
    <!-- CABECERA -->
    <header id="header">
        <div id="logo">
            <img src="assets/img/camiseta.png" alt="camiseta"/>
            <a href="index.php">
                Tienda de camiseta
            </a>
        </div>
    </header>
    <!-- MENU-->
    <nav id="menu">
        <ul>
            <li>
                <a href="">Inicio</a>
            </li>
            <li>
                <a href="">Inicio</a>
            </li>
            <li>
                <a href="">Inicio</a>
            </li>
            <li>
                <a href="">Inicio</a>
            </li>
        </ul>
    </nav>
    <!-- CONTENIDO -->
    <div id="content">
        <!-- BARRA LATERAL-->
        <aside id="lateral">
            <h3>Entrar a la web</h3>
            <div id="login" class="block-aside">
                <form action="#" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email"/>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password"/>
                    <input type="submit"value="Enviar"/>
                </form>
                <ul>
                <li><a href="#">Mis pedidos</a></li>
                <li><a href="#">Gestionar pedidos</a></li>
                <li><a href="#">Gestionar categorias</a></li>
                </ul>
            </div>
        </aside>
        <!-- CONTENIDO PRINCIPAL -->
        <div id="central">
        <h1>Productos destacados</h1>
            <div class="product">
                <img src="assets/img/camiseta.png" alt="camiseta"/>
                <h2>Camiseta axul</h2>
                <p>500 pesos</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/camiseta.png" alt="camiseta"/>
                <h2>Camiseta axul</h2>
                <p>500 pesos</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/camiseta.png" alt="camiseta"/>
                <h2>Camiseta axul</h2>
                <p>500 pesos</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/camiseta.png" alt="camiseta"/>
                <h2>Camiseta axul</h2>
                <p>500 pesos</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/camiseta.png" alt="camiseta"/>
                <h2>Camiseta axul</h2>
                <p>500 pesos</p>
                <a href="" class="button">Comprar</a>
            </div>
            <div class="product">
                <img src="assets/img/camiseta.png" alt="camiseta"/>
                <h2>Camiseta axul</h2>
                <p>500 pesos</p>
                <a href="" class="button">Comprar</a>
            </div>
        </div>   
    </div>
    <!-- PIE DE PAGINA -->
        <footer id="footer">
            <p>Desarrollado por Daniel Valenzuela &copy; <?= date("Y")?></p>
        </footer>
</div>
</body>
</html>