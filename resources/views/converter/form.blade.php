<h1>Convert your file</h1>
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>

{!! Form::open(array('route' => 'converter', 'files' => true, 'class' => 'form')) !!}

<div class="form-group">
    {!! Form::file('file') !!}
</div>
<br>
<br>

<div class="form-group">
    {!! Form::radio('to', 'CSV') !!}CSV<br>
    {!! Form::radio('to', 'JSON') !!}JSON<br>
    {!! Form::radio('to', 'XML') !!}XML<br>
    {!! Form::radio('to', 'YAML') !!}YAML<br>
</div>
<br>
<br>
<div class="form-group">
    {!! Form::submit('Convert', array('class'=>'btn btn-primary')) !!}
</div>
{!! Form::close() !!}