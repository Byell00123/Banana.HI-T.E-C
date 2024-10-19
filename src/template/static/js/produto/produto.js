// Variável para armazenar o HTML original do select
var originalSelectHTML = '';

// Função para alternar entre input e select
function toggleInputType() {
    var checkbox = document.getElementById('toggleInput');
    var container = document.getElementById('inputContainer');
    var labelInput = document.querySelector('.label-input');
    var labelSelect = document.querySelector('.label-select');

    if (checkbox.checked) {
        // Se o checkbox for marcado, exibe o campo de input e ajusta as cores
        container.innerHTML = '<input type="text" class="input novo_tipo" name="tipo_produto" placeholder="Digite o tipo de produto" required>';
        labelInput.style.color = "#00bfff";  // Cor do label do input quando ativo
        labelSelect.style.color = "gray";    // Cor do label do select quando inativo
    } else {
        // Se o checkbox for desmarcado, restaura o HTML original do select
        container.innerHTML = originalSelectHTML;
        labelSelect.style.color = "#ff007f";  // Cor do label do select quando ativo
        labelInput.style.color = "gray";      // Cor do label do input quando inativo
    }
}

// Função que roda quando a página é carregada para ajustar o estado inicial
window.onload = function() {
    var selectElement = document.querySelector('.tipo_produto');
    originalSelectHTML = selectElement.parentElement.innerHTML; // Salva o HTML original do select no container
    toggleInputType(); // Chama a função para configurar o estado inicial
};

// Cria uma nova instância do Cleave.js para formatar o input de preço
var cleave = new Cleave('input.preco', {
    numeral: true, // Ativa o modo numeral para que o campo funcione como um campo numérico formatado
    numeralThousandsGroupStyle: 'thousand', // Define o estilo de agrupamento de milhares (ex: 1.000,00)
    numeralDecimalMark: ',', // Define a vírgula como separador decimal (ex: 100,00)
    delimiter: '.', // Define o ponto como delimitador de milhares (ex: 1.000)
    numeralDecimalScale: 2, // Número de casas decimais (ex: 100,00)
    numeralIntegerScale: 6, // Número máximo de dígitos inteiros permitidos antes da vírgula (ex: 999.999)
    prefix: '', // Define o prefixo (pode ser um símbolo como 'R$' se necessário)
    rawValueTrimPrefix: true, // Remove o prefixo ao obter o valor bruto (sem o prefixo)
    numericOnly: true, // Permite apenas a entrada de números (sem letras ou caracteres especiais)
    padFractionalZeros: true // Adiciona zeros após a vírgula para completar as casas decimais (ex: 100 se torna 100,00)
});

var cleave = new Cleave('input.peso', {
    numeral: true, // Ativa o modo numeral para que o campo funcione como um campo numérico formatado
    numeralThousandsGroupStyle: 'thousand', // Define o estilo de agrupamento de milhares (ex: 999.999,99)
    numeralDecimalMark: ',', // Define a vírgula como separador decimal (ex: 100,00)
    delimiter: '.', // Define o ponto como delimitador de milhares (ex: 1.000)
    numeralDecimalScale: 2, // Número de casas decimais (ex: 100,00)
    numeralIntegerScale: 3, // Número máximo de dígitos inteiros permitidos antes da vírgula (ex: 999.999)
    prefix: '', // Define o prefixo (pode ser um símbolo como 'R$' se necessário)
    rawValueTrimPrefix: true, // Remove o prefixo ao obter o valor bruto (sem o prefixo)
    numericOnly: true, // Permite apenas a entrada de números (sem letras ou caracteres especiais)
    padFractionalZeros: true // Adiciona zeros após a vírgula para completar as casas decimais (ex: 100 se torna 100,00)
});

const inputQtd = document.querySelector('.input.qtd');

inputQtd.addEventListener('input', function () {
    // Remove qualquer caractere que não seja dígito
    let value = this.value.replace(/\D/g, '');
    
    // Formata o número com ponto como separador de milhar
    if (value.length > 3) {
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Limita a entrada a 7 caracteres
    if (value.length > 7) {
        value = value.slice(0, 7);
    }

    // Atualiza o valor do input
    this.value = value;
});
