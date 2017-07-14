



    // donde se busca el producto
    var filtro=$('#filtro');
    // el precio del producto
    var precio=$('#precio');
    // donde se pone la cantidad del producto
    var cantidad=$('#cantidad');
    // para mostrar mensaje de validacion 
    var m_filtro=$('#m_filtro');
    // para mostrar mensaje de validacion
    var m_precio=$('#m_precio');
    // para mostrar mensaje de validacion
    var m_cantidad=$('#m_cantidad');
    // para mostrar mensaje de validacion del proveedor
    var m_proveedor=$('#m_proveedor');
    // tabal donde se muestra la compra
    var tabla=$('#t_compra');
    // tbody de la tabla para agregar filas
    var filas=$('#tabla_compra');
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

    var datos_compra=new Array();
    var contador=0;

    var total_compra=$('#total_compra');

    var modo_compra=$('#modo_compra');
    var pago=$('#pago');
    var m_modo_compra=$('#m_modo_compra');
    var m_pago=$('#m_pago');

    var proveedor=$('#proveedor');
    var id_proveedor=$('#id_proveedor');
    var stock_maximo=$('#stock_maximo');

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
      consultar_cantidad_producto(ui.item.id)
      id_producto.val(ui.item.id);
      nombre_producto.val(ui.item.value);
      } 

}); 



function consultar_cantidad_producto(id_producto)
{
  $.ajax({
      url:url_web+'consulta_cantidad_producto/'+id_producto,
      type:'GET',
      success: function(data){
        total="";
        stock_maximo.val(data['stock_maximo']);
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





  function agregar_compra()
  {
    if (filtro.val()=="" || id_producto.val()==""){
      m_filtro.text('Digita el nombre o codigo del producto y seleccionalo de la lista');
      filtro.focus();
    }
    else
    {
      m_filtro.text('');
      if (precio.val()=="")
      {
        m_precio.text('Digita el precio unitario del producto');
        precio.focus();
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
          if(parseInt(cantidad.val())>parseInt(stock_maximo.val()))
          {
            alert('La cantidad que ingresaste supera el stock maximo del producto !');
            cantidad.focus();
          }
          else
          {
          var producto_repetido=false;
          if(datos_compra.length>0)
          {
            for (var i = 0; i < datos_compra.length; i++) 
            {
              if (datos_compra[i]!=null)
              {
                  if (datos_compra[i].id_producto==id_producto.val()) 
                  {
                    alert('El producto ya se encuentra en la lista de compra !');
                    limpiar_campos();
                    producto_repetido=true;
                    break;
                  }
              }
            }
          }

          if(producto_repetido==false) 
          {
              tabla.show();
              nueva_cantidad=parseInt(cantidad_consultada.val())+parseInt(cantidad.val());
              total=parseInt(precio.val())*parseInt(cantidad.val());
              filas.append(
              '<tr id="tr_compra_'+contador+'">'+
              '<td>'+contador+'</td>'+
              '<td><img src="'+url_web+imagen_producto.val()+'" class="responsive-img materialboxed" width="70"></td>'+
              '<td>'+nombre_producto.val()+'</td>'+
              '<td>'+cantidad_consultada.val()+'</td>'+
              '<td>'+cantidad.val()+'</td>'+
              '<td>'+nueva_cantidad+'</td>'+
              '<td>'+precio.val()+'</td>'+
              '<td>'+total+'</td>'+
              '<td><a class="btn-floating btn-large #e53935 red darken-1"  href="#" onclick="eliminar_producto_compra('+contador+')"><i class="material-icons" title="Eliminar">delete</i></a></td>'+
              '</tr>');

              datos_compra[contador]={
              'id_producto':id_producto.val(),
              'cantidad':cantidad.val(),
              'valor_unitario':precio.val(),
              'subtotal':total};

              calcula_subtotal();
              limpiar_campos();
              contador++;

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
                stock_maximo.val('');
                precio.val('');
                imagen_producto.val('');
}


  function eliminar_producto_compra(posicion_array)
  {
    if (confirm('Seguro que deseas eliminar el producto de la lista ?')==true)
    {
        $('#tr_compra_'+posicion_array).remove();
        delete datos_compra[posicion_array];
        // cuenta las posiones del array
        var numero_posiciones=datos_compra.length
        var cuenta_posicones_null=0;   
        calcula_subtotal(); 

            // cuenta posiciones null del array
            for (var i = 0; i < datos_compra.length; i++) 
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
            for (var i = 0; i < datos_compra.length; i++) 
            {
              if (datos_compra[i]!=null)
              {
                acumulador_total=acumulador_total+datos_compra[i].subtotal;
              }
            }
            muestra_total.text('Total: '+acumulador_total);
            total_compra.val(acumulador_total);
}


function cancelar_compra()
{
    if (confirm('Seguro que deseas cancelar la compra ?')==true)
    {
      tabla.hide();
      datos_compra.length=0;
      filas.empty();
      total_compra.val('');
      id_proveedor.val('');
    }
} 




$('#modo_compra').change(function(){
  if (modo_compra.val()==1)
  {
    $('#label_pago').text('Valor pago total');
  }
  else
  {
      if (modo_compra.val()==2)
      {
        $('#label_pago').text('Valor pago inicial');
      }
  }
});









function confirmar_compra()
{

// si no selecciona la forma de pago
if (modo_compra.val()==null) 
{
    m_modo_compra.text('Selecciona el modo de compra');
}
else
{
  m_modo_compra.text('');
  // si selecciona pagado y el  campo de pago es vacio
  if (modo_compra.val()==1 && pago.val()=="")
  {
    m_pago.text('Digita el valor con el que pagaste');
    pago.focus();
  }
  else
  {
      m_pago.text('');
      // si selecciona pagado y el  campo de pago menor al total
      if (modo_compra.val()==1 && parseInt(pago.val())<parseInt(total_compra.val()))
      {
        m_pago.text('El pago debe ser mayor o igual al total');
        pago.focus();
      }
      else
      {
            m_pago.text('');
            // si selecciona por pagar y el pago es mayor o igual al total
            if (modo_compra.val()==2 && parseInt(pago.val())>=parseInt(total_compra.val()))
            { 
                m_pago.text('El pago debe ser menor que el total o puede quedar vacio');
                pago.focus();

            }
            else
            {
               m_pago.text('');
               if (id_proveedor.val()=="")
               {
                  m_proveedor.text('Debes filtrar por nombre o numero de documento y seleccionar el proveedor');
               }
               else
               {

                // si confirma el mensaje 
                if (confirm('Seguro que deseas confirmar la compra ?')==true)
                {

                  var token=$('#token').val();
                  $.ajax({
                    url:url_web+'registrar_compra',
                    headers:{'X-CSRF-TOKEN':token},
                    type:'POST',
                    data:{
                      compra:JSON.stringify(datos_compra),
                      modo_compra:modo_compra.val(),
                      pago:pago.val(),
                      total:total_compra.val(),
                      id_proveedor:id_proveedor.val()
                    },
                            beforeSend: function () {
                                    $("#cargar").html(
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
                            success:  function (response) {
                                    if (parseInt(pago.val())>parseInt(total_compra.val()))
                                    {
                                        var cambio=parseInt(pago.val())-parseInt(total_compra.val())
                                        $("#cargar").html(response+' '+'El cambio es de $'+cambio);
                                    }
                                    else
                                    {
                                        $("#cargar").html(response);
                                    }

                                    $("#cargar").fadeOut(12000);
                                    tabla.hide();
                                    datos_compra.length=0;
                                    filas.empty();
                                    pago.val('');
                                    id_proveedor.val('');
                                    proveedor.val('');
                            }
                  });

                }

               }
                
            }
      }
  }

}

}







  $('#proveedor').autocomplete({
    source : function(requete, reponse){
        $.ajax({
            url :url_web+"busca_proveedor/"+$('#proveedor').val(),
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
      id_proveedor.val(ui.item.id);
      } 

}); 















