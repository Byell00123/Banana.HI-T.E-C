// src/template/static/administradores/js/lista_u_adm.js
// Seleciona/desmarca todos os checkboxes
document.getElementById('selectAll').addEventListener('change', function () {
    var checkboxes = document.querySelectorAll('.userCheckbox');
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = document.getElementById('selectAll').checked;
    });
});

// Verifica se todos os checkboxes estão marcados e atualiza o estado do checkbox do cabeçalho
document.querySelectorAll('.userCheckbox').forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
        var checkboxes = document.querySelectorAll('.userCheckbox');
        var selectAll = document.getElementById('selectAll');

        // Se todos os checkboxes estiverem marcados, marca o checkbox do cabeçalho
        selectAll.checked = Array.from(checkboxes).every(function (checkbox) {
            return checkbox.checked;
        });
    });
});