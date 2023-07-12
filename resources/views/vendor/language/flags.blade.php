<ul class="{{ config('language.flags.ul_class') }}">
    @foreach (language()->allowed() as $code => $name)
    <li class="{{ config('language.flags.li_class') }}">
        <a href="{{ language()->back($code) }}">
            <img src="{{ Vite::asset('vendor/akaunting/laravel-language/src/Resources/assets/img/flags/'. language()->country($code) .'.png') }}" alt="{{ $name }}" width="{{ config('language.flags.width') }}" />
        </a>
    </li>
    @endforeach
</ul>
