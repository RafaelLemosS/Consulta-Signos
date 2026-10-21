<?php
$dataMaxima = date('Y-m-d');
?>
<?php include __DIR__ . '/layouts/header.php'; ?>
<body class="pagina-formulario">
    <main class="container py-5">
        <section class="cartao-signos mx-auto">
            <p class="texto-pequeno mb-2">&#10022; Zodíaco &#10022;</p>
            <h1 class="titulo-signos mb-3">Descubra seu signo</h1>
            <hr class="divisor">
            <p class="text-secondary mb-4">
                Conte quando você nasceu e veja o que as estrelas dizem sobre você.
            </p>

            <form id="signo-form" method="POST" action="show_zodiac_sign.php">
                <div class="mb-3">
                    <label for="data_nascimento" class="form-label d-block">Data de nascimento</label>
                    <input
                        type="date"
                        class="form-control"
                        id="data_nascimento"
                        name="data_nascimento"
                        max="<?= htmlspecialchars($dataMaxima, ENT_QUOTES, 'UTF-8') ?>"
                        required
                    >
                </div>
                <button type="submit" class="btn btn-primary w-100">Descobrir</button>
            </form>
        </section>
    </main>
</body>
</html>
