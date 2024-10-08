{{-- 
    <div class="card card-primary card-tabs" style="width: 100%">
      <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
          <li class="pt-2 px-3"><h3 class="card-title">Card Title</h3></li>
          <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Messages</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Settings</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
          <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
             Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
          </div>
          <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
             Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
          </div>
          <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
             Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
          </div>
          <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel" aria-labelledby="custom-tabs-two-settings-tab">
             Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div> --}}



    <div class="card_register card card-primary">
        <div class="card-header" style="background-color: #573da2">
          <h3 class="card-title"><i class="fa-solid fa-user-plus"></i>&nbsp;&nbsp; Registrar usuario</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
          <div class="card-body">

            <div class="row">
              
              <div class="col">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre:</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Apellido:</label>
                  <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Direccion:</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Dirección">
                </div>


                
                <div class="form-group">
                  <label for="exampleInputPassword1">Celular Emergencia:</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Celular emergencia">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Contraseña:</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
                </div>

                <div class="form-group">
                  <label>Tipo de Usuario:</label>
                  <select class="form-control">
                    <option value="administrador">Administrador</option>
                    <option value="usuario">usuario</option>
                  </select>
                </div>
              </div>
              
              
              <div class="col">

                <div class="form-group">
                  <label>Tipo de labor:</label>

                  
                  <select class="form-control">
                    @foreach ($labores as $labor)
                    <option value="{{$labor["id_labor"]}}">{{$labor["nombre_labor"]}}</option>
                    @endforeach
                  </select>
                  
                </div>
              

                <div class="form-group">
                  <label for="exampleInputPassword1">Fecha de nacimiento:</label>
                  <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Fecha de nacimiento.">
                </div>
                

                <div class="form-group">
                  <label for="exampleInputPassword1">E-mail:</label>
                  <input type="email" class="form-control" id="exampleInputPassword1" placeholder="E-mail">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Cédula:</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Cédula">
                </div>


                <div class="form-group">
                  <label for="exampleInputPassword1">Celular:</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Cédula">
                </div>

                <div class="form-group" >
                  <label for="exampleInputPassword1">Nombre Contacto de Emergencia:</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nombre Emergencia">
                </div>
              </div>
            </div>
          </div>

          <!-- /.card-body -->

          <div class="card-footer" style="background-color: inherit">
            <center ><button  class="btn_send btn btn-primary shadow" onclick="{{route('saveUser')}}"><i class="fa-regular fa-paper-plane" ></i>&nbsp;&nbsp;Enviar</button></center>
            
          </div>
        </form>
      </div>
