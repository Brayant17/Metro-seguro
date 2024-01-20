import { address } from './config.js'

$(function () {
    $('#altaEstaciones').on('submit', function (event) {
        event.preventDefault();
        let nombreEstacion = $('#nombreEstacion').val();
        let descripcion = $('#descEstacion').val();
        $.ajax({
            type: "POST",
            url: "peticiones.php",
            data: {
                controller: 'Metro',
                action: 'guardarEstacion',
                nombreEstacion: nombreEstacion,
                descripcion: descripcion,
            },
            success: function (result) {
                console.log(result)
                $('#alert-estacion').removeClass('d-none')
                setTimeout(() => {
                    $('#alert-estacion').addClass('d-none');
                }, 5000);
                let nombreEstacion = $('#nombreEstacion').val('');
                let descripcion = $('#descEstacion').val('');
                // refresh a la tabla
            }
        });
    });
    $('#altaLinea').on('submit', function (event) {
        event.preventDefault();
        let nombreLinea = $('#nombreLinea').val();
        let descripcion = $('#descLinea').val();
        $.ajax({
            type: "POST",
            url: "peticiones.php",
            data: {
                controller: 'Metro',
                action: 'guardarLinea',
                nombreLinea: nombreLinea,
                descripcion: descripcion,
            },
            success: function (result) {
                console.log(result)
                $('#alert-estacion').removeClass('d-none')
                setTimeout(() => {
                    $('#alert-estacion').addClass('d-none');
                }, 5000);
                let nombreEstacion = $('#nombreEstacion').val('');
                let descripcion = $('#descEstacion').val('');
                tablaEstaciones()
            }
        });
    });

    const myModalEl = $('#exampleModal');
    myModalEl.on('show.bs.modal', event => {
        const button = event.relatedTarget;
        let idNode = button.getAttribute('data-bs-id-node');
        $('.modal-body').load(`${address}metro-seguro2/modal-edit.php?id=${idNode}`);
    })

    $('#saveChanges').click(() => {
        myModalEl.modal('hide');
        data = getFormData();
        $.ajax({
            url: "peticiones.php",
            type: "post",
            data: {
                controller: 'Metro',
                action: 'changeDataEstacion',
                data: data,

            },
            success: function (result) {
                console.log(result);
            }
        });
    })

    function getFormData() {
        var config = {};
        $('#form-editEstacion input, #form-editEstacion select').each(function () {
            config[this.name] = this.value;
        });
        return config;
    }

    function tablaEstaciones() {
        console.log('hola')
    }


})

