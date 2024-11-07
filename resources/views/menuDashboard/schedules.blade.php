<div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
        <div class="card-header" style="background-color: #0F318F">
            <h3 class="card-title" style="color: white; font-weight: bold;">Horarios</h3>
            <div class="card-tools">

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <center>
                <h3>Horarios Usuarios</h3>
            </center>

            <hr>


            <div class="form-group">
                <label for="select_labor">Seleccionar labor:</label>
                <select class="form-control select2 select2-danger"
                    data-dropdown-css-class="select2-danger" id="select_user">
                    <option selected="selected" value="selected">Seleccionar usuario</option>

                    @foreach ($users as $user)
                        <option value="{{ $user['cedula'] }}">{{ $user['nombre'] }} {{ $user['apellido'] }}</option>
                    @endforeach

                </select>
            </div>

            <button class="btn btn-info m-2" data-toggle="modal" data-target="#editSchedules"><i
                    class="fa-solid fa-user-plus"></i>&nbsp;&nbsp;Añadir usuario</button>


            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Cédula</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Lunes</th>
                        <th scope="col">Martes</th>
                        <th scope="col">Miércoles</th>
                        <th scope="col">Jueves</th>
                        <th scope="col">Viernes</th>
                        <th scope="col">Sábado</th>
                        <th scope="col">Domingo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">cedula</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>7:00 / 12:00 - 2:00 / 5:00</td>
                        <td>7:00 / 12:00 - 2:00 / 5:00</td>
                        <td>7:00 / 12:00 - 2:00 / 5:00</td>
                        <td>7:00 / 12:00 - 2:00 / 5:00</td>
                        <td>7:00 / 12:00 - 2:00 / 5:00</td>
                        <td>7:00 / 12:00 - 2:00 / 5:00</td>
                        <td>7:00 / 12:00 - 2:00 / 5:00</td>

                    </tr>
                    </tr>
                </tbody>
            </table>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="editSchedules" tabindex="-1" aria-labelledby="editSchedules" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary"><i
                                class="fa-solid fa-paper-plane"></i>&nbsp;&nbsp;Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


