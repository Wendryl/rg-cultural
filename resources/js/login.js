window.login = (event) => {
    event.preventDefault();

    const form = new FormData(document.querySelector("form"));

    fetch("/api/login", {
        body: form,
        method: "POST",
    })
        .then((res) => {
            if (res.status === 401)
                throw new Error("Usuário ou senha incorretos");

            return res.json();
        })
        .then((res) => {
            sessionStorage.setItem('tkn', res.token);
            sessionStorage.setItem('user_data', JSON.stringify(res.user));
            alert('Usuário autenticado com sucesso!');
            window.location.replace('home');
        })
        .catch((err) => alert(err.message));
};
