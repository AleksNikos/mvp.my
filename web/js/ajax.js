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