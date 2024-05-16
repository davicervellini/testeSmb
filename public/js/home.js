function calcularIdade(data) {
    var dataAtual = $('#dataAtual').val();
    var diferenca = (new Date(data) - new Date(dataAtual)) / (1000 * 60 * 60 * 24 * 365.25);
    diferenca = (diferenca | 0) * -1;
    $('#idede').val(diferenca + ' Ano(s)');
}

function list() {
    $.ajax({
        url: "./list",
        method: "POST",
        success: function (data) {
            clearDataTable();
            $('#tabela').html(data);
            onDataTable();
        }
    });
}

var alerta = 'Tem certeza que deseja cadastrar o cliente?';

function store() {
    if (confirm(alerta)) {
        $.ajax({
            url: "./store",
            method: "POST",
            data: {
                nome: $('#nome').val(),
                telefone: $('#telefone').val(),
                email: $('#email').val(),
                dtNacimento: $('#dtNacimento').val(),
                img: $('#img').val(),
                id: $('#id').val(),
            },
            success: function (data) {
                alert(data);
                list();
                limparCampos();
            }
        });
    }
}

function editar(id) {
    $.ajax({
        url: "./edit",
        method: "POST",
        data: {
            id: id
        },
        success: function (data) {
            var data = $.parseJSON(data);
            $('#id').val(data.id);
            $('#nome').val(data.nome);
            $('#telefone').val(data.telefone);
            $('#email').val(data.email);
            $('#dtNacimento').val(data.dtNacimento);
            $('#ajaxImgUpload').attr('src', './img/' + data.img);
            $('#img').val(data.img);
            calcularIdade(data.dtNacimento);
            $('#btnCadastro').html('Editar');
            alerta = 'Tem certeza que deseja atualizar o cliente?';
        }
    });
}

function deletar(id) {
    if (confirm('Tem certeza que deseja excluir?')) {
        $.ajax({
            url: "./delete",
            method: "POST",
            data: {
                id: id
            },
            success: function (data) {
                alert(data);
                list();
            }
        });
    }
}

function onFileUpload(input, id) {
    id = id || '#ajaxImgUpload';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(id).attr('src', e.target.result).width(300)
        };
        reader.readAsDataURL(input.files[0]);
    }
}

jQuery(document).ready(function () {
    jQuery('#upload-image-form').on('submit', function (e) {
        e.preventDefault();
        if (jQuery('#file-name').val() == '') {
            if ($('#id').val() != ''){
                store();
            }else{
                alert("Choose File");
                document.getElementById("upload-image-form").reset();
            }
        } else {
            jQuery.ajax({
                url: "./upload",
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function (res) {
                    if (res.success == true) {
                        jQuery('#ajaxImgUpload').attr('src', '');
                        jQuery('#alertMsg').html(res.msg);
                        jQuery('#alertMessage').show();
                        $('#img').val(res.img);
                        store();
                    } else if (res.success == false) {
                        jQuery('#alertMsg').html(res.msg);
                        jQuery('#alertMessage').show();
                    }
                    setTimeout(function () {
                        jQuery('#alertMsg').html('');
                        jQuery('#alertMessage').hide();
                    }, 4000);
                    document.getElementById("upload-image-form").reset();
                }
            });
        }
    });
});

function limparCampos() {
    $('#nome').val('');
    $('#telefone').val('');
    $('#email').val('');
    $('#dtNacimento').val('');
    $('#img').val('');
    $('#id').val('');
    $('#ajaxImgUpload').attr('src', '');
    $('#btnCadastro').html('Cadastrar');
    alerta = 'Tem certeza que deseja cadastrar o cliente?';
}

$(document).ready(function () {
    $("#dtNacimento").datepicker({
        format: "yyyy/mm/dd"
    });

    list();

    jQuery("input.telefone")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if (phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        });
});