<div class="container mt-3">

    <div class="col-md-6 mx-auto">

        <h5 class="animate__animated animate__fadeIn">

            <strong>Usuário</strong> - <?php echo utf8_decode($_SESSION['USUARIO_NOME'])?>
            <input type="hidden" name="name" id="name" value="<?php echo utf8_decode($_SESSION['USUARIO_NOME'])?>">

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

                        <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="sendMessage('#formMessage')">

                            <i class="far fa-paper-plane"></i>

                        </button>

                    </div>

                </div>

                <input type="hidden" name="cliente_id" id="_cliente_id" value=""/>
                <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo utf8_decode($_SESSION['USUARIO_ID'])?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="MESSAGE"/>
                <input type="hidden" name="ACTION" value="MESSAGE_SAVE"/>

            </form>

            <div class="card-footer bg-transparent">

                <select name="room" id="room" class="custom-select" onchange="connect()">

                    <option value="0">

                        Selecione

                    </option>
                    
                </select>

            </div>

        </div>

        <form role="form" id="formUsuarioLogout" class="animate__animated animate__fadeIn">

            <button type="button" class="btn btn-danger mt-3 w-100" onclick="sendForm('#formUsuarioLogout')">

                <i class="fas fa-sign-out-alt mr-1"></i>Sair

            </button>

            <input type="hidden" name="FOLDER" value="ACTION"/>
            <input type="hidden" name="TABLE" value="USUARIO"/>
            <input type="hidden" name="ACTION" value="USUARIO_LOGOUT"/>

        </form>

    </div>

    <div class="col-md-6 mx-auto mt-3">

        <ul class="list-group shadow-sm" id="clientList"></ul>

    </div>

</div>