<?php
//-----------------------------------------------------------
// CRUD = Create Read Update Delete
//-----------------------------------------------------------

//----------------------------------------------------------
// Criar uma conexão à base dados
//----------------------------------------------------------

$con = mysqli_connect('127.0.0.1', 'root', '', 'recipe_app');

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
    echo "5 - Criar nova categoria\n";
    echo "6 - Listar todas as categorias\n";
    echo "7 - Associar receita a categoria\n";
    echo "8 - Desassociar receita de categoria\n";
    echo "9 - Ver receitas por categoria\n";
    echo "10. Apagar categoria\n";
    echo "11. Criar ingrediente\n";
    echo "12. Listar Ingrediente\n";
    echo "13. Associar ingredientes a Receitas\n";
    echo "14. Atualizar quantidade/unidade\n";
    echo "15. Remover Ingrediente Receita\n";
    echo "16. Mostrar Detalhes Receita\n";
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

        case 5:
            criarCategoria($con);
            break;

        case 6:
            listarCategorias($con);
            break;

        case 7:
            associarReceitaCategoria($con);
            break;

        case 8:
            desassociarReceitaCategoria($con);
            break;

        case 9:
            receitasPorCategoria($con);
            break;

        case 10: apagarCategoria($con);
             break;
        
        case 11: criarIngrediente($con);
             break;
        
        case 12: listarIngredientes($con);
             break;
        
        case 13: associarIngredienteReceita($con);
             break;
        
        case 14: atualizarIngredienteReceita($con);
             break;

        case 15: removerIngredienteReceita($con);
             break;
        
        case 16: mostrarDetalhesReceita($con);
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

// ------------------------------------------------------------------
// Função Criar categoria
// ------------------------------------------------------------------
function criarCategoria($con) {
    echo "\n--- Criar Nova Categoria ---\n";
    $nome_categoria = readline("Nome da categoria: ");

    //criar comando SQL
    $sql = "INSERT INTO categoria (nome_categoria) VALUES ('$nome_categoria')";

    //Executar o comando SQL
    if (mysqli_query($con, $sql)) {
        echo "Categoria criada com sucesso!\n";
    } else {
        echo "Erro ao criar categoria.\n";
    }
}


// ------------------------------------------------------------------
// Função Listar Categorias
// ------------------------------------------------------------------

function listarCategorias($con) {
    echo "\n--- Lista de Categorias ---\n";
    $sql = "SELECT * FROM categoria";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: {$row['id_categoria']} | Nome: {$row['nome_categoria']}\n";
    }
}

// ------------------------------------------------------------------
// Função Associar Receita Categoria
// ------------------------------------------------------------------

function associarReceitaCategoria($con) {
    echo "\n--- Associar Receita a Categoria ---\n";
    listarReceitas($con);
    $id_receita = readline("ID da receita: ");
    listarCategorias($con);
    $id_categoria = readline("ID da categoria: ");
    $sql = "INSERT INTO receitacategoria (id_receita, id_categoria) VALUES ($id_receita, $id_categoria)";
    if (mysqli_query($con, $sql)) {
        echo "Receita associada com sucesso à categoria!\n";
    } else {
        echo "Erro ao associar receita.\n";
    }
}

// ------------------------------------------------------------------
// Função Desassociar Receita na Categoria
// ------------------------------------------------------------------

function desassociarReceitaCategoria($con) {
    echo "\n--- Desassociar Receita de Categoria ---\n";
    $id_receita = readline("ID da receita: ");
    $id_categoria = readline("ID da categoria: ");
    $sql = "DELETE FROM receitacategoria WHERE id_receita = $id_receita AND id_categoria = $id_categoria";
    if (mysqli_query($con, $sql)) {
        echo "Associação removida com sucesso!\n";
    } else {
        echo "Erro ao remover associação.\n";
    }
}

// ------------------------------------------------------------------
// Receitas por Categoria
// ------------------------------------------------------------------

function receitasPorCategoria($con) {
    echo "\n--- Ver Receitas por Categoria ---\n";
    listarCategorias($con);
    $id_categoria = readline("ID da categoria: ");
    $sql = "SELECT r.* FROM receita r
            INNER JOIN receitacategoria rc ON r.id_receita = rc.id_receita
            WHERE rc.id_categoria = $id_categoria";
    $result = mysqli_query($con, $sql);
    echo "\n--- Receitas nesta categoria ---\n";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: {$row['id_receita']} | Nome: {$row['nome']} | Tempo: {$row['tempo_preparacao']} min | Doses: {$row['numero_doses']}\n";
        echo "Descrição: {$row['descricao_preparacao']}\n";
        echo "-----------------------------\n";
    }
}
// -------------------------------------------------------------------
// Apagar Categorias
// ------------------------------------------------------------------
function apagarCategoria($con) {
    echo "\n--- Apagar Categoria ---\n";
    listarCategorias($con);
    $id_categoria = readline("ID da categoria a apagar: ");

    $stmt = $con->prepare("DELETE FROM categoria WHERE id_categoria = ?");
    $stmt->bind_param("i", $id_categoria);
   if ($stmt->execute()) {
        echo "Categoria apagada com sucesso!\n";
    } else {
        echo "Erro ao apagar categoria.\n";
    }

    $stmt->close();
}

// -------------------------------------------------------------------
// Criar Ingrediente
// ------------------------------------------------------------------

function criarIngrediente($con) {
    echo "\n--- Criar Ingrediente ---\n";
    $nome_ingrediente = readline("Nome do ingrediente: ");
    $sql = "INSERT INTO ingrediente (nome_ingrediente) VALUES ('$nome_ingrediente')";
    if (mysqli_query($con, $sql)) {
        echo " Ingrediente criado com sucesso!\n";
    } else {
        echo " Erro ao criar ingrediente.\n";
    }
}

// -------------------------------------------------------------------
// Listar Ingrediente
// ------------------------------------------------------------------

function listarIngredientes($con) {
    echo "\n--- Lista de Ingredientes ---\n";
    $sql = "SELECT * FROM ingrediente";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: {$row['id_ingrediente']} | Nome: {$row['nome_ingrediente']}\n";
    }
}

// -------------------------------------------------------------------
// Associar ingredientes a receitas com quantidade e unidade 
// ------------------------------------------------------------------

function associarIngredienteReceita($con) {
    echo "\n--- Associar Ingrediente à Receita ---\n";
    listarReceitas($con);
    $id_receita = readline("ID da receita: ");
    listarIngredientes($con);
    $id_ingrediente = readline("ID do ingrediente: ");
    $quantidade = readline("Quantidade: ");
    $unidade_medida = readline("Unidade (ex: g, ml): ");

    $sql = "INSERT INTO receitaingrediente (id_receita, id_ingrediente, quantidade, unidade_medida)
            VALUES ($id_receita, $id_ingrediente, $quantidade, '$unidade_medida')";

    if (mysqli_query($con, $sql)) {
        echo " Ingrediente associado com sucesso!\n";
    } else {
        echo " Erro ao associar ingrediente.\n";
    }
}


// -------------------------------------------------------------------
// Atualizar quantidade/unidade de ingredientes de uma receita 
// ------------------------------------------------------------------

function atualizarIngredienteReceita($con) {
    echo "\n--- Atualizar Ingrediente de Receita ---\n";
    $id_receita = readline("ID da receita: ");
    $id_ingrediente = readline("ID do ingrediente: ");
    $quantidade = readline("Nova quantidade: ");
    $unidade_medida = readline("Nova unidade: ");

    $sql = "UPDATE receitaingrediente
            SET quantidade = $quantidade, unidade_medida = '$unidade_medida'
            WHERE id_receita = $id_receita AND id_ingrediente = $id_ingrediente";

    if (mysqli_query($con, $sql)) {
        echo " Ingrediente atualizado com sucesso!\n";
    } else {
        echo " Erro ao atualizar ingrediente.\n";
    }
}

// -------------------------------------------------------------------
// Remover ingredientes de uma receita
// ------------------------------------------------------------------

function removerIngredienteReceita($con) {
    echo "\n--- Remover Ingrediente de Receita ---\n";
    $id_receita = readline("ID da receita: ");
    $id_ingrediente = readline("ID do ingrediente: ");

    $sql = "DELETE FROM receitaingrediente WHERE id_receita = $id_receita AND id_ingrediente = $id_ingrediente";

    if (mysqli_query($con, $sql)) {
        echo " Ingrediente removido com sucesso!\n";
    } else {
        echo " Erro ao remover ingrediente.\n";
    }
}
// -------------------------------------------------------------------
// Remover ingredientes de uma receita
// ------------------------------------------------------------------

function mostrarDetalhesReceita($con) {
    echo "\n--- Detalhes da Receita ---\n";
    listarReceitas($con);
    $id_receita = readline("ID da receita: ");

    $sql = "SELECT r.nome AS nome_receita, r.descricao_preparacao, r.tempo_preparacao, r.numero_doses,
                   i.nome AS nome_ingrediente, ri.quantidade, ri.unidade_medida
            FROM receita r
            LEFT JOIN receitaingrediente ri ON r.id_receita = ri.id_receita
            LEFT JOIN ingrediente i ON ri.id_ingrediente = i.id_ingrediente
            WHERE r.id_receita = $id_receita";

    $result = mysqli_query($con, $sql);
    
    $primeira = true;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($primeira) {
            echo "\nNome: {$row['nome_receita']}\n";
            echo "Descrição: {$row['descricao_preparacao']}\n";
            echo "Tempo: {$row['tempo_preparacao']} min | Doses: {$row['numero_doses']}\n";
            echo "Ingredientes:\n";
            $primeira = false;
        }
        if ($row['nome_ingrediente']) {
            echo " - {$row['quantidade']} {$row['unidade_medida']} de {$row['nome_ingrediente']}\n";
        }
    }
}

// -------------------------------------------------------------------
// Fechar Conexão
// ------------------------------------------------------------------
//

mysqli_close($con);