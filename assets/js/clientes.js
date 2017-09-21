$(document).ready(function() {
    $('.btnLimpiar').click(function() {
        $('#ficha-cliente div').html("");
        $('#rif-buscar').val("");
        $('#nombre-buscar').val("");
    });
});

function autocompletarCliente(opcion){
    switch (opcion) {
        case 1:
            $.ajax('<?php echo base_url("cliente/autoCompletarPorRif"); ?>',{
            dataType: 'json',
            error: err => {
                console.log('Error en ajax para autocompletar');
            },
            success: function(datos){
                $('input.autocomplete.rif').autocomplete({
                    data: datos,
                    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                    onAutocomplete: function(val) {
                        alert(val);
                    },
                    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                });
            }                            
            });
        break;

        case 2:
            $.ajax('<?php echo base_url("cliente/autoCompletarPorNombre"); ?>',{
                dataType: 'json',
                error: err => {
                    console.log('Error en ajax para autocompletar');
                },
                success: datos => {
                    $('#nombre-buscar').autocomplete({
                        data: datos,
                        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                        onAutocomplete: function(val) {},
                        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                    });
                }                            
            });
        break;

        case 3:
            $.ajax('<?php echo base_url("cliente/autoCompletarPorRif"); ?>',{
                dataType: 'json',
                error: err => {
                    console.log('Error en ajax para autocompletar');
                },
                success: datos => {
                    $('#txtRif').autocomplete({
                        data: datos,
                        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                        onAutocomplete: function(val) {
                            $('#nombreCLienteOrden').load('<?php echo base_url('cliente/ver/') ?>' + val);
                        },
                        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                    });
                }                            
            });
        break;

        case 4:
            $.ajax('<?php echo base_url("vehiculo/autocompletarPlacas"); ?>',{
                dataType: 'json',
                error: err => {
                    console.log('Error en ajax para autocompletar');
                },
                success: datos => {
                    $('#txtPlaca').autocomplete({
                        data: datos,
                        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                        onAutocomplete: function(val) {},
                        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
                    });
                }                            
            });
        break;
    }
}

function activarCampos(){
    $('#tab-info input:disabled').removeAttr('disabled');
    $('#tab-info button[type="submit"]').css('display','block');
    $('#btnDesactivarCampos').css('display','inline-block');

    $('input').each(function(i,el){
        var texto = $(el).val();
        if(texto == 'No tiene') {
            $(el).val('');
        }
    });
}

function desactivarCampos(){
    $('#tab-info input').attr('disabled','disabled');
    $('#tab-info button[type="submit"]').css('display','none');
    $('#btnDesactivarCampos').css('display','none');

    $('input').each(function(i,el){
        var texto = $(el).val();
        if(texto == '') {
            $(el).val('No tiene');
        }
        
    });
}

var verificarCliente = function(rif){
    $.ajax('<?php echo base_url('cliente/verificarCliente/') ?>' + rif,{
        success: dato => {
            if (dato.msj == 1){
                $('#Cod').val(dato.CodigoCliente);
                $('#grupo').val(dato.CodigoGrupo);
                $('#zona').val(dato.Zona);
                $('#nombres').val(dato.Nombre);
                $('#razon').val(dato.RazonSocial);
                $('#direccion-sel').val(dato.Direccion);
                $('#nit').val(dato.NIT);
                $('#documento').val(dato.DocumentoFiscal);
                $('#tlf').val(dato.Telefonos);
                $('#estado').val(dato.Estado);
                $('#ciudad').val(dato.Ciudad);
                $('#municipio').val(dato.Municipio);
                $('h4#cliente_existe').text('El cliente existe');
            } else {
                console.log('El cliente no existe');
            }
        },
        error: function (err){
            console.log(err);
        },
        dataType: 'json'
    });   
}

