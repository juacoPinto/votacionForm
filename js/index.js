//FUNCION PARA GENERAR LAS COMUNAS
function getComuna(val){
    //SE ENVIA LA DATA PARA GENERAR EL SELECT DE COMUNA DINAMICO
    $.ajax({
        type: "POST",
        url:"getComuna.php",
        data: 'region_id=' +val,
        success:function(data){
            $("#comunas").html(data);
        }
    })
};

//VALIDACIONES DE FORMULARIO
$(document).ready(function(){
    $("#botonEnviar").click(function(){
        let nombre = $("#nombre").val();
        let email = $("#email").val();
        let alias = $("#alias").val();
        var rut = $("#rut").val();

        //VALIDANDO NOMBRE
        if(nombre.length <= 2){
            alert ("Nombre debe tener mas de dos letras");
            return false;
        };

        //VALIDANDO ALIAS
        var validarAlias = new RegExp(/[A-Za-z0-9]+/g);
        var resultado = validarAlias.test(alias);

        if(alias.length <= 5 || !resultado){
            alert ("Alias debe tener al menos 5 caracteres incluyendo una letra y un numero");
            return false;
        };

        //VALIDANDO EL LARGO DEL RUT
        if(rut.length <= 6){
            alert ("Rut muy corto");
            return false;
        };

        //FORMATEANDO  RUT
        function formateaRut(inputRut) {

            var actual = inputRut.replace(/^0+/, "");

            if (actual != '' && actual.length > 1) {
                var sinPuntos = actual.replace(/\./g, "");
                var actualLimpio = sinPuntos.replace(/-/g, "");
                var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
                var rutPuntos = "";
                var i = 0;
                var j = 1;
                for (i = inicio.length - 1; i >= 0; i--) {
                    var letra = inicio.charAt(i);
                    rutPuntos = letra + rutPuntos;
                    if (j % 3 == 0 && j <= inicio.length - 1) {
                        rutPuntos = "." + rutPuntos;
                    }
                    j++;
                };
                var dv = actualLimpio.substring(actualLimpio.length - 1);
                rutPuntos = rutPuntos + "-" + dv;
            };
            
            return $("#rut").val(rutPuntos);
        };

        //EJECUTAMOS EL FORMATEO
        formateaRut(rut);
        
        //VALIDANDO EMAIL
        let validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

        if(email == "" || !validEmail.test(email)){
            alert ("Debe ingresar un correo Valido");
            return false;
        };

        //VALIDANDO LAS FORMAS DE CONTACTO
        var form_data = new FormData(document.querySelector("form"));
        if(form_data.getAll("contacto[]").length < 2){
            alert ("Seleccionar mas de una forma de contacto");
            return false;
        };

    });
});