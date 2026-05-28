const form = document.getElementById('form');
const successMessage = document.getElementById('success-message');

form.addEventListener('submit', (event) => {
    event.preventDefault(); // impede envio real, por enquanto

    // aqui você poderia adicionar validação ou envio pro servidor

    // mostra a mensagem de sucesso
    successMessage.classList.remove('hidden');

    // limpa os campos do formulário
    form.reset();

    // esconde a mensagem após 3 segundos
    setTimeout(() => {
        successMessage.classList.add('hidden');
    }, 3000);
});
