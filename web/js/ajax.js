/**
 * Created by Vitaly on 08.05.2019.
 */
var ajaxResponse;
function ajaxSuccess(){

    if(typeof ajaxResponse != "undefined" && ajaxResponse){//Если не пустое значение
        $.fancybox.close();
        $("#success").fancybox().click();
        $("#success .informer").html(ajaxResponse.success);
        setTimeout(function () {
            $.fancybox.close();
        },5000);

    }else {
        console.log("none");
    }
}


/*
 * Взять за основу вывода ошибок
 * и тщательно продумать вывод
 * */
function setWarnings(selector){

    $(selector + " .error").each(function() {
        this.remove();
    });
    $(selector+' input').each(function() {
        var attribute = this.getAttribute('name'); //вытащили текущий атрибут
        //теперь перебираем все ошибки елси таковые имеются
        if(typeof ajaxResponse.error != "undefined"){
            for(var j in ajaxResponse.error){

                var message = ajaxResponse.error[j];
                var attributeModel = j;

                if(attribute && attribute.search(attributeModel)!=-1){

                        /*Для обычных input*/
                        var span = document.createElement("span");
                        // span.<div class="info">!</div>
                        span.innerHTML = message;
                        var incorrect_html = "<span class=\"incorrect\" style=\"    font-size: 12px;color: #d36363;padding: 0 0 10px 10px;\">"+message+"</span>";
                        // this.parentNode.append(span);
                        // this.parentNode.append(span);
                        this.parentNode.classList.add("error");
                        var div = document.createElement("div");
                        div.classList = "info";
                        div.innerText = "!";
                        this.parentNode.appendChild(div);
                        span = $(this.parentNode).find("span");
                        span[0].innerHTML = message;
                        // span[0].style("display", "block");
                }

            }
        }
    });
}

/*
* Обрабатывает форму регистрации
*
* */
function RegisterForm(event,form){
    event.preventDefault();
    Form = form;
    data = $(Form).serialize();
    cleanForm(Form);
    if (ajax = xhr ("/register", data)){
        ajaxString = JSON.parse(ajax.response); //Парсим ошибки формы
        if (ajaxString!==true){
            setErrors(ajax,Form);
        }else{
            cleanForm(Form);
            //You have successfully registered, an email has been sent to your inbox.
            $.fancybox.close();
            var success = $("#success")[0];
            var title = success.querySelector(".title");
            title.innerText = "You have successfully registered, an email has been sent to your inbox";
            $("#success").fancybox().click();

            var inputs = form.querySelectorAll("input");
            for(var input in inputs){
                var inp = inputs[input];
                if (inp.getAttribute("type")!="submit" && inp.getAttribute("type")!="hidden"){
                    inp.value="";
                }
            }
        }
    }
}

/*
* Получает csrf токен из метатега.
* */
function getCSRFtoken(){
   var  meta = document.querySelector("meta[name=csrf-token]");
   return meta.getAttribute("content");

}

/*
* Обрабатывает отправку формы сброса пороля
*
* @param event - событие клика по кнопки резет
* @param form - текущая форма.
* */
function ResetForm(event,form){
    event.preventDefault();
    Form = form;
    data = $(Form).serialize();
    cleanForm(Form);
    if (ajax = xhr ("/reset", data)){
        ajaxString = JSON.parse(ajax.response); //Парсим ошибки формы
        if (ajaxString!==true){
            setErrors(ajax,Form);
        }else{ //Если письмо удачно отправлено.
            $.fancybox.close();
            var success = $("#success")[0];
            var title = success.querySelector(".title");
            title.innerText = "A message with a link to reset your password has been sent to your email.";
            $("#success").fancybox().click();
        }
    }
}


function ChangePasswordForm(event,form){
    event.preventDefault();
    Form = form;
    data = $(Form).serialize();
    cleanForm(Form);
    if (ajax = xhr ("/user/change-password", data)){
        ajaxString = JSON.parse(ajax.response); //Парсим ошибки формы
        if (ajaxString!==true){
            setErrors(ajax,Form);
        }else{
            $.fancybox.close();
            var success = $("#success")[0];
            var title = success.querySelector(".title");
            title.innerText = "Password was successful change.";
            $("#success").fancybox().click();
        }
    }

}


/*
* Метод отвечающий за обработку формы логина.
*
* @param event - событие клика по кнопке
* @param form - объект формы
* */
function LoginForm(event,form){
    event.preventDefault();
    Form = form;
    data = $(Form).serialize();
    cleanForm(Form);

    if (ajax = xhr ("/login", data)){
        ajaxString = JSON.parse(ajax.response); //Парсим ошибки формы
        if (ajaxString!==true){
            setErrors(ajax,Form);
        }else{
            cleanForm(Form);
            var role = getRole();
            if(role=="agent"){
                document.location.href="/agent/keys"; //редериктем куда надо.
            }else if(role=="unit"){
                document.location.href="/user/index"; //редериктем куда надо.
            }

        }
    }
}

/*
* возвращает роль текущего пользователя.
* */
function getRole(){
     ajax2 = xhr("/get-role");
    return JSON.parse(ajax2.responseText);
}

/*
* Устанавливает ошибки в форме которая соответствует какой либо модели.
*
* @param ajax - объект который получаем от сервера (объект ajax)
* @param Form - объект формы по который кликнули.
* */
function setErrors(ajax, Form) {
    ajax = JSON.parse(ajax.response);
    for(resp in ajax){
        response = ajax[resp]; //конкретная ошибка
        input  = Form.querySelector("."+resp); //ищем поле которое соответствует ошибке
        if(input!=null){
            input.classList.add("error"); //добавляем к полю класс error

            /*добавляем к полю span info*/
            var div = document.createElement("div");
            div.classList = "info";
            div.innerText = "!";
            input.appendChild(div);

            span = input.querySelector("span");//Вставляем в span ошибку модели.
            span.innerText = response[0];
        }
    }
}

/*
 * Очищает форму по которой кликнули.
 *
 * @param form - объект формы по которой кликнули.
* */
function cleanForm(form){
    var error  = form.querySelector(".error");
    if(error!=null){
        error.classList.remove("error");
    }
    var info = form.querySelectorAll(".info");
    if (info.length>0) {
        for (var i = 0 ; i<info.length; i++){
            info[i].remove();
        }
    }
}
function xhr (url, data="") {
    var xhr = new XMLHttpRequest();

    // 2. Конфигурируем его: GET-запрос на URL 'phones.json'
    xhr.open('POST', url, false);
    xhr.setRequestHeader("X-Requested-With","XMLHttpRequest");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 3. Отсылаем запрос
    xhr.send(data);

// 4. Если код ответа сервера не 200, то это ошибка
    if (xhr.status != 200) {
        // обработать ошибку
        console.log( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
        ajaxEr = xhr;
        return null;
    } else {
        // вывести результат
        return xhr; // responseText -- текст ответа.
    }
}
