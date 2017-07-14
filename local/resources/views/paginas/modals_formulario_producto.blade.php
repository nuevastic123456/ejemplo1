

     <!-- modal para registrar categoria -->
              <div id="modal_categoria" class="modal modal-fixed-footer">
                <div class="modal-content">
                  <h4>Categorias</h4>                
                  @include('paginas.formularios.formulario_categoria')

                </div>
                <div class="modal-footer">
                  <a href="#" onclick="registra_categoria()" class="modal-action modal-close waves-effect waves-green btn-flat ">Registrar</a>
                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
                </div>
              </div>



              <!-- modal para registrar unidad de  medida -->
              <div id="modal_unidad" class="modal modal-fixed-footer">
                <div class="modal-content">
                  <h4>Unidades de medida</h4>
                  @include('paginas.formularios.formulario_unidad_medida')
                </div>
                <div class="modal-footer">
                <a href="#" onclick="registra_unidad()" class="modal-action modal-close waves-effect waves-green btn-flat ">Registrar</a>
                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cerrar</a>
                </div>
              </div>
