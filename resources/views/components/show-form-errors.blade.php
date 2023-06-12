<p style="color:red">{{ __('layout.oops') }}</p>
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li style="color:red">{{ $error }}</li>
        @endforeach
    </ul>
</div>