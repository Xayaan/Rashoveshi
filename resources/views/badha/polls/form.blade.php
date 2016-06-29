@extends('layouts.badha')
{{-- Web site Title --}}
@section('title', 'Create Poll')
@section('content')
    <style>
        .thaana {
            font-family: "MV Waheed" !important;
            direction: rtl;
            text-align: right;
        }
    </style>
    {!! Form::model($poll, array('class' =>'ui form polls-form', 'autocomplete' =>'off', 'files' => true)) !!}
    <div class="two fields">
        {{-- Fields on left --}}
        <div class="eight wide field">
            <div class="field {{ $errors->first('title', ' error') }}">
                {!! Form::label('title','Title')!!}
                <div class="one field">
                    <div class="field">
                        {!! Form::text('title',null,['placeholder'=>'Enter the title of the poll..', 'class' => 'thaana', "required" => "required"]) !!}
                    </div>
                 </div>
            </div>

            <div class="field {{ $errors->first('desc', ' error') }}">
                {!! Form::label('desc','Description')!!}
                <div class="one field">
                    <div class="field">
                        {!! Form::textarea('desc',null,['placeholder'=>'Enter the description for this poll..', 'class' => 'thaana']) !!}
                    </div>
                 </div>
            </div>
        </div>
        <div class="one field">
            <h3>Choices</h3>
            <p>Enter one choice(option) per input field.</p>
            <button class="add-choice ui yellow button">
                <i class="add icon"></i> Add Choice
            </button>
            <hr>
            <div class="choices-wrapper">
                <div class="field {{ $errors->first('choice', ' error') }}">
                    <div class="one field">
                        <div class="field ui right labeled input">
                            {!! Form::text('choice',null,['placeholder'=>'Enter text here', 'class' => 'thaana', 'dir' => 'rtl', "style" => "text-align:right;", "required" => "required", "name" => "choices[]"]) !!}
                            <div class="ui basic label">1.</div>
                        </div>
                     </div>
                </div>
                <div class="field {{ $errors->first('choice', ' error') }}">
                    <div class="one field">
                        <div class="field ui right labeled input">
                            {!! Form::text('choice',null,['placeholder'=>'Enter text here', 'class' => 'thaana', 'dir' => 'rtl', "style" => "text-align:right", "required" => "required", "name" => "choices[]"]) !!}
                            <div class="ui basic label">2.</div>
                        </div>
                     </div>
                </div>
                <div class="field {{ $errors->first('choice', ' error') }}">
                    <div class="one field">
                        <div class="field ui right labeled input">
                        <button class="ui red button remove-choice" style="padding:5px;padding-left:10px"><i class="trash outline icon"></i></button>
                            {!! Form::text('choice',null,['placeholder'=>'Enter text here', 'class' => 'thaana', 'dir' => 'rtl', "style" => "text-align:right", "required" => "required", "name" => "choices[]"]) !!}
                            <div class="ui basic label">3.</div>
                        </div>
                     </div>
                </div>
                <div class="field {{ $errors->first('choice', ' error') }}">
                    <div class="one field">
                        <div class="field ui right labeled input">
                        <button class="ui red button remove-choice" style="padding:5px;padding-left:10px"><i class="trash outline icon"></i></button>
                            {!! Form::text('choice',null,['placeholder'=>'Enter text here', 'class' => 'thaana', 'dir' => 'rtl', "style" => "text-align:right", "required" => "required", "name" => "choices[]"]) !!}
                            <div class="ui basic label">4.</div>
                        </div>
                     </div>
                </div>
                <div class="field {{ $errors->first('choice', ' error') }}">
                    <div class="one field">
                        <div class="field ui right labeled input">
                        <button class="ui red button remove-choice" style="padding:5px;padding-left:10px"><i class="trash outline icon"></i></button>
                            {!! Form::text('choice',null,['placeholder'=>'Enter text here', 'class' => 'thaana', 'dir' => 'rtl', "style" => "text-align:right", "required" => "required", "name" => "choices[]"]) !!}
                            <div class="ui basic label">5.</div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>



    <hr>
    <button class="ui button">Discard</button>
    <button type="submit"class="ui primary button"> Save</button>
    {!! Form::close() !!}

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        var maxFields      = 5; //maximum input boxes allowed
        var wrapper         = $(".choices-wrapper"); //Fields wrapper
        var addButton      = $(".add-choice"); //Add button ID
        
        var x = 5; //initlal text box count
        $(addButton).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < maxFields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="one field"><div class="field ui right labeled input"><button class="ui red button remove-choice" style="padding:5px;padding-left:10px"><i class="trash outline icon"></i></button>{!! Form::text('choice',null,['placeholder'=>'Enter text here', 'class' => 'thaana', 'dir' => 'rtl', "style" => "text-align:right", "required" => "required", "name" => "choices[]"]) !!}<div class="ui basic label">'+x+'.</div></div></div>'
                );
            }
        });
        
        $(wrapper).on("click",".remove-choice", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent().parent().parent().remove(); x--;
        })
    });
</script>
@endsection