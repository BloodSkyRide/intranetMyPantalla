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
                <h3>Horarios de usuarios y aseos</h3>
            </center>

            <hr>

            <div class="table-responsive">
                <table class="table" id="table_schedule">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Cédula</th>
                            <th scope="col">Nombre</th>
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
    
                        @foreach ($users as $key => $user)

                        @php
                            $lunes = ($user['aseo-lunes']) ? "<i title='Realizar aseo' class='fa-solid fa-toilet' style='color: #1c8266'></i>" : "";
                            $martes = ($user['aseo-martes']) ? "<i title='Realizar aseo' class='fa-solid fa-toilet' style='color: #1c8266'></i>" : "";
                            $miercoles = ($user['aseo-miercoles']) ? "<i title='Realizar aseo' class='fa-solid fa-toilet' style='color: #1c8266'></i>" : "";
                            $jueves = ($user['aseo-jueves']) ? "<i title='Realizar aseo' class='fa-solid fa-toilet' style='color: #1c8266'></i>" : "";
                            $viernes = ($user['aseo-viernes']) ? "<i title='Realizar aseo' class='fa-solid fa-toilet > style='color: #1c8266'</i>" : "";
                            $sabado = ($user['aseo-sabado']) ? "<i title='Realizar aseo' class='fa-solid fa-toilet' style='color: #1c8266'></i>" : "";
                            $domingo = ($user['aseo-domingo']) ? "<i title='Realizar aseo' class='fa-solid fa-toilet' style='color: #1c8266'></i>" : "";


                        @endphp
 

                            <tr>
                                <th scope="row">
                                    
                                    @if ($rol === "administrador")
                                    <a type="button" title="Editar o modificar horario" onclick="modalSchedule('{{ $user['cedula'] }}', '{{ $user['nombre'] }}', '{{ $user['apellido'] }}')" data-toggle="modal" data-target="#editSchedules"><i class="fa-solid fa-clock text-dark"></i>&nbsp;&nbsp;<span class="badge bg-success">{{ $user['cedula'] }}</span></a>
                                        
                                    @else
                                    <span class="badge bg-success">{{ $user['cedula'] }}</span>
                                    @endif
                                </th>


                                @if ($rol === "administrador")
                                    
                                <td>{{ $user['nombre'] }} {{ $user['apellido'] }}</td>
                                <td><span class="badge bg-info">{!! $user['lunes'] !!}</span>&nbsp;&nbsp; <a type="button" onclick="deleteClear('{{route('deleteclear')}}','{{$user['cedula'] }}', 'aseo-lunes')">{!! $lunes !!}</a></td>
                                <td><span class="badge bg-info">{!! $user['martes'] !!}</span>&nbsp;&nbsp; <a type="button" onclick="deleteClear('{{route('deleteclear')}}','{{$user['cedula'] }}', 'aseo-martes')">{!! $martes !!}</a></td>
                                <td><span class="badge bg-info">{!! $user['miercoles'] !!}</span>&nbsp;&nbsp; <a type="button" onclick="deleteClear('{{route('deleteclear')}}','{{$user['cedula'] }}', 'aseo-miercoles')">{!! $miercoles !!}</a></td>
                                <td><span class="badge bg-info">{!! $user['jueves'] !!}</span>&nbsp;&nbsp; <a type="button" onclick="deleteClear('{{route('deleteclear')}}','{{$user['cedula'] }}', 'aseo-jueves')">{!! $jueves !!}</a></td>
                                <td><span class="badge bg-info">{!! $user['viernes'] !!}</span>&nbsp;&nbsp; <a type="button" onclick="deleteClear('{{route('deleteclear')}}','{{$user['cedula'] }}', 'aseo-viernes')">{!! $viernes !!}</a></td>
                                <td><span class="badge bg-info">{!! $user['sabado'] !!}</span>&nbsp;&nbsp; <a type="button" onclick="deleteClear('{{route('deleteclear')}}','{{$user['cedula'] }}', 'aseo-sabado')">{!! $sabado !!}</a></td>
                                <td><span class="badge bg-info">{!! $user['domingo'] !!}</span>&nbsp;&nbsp; <a type="button" onclick="deleteClear('{{route('deleteclear')}}','{{$user['cedula'] }}', 'aseo-domingo')">{!! $domingo !!}</a></td>
                                @else

                                                                <td>{{ $user['nombre'] }} {{ $user['apellido'] }}</td>
                                <td><span class="badge bg-info">{!! $user['lunes'] !!}</span>&nbsp;&nbsp; {!! $lunes !!}</td>
                                <td><span class="badge bg-info">{!! $user['martes'] !!}</span>&nbsp;&nbsp; {!! $martes !!}</td>
                                <td><span class="badge bg-info">{!! $user['miercoles'] !!}</span>&nbsp;&nbsp; {!! $miercoles !!}</td>
                                <td><span class="badge bg-info">{!! $user['jueves'] !!}</span>&nbsp;&nbsp; {!! $jueves !!}</td>
                                <td><span class="badge bg-info">{!! $user['viernes'] !!}</span>&nbsp;&nbsp; {!! $viernes !!}</td>
                                <td><span class="badge bg-info">{!! $user['sabado'] !!}</span>&nbsp;&nbsp; {!! $sabado !!}</td>
                                <td><span class="badge bg-info">{!! $user['domingo'] !!}</span>&nbsp;&nbsp; {!! $domingo !!}</td>

                                @endif
    
                            </tr>
                        @endforeach
    
                    </tbody>
                </table>
            </div>



        </div>

    </div>
</div>

<script>

    $(document).ready(function(){



        $("#table_schedule").DataTable({
            responsive: true,
            order: [[7, "desc"]],
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            language: {
                search: "Buscar en la tabla:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior",
                },
                emptyTable: "No hay datos disponibles",
            },
        });
    })




    document.getElementById("select_main").addEventListener("change", getOptions); // recibe una funcion como parametro;



    function getOptions() {


        let value = document.getElementById("select_main").value;
        let container = document.getElementById("container_options");

        let node_children = container.childNodes.length;

        let dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];

        if (node_children > 0) {

            container.innerHTML = "";

        }

        if (value === "individual") {

            let select = document.createElement("select");
            container.appendChild(select);

            let label = document.createElement("label");

            label.innerHTML = "Selecciona el día:";

            label.setAttribute("for", "selector_days");



            select.setAttribute("id", "selector_days");

            let selector_days = document.getElementById("selector_days");

            selector_days.setAttribute("class", "form-control");

            let selected = document.createElement("option");

            selected.textContent = "Seleccionar día";
            selected.setAttribute("value", "selected");

            selected.setAttribute("selected", "selected");

            selector_days.add(selected);
            dias.forEach((element) => {

                let option = document.createElement("option");

                option.textContent = element;

                let valor = element.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                option.setAttribute("value", valor.toLowerCase());
                selector_days.add(option);

            })



        }

    }
</script>
</div>
