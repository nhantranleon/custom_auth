<ul>
    @foreach ($list as $value)
        <li onclick="setValueInput(this)">{{ $value }}</li>
    @endforeach
</ul>