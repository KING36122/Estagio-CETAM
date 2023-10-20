
<button type="button" onclick="adicionarDisciplina()">Adicionar Disciplina</button>

<?php
require_once("config.php");

$sql = 'select * from professor';

$res = $pdo->query($sql);

if ($res) { // Verifique se a consulta foi bem-sucedida
    $qtd = $res->rowCount(); // Use o método rowCount() para contar as linhas retornadas   


if ($qtd > 0){
print "<table class='table table-hover'>";
    print "<tr>";
    print "<th>CPF:</th>";
    print "<th>Nome:</th>";
    print "<th>Ações</th>";
    print "</tr>";
while($row = $res->fetch_object()){
    print "<tr>";
    print "<td>".$row->cpf."</td>";
    print "<td>".$row->nome."</td>";

    print "<td>
    
    <button onclick=\"location.href='?page=editar_professor&id=".$row->cpf."'\" class='btn btn-success'>Editar</button>
    
    <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar_professor&acao=excluir&id=".$row->cpf."'}else{false;}\" class='btn btn-danger'>Excluir</button>
    
    </td>";
    print "</tr>";
}
print "</table>";
} else{
print "<p class='alert alert-danger'>Sem resultados!</p>";
} }

    
?>