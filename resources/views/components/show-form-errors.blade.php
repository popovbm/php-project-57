<p style="color:red">Упс! Что-то пошло не так:</p>
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li style="color:red">{{ $error }}</li>
        @endforeach
    </ul>
</div>