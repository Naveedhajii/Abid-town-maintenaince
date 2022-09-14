<h2>Permissions</h2>
<script>
    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
function check(id){
    var check;
    if(id.checked==true){
        check=true;
    }
    else{
        check=false;
    }
    const lists = id.classList;
    const items = document.getElementsByClassName(lists);
    for (let x of items) {
    x.checked=check;
}
}

</script>


<input type="checkbox" onclick="toggle(this);"> Select  all?<br><br>
    @php
    $i=1;
    @endphp
    @foreach ($permissions as $permission)
        @php
            $yes=false;
            $permission_name=explode('.',$permission->slug);
        @endphp

        @if ($i==1)
        
            <div style=
            >
             <div style="gap: 5px; ">
            <input class="{{$permission_name[1]}}" id="{{$permission_name[1]}}"  type="checkbox" 
            onclick="check(document.getElementById('{{$permission_name[1]}}'))">
            <label for="{{$permission_name[1]}}"><h3>{{$permission_name[1]}}</h3></label>
            </div>
            <div style="justify-content: space-between; display:flex;">
                <br>
        @endif
@php
    
@endphp
@foreach ($rolePermissions as $userp)
@if ($userp->id===$permission->id)
                @php
                    $yes=true;
                @endphp
            @endif
            @endforeach
        <div style="gap: 5px; ">
            @if($yes)
                <input class="{{$permission_name[1]}}" checked type="checkbox"  name="permissions[{{$permission->id}}]" value="{{$permission->id}}">
                <label for="permissions[{{$permission->id}}]">{{$permission->description}}</label>
            @else
                <input class="{{$permission_name[1]}}" type="checkbox"  name="permissions[{{$permission->id}}]" value="{{$permission->id}}">
                <label for="permissions[{{$permission->id}}]">{{$permission->description}}</label>
            @endif
        </div>
        @if ($i==4)
            </div>
        </div>
            <br>
            @php
                $i=1;
            @endphp
        @else
            @php
                $i++;
            @endphp
        @endif

    @endforeach


