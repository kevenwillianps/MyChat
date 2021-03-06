<div class="container mt-3">

    <div class="col-md-6 mx-auto">

        <div class="card shadow-sm">

            <form id="formCliente" role="form" class="card-body">

                <h6 class="card-title">

                    Cadastro de Cliente

                </h6>

                <div class="form-group">

                    <label for="name">

                        Nome

                    </label>

                    <input type="text" class="form-control" id="name" name="name">

                </div>
                
                <div class="form-group">

                    <label for="email">

                        Email

                    </label>

                    <input type="text" class="form-control" id="email" name="email">
                    
                </div>

                <div class="form-group">

                    <label for="password">

                        Senha

                    </label>

                    <input type="password" class="form-control" id="password" name="password">

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <a href="cliente/login/" class="btn btn-primary">

                                Entrar

                            </a>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group text-right">

                            <button type="button" class="btn btn-primary" onclick="sendForm('#formCliente')">

                                Cadastrar

                            </button>

                        </div>

                    </div>

                </div>

                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="CLIENTE"/>
                <input type="hidden" name="ACTION" value="CLIENTE_SAVE"/>

            </form>

        </div>

    </div>

</div>