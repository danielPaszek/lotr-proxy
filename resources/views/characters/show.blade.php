@php /** @var App\Models\Character $character */ @endphp
<x-head :title="$character->name"/>
<div class="mt-6 mb-4">
    <div class="flex flex-col justify-center items-center">
    <h1 class="text-center text-xl font-semibold text-gray-900 dark:text-white"
        style="margin: 20px">{{$character->name}}</h1>
        @auth
            <a href="/characters/{{$character->name}}/edit">
                <button class="button">Edit character</button>
            </a>
        @endauth
    </div>
    <div>
        <div
            class="mt-4 text-center text-gray-500 dark:text-gray-400 text-sm leading-relaxed grid grid-cols-1 md:grid-cols-2 gap-6">
            <p><b>Race:</b> {{$character->race ? $character->race : "Unknown"}}</p>
            <p><b>Birth:</b> {{$character->birth ? $character->birth : "Unknown"}}</p>
            <p><b>Gender:</b> {{$character->gender ? $character->gender : "Unknown"}}</p>
            <p><b>Hair:</b> {{$character->hair ? $character->hair : "Unknown"}}</p>
            <p><b>Height:</b> {{$character->height ? $character->height : "Unknown"}}</p>
            <p><b>Realm:</b> {{$character->realm ? $character->realm : "Unknown"}}</p>
            <p><b>Spouse:</b> {{$character->spouse ? $character->spouse : "Unknown"}}</p>
        </div>
    </div>
    @if($character->quotes && $character->quotes[0])
        <h3 class="text-center mt-6">Quotes:</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 mt-6">

            @foreach($character->quotes as $quote)
                <div
                    class="max-w-32 max-h-32 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20  flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div class="text-center ">
                        <p>{{$quote->dialog}}</p>
                    </div>
                </div>

            @endforeach
        </div>
    @else
        <h3 class="text-center">No quotes :(</h3>
    @endif
    @if($character->images->isEmpty())
        <h3 class="text-center">No images :(</h3>
    @else
        <h3 class="text-center mt-6">Images:</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 mt-6">

            @foreach($character->images as $image)
                <a href="{{$image->url}}" target="_blank">
                    <div
                        class="scale-100 min-h-64 min-w-64  p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div class="h-64 w-64 bg-red-50 dark:bg-red-800/20 flex items-center justify-center">
                            <img src="{{$image->url}}"/>
                        </div>
                    </div>
                </a>

            @endforeach
        </div>
    @endif
</div>
<div>
    <ul class="inline-flex gap-6">
        @if($page != 1)
            <li>
                <a href="/characters/{{$character->name}}"
                   class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">First</a>
            </li>
            <li>
                <a href="/characters/{{$character->name}}?page={{$page-1}}"
                   class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&laquo;
                    Previous</a>
            </li>
        @endif
        @if($character->quotes && $character->quotes[0])
            <li>
                <a href="/characters/{{$character->name}}?page={{$page+1}}"
                   class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next
                    &raquo; </a>
            </li>

        @else
            <li>
                No more quotes
            </li>
        @endif

    </ul>
</div>
<x-footer/>

