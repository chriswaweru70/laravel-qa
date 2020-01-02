@if ($model instanceof App\Question)
    @php
        $name = 'question';
        $firstURLSegment = 'questions';
    @endphp
@elseif ($model instanceof App\Answer)  
    @php
        $name = 'answer';
        $firstURLSegment = 'answers';  
    @endphp
@endif
@php 
 $formId = $name . "-" . $model->id;
 $formAction = "/{$firstURLSegment}/{$model->id}"
@endphp    
