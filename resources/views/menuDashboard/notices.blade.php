<div class="container-fluid">

    <div class="card card-primary">
        <div class="card-header" style="background-color: #0f318f">
            <h3 class="card-title"><i class="fa-solid fa-newspaper"></i>&nbsp;&nbsp;Noticias</h3>
        </div>
        <div class="card-body">


            {{-- <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-interval="10000">
                        <img src="..." class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-interval="2000">
                        <img src="..." class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="..." class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-target="#carouselExampleInterval"
                    data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-target="#carouselExampleInterval"
                    data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </button>
            </div> --}}
            <hr>
            <center>
                <h3>Porcentajes de efectividad</h3>
            </center>

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
                            <th style="position: sticky; top: 0; z-index: 1;">
                                <center>Ponderado Final<br><i class="fa-solid fa-chart-simple"></i></center>
                            </th>
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
                                    <center>
                                        @if ($user['cedula'] == $ponderado['id_user'])
                                            @if ($ponderado['ponderado'] > 0)
                                                {{ ucfirst($ponderado['nombre_atributo_ponderado']) }}: <span
                                                    class="badge badge-info">{{ $ponderado['ponderado'] }} %</span><br>
                                            @else
                                                {{ ucfirst($ponderado['nombre_atributo_ponderado']) }}: <span
                                                    class="badge badge-danger">{{ $ponderado['ponderado'] }}
                                                    %</span><br>
                                            @endif
                                        @endif
                                    @endforeach
                                </center>
                                </th>

                                @foreach ($porcentajes as $porcentaje)
                                    @if ($porcentaje['id_user'] == $user['cedula'])
                                        <th>
                                            <center><span class="badge badge-primary">{{ $porcentaje['ponderado_suma'] }} %</span></center>
                                        </th>
                                    @endif
                                @endforeach

                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>

        </div>

    </div>

</div>
