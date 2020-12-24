@if(session()->has('message'))
<div class="alert alert-info" role="alert">
    <strong>{{session()->get('message')}}</strong>
</div>
@endif