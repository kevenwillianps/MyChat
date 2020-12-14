<div class="container mt-3">

    <div class="col-md-6 mx-auto">

        <h5 class="animate__animated animate__fadeIn">

            <strong>Cliente</strong> - <?php echo utf8_decode($_SESSION['CLIENTE_NOME'])?>
            <input type="hidden" name="name" id="name" value="<?php echo utf8_decode($_SESSION['CLIENTE_NOME'])?>">
            <input type="hidden" id="cliente_id" value="<?php echo utf8_decode($_SESSION['CLIENTE_ID'])?>">
            <input type="hidden" id="cliente_nome" value="<?php echo utf8_decode($_SESSION['CLIENTE_NOME'])?>">

        </h5>

        <div class="card shadow-sm animate slideIn">

            <div class="card-body">

                <h6 class="card-title">

                    Chat de Atendimento

                </h6>

                <hr>

                <ul class="list-unstyled chat-area" id="messageList"></ul>

            </div>

            <form role="form" id="formMessage" class="card-footer bg-transparent">

                <div class="input-group">

                    <input type="text" class="form-control" placeholder="Mensagem" aria-label="Mensagem" aria-describedby="button-addon2" name="message" id="message">

                    <div class="input-group-append">

                        <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="sendMessage()">

                            <i class="far fa-paper-plane"></i>

                        </button>

                    </div>

                </div>

                <input type="hidden" name="CLIENTE_ID" id="CLIENTE_ID" value="<?php echo utf8_decode($_SESSION['CLIENTE_ID'])?>"/>
                <input type="hidden" name="CLIENTE_NAME" id="CLIENTE_NAME" value="<?php echo utf8_decode($_SESSION['CLIENTE_NOME'])?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="MESSAGE"/>
                <input type="hidden" name="ACTION" value="MESSAGE_SAVE"/>

            </form>

        </div>

        <form role="form" id="formClienteLogout" class="animate slideIn">

            <button type="button" class="btn btn-danger mt-3 w-100" onclick="sendForm('#formClienteLogout')">

                <i class="fas fa-sign-out-alt mr-1"></i>Sair

            </button>

            <input type="hidden" name="FOLDER" value="ACTION"/>
            <input type="hidden" name="TABLE" value="CLIENTE"/>
            <input type="hidden" name="ACTION" value="CLIENTE_LOGOUT"/>

        </form>

        <button type="button" class="btn btn-danger mt-3 w-100 slideIn" onclick="desconect()">

            <i class="fas fa-sign-out-alt mr-1"></i>Desconectar

        </button>

    </div>

</div>