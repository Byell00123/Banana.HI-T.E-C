document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formPesquisa').addEventListener('submit', function(event) {
        event.preventDefault();
        realizarPesquisa();
    });

    document.getElementById('inputPesquisa').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            realizarPesquisa();
        }
    });

    document.querySelector('.menuTopo ul li.pesquisa button[type="submit"]').addEventListener('click', function(event) {
        event.preventDefault();
        realizarPesquisa();
    });
});

function realizarPesquisa() {
    // Implemente a lógica da pesquisa aqui
    var termoPesquisa = document.getElementById('inputPesquisa').value;
    alert('Pesquisa realizada para: ' + termoPesquisa);
}