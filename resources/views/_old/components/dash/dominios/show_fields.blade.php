<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $dominios->id !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('words.updatedAt').':') !!}
    <p>{!! $dominios->updated_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('words.createdAt').':') !!}
    <p>{!! $dominios->created_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', trans('words.deletedAt').':') !!}
    <p>{!! $dominios->deleted_at !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('words.name').':') !!}
    <p>{!! $dominios->name !!}</p>
</div>

