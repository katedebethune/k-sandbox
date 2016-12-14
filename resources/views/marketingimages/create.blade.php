
@extends('layouts.master')

@section('content')

    {!! Breadcrumb::withLinks(['Home' => '/', 'marketing images' => '/marketingimage', 'create']) !!}

     <h1>Upload a Photo </h1>


     <hr/>

     @if (count($errors) > 0)
	 <div class="alert alert-danger">
	 <strong>Whoops! </strong> There were some problems with your input. <br> <br>
	 <ul>
	     @foreach ($errors->all() as $error)
		 <li>{{ $error }} </li>
	     @endforeach

         </ul>
         </div>

    @endif


    {!! Form::open(array('route' => 'marketingimage.store', 'class' => 'form', 'files' => true)) !!}

     <!-- image name Form Input -->
     <div class="form-group">
        {!! Form::label('image name', 'Image name:') !!}
        {!! Form::text('image_name', null, ['class' => 'form-control']) !!}
     </div>


     <!-- mobile_image_name Form Input -->
     <div class="form-group">
        {!! Form::label('mobile_image_name', 'Mobile Image Name:') !!}
        {!! Form::text('mobile_image_name', null, ['class' => 'form-control']) !!}
     </div>


     <!-- is_something Form Input -->
     <div class="form-group">
        {!! Form::label('is_active', 'Is Active:') !!}
        {!! Form::checkbox('is_active') !!}
     </div>

     <!-- is_featured Form Input -->
     <div class="form-group">
        {!! Form::label('is_featured', 'Is Featured:') !!}
        {!! Form::checkbox('is_featured') !!}
     </div>

    <!-- form field for file -->
    <div class="form-group">
       {!! Form::label('image', 'Primary Image') !!}
       {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
    </div>

     <!-- form field for file -->
     <div class="form-group">
        {!! Form::label('mobile_image', 'Mobile Image') !!}
        {!! Form::file('mobile_image', null, array('required', 'class'=>'form-control')) !!}
     </div>

     <div class="form-group">

        {!! Form::submit('Upload Photo', array('class'=>'btn btn-primary')) !!}

     </div>

    {!! Form::close() !!}

@endsection
