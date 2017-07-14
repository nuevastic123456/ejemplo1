
  $(document).ready(function() {
    $('select').material_select();
  });
       

  $(document).ready(function(){
    $('ul.tabs').tabs();
  });
        

// requerido para las ventanas modales
$(document).ready(function() {
$('.modal-trigger').leanModal();
 });


// requerido para para el collapsible
  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
        

//url principal 
var pathArray = location.href.split("/");
var url_web=pathArray[0]+'/'+pathArray[1]+'/'+pathArray[2]+'/'+pathArray[3]+'/';



//validar que se digite solo numeros
function solo_numeros(e){
    var key = window.Event ? e.which : e.keyCode 
    return ((key >= 48 && key <= 57) || (key==8)) 
}


function cargar_municipios(id_departamento)
{  
    $.ajax({
      url:url_web+'consulta_municipios/'+id_departamento,
      type:'get',  
      error: function(result){
        $('#id_municipio').html('<strong>Error !</strong>');
      },
      beforeSend: function(){
        $('#id_municipio').html(
        	'<div class="preloader-wrapper small active">'+
    		'<div class="spinner-layer spinner-green-only">'+
      		'<div class="circle-clipper left">'+
        	'<div class="circle"></div>'+
      		'</div><div class="gap-patch">'+
        	'<div class="circle"></div>'+
      		'</div><div class="circle-clipper right">'+
        	'<div class="circle"></div>'+
      		'</div>'+
    		'</div>'+
  			'</div>'
        	);
      },
      success: function(result){
        $('#id_municipio').html(result);
      }
    });

}




// carga lista de registros segun el parametro de busqueda
function filtro_busqueda(url,div)
{  

    $.ajax({
      url:url,
      type:'get',
      error: function(result){
        $(div).html('<strong>Sin resultados !</strong>');
      },
      beforeSend: function(){
        $(div).html(
          '<div class="preloader-wrapper small active">'+
        '<div class="spinner-layer spinner-green-only">'+
          '<div class="circle-clipper left">'+
          '<div class="circle"></div>'+
          '</div><div class="gap-patch">'+
          '<div class="circle"></div>'+
          '</div><div class="circle-clipper right">'+
          '<div class="circle"></div>'+
          '</div>'+
        '</div>'+
        '</div>'
          );
      },
      success: function(result){
        $(div).html(result);
      }
    });
}




function registra_categoria()
{  

    var nombre=$('#nombre_categoria');
    var descripcion=$('#descripcion_categoria');
    var estado="";
    if ($('#test6').prop('checked'))
    {
      estado='1';
    }
    else
    {
      estado='0';
    }

    if (nombre.val()=="") 
    {
      alert('El nombre de la categoria es obligatorio !');
      nombre.focus();
    }
    else
    {

    $.ajax({
      url:url_web+'registrar_categoria_ajax',
      type:'get',
      data:{
        nombre:nombre.val(),
        descripcion:descripcion.val(),
        estado:estado},  
      error: function(result){
        $('#id_categoria').html('<strong>Error !</strong>');
      },
      beforeSend: function(){
        $('#id_categoria').html(
          '<div class="preloader-wrapper small active">'+
        '<div class="spinner-layer spinner-green-only">'+
          '<div class="circle-clipper left">'+
          '<div class="circle"></div>'+
          '</div><div class="gap-patch">'+
          '<div class="circle"></div>'+
          '</div><div class="circle-clipper right">'+
          '<div class="circle"></div>'+
          '</div>'+
        '</div>'+
        '</div>'
          );
      },
      success: function(result){
        $('#id_categoria').html(result);
      }

    });
    
    }
}



function registra_unidad()
{  
    var nombre=$('#nombre_unidad');
    var descripcion=$('#descripcion_unidad');
    var estado="";
    if ($('#test7').prop('checked'))
    {
      estado='1';
    }
    else
    {
      estado='0';
    }

    if (nombre.val()=="") 
    {
      alert('El nombre de la unidad de medidad es obligatorio !');
      nombre.focus();
    }
    else
    {

    $.ajax({
      url:url_web+'registrar_unidad_ajax',
      type:'get',
      data:{
        nombre:nombre.val(),
        descripcion:descripcion.val(),
        estado:estado},  
      error: function(result){
        $('#id_unidad').html('<strong>Error !</strong>');
      },
      beforeSend: function(){
        $('#id_unidad').html(
          '<div class="preloader-wrapper small active">'+
        '<div class="spinner-layer spinner-green-only">'+
          '<div class="circle-clipper left">'+
          '<div class="circle"></div>'+
          '</div><div class="gap-patch">'+
          '<div class="circle"></div>'+
          '</div><div class="circle-clipper right">'+
          '<div class="circle"></div>'+
          '</div>'+
        '</div>'+
        '</div>'
          );
      },
      success: function(result){
        $('#id_unidad').html(result);
      }

    });
    }
}





function dar_permiso(id_tipo_usuario, id_permiso)
{  

var url='';
if ($('#test'+id_permiso+id_tipo_usuario).prop('checked') && confirm('Seguro que deseas realizar la acción ?'))
{
  url=url_web+"dar_permiso_usuario/"+id_permiso+'/'+id_tipo_usuario;
}
else
{
  url=url_web+"cancelar_permiso_usuario/"+id_permiso+'/'+id_tipo_usuario;
  $('#test'+id_permiso+id_tipo_usuario).prop('checked',false);
}

         $.ajax({
                url:url,
                type:'GET',
                success:function(result){
                  alert(result);
                }
          });
}


function agregar_precio()
{
  var precio=$('#precio');
  var descripcion_precio=$('#descripcion_precio');
  var lista_precio=$('#lista_precio');
  var registro_precio=$('#registro_precio');
  var input_precio=$('#input_precio');

  var array=new Array();
  var contador=0;

  if (precio.val()=="") 
  {
    alert('Debes ingresar el precio!');
    precio.focus();
  }
  else
  {
    if (descripcion_precio.val()=="") 
    {
      alert('Debes agregar la descripcion del precio');
      descripcion_precio.focus();
    }
    else
    {
      lista_precio.show();
      registro_precio.append(
                      '<tr>'+
                        '<td>'+precio.val()+'</td>'+
                        '<td>'+descripcion_precio.val()+'</td>'+
                      '</tr>'

        );
      array[contador]={'precio':precio.val(),'descripcion_precio':descripcion_precio.val()};
      contador=contador+1;
      input_precio.val(JSON.stringify(array));
      precio.val('');
      descripcion_precio.val('');
    }
  }

}



 $( function() {
    var dateFormat = "yy-mm-dd",
      from = $( ".from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( ".to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );





// consulta de fecha incio inicio a  fecha fin
function consulta_reporte(fec_inico, fec_fin, parametro,url,div)
{

  if ($(parametro).val()==null) 
  {
    alert('seleccione la opción de consulta!')
  }
  else
  {
      if ($(fec_inico).val()=="")
      {
        alert('seleccione la fecha inicial!')
        $(fec_inico).focus();
      }
      else
      {
            if ($(fec_fin).val()=="") 
            {
              alert('seleccione la fecha final!');
              $(fec_fin).focus();
            }
            else
            {
                    filtro_busqueda(url,div);

            }
      }
  }

}









