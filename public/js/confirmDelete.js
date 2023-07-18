function confirmDelete(event, nome, formId) {
    event.preventDefault(); // Prevenir envio do formulário padrão


    Swal.fire({
        title: 'Tem certeza que deseja excluir ' + nome + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-excluir-' + formId).submit(); // Enviar formulário específico após confirmação
        }
    });
}
