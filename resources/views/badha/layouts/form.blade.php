@extends('layouts.badha') {{-- Web site Title --}} @section('title', 'Layout Manager') @section('content')
<main class="ui stackable grid">
    <div class="row" style="margin-top:20px;">
        <div class="eight wide column left floated">
            {!! Form::model($layout, array('class' =>'ui form layout-form', 'autocomplete' =>'off', 'files' => true)) !!}
            {!! Form::hidden('user_id',$currentUser->id,[])!!}
            <div class="four fields" direction="rtl">
                <div class="field">
                    {!! Form::label('pos_4','Position 4')!!}
                    <div class="one field">
                        <div class="field">
                            {!! Form::text('pos_4',$layout['pos_4'],['placeholder'=>'Pos 4','class'=>'set_field_no']) !!}
                        </div>
                    </div>
                </div>
                <div class="field">
                    {!! Form::label('pos_3','Position 3')!!}
                    <div class="one field">
                        <div class="field">
                            {!! Form::text('pos_3',$layout['pos_3'],['placeholder'=>'Pos 3','class'=>'set_field_no']) !!}
                        </div>
                    </div>
                </div>
                <div class="field">
                    {!! Form::label('pos_2','Position 2')!!}
                    <div class="one field">
                        <div class="field">
                            {!! Form::text('pos_2',$layout['pos_2'],['placeholder'=>'Pos 2','class'=>'set_field_no']) !!}
                        </div>
                    </div>
                </div>
                <div class="field">
                    {!! Form::label('pos_1','Main')!!}
                    <div class="one field">
                        <div class="field">
                            {!! Form::text('pos_1',$layout['pos_1'],['placeholder'=>'Main','style'=>'border:1px solid purple;','class'=>'set_field_no']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="three fields">
                <div class="field">
                    {!! Form::label('developing','Developing')!!}
                    <div class="one field ">
                        <div class="field">
                            {!! Form::text('developing',$layout['developing'],['placeholder'=>'Developing','style'=>'border:1px solid #f2711c;','class'=>'set_field_no']) !!}
                        </div>
                    </div>
                </div>
                <div class="field">
                    {!! Form::label('live','Live')!!}
                    <div class="one field">
                        <div class="field">
                            {!! Form::text('live',$layout['live'],['placeholder'=>'Live','style'=>'border:1px solid #2185d0;','class'=>'set_field_no']) !!}
                        </div>
                    </div>
                </div>
                <div class="field">
                    {!! Form::label('breaking','Breaking')!!}
                    <div class="one field">
                        <div class="field">
                            {!! Form::text('breaking',$layout['breaking'],['placeholder'=>'Breaking','style'=>'border:1px solid #db2828;','class'=>'set_field_no']) !!}
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::submit("Update",['class'=>'ui submit button fluid green']) !!}
         {!! Form::close() !!}
            </div>
                <div class="eight wide column right floated">
                    <div class="ui ignored message status_layout_msg" style="display:none;"></div>
                    <table class="ui selectable inverted table striped">
                        <thead>
                            <tr>
                                <th class="right aligned">Heading</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($posts) @foreach ($posts as $post)
                            <tr class="add_field_no" data-id="{{ $post->id }}">
                                <td class="thaana thaana_bold right aligned">{{ $post->heading }}</td>
                                <td>{{ $post->id }}</td>
                            </tr>
                            @endforeach @endif
                        </tbody>
                    </table>
                </div>
        </div>
</main>
<table class="ui very basic selectable blue table striped">
    <thead>
        <tr>
            <th>User</th>
            <th>Live</th>
            <th>Devl</th>
            <th>Brk</th>
            <th>Pos_4</th>
            <th>Pos_3</th>
            <th>Pos_2</th>
            <th>Main</th>
            <th>ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($layouts as $lout)
        <tr>
            <td>{{ $lout->created_by->first_name }}</td>
            <td>{{ $lout->live }}</td>
            <td>{{ $lout->developing }}</td>
            <td>{{ $lout->breaking }}</td>
            <td>{{ $lout->pos_4 }}</td>
            <td>{{ $lout->pos_3 }}</td>
            <td>{{ $lout->pos_2 }}</td>
            <td>{{ $lout->pos_1 }}</td>
            <td>{{ $lout->id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</section>
@stop
@section('scripts')
<script type="text/javascript">

	var setField;

	$(document).ready(function(){
		$('.set_field_no').on('click', function(e){
			e.preventDefault();
			setField = $(this).attr('id');
		});

		$('.add_field_no').on('click', function(e){
			e.preventDefault();
			var id = $(this).data('id');

			if(!setField){
				console.log('Select a Layout Position First');
			}else{
				$('#' + setField).val(id);
				setField ='';
			}
		});




	});


</script>
@endsection