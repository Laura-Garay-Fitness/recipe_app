<?php
//-----------------------------------------------------------
// CRUD = Create Read Update Delete
//-----------------------------------------------------------

//----------------------------------------------------------
// Criar uma conexão à base dados
//----------------------------------------------------------

$con = mysqli_connect('127.0.0.1', 'root', '', '5425_laura');

//-----------------------------------------------------------
//verificar se a conexão foi concluida
//------------------------------------------------------------

if ($con) {
    echo "Conexão com a base de dados concluída!\n";
} else {
    echo "Erro na conexão com a base de dados\n";
}

// ----------------------------------------------------------
// Menu Principal
// ----------------------------------------------------------

$fim = false;

while (!$fim) {
    echo "\n ----- MENU RECEITAS -----\n";
    echo "1 - Criar nova receita\n";
    echo "2 - Listar todas as receitas\n";
    echo "3 - Atualizar uma receita\n";
    echo "4 - Apagar uma receita\n";
    echo "0 - Sair\n";

    $opcao = readline("Escolha a opção: ");

    switch ($opcao) {
        case 0:
            echo "Adeus!\n";
            $fim = true;
            break;

        case 1:
            criarReceita($con);
            break;

        case 2:
            listarReceitas($con);
            break;

        case 3:
            atualizarReceita($con);
            break;

        case 4:
            apagarReceita($con);
            break;

        default:
            echo "Opção inválida.\n";
            break;
    }
}

// ------------------------------------------------------
// Função Criar Receita
// ------------------------------------------------------

function criarReceita($con) {
    echo "\n--- Criar Nova Receita ---\n";
    $nome = readline("Nome da receita: ");
    $descricao_preparacao = readline("Descrição: ");
    $tempo_preparacao = readline("Tempo de preparação (minutos): ");
    $numero_doses = readline("Número de doses: ");

// criar comando SQL
    $sql = "INSERT INTO receita (nome, descricao_preparacao, tempo_preparacao, numero_doses)
            VALUES ('$nome', '$descricao_preparacao', $tempo_preparacao, $numero_doses)";

//Executar o comando SQL
    if (mysqli_query($con, $sql)) {
        echo " Receita criada com sucesso!\n";
    } else {
        echo " Erro ao criar receita.\n";
    }
}

// --------------------------------------------------------------
// Função Listar Receitas
// --------------------------------------------------------------

function listarReceitas($con) {
    echo "\n--- Lista de Receitas ---\n";
    $sql = "SELECT * FROM receita";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: {$row['id_receita']} | Nome: {$row['nome']} | Tempo: {$row['tempo_preparacao']} min | Doses: {$row['numero_doses']}\n";
        echo "Descrição: {$row['descricao_preparacao']}\n";
        echo "-----------------------------\n";
    }
}

// ----------------------------------------------------------------
// Função Atualizar Receita
// ----------------------------------------------------------------

function atualizarReceita($con) {
    echo "\n--- Atualizar Receita ---\n";
    listarReceitas($con);
    $id_receita = readline("ID da receita a atualizar: ");

    $verifica = mysqli_query($con, "SELECT * FROM receita WHERE id_receita = $id_receita");
    if (mysqli_num_rows($verifica) == 0) {
        echo " Receita não encontrada.\n";
        return;
    }

    $nome = readline("Novo nome da receita: ");
    $descricao_preparacao = readline("Nova descrição: ");
    $tempo_preparacao = readline("Novo tempo de preparação (min): ");
    $numero_doses = readline("Novo número de doses: ");

    $sql = "UPDATE receita
            SET nome = '$nome', descricao_preparacao = '$descricao_preparacao', tempo_preparacao = $tempo_preparacao, numero_doses = $numero_doses
            WHERE id_receita = $id_receita";
    if (mysqli_query($con, $sql)) {
        echo " Receita atualizada com sucesso!\n";
    } else {
        echo " Erro ao atualizar receita.\n";
    }
}

// ------------------------------------------------------------------
// Função Apagar Receita
// ------------------------------------------------------------------

function apagarReceita($con) {
    echo "\n--- Apagar Receita ---\n";
    listarReceitas($con);
    $id_receita = readline("ID da receita a apagar: ");

    $sql = "DELETE FROM receita WHERE id_receita = $id_receita";
    if (mysqli_query($con, $sql)) {
        echo " Receita apagada com sucesso!\n";
    } else {
        echo " Erro ao apagar receita.\n";
    }
}

// -------------------------------------------------------------------
// Fechar Conexão
// ------------------------------------------------------------------

mysqli_close($con);