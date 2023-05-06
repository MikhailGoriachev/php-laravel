<div class='m-3 p-3 border bg-white shadow rounded'>
    <h5>{{$title}}</h5>

    @if(count($array) > 0)
        <div class='row mt-3'>
            @foreach($array as $item)
                <div class='border m-2 p-2 shadow-sm w-8rem text-center rounded {{isset($isActive) ? $isActive($item) : ''}}'>
                    {{number_format($item, 3)}}
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            Нет данных
        </div>
    @endif
</div>
