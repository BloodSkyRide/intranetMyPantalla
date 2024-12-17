<div class="container-fluid">

    <div class="card card-primary">
        <div class="card-header" style="background-color: #0f318f">
            <h3 class="card-title"><i class="fa-solid fa-chart-pie"></i>&nbsp;&nbsp;Efectividad colaboradores</h3>
        </div>
        <div class="card-body">
            <hr>

            <center class="m-2"><button class="btn btn-info" onclick="openModalEfectivesness()"><i
                        class="fa-solid fa-plus"></i>&nbsp;&nbsp;Eliminar/Editar atributo</button></center>

            <button class="btn btn-primary mb-3" onclick="saveDay('{{ route('saveAtribute') }}')"><i
                    class="fa-solid fa-floppy-disk"></i>&nbsp;&nbsp;Guardar día</button>
            <button class="btn btn-danger mb-3 ml-2" data-target="#modal_answer" data-toggle="modal"><i
                    class="fa-solid fa-rotate-right"></i>&nbsp;&nbsp;Reiniciar Ponderados</button>


            <div class="table-responsive" style="overflow-y: scroll; max-height: 470px; border-top-left-radius: 20px;">
                <table class="table" id="table_efectiveness">
                    <thead class="thead-dark" style="width: 100%; border-collapse: collapse;">

                        <tr>
                            <th style="position: sticky; top: 0; z-index: 1;">
                                <center><br>Nombre/Cédula<br><i class="fa-solid fa-signature"></i></center>
                            </th>
                            <th style="position: sticky; top: 0; z-index: 1;">
                                <center>Total Ponderado<br><i class="fa-solid fa-chart-simple"></i></center>
                            </th>
                            @foreach ($atributos as $atributo)
                                <th style="position: sticky; top: 0; z-index: 1;">
                                    <center><i
                                            class="fa-brands fa-creative-commons-by"></i>&nbsp;&nbsp;{{ $atributo['nombre_atributo'] }}
                                        <br> <span
                                            class="badge badge-info">{{ $atributo['porcentaje_efectividad'] }}%</span>
                                    </center>
                                </th>
                            @endforeach
                        </tr>

                    </thead>

                    @php

                    @endphp
                    <tbody>
                        @foreach ($users as $user)
                            <tr>

                                <th class="d-flex align-items-center">
                                    <span class="badge badge-success">{{ $user['cedula'] }}-{{ $user['nombre'] }}</span>

                                </th>
                                <th>

                                    @foreach ($ponderados as $ponderado)
                                        @if ($user['cedula'] == $ponderado['id_user'])
                                            @if ($ponderado['ponderado'] > 0)
                                                {{ $ponderado['nombre_atributo_ponderado'] }}: <span
                                                    class="badge badge-info">{{ $ponderado['ponderado'] }} %</span><br>
                                            @else
                                                {{ $ponderado['nombre_atributo_ponderado'] }}: <span
                                                    class="badge badge-danger">{{ $ponderado['ponderado'] }}
                                                    %</span><br>
                                            @endif
                                        @endif
                                    @endforeach


                                </th>
                                @foreach ($atributos as $atributo)
                                    <td>
                                        @php

                                            $dias = [
                                                'Lunes',
                                                'Martes',
                                                'Miércoles',
                                                'Jueves',
                                                'Viernes',
                                                'Sábado',
                                                'Domingo',
                                            ];
                                            $dias_html = '';
                                            for ($i = 0; $i < count($dias); $i++) {
                                                $dias_html .=
                                                    "<div class='form-check'>
                                                <input class='form-check-input' type='checkbox' id='checkbox_efectividad' data-date='" .
                                                    $dias[$i] .
                                                    '-' .
                                                    $atributo['id_atributo'] .
                                                    '-' .
                                                    $user['cedula'] .
                                                    '-' .
                                                    $atributo['nombre_atributo'] .
                                                    "'>
                                                <label class='form-check-label'>" .
                                                    $dias[$i] .
                                                    "</label>
                                                </div>";
                                            }
                                        @endphp

                                        {!! $dias_html !!}
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach
                    </tbody>
                </table>


                
                
            </div>
            <hr>
            <center>
                <h3>Porcentaje efectividad Media</h3>
            </center>

            <div class="table-responsive">
                <table class="table" id="table_ponderado_final">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Cédula</th>
                            <th scope="col">Nombre/Apellido</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Total ponderado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finales as $final)
                            <tr>
    
                                <td><span class="badge badge-success">{{$final['id_user']}}</span></td>
                                <td>{{$final['nombre_user']}} {{$final['apellido_user']}}</td>
                                <td>{{$final['fecha']}}</td>
                                <td><span class="badge badge-info">{{$final['ponderado_final']}}%</span></td>
    
                            </tr>
                        @endforeach
    
    
                    </tbody>
                </table>
            </div>


        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_efectiveness" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg bg-info">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar atributos de evaluación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">


                        <div class="col-sm">

                            <label for="atribute">Nombre Atributo:</label>
                            <input type="text" id="atribute" name="atribute" class="form-control" autocomplete="off"
                                placeholder="Nombre atributo">

                            <label for="%_efectiveness">Porcentaje efectividad:</label>
                            <input type="number" id="%_efectiveness" name="atribute" class="form-control"
                                autocomplete="off" placeholder="Porcentaje para este atributo %...">

                            <div class="form-group">
                                <label for="selector_atribute">Seleccionar Atributo:</label>
                                <select class="form-control" id="selector_atribute">
                                    <option selected value="selected">Seleccionar atributo</option>

                                    @foreach ($atributos as $atributo)
                                        <option value="{{ $atributo['id_atributo'] }}">
                                            {{ $atributo['nombre_atributo'] }}</option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-info"
                        onclick="editAtriubte('{{ route('editPorcentaje') }}')">Cambiar porcentaje</button>
                    <button type="button" class="btn btn-danger"
                        onclick="deleteAtribute('{{ route('deleteAtribute') }}')">Eliminar Atributo</button>
                    <button type="button" class="btn btn-primary"
                        onclick="insertAtribute('{{ route('insertAtribute') }}')">Crear atributo</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_answer" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg bg-danger">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirmación de acción!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4>Seguro de reiniciar todos los ponderados?</h4>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-info"
                            onclick="resetPonderados('{{ route('resetPonderados') }}')">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
