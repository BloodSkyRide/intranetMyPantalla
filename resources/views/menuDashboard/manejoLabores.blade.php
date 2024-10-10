<div class="container-fluid">
  <!-- SELECT2 EXAMPLE -->
  <div class="card card-default">
      <div class="card-header">
          <h3 class="card-title">Administrador de labores</h3>
          <div class="card-tools">
              
          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
 
          <!-- /.row -->
          <div class="row">
              <div class="col-12 col-sm-6">
                  <div class="form-group">
                      <label for="select_labor">Seleccionar labor:</label>
                      <select class="form-control select2 select2-danger"
                          data-dropdown-css-class="select2-danger" style="width: 100%;" id="select_labor">
                          <option selected="selected">Seleccionar labor</option>

                          @foreach ($labores as $labor)
                          
                          <option value="{{$labor['id_labor']}}">{{$labor['nombre_labor']}}</option>

                          @endforeach
                          
                      </select>
                  </div>
                  <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6">
                  <div class="form-group">
                      <label>Seleccionar grupo de</label>
                      <div class="select2-purple">
                          <select class="select2" multiple="multiple" data-placeholder="Select a State"
                              data-dropdown-css-class="select2-purple" style="width: 100%;">
                              <option>Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                          </select>
                      </div>
                  </div>
                  <!-- /.form-group -->
              
                 
              </div>



              <!-- /.col -->
          </div>
          <hr>
          <center><h2>Tabla de labores</h2></center>
          

          <div class="mt-4">
                
            <table class="table table-striped">
              <thead class="table-warning ">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombre Labor</th>
                  <th scope="col">Grupo Labores</th>

                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td> recordar que aqui colocaremos en forma de checkbox items para sacarlos al selector multiple y en la parte de arriba poder asignarlo a cualwuier labor principal
                </tr>
              </tbody>
            </table>
            </div>
          <!-- /.row -->

      <!-- /.card-body -->
      <div class="card-footer">
          Mypantalla todos los derechos reservados © 2024
      </div>
  </div>
</div>