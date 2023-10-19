
async function deletar_professor(id) {
  const dados = await fetch ('crud-professor.php?id='+id);
console.log(dados)
const resposta = await dados.json();

// if(!resposta['status']){
//   document.getElementById
// }

}