// Funcionalidade de Filtragem de Produtos

document.addEventListener('DOMContentLoaded', function() {
    const produtoCards = document.querySelectorAll('.produto-card');
    const filtroCheckboxes = document.querySelectorAll('.filtro-checkbox');
    const filtroRadios = document.querySelectorAll('.filtro-radio');
    const btnLimpar = document.querySelector('.btn-limpar-filtros');

    // Função principal de filtragem
    function filtrarProdutos() {
        // Obter filtros selecionados
        const tiposSelecionados = Array.from(document.querySelectorAll('.filtro-checkbox[data-filter="tipo"]:checked'))
            .map(checkbox => checkbox.value);
        
        const precoSelecionado = document.querySelector('.filtro-radio[data-filter="preco"]:checked').value;
        const disponibilidadeSelecionada = document.querySelector('.filtro-radio[data-filter="disponibilidade"]:checked').value;

        // Filtrar cada produto
        produtoCards.forEach(card => {
            let mostrar = true;

            // Filtro por tipo
            const tipoProduto = card.getAttribute('data-tipo');
            if (!tiposSelecionados.includes('todos') && !tiposSelecionados.includes(tipoProduto)) {
                mostrar = false;
            }

            // Filtro por preço
            const precoProduto = parseFloat(card.getAttribute('data-preco'));
            if (precoSelecionado === 'baixo' && precoProduto >= 15) {
                mostrar = false;
            } else if (precoSelecionado === 'medio' && (precoProduto < 15 || precoProduto > 20)) {
                mostrar = false;
            } else if (precoSelecionado === 'alto' && precoProduto <= 20) {
                mostrar = false;
            }

            // Filtro por disponibilidade
            const disponibilidadeProduto = card.getAttribute('data-disponibilidade');
            if (disponibilidadeSelecionada !== 'todos' && disponibilidadeProduto !== disponibilidadeSelecionada) {
                mostrar = false;
            }

            // Aplicar visibilidade
            if (mostrar) {
                card.classList.remove('hidden');
            } else {
                card.classList.add('hidden');
            }
        });
    }

    // Lógica para checkbox "Todos"
    const checkboxTodos = document.querySelector('.filtro-checkbox[value="todos"]');
    const outrosCheckboxes = document.querySelectorAll('.filtro-checkbox[data-filter="tipo"]:not([value="todos"])');

    checkboxTodos.addEventListener('change', function() {
        if (this.checked) {
            outrosCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    });

    outrosCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkboxTodos.checked = false;
            }
            
            // Se nenhum checkbox estiver marcado, marcar "Todos"
            const algumMarcado = Array.from(outrosCheckboxes).some(cb => cb.checked);
            if (!algumMarcado) {
                checkboxTodos.checked = true;
            }
        });
    });

    // Event listeners
    filtroCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filtrarProdutos);
    });

    filtroRadios.forEach(radio => {
        radio.addEventListener('change', filtrarProdutos);
    });

    // Botão limpar filtros
    btnLimpar.addEventListener('click', function() {
        // Resetar checkboxes de tipo
        checkboxTodos.checked = true;
        outrosCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });

        // Resetar radios de preço
        document.querySelector('.filtro-radio[data-filter="preco"][value="todos"]').checked = true;

        // Resetar radios de disponibilidade
        document.querySelector('.filtro-radio[data-filter="disponibilidade"][value="todos"]').checked = true;

        // Aplicar filtragem
        filtrarProdutos();
    });

    // Filtrar na carga inicial
    filtrarProdutos();
});