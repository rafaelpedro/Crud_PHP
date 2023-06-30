<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sistema de Gerenciamentos de Projetos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="estilo.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="topnav">
        <a href="index.php?pagina=colaborador.php">Colaborador</a>
        <a href="index.php?pagina=tarefa.php">Tarefas</a>
        <a href="index.php?pagina=projeto.php">Projetos</a>
    </div>

    <div class="content">
        <!--<h2>CSS Template</h2>
  <p>A topnav, content and a footer.</p>-->
        <?php
        if (
            isset($_GET["pagina"]) &&
            !empty($_GET["pagina"])
        ) {
            $pagina = $_GET["pagina"];
            include($pagina);
        } else {
        }
        ?>
    </div>

    <div class="footer">
        <p>Footer</p>
    </div>

    <script>
        // Get all elements with class="closebtn"
        var close = document.getElementsByClassName("closebtn");
        var i;

        // Loop through all close buttons
        for (i = 0; i < close.length; i++) {
            // When someone clicks on a close button
            close[i].onclick = function() {

                // Get the parent of <span class="closebtn"> (<div class="alert">)
                var div = this.parentElement;

                // Set the opacity of div to 0 (transparent)
                div.style.opacity = "0";

                // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
                setTimeout(function() {
                    div.style.display = "none";
                }, 600);
            }
        }
    </script>

    <script>
        const constCPF = document.getElementById('cpf');
        const form = document.getElementById('checkout_form');

        constCPF.addEventListener("focus", function(event) {
            event.target.style.background = "white"
        }, true);

        constCPF.addEventListener("blur", function(event) {
            var string = document.getElementById('cpf').value;
            var strCPF = string.replace('.', '').replace('-', '').replace('.', '');

            if (TestaCPF(strCPF) != true) {
                alert("CPF inválido")
                event.target.style.background = "#ff00007a"
            } else {
                event.target.style.background = "#00b6ff29"
            }
        }, true);

        function TestaCPF(strCPF) {
            var Soma;
            var Resto;
            Soma = 0;

            if (strCPF == "00000000000") return false;

            for (i = 1; i <= 9; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (11 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10))) return false;

            Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i - 1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11)) Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11))) return false;
            return true;
        }
    </script>
</body>

</html>