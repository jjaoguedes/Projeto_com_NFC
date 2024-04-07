document.getElementById('startNFC').addEventListener('click', async () => {
  try {
    const reader = new NDEFReader();
    await reader.scan();
    
    reader.onreading = event => {
    const message = event.message;
    for (const record of message.records) {
    //document.body.innerHTML += '<p>' + record.recordType + '</p>';
    //document.body.innerHTML += '<p>' + record.mediaType + '</p>';
    //document.body.innerHTML += '<p>' + record.id + '</p>';
    if (record.recordType === "text") {
        const textDecoder = new TextDecoder(record.encoding);
        //document.body.innerHTML += textDecoder.decode(record.data);
        //criarTabela(textDecoder.decode(record.data));
        receberDados(textDecoder.decode(record.data));
    } else {
        // O código dentro deste bloco será executado quando recordType não for "text".
        console.log("Não é um registro de texto.");
    }
}
      //document.body.innerHTML += '<p>' + tagData + '</p>';
      //reader.stop();
    };
  } catch (error) {
    console.error('Erro ao iniciar a leitura NFC:', error);
  }
});