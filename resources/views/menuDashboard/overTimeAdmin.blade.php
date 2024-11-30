<div class="container-fluid">

    <div class="card card-default">
        <div class="card-header" style="background-color: #0F318F">
            <h3 class="card-title" style="color: white; font-weight: bold;"><i
                    class="fa-solid fa-stopwatch"></i>&nbsp;&nbsp;Solicitudes de horas extras</h3>
            <div class="card-tools"></div>
        </div>


        <div class="container">
            <hr>

            <center>
                <h4 class="text-secondary">Realizar solicitud de horas extras</h4>
            </center>
            <hr>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Solicitar horas extra</h3>
                </div>


                <div class="card-body">



                    <div class="form-group">
                        <label>Motivo:</label>
                        <textarea class="form-control" rows="3"
                            placeholder="Describe el motivo por el cual deseas solicitar hora extra..." id="motivo"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Fecha:</label>

                        <input type="date" id="fecha" class="form-control">

                    </div>


                    <div class="form-group">
                        <label>Hora inicio:</label>

                        <input type="time" class="form-control" id="h_i">

                    </div>

                    <div class="form-group">
                        <label>Hora final:</label>

                        <input type="time" class="form-control" id="h_f">

                    </div>


                    <!-- /.card-body -->


                    <center><button class="btn btn-primary" onclick="requestOverTime('{{ route('sendOverTime') }}', '{{$id_user}}')"><i
                                class="fa-solid fa-bell-concierge"></i>&nbsp;&nbsp;Solicitar</button></center>



                </div>

            </div>

        </div>

    </div>
</div>
