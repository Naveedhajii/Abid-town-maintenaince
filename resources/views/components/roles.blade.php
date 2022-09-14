
<label for="roles[]">Please select roles</label>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css"
/>

<div class="w-25">
<select class="form-select w-25" type='select-multiple' id="select-multiple" name="roles[]" id="choices"  multiple >
    @foreach($roles as $key => $value)
    @php
$yes=false;
@endphp
    @foreach ($userRoles as $userrole)
    @if ($userrole->id===$value->id)
        @php
            $yes=true;
        @endphp
    @endif
    @endforeach
        <option value="{{$value->id}}" @if($yes)selected="selected"@endif >
            {{$value->description}}
        </option>
    @endforeach
</select>
</div>

<br>
<!-- Include Choices JavaScript (latest) -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- Or versioned -->
<script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js"></script>
<script>$(document).ready(function(){
    
    var multipleCancelButton = new Choices('#select-multiple', {
       removeItemButton: true,
       searchResultLimit:5
     }); 
    
    
});</script>
{{-- @if(in_array($value->id, $userRoles))selected="selected"@endif --}}