@extends('layouts.dashboard.app')

@section('content')
    <section class="content-header">
        <h1>
            Dominios
        </h1>
   </section>
   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($dominios, ['route' => ['dominios.update', $dominios->id], 'method' => 'patch']) !!}

                        @include('dashboard.dominios.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection