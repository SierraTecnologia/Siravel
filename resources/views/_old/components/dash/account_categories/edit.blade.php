@extends('layouts.dashboard.app')

@section('content')
    <section class="content-header">
        <h1>
            Account Category
        </h1>
   </section>
   <div class="content">

       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($accountCategory, ['route' => ['accountCategories.update', $accountCategory->id], 'method' => 'patch']) !!}

                        @include('dashboard.account_categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection