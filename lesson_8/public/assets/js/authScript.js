
//отправляем данные аутентификации
$( document ).ready(function(){
    $(".send_log_form").click(function(){
        let formLogin = $("#login").serializeArray();
        if(!Validate(formLogin, "#login")) {
            return false;
        }
        let requestUrl = $("#login").serialize();
        $.ajax({
            method: "GET",
            url: "/login/auth",
            data: requestUrl,
            success: function(data){
                let response = JSON.parse(data);
                if (response === true) {
                    location="/cabinet";
                }
                renderErrors(response, "#login");
            }
        })
    });
});

//отправляем данные регистрации
$(document).ready(function(){
    $(".send_reg_form").click(function(){
        let formLogin = $("#register").serializeArray();
        if(!Validate(formLogin, "#register")) {
            return false;
        }
        let requestUrl = $("#register").serialize();
        $.ajax({
            method: "POST",
            url: "/login/reg",
            data: requestUrl,
            success: function(data){
                let response = JSON.parse(data);
                if (response === true) {
                    location="/cabinet";
                }
                console.log(response);
                renderErrors(response, "#register");
            }
        })
    });
});

function Validate(array, idForm) {
    let errors = '';
    for (let i = 0; i < array.length; i++) {
        for (let key in array[i]) {
            let name = array[i]['name'];
            let value = array[i]['value'];
            if (value === '') {
                errors = name;
                break
            }
        }
    }
    if (errors === 'user[email]') {
        $(`${idForm} .EmailHelpBlock`).html('<div>Заполните поле</div>');
        return false;
    }
    if (errors === 'user[password]') {
        $(`${idForm} .PasswordHelpBlock`).html('<div>Заполните поле</div>');
        return false;
    }
    return true;
}

function renderErrors(objErrors, idForm) {
    $(`${idForm} .EmailHelpBlock div`).remove();
    $(`${idForm} .PasswordHelpBlock div`).remove();
    for (let key in objErrors) {
        if (key === 'email') {
            $(`${idForm} .EmailHelpBlock`).html(`<div>${objErrors[key]}</div>`);
        }
        if (key === 'password') {
            $(`${idForm} .PasswordHelpBlock`).html(`<div>${objErrors[key]}</div>`);
        }
    }
}
