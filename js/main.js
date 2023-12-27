$(function () {
    $('#altaEstaciones').on('submit', function (event) {
        event.preventDefault();
        let nombreEstacion = $('#nombreEstacion').val();
        let descripcion = $('#descEstacion').val();
        $.ajax({
            type: "POST",
            url: "peticiones.php",
            data: {
                controller:'Metro', 
                action:'guardarEstacion',
                nombreEstacion: nombreEstacion,
                descripcion: descripcion,
            },
            success: function (result) {
                console.log(result)
                $('#alert-estacion').removeClass('d-none')
                setTimeout(()=>{
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
                controller:'Metro', 
                action:'guardarLinea',
                nombreLinea: nombreLinea,
                descripcion: descripcion,
            },
            success: function (result) {
                console.log(result)
                $('#alert-estacion').removeClass('d-none')
                setTimeout(()=>{
                    $('#alert-estacion').addClass('d-none');
                }, 5000);
                let nombreEstacion = $('#nombreEstacion').val('');
                let descripcion = $('#descEstacion').val('');
                tablaEstaciones()
            }
        });
    });

    $('#editar').on('click', ()=>{
        console.log($('#editar').data-bs-target)
    })

    function tablaEstaciones(){
        console.log('hola')
    }

    
})

