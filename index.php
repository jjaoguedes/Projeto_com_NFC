<?php 



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leitura de Tag NFC</title>
</head>
<body>

<button id="startNFC">Iniciar Leitura NFC</button>
<div id="tagInfo"></div>

<script>
document.getElementById('startNFC').addEventListener('click', async () => {
  try {
    const reader = new NDEFReader();
    await reader.scan();
    
    reader.onreading = event => {
      const tagData = event.message.records.map(record => record.data);
      displayTagInfo(true, tagData);
      reader.stop();
    };
  } catch (error) {
    displayTagInfo(false, error.message);
    console.error('Erro ao iniciar a leitura NFC:', error);
  }
});

function displayTagInfo(success, data) {
  const tagInfoDiv = document.getElementById('tagInfo');
  
  if (success) {
    tagInfoDiv.innerHTML = "<p>Leitura bem-sucedida. Dados da tag: " + data.join(", ") + "</p>";
  } else {
    tagInfoDiv.innerHTML = "<p>Erro ao ler a tag. Detalhes: " + data + "</p>";
  }
}
</script>

</body>
</html>

