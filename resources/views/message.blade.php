@if(session()->has('msg'))

<div class="alert alert-success" role="alert">
    {{session()->get('msg')}}
</div>

@endif
