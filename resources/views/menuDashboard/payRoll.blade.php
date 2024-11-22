<div class="container-fluid">
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
        <div class="card-header" style="background-color: #0F318F">
            <h3 class="card-title" style="color: white; font-weight: bold;"><i
                    class="fa-solid fa-dollar-sign"></i>&nbsp;&nbsp;Nomina usuarios</h3>
            <div class="card-tools">

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <center>
                <h3>Nomina</h3>
            </center>

            <hr>

            <button class="btn btn-primary" onclick="sendPdf('{{route('insertsPdfs')}}','{{ count($users) }}')"><i
                    class="fa-solid fa-file-invoice-dollar"></i>&nbsp;&nbsp;Cargar nomina</button>

            <div class="table-responsive">

                <table class="table" id="table_payroll">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">
                                <center>Cédula</center>
                            </th>
                            <th scope="col">
                                <center>Nombre</center>
                            </th>
                            <th scope="col">
                                <center>Apellido</center>
                            </th>
                            <th scope="col">
                                <center>Fecha</center>
                            </th>

                            <th scope="col">
                                <center>Cargar</center>
                            </th>

                            <th scope="col">
                                <center>Ver historico</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                            @php
                                $flagg = 0;
                            @endphp

                        @foreach ($users as $user)



                            <tr>
                                <th scope="row">
                                    <center><span class="badge bg-success">{{ $user['cedula'] }}</span></center>
                                </th>
                                <td>{{ $user['nombre'] }}</td>
                                <td>
                                    <center>{{ $user['apellido'] }}</center>
                                </td>
                                <td>
                                    <center>{{ $user['cedula'] }}</center>
                                </td>
                                <td>
                                    <center>

                                            
                                            <input type="file" accept="application/pdf" class="form-control"
                                                id="input_pdf{{ $flagg }}"  data-code="{{$user['cedula']}}">

                                    </center>
                                </td>
                                <td>
                                    <center><a type="button" id="button_history{{ $flagg }}"
                                            title="Ver historico de usuario"><i class="fa-regular fa-eye text-danger"
                                                onclick="getHistoryPayRoll('{{ route('getHistoryPayRoll') }}','{{ $user['cedula'] }}')"></i></a>
                                    </center>
                                </td>
                            </tr>

                            @php

                                $flagg++;

                            @endphp
                        @endforeach

                    </tbody>
                </table>

            </div>

            <hr>

        </div>

    </div>
</div>
