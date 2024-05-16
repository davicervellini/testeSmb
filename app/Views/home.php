<?php include "head.php" ?>

<link rel="stylesheet" href="/css/home.css">

<body>
    <nav class="light-blue lighten-1" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a></div>
    </nav>
    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <form method="post" id="upload-image-form" class="upl-img" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col l6">
                        <input placeholder="Nome" id="nome" type="text" class="validate">
                        <label for="nome">Nome</label>
                    </div>
                    <div class="input-field col l6">
                        <input placeholder="Telefone" id="telefone" type="text" class="validate telefone">
                        <label for="telefone">Telefone</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6">
                        <input placeholder="Email" id="email" type="text" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col l3">
                        <input placeholder="Data de nascimento" id="dtNacimento" type="text" class="validate" onchange="calcularIdade(this.value)">
                        <label for="dtNacimento">Data de nascimento</label>
                    </div>
                    <div class="input-field col l3">
                        <input placeholder="Anos" id="idede" type="text" disabled>
                        <label for="idede">Idade</label>
                    </div>
                    <input type="hidden" id="dataAtual" value="<?php print(date('Y/m/d')); ?>">
                    <input type="hidden" id="img" value="">
                    <input type="hidden" id="id" value="">
                </div>
                <div class="row">
                    <div class="col l6">
                        <div class="form-group mb-3">
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Arquivo</span>
                                    <input type="file" name="file_name" multiple="true" id="file-name" onchange="onFileUpload(this);" class="form-control form-control-lg" accept="image/*">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l6">
                        <div id="alertMessage" class="alert alert-warning mb-3" style="display: none">
                            <span id="alertMsg"></span>
                        </div>
                        <div class="text-center">
                            <img style="width: 150px;" class="mb-3" id="ajaxImgUpload" alt="Preview Image" src="" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button id="btnCadastro" type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
                </div>
            </form>
            <div class="row">
                <div id="man" class="col s12">
                    <div class="material-table">
                        <div class="table-header">
                            <span class="table-title">Lista de Clientes</span>
                            <div class="actions">
                                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                            </div>
                        </div>
                        <table id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Data de nascimento</th>
                                    <th>Foto</th>
                                    <th>Editar</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                            <tbody id="tabela">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer orange">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Teste para a Smb Store</h5>
                    <p class="grey-text text-lighten-4">Codigo teste para a vaga de desenvolvedor da Smb Store</p>


                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <font _mstmutation="1">
                    Made by Davi Cervellini SantAnna</font>
            </div>
        </div>
    </footer>

    <script src="/js/datatable.js"></script>
    <script src="/js/home.js"></script>
</body>

</html>