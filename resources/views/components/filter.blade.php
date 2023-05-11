<div>
    <form method="GET" action="/characters">
        @foreach($categories as $name => $values)
            <div class="flex flex-col  mt-4">
                <div class="flex gap-4" style="margin-top:0">
                    <h3 class="" style="margin-bottom: 0; padding-bottom: 5px">{{$name}}:</h3>
                @foreach($values as $value)
                    @php
                        $isOn = boolval(request($name . '_' . $value, false));
                    @endphp
                    <div>
                        <label style="font-size: small">
                        <input type="checkbox"
                               @if($isOn)
                               checked="true"
                               @endif
                               name="{{$name}}_{{$value}}">
                        {{$value}}
                        </label>
                    </div>
                @endforeach
                </div>
            </div>
        @endforeach
        <button class="button mt-4" role="button">Filter</button>
    </form>
</div>
