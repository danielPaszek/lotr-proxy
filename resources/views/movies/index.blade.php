<x-head title="Lotr characters"/>

<div class="mt-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        @foreach($movies as $movie)
            @php /** @var App\Models\Movie $movie */
            @endphp
            <div
                class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div>
                    <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center">
                        <svg height="800px" width="800px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             viewBox="0 0 57.581 57.581" xml:space="preserve">
                            <g>
                                <path style="fill:#000;" d="M53.529,11.54c0.589,0,1.063-0.476,1.063-1.064s-0.477-1.064-1.063-1.064h-2.485v-7.28h2.485
                                    c0.589,0,1.063-0.479,1.063-1.066s-0.477-1.064-1.063-1.064L4.052,0C3.464,0,2.988,0.478,2.988,1.065s0.476,1.066,1.064,1.066
                                    h1.951V9.41H4.052c-0.588,0-1.064,0.477-1.064,1.065s0.477,1.064,1.064,1.064h9.113v34.504H4.052c-0.588,0-1.064,0.477-1.064,1.064
                                    c0,0.589,0.477,1.064,1.064,1.064h1.951v7.28H4.052c-0.588,0-1.064,0.478-1.064,1.065s0.477,1.065,1.064,1.065h49.476
                                    c0.59,0.002,1.064-0.477,1.064-1.065c0-0.588-0.477-1.064-1.063-1.064h-2.485v-7.279h2.485c0.589,0,1.063-0.477,1.063-1.065
                                    s-0.477-1.063-1.063-1.063h-8.879V11.54H53.529z M33.877,2.132h6.453v7.279h-6.453V2.132z M25.298,2.132h6.451v7.279h-6.451V2.132z
                                     M16.716,2.132h6.451v7.279h-6.451V2.132z M14.585,55.454H8.134v-7.28h6.451C14.585,48.174,14.585,55.454,14.585,55.454z
                                     M14.585,9.41H8.134V2.131h6.451C14.585,2.131,14.585,9.41,14.585,9.41z M14.586,11.54H43.23v34.504H14.586V11.54z M23.167,55.454
                                    h-6.451v-7.278h6.451V55.454z M31.749,55.454h-6.451v-7.278h6.451V55.454z M40.332,55.454h-6.453v-7.278h6.453V55.454z
                                     M48.913,48.176v7.278h-6.451v-7.278H48.913z M42.461,9.411V2.132h6.451v7.279H42.461z"/>
                            </g>
                            </svg>
                    </div>

                    <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{$movie->name}}</h2>

                    <div class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        <p><b>Runtime in minutes:</b> {{$movie->runtimeInMinutes}}</p>
                        <p><b>Budget (mln$):</b> {{$movie->budgetInMillions}}</p>
                        <p><b>Box office revenue (mln$): </b> {{$movie->boxOfficeRevenueInMillions}}</p>
                        <p><b>Academy Award Nominations: </b> {{$movie->academyAwardNominations}}</p>
                        <p><b>Academy Award Wins: </b> {{$movie->academyAwardWins}}</p>
                        <p><b>Rotten tomatoes score: </b> {{$movie->rottenTomatoesScore}}</p>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
<x-footer/>

