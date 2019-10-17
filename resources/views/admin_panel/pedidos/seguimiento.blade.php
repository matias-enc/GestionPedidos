@extends('admin_panel.index')
@section('content')
{{-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12 offset-1">
                <a href=" {{ URL::previous() }} " class="btn btn-outline-primary btn-pill">
<b>&larr; Volver </b>
</a>
</div>
</div>
<br> --}}
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-4">


            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    </div>
                    <div class="timeline">
                        <div class="time-label">
                            <span class="bg-secondary" style="color: ">Seguimiento</span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        @foreach ($historiales as $historial)
                        @if($historial->estado->nombre != 'Finalizado')
                        <div>
                            <i class="fas fa-check bg-success"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fal fa-check"></i>
                                    {{$historial->created_at->diffForHumans()}}</span>
                                <h3 class="timeline-header"><strong>{{$historial->estado->nombre}} </strong></h3>

                            </div>
                        </div>
                        @else
                        <div>
                            <i class="fas fa-times bg-danger"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fal fa-check"></i>
                                    {{$historial->created_at->diffForHumans()}}</span>
                                <h3 class="timeline-header"><strong>{{$historial->estado->nombre}} </strong></h3>

                            </div>
                        </div>
                        @endIf

                        <!-- END timeline item -->
                        @endforeach
                        @if($historial->estado->nombre != 'Finalizado')
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.timeline -->
        </div>

    </div>
    <!-- /.card-body -->
</div>




@endsection
