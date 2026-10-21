<?php
$dataNascimento = $_POST['data_nascimento'] ?? '';
$mensagemErro = '';
$signoEncontrado = null;
$dataFormatada = '';
$simbolos = [
    'Áries' => '♈', 'Touro' => '♉', 'Gêmeos' => '♊', 'Câncer' => '♋',
    'Leão' => '♌', 'Virgem' => '♍', 'Libra' => '♎', 'Escorpião' => '♏',
    'Sagitário' => '♐', 'Capricórnio' => '♑', 'Aquário' => '♒', 'Peixes' => '♓',
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $mensagemErro = 'Use o formulário para informar sua data de nascimento.';
} elseif (!is_string($dataNascimento) || $dataNascimento === '') {
    $mensagemErro = 'Informe uma data de nascimento.';
} else {
    $data = DateTimeImmutable::createFromFormat('!Y-m-d', $dataNascimento);
    $errosData = DateTimeImmutable::getLastErrors();

    if (
        $data === false
        || ($errosData !== false && ($errosData['warning_count'] > 0 || $errosData['error_count'] > 0))
        || $data->format('Y-m-d') !== $dataNascimento
        || $data > new DateTimeImmutable('today')
    ) {
        $mensagemErro = 'A data informada não é válida. Escolha uma data que já aconteceu.';
    } else {
        $dataFormatada = $data->format('d/m/Y');
        $dataUsuario = (int) $data->format('md');
        $signos = simplexml_load_file(__DIR__ . '/signos.xml');

        if ($signos === false) {
            $mensagemErro = 'Não foi possível carregar a lista de signos. Verifique o arquivo signos.xml.';
        } else {
            foreach ($signos->signo as $signo) {
                $inicioPartes = explode('/', (string) $signo->dataInicio);
                $fimPartes = explode('/', (string) $signo->dataFim);
                $inicio = (int) sprintf('%02d%02d', $inicioPartes[1], $inicioPartes[0]);
                $fim = (int) sprintf('%02d%02d', $fimPartes[1], $fimPartes[0]);

                if ($inicio <= $fim) {
                    $estaNoPeriodo = $dataUsuario >= $inicio && $dataUsuario <= $fim;
                } else {
                    $estaNoPeriodo = $dataUsuario >= $inicio || $dataUsuario <= $fim;
                }

                if ($estaNoPeriodo) {
                    $signoEncontrado = $signo;
                    break;
                }
            }

            if ($signoEncontrado === null) {
                $mensagemErro = 'Não encontramos um signo para essa data. Confira as datas no arquivo signos.xml.';
            }
        }
    }
}
?>
<?php include __DIR__ . '/layouts/header.php'; ?>
<body class="<?= $mensagemErro === '' ? 'pagina-resultado' : 'pagina-formulario' ?>">
    <main class="container py-5">
        <section class="cartao-signos <?= $mensagemErro === '' ? 'cartao-resultado' : '' ?> mx-auto">
            <?php if ($mensagemErro !== ''): ?>
                <div class="alert alert-warning" role="alert">
                    <?= htmlspecialchars($mensagemErro, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php else: ?>
                <?php $nomeSigno = (string) $signoEncontrado->signoNome; ?>
                <p class="texto-pequeno mb-3">Nascido em <?= htmlspecialchars($dataFormatada, ENT_QUOTES, 'UTF-8') ?></p>
                <?php if (isset($simbolos[$nomeSigno])): ?>
                    <div class="simbolo-signo" aria-hidden="true"><?= $simbolos[$nomeSigno] ?>&#xFE0E;</div>
                <?php endif; ?>
                <h1 class="nome-signo mb-4"><?= htmlspecialchars($nomeSigno, ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="descricao-signo mb-5">
                    <?= htmlspecialchars((string) $signoEncontrado->descricao, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <a href="index.php" class="btn <?= $mensagemErro === '' ? 'btn-outline-light' : 'btn-outline-primary' ?>">Voltar</a>
        </section>
    </main>
</body>
</html>
