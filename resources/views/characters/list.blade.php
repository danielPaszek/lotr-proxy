<x-head title="Characters names"/>
<div class="mt-16 mb-4">
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-6 lg:gap-8">
        @foreach($characters as $lightCharacter)
            @php /** @var App\Models\LightCharacter $lightCharacter */ @endphp
            <a href="{{'/characters/'. $lightCharacter->name}}">
                <div
                    class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{$lightCharacter->name}}</h2>
                    </div>
                </div>
            </a>

        @endforeach
    </div>
</div>
<div>
    <ul class="inline-flex gap-6">
        @if($page != 1)
            <li>
                <a href="/characters_names/?q={{$q}}"
                   class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">First</a>
            </li>
            <li>
                <a href="/characters_names/?q={{$q}}&page={{$page-1}}"
                   class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&laquo;
                    Previous</a>
            </li>
        @endif
        @if($page != $characters->lastPage())
            <li>
                <a href="/characters_names/?q={{$q}}&page={{$page+1}}"
                   class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next
                    &raquo; </a>
            </li>
        @endif
    </ul>
</div>
<x-footer/>

