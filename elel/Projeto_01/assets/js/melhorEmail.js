const button = document.querySelector('submit');

const handleSubmit = (event) => {
    event.preventDefault();

    const email = document.querySelector('input[name=email]').value;

    fetch('https://sheetdb.io/api/v1/lfuqazsh1crrp', {
        method: 'post',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            email
        }),
    });
    
    alert('E-mail enviado com sucesso!');
    //Redirecionar para página ''
    window.location.href = '';
}

document.querySelector('form').addEventListener('submit', handleSubmit)