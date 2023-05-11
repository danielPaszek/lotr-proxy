@php /** @var App\Models\Character $character */
    $globalIndex = 0;
@endphp
<x-head :title="$character->name"/>
<div class="mt-16">
    <form method="POST" action="/characters/{{$character->name}}/edit">
        @csrf
        <h1 class="text-center text-xl font-semibold text-gray-900 dark:text-white"
            style="margin: 20px">{{$character->name}}</h1>
        <div>
            <div
                class="mt-4 text-center text-gray-500 dark:text-gray-400 text-sm leading-relaxed grid grid-cols-1 md:grid-cols-2 gap-6">
                <p><b>Race:</b> <input name="race" value="{{$character->race }}"/></p>
                <p><b>Birth:</b> <input name="birth" value="{{$character->birth }}"/></p>
                <p><b>Gender:</b> <input name="gender" value="{{$character->gender }}"/>
                </p>
                <p><b>Hair:</b> <input name="hair" value="{{$character->hair }}"/></p>
                <p><b>Height:</b> <input name="height" value="{{$character->height }}"/>
                </p>
                <p><b>Realm:</b> <input name="realm" value="{{$character->realm }}"/></p>
                <p><b>Spouse:</b> <input name="spouse" value="{{$character->spouse }}"/> </p>
                <p><b>Wiki Url:</b> <input name="wiki_url" value="{{$character->wiki_url }}"/></p>
            </div>
        </div>
        @if($character->images->isEmpty())
            <h3 class="text-center">Upload images:</h3>
            <label>Source:
                <input name="image.{{$index}}" value="{{$image->url}}"/>
            </label>
        @else
            <h3 class="text-center mt-6">Images:</h3>
            <div id="images" class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 mt-6">

                @foreach($character->images as $index => $image)
                    <div>
                        <div
                            class="scale-100 min-h-64 min-w-64  p-6 bg-white from-gray-700/50 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex flex-col motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div class="h-64 w-64 bg-red-50 dark:bg-red-800/20 flex items-center justify-center">
                                <img src="{{$image->url}}"/>
                            </div>
                            <label>Source: <br>
                                <input name="image.{{$index}}" style="width: 100%" type="text" value="{{$image->url}}"/>
                            </label>
                        </div>
                    </div>
                    @php
                    $globalIndex++;
                    @endphp
                @endforeach
            </div>
        @endif
        <button id="add_image">Add image</button>
        <button type="submit">Submit</button>
    </form>
</div>
<script>
    let btn = document.querySelector("#add_image");
    let images = document.querySelector("#images");
    let globalIndex = {{$globalIndex}};
    btn.addEventListener("click", function (event) {
        event.preventDefault();
        const div = document.createElement("div");
        const classes = ["flex", "items-center", "justify-center", "flex-col"];
        div.classList.add(...classes);
        const h3 = document.createElement("h3");
        h3.textContent = "Upload Image";
        const label = document.createElement("label");
        label.textContent = "source: ";
        const input = document.createElement("input");
        console.log(globalIndex);
        input.setAttribute("name", "image."+globalIndex);
        globalIndex++;
        div.append(h3);
        div.append(label);
        div.append(input);
        images.append(div);
    })
</script>
<x-footer/>

