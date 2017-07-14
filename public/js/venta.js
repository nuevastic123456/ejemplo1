
    // donde se busca el producto
    var filtro=$('#filtro');
    // el precio del producto
    var precio=$('#precio_producto');
    // donde se pone la cantidad del producto
    var cantidad=$('#cantidad');
    // para mostrar mensaje de validacion 
    var m_filtro=$('#m_filtro');
    // para mostrar mensaje de validacion
    var m_precio=$('#m_precio');
    // para mostrar mensaje de validacion
    var m_cantidad=$('#m_cantidad');
    // para mostrar mensaje de validacion del proveedor
    var m_cliente=$('#m_cliente');

    var m_modo_venta=$('#m_modo_venta');
    var m_pago=$('#m_pago');

    // tabal donde se muestra la compra
    var tabla=$('#t_venta');
    // tbody de la tabla para agregar filas
    var filas=$('#tabla_venta');
    // nombre del producto
    var nombre_producto=$('#nombre_producto');
    // id del prodcuto
    var id_producto=$('#id_producto');
    // cantidad total consultada del producto
    var cantidad_consultada=$('#cantidad_producto');
     // campo oculto imagen del producto
    var imagen_producto=$('#imagen_producto');
    // total 
    var muestra_total=$('#total');
    
    var modo_venta=$('#modo_venta');
    
    var total_venta=$('#total_venta');
    
    var cliente=$('#cliente');
    var id_cliente=$('#id_cliente');

    var datos_venta=new Array();
    var contador=0;

    var pago=$('#pago');






$('#categoria').change(function(){
  filtro.val('');
  id_producto.val('');
  cantidad_consultada.val('');
});



  filtro.autocomplete({
    source : function(requete, reponse){
        $.ajax({
            url :url_web+"busca_producto/"+$('#filtro').val()+"/"+$('#categoria').val(),
            type: 'GET',
            success : function(donnee){
                reponse($.map(donnee, function(objet){
                    return {
                        label: objet.pro_nombre+' ('+objet.pro_codigo+')',
                        value: objet.pro_nombre,
                        id: objet.id
                        };
                }));
            },
        });
    },

    minLength: 2,
    delay:500,

    select: function( event, ui ) {
      id_producto.val(ui.item.id);
      nombre_producto.val(ui.item.value);
      carga_precios(ui.item.id);
      consultar_cantidad_producto(ui.item.id);
      } 
}); 




function carga_precios(id_producto)
{
  $.ajax({
      url:url_web+'precios/'+id_producto,
      type:'GET',
      error: function(result){
        $('#div_precio').html('<strong>Error !</strong>');
      },
      beforeSend: function(){
        $('#div_precio').html(
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
        $('#div_precio').html(result);
      }
  });
}






function consultar_cantidad_producto(id_producto)
{
  $.ajax({
      url:url_web+'consulta_cantidad_producto/'+id_producto,
      type:'GET',
      success: function(data){
        total="";
        if (data['comprado']==null && data['vendido']==null) 
        {
          total=0;
        }
        else
        {
            if (data['comprado']!=null && data['vendido']!=null) 
            {
              total=parseInt(data['comprado'])-parseInt(data['vendido']);
            }
            else
            {
              if (data['comprado']!=null && data['vendido']==null) 
              {
                total=data['comprado'];
              }
            }
        }

        cantidad_consultada.val(total);
        imagen_producto.val(data['imagen']);
      }
  });
}
















  function agregar_venta()
  {
    if (filtro.val()=="" || id_producto.val()==""){
      m_filtro.text('Digita el nombre o codigo del producto y seleccionalo de la lista');
      filtro.focus();
    }
    else
    {
      m_filtro.text('');
      if (precio.val()==null)
      {
        m_precio.text('Selecciona el precio de venta');
      }
      else
      {
        m_precio.text('');
        if (cantidad.val()=="")
        {
          m_cantidad.text('Digita la cantidad del producto');
          cantidad.focus();
        }
        else
        {
          m_cantidad.text('');
          var producto_repetido=false;
          if(datos_venta.length>0)
          {
            for (var i = 0; i < datos_venta.length; i++) 
            {
              if (datos_venta[i]!=null)
              {
                  if (datos_venta[i].id_producto==id_producto.val()) 
                  {
                    alert('El producto ya se encuentra en la lista de venta !');
                    limpiar_campos();
                    producto_repetido=true;
                    break;
                  }
              }
            }
          }

          if(producto_repetido==false) 
          {

            if (parseInt(cantidad_consultada.val())>=parseInt(cantidad.val()))
            {

              tabla.show();
              nueva_cantidad=parseInt(cantidad_consultada.val())-parseInt(cantidad.val());
              total=parseInt(precio.val())*parseInt(cantidad.val());

             
              filas.append(
              '<tr id="tr_venta_'+contador+'">'+
              '<td>'+contador+'</td>'+
              '<td><img src="'+url_web+imagen_producto.val()+'" class="responsive-img materialboxed" width="70"></td>'+
              '<td>'+nombre_producto.val()+'</td>'+
              '<td>'+cantidad_consultada.val()+'</td>'+
              '<td>'+cantidad.val()+'</td>'+
              '<td>'+nueva_cantidad+'</td>'+
              '<td>'+precio.val()+'</td>'+
              '<td>'+total+'</td>'+
              '<td><a class="btn-floating btn-large #e53935 red darken-1"  href="#" onclick="eliminar_producto_venta('+contador+')"><i class="material-icons" title="Eliminar">delete</i></a></td>'+
              '</tr>');

              datos_venta[contador]={
              'id_producto':id_producto.val(),
              'cantidad':cantidad.val(),
              'valor_unitario':precio.val(),
              'subtotal':total};

              calcula_subtotal();
              limpiar_campos();
              contador++;
            }
            else
            {
              alert('La cantidad que digitaste supera la cantidad actual del producto!')
            }

            }
        } 
      }
    }
  }


function limpiar_campos()
{
                filtro.val('');
                precio.val('');
                cantidad.val('');
                id_producto.val('');
                nombre_producto.val('');
                imagen_producto.val('');
                precio.val('');
                imagen_producto.val('');
}







  function eliminar_producto_venta(posicion_array)
  {
    if (confirm('Seguro que deseas eliminar el producto de la lista ?')==true)
    {
        $('#tr_venta_'+posicion_array).remove();
        delete datos_venta[posicion_array];
        // cuenta las posiones del array
        var numero_posiciones=datos_venta.length
        var cuenta_posicones_null=0;   
        calcula_subtotal(); 

            // cuenta posiciones null del array
            for (var i = 0; i < datos_venta.length; i++) 
            {
              if (datos_compra[i]==null) 
              {
                cuenta_posicones_null=cuenta_posicones_null+1;
              }
            }

        // compara posiones del array
        if (cuenta_posicones_null==numero_posiciones)
        {
          tabla.hide();
          alert('No hay productos en la lista de compras !')
        }
    }
  }





function calcula_subtotal()
{
            var acumulador_total=0;
            for (var i = 0; i < datos_venta.length; i++) 
            {
              if (datos_venta[i]!=null)
              {
                acumulador_total=acumulador_total+datos_venta[i].subtotal;
              }
            }
            muestra_total.text('Total: '+acumulador_total);
            total_venta.val(acumulador_total);
}



modo_venta.change(function(){
  if (modo_venta.val()==1)
  {
    $('#label_pago').text('Valor pago total');
  }
  else
  {
      if (modo_venta.val()==2)
      {
        $('#label_pago').text('Valor pago inicial');
      }
  }
});





  cliente.autocomplete({
    source : function(requete, reponse){
        $.ajax({
            url :url_web+"busca_cliente/"+$('#cliente').val(),
            type: 'GET',
            success : function(donnee){
                reponse($.map(donnee, function(objet){
                    return {
                        label: objet.usu_nombre+' ('+objet.usu_numero_documento+')',
                        value: objet.usu_nombre,
                        id: objet.id
                        };
                }));
            },
        });
    },

    minLength: 2,
    delay:500,

    select: function( event, ui ) {
      id_cliente.val(ui.item.id);
      } 

}); 



function confirmar_venta()
{

// si no selecciona la forma de pago
if (modo_venta.val()==null) 
{
    m_modo_venta.text('Selecciona el modo de venta');
}
else
{
  m_modo_venta.text('');
  // si selecciona pagado y el  campo de pago es vacio
  if (modo_venta.val()==1 && pago.val()=="")
  {
    m_pago.text('Digita el valor con el que se pago');
    pago.focus();
  }
  else
  {
      m_pago.text('');
      // si selecciona pagado y el  campo de pago menor al total
      if (modo_venta.val()==1 && parseInt(pago.val())<parseInt(total_venta.val()))
      {
        m_pago.text('El pago debe ser mayor o igual al total');
        pago.focus();
      }
      else
      {
            m_pago.text('');
            // si selecciona por pagar y el pago es mayor o igual al total
            if (modo_venta.val()==2 && parseInt(pago.val())>=parseInt(total_venta.val()))
            { 
                m_pago.text('El pago debe ser menor que el total o puede quedar vacio');
                pago.focus();

            }
            else
            {
               m_pago.text('');
               if (id_cliente.val()=="")
               {
                  m_cliente.text('Debes filtrar por nombre o numero de documento y seleccionar el cliente');
               }
               else
               {

                // si confirma el mensaje 
                if (confirm('Seguro que deseas confirmar la venta ?')==true)
                {

                  var token=$('#token').val();
                  $.ajax({
                    url:url_web+'registrar_venta',
                    headers:{'X-CSRF-TOKEN':token},
                    type:'POST',
                    data:{
                      venta:JSON.stringify(datos_venta),
                      modo_venta:modo_venta.val(),
                      pago:pago.val(),
                      total:total_venta.val(),
                      id_cliente:id_cliente.val()
                    },
                            beforeSend: function () {
                                    $("#cargar").html('<div class="progress">'+
                                    '<div class="indeterminate"></div></div>');
                            },
                            success:  function (response) {
                                    if (parseInt(pago.val())>parseInt(total_venta.val()))
                                    {
                                        var cambio=parseInt(pago.val())-parseInt(total_venta.val())
                                        $("#cargar").html(response+' '+'El cambio es de $'+cambio);
                                    }
                                    else
                                    {
                                        $("#cargar").html(response);
                                    }

                                    $("#cargar").fadeOut(12000);
                                    tabla.hide();
                                    datos_venta.length=0;
                                    filas.empty();
                                    pago.val('');
                                    id_cliente.val('');
                                    cliente.val('');
                            }
                  });

                }

               }
                
            }
      }
  }

}

}