function criarTabela(dadodescricao, dadocategoria, dadoTAG, dadoid, dadoposicao) {
  // Obtém a referência do contêiner onde a tabela será inserida
  var tabelaContainer = document.getElementById("tabela-container");

  // Verifica se a tabela já foi criada
  var tabela = tabelaContainer.querySelector("table");

  // Se a tabela ainda não existe, cria uma nova
  if (!tabela) {
    tabela = document.createElement("table");

    // Cria o cabeçalho da tabela
    var cabecalho = tabela.createTHead();
    var cabecalhoLinha = cabecalho.insertRow();
    var cabecalhoCelula1 = cabecalhoLinha.insertCell(0);
    var cabecalhoCelula2 = cabecalhoLinha.insertCell(1);
    var cabecalhoCelula3 = cabecalhoLinha.insertCell(2);
    var cabecalhoCelula4 = cabecalhoLinha.insertCell(3);
    var cabecalhoCelula5 = cabecalhoLinha.insertCell(4);

    cabecalhoCelula1.innerHTML = "Descrição";
    cabecalhoCelula2.innerHTML = "Categoria";
    cabecalhoCelula3.innerHTML = "Número de Série";
    cabecalhoCelula4.innerHTML = "ID";
    cabecalhoCelula5.innerHTML = "Posição";

    // Adiciona a tabela ao contêiner
    tabelaContainer.appendChild(tabela);
  }

  // Adiciona uma nova linha ao corpo da tabela
   var corpo = tabela.createTBody();
   var linha = corpo.insertRow();
   var celula1 = linha.insertCell(0);
   var celula2 = linha.insertCell(1);
   var celula3 = linha.insertCell(2);
   var celula4 = linha.insertCell(3);
   var celula5 = linha.insertCell(4);

   celula1.innerHTML = dadodescricao;
   celula2.innerHTML = dadocategoria;
   celula3.innerHTML = dadoTAG;
   celula4.innerHTML = dadoid;
   celula5.innerHTML = dadoposicao;
}

function receberDados(dadoTAG) {
    // Referência para o nó no Realtime Database
    const database = firebase.database();

    // Lendo os dados do nó com o nome fornecido em dadoTAG
    database.ref("numSerie/" + dadoTAG).once('value')
        .then(snapshot => {
            const dados = snapshot.val();

            // Verifica se os dados existem
            if (dados != null) {
                // Passando as informações para a função criarTabela()
                criarTabela(dados.descricao, dados.categoria, dadoTAG, dados.id, dados.posicao);
            } else {
                console.error('Nenhum dado encontrado para a tag fornecida:', dadoTAG);
            }
        })
        .catch(error => {
            console.error('Erro ao acessar dados do Firebase:', error);
        });
}