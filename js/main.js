const urlAplicacao = 'http://localhost/MyChat/';

/** Excluir Modal */
function destroyModal(name)
{

    $(name).on('hidden.bs.modal', function () {

        $(name).remove();

    });

}

/** Envio uma requisição para o backend */
function sendForm(form) {

    $.ajax({

        url      : urlAplicacao + "router.php",
        type     : "post",
        dataType : "json",
        data     : $(form).serialize(),

        /** Antes de enviar */
        beforeSend : function () {

            let div  = '<div class="modal hide fade in shadow-sm" id="modalSendForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">';
                div += '	<div class="modal-dialog">';
                div += '		<div class="modal-content">';
                div += '			<div class="modal-header">';
                div += '		        <h5>Processando</h5>';
                div += '		    </div>';
                div += '			<div class="modal-body">';
                div += '                <div class="progress">';
                div += '                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>';
                div += '                </div>';
                div += '			</div>';
                div += '		</div>';
                div += '	</div>';
                div += '</div>';

            /** Carrego o popup **/
            $('body').append(div);

            /** Abro o popup **/
            $('#modalSendForm').modal('show');

        },

        /** Caso tenha sucesso */
        success: function (response)
        {

            /** Delay de resposta */
            window.setTimeout(() => {

                switch (response.cod)
                {

                    /** Verifico se é autenticação */
                    case 'AUTH_START':

                        /** Redireciono a página */
                        location.href = urlAplicacao + response.redirect;
                        break;

                    /** Verifico se é autenticação */
                    case 'AUTH_REGISTER':

                        /** Redireciono a página */
                        location.href = urlAplicacao + response.redirect;
                        break;

                    /** Verifico se é autenticação */
                    case 'AUTH_404':

                        /** Recarrego a página */
                        location.href = urlAplicacao;
                        break;

                    /** Verifico se é autenticação */
                    case 'AUTH_EXIT':

                        /** Redireciono a página */
                        location.href = urlAplicacao + response.redirect;
                        break;

                    case 0:

                        /** Redireciono a página */
                        location.href = urlAplicacao + response.redirect;
                        break;

                    default:

                        /** Abro um popup com os dados **/
                        openPopup(response.title, response.message, response.cod);
                        break;

                }

            }, 1000);

        },

        /** Caso tenha falha */
        error: function (xhr, ajaxOptions, thrownError) {

            /** Delay de resposta */
            window.setTimeout(() => {

                let messages = Array();
                messages.push(xhr.status + ' - ' + ajaxOptions + ' - ' + thrownError);

                /** Abro um popup com os dados **/
                openPopup('Atenção', messages);

            }, 1000);

        }

    });

}

function openPopup(title, message) {

    /** Oculto o popup anterior **/
    $('#modalSendForm').modal('dispose');
    $('#modalSendForm').remove();
    $('.modal-backdrop').remove();
    $('nav').removeAttr('style');
    $('footer').removeAttr('style');

    let div = '<div class="modal hide fade in shadow-sm" id="modalPopUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">';
        div += '	<div class="modal-dialog">';
        div += '		<div class="modal-content">';
        div += '			<div class="modal-header">';
        div += '                <h5 class="modal-title" id="myModalLabel">' + title + '</h5>';
        div += '                <button type="button" class="close" data-dismiss="modal" onclick="destroyModal(\'#modalPopUp\')">&times;</button>';
        div += '            </div>';
        div += '            <div class="modal-body text-break text-justify">';
        div += '            <ul class="list-unstyled">';
        for (let i = 0; i < message.length; i++) {
            div += '                <li class="media">';
            div += '                    <div class="media-body">';
            div += '                        ' + message[i];
            div += '                    </div>';
            div += '                </li>';
        }
        div += '            </ul>';
        div += '            </div>';
        div += '            <div class="modal-footer">';
        div += '                <button type="button" class="btn btn-danger text-white" data-dismiss="modal" onclick="destroyModal(\'#modalPopUp\')"><i class="far fa-times-circle mr-1"></i>Fechar</button>';
        div += '            </div>';
        div += '        </div>';
        div += '    </div>';
        div += '</div>';

    /** Carrego o popup **/
    $('body').append(div);

    /** Abro o popup **/
    $('#modalPopUp').modal('show');

}