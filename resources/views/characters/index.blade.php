<x-head title="Lotr characters"/>
<x-filter :categories="$categories"/>
@if($message)
    <p class="mt-6 {{$msgClass}}">{{$message}}</p>
@endif
<div class="mt-16 mb-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        @foreach($characters as $character)
            @php /** @var App\Models\Character $character */
            /** @var array $categories */
            @endphp
            <a href="{{'/characters/'. $character->name}}">
                <div
                    class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                    <div>
                        <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center">
                            @if($character->images()->first())
                                <img src="{{$character->images()->first()->url}}"/>
                            @else
                                <svg width="100px" height="100px" viewBox="0 0 20 20" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink">

                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                       fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview"
                                           transform="translate(-380.000000, -2119.000000)" fill="#000000">
                                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                                <path
                                                    d="M338.083123,1964.99998 C338.083123,1962.79398 336.251842,1960.99998 334,1960.99998 C331.748158,1960.99998 329.916877,1962.79398 329.916877,1964.99998 C329.916877,1967.20599 331.748158,1968.99999 334,1968.99999 C336.251842,1968.99999 338.083123,1967.20599 338.083123,1964.99998 M341.945758,1979 L340.124685,1979 C339.561214,1979 339.103904,1978.552 339.103904,1978 C339.103904,1977.448 339.561214,1977 340.124685,1977 L340.5626,1977 C341.26898,1977 341.790599,1976.303 341.523154,1975.662 C340.286989,1972.69799 337.383888,1970.99999 334,1970.99999 C330.616112,1970.99999 327.713011,1972.69799 326.476846,1975.662 C326.209401,1976.303 326.73102,1977 327.4374,1977 L327.875315,1977 C328.438786,1977 328.896096,1977.448 328.896096,1978 C328.896096,1978.552 328.438786,1979 327.875315,1979 L326.054242,1979 C324.778266,1979 323.773818,1977.857 324.044325,1976.636 C324.787453,1973.27699 327.107688,1970.79799 330.163906,1969.67299 C328.769519,1968.57399 327.875315,1966.88999 327.875315,1964.99998 C327.875315,1961.44898 331.023403,1958.61898 334.733941,1959.04198 C337.422678,1959.34798 339.650022,1961.44698 340.05323,1964.06998 C340.400296,1966.33099 339.456073,1968.39599 337.836094,1969.67299 C340.892312,1970.79799 343.212547,1973.27699 343.955675,1976.636 C344.226182,1977.857 343.221734,1979 341.945758,1979 M337.062342,1978 C337.062342,1978.552 336.605033,1979 336.041562,1979 L331.958438,1979 C331.394967,1979 330.937658,1978.552 330.937658,1978 C330.937658,1977.448 331.394967,1977 331.958438,1977 L336.041562,1977 C336.605033,1977 337.062342,1977.448 337.062342,1978"
                                                    id="profile_round-[#1346]">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            @endif
                        </div>

                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{$character->name}}</h2>

                        <div class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        <p><b>Race:</b> {{$character->race}}</p>
                        <p><b>Birth:</b> {{$character->birth}}</p>
                        <p><b>Death:</b> {{$character->death}}</p>
                        </div>
                    </div>
                </div>
            </a>

        @endforeach
    </div>
</div>
<div>
    <ul class="inline-flex gap-6">
        @php
        $link = '';
            foreach ($categories as $name => $values) {
                foreach ($values as $value) {
                    $isOn = boolval(request($name . '_' . $value, false));
                    if($isOn) {
                        $link .= $name . '_' . $value . '=on&';
                    }
                }
            }

        @endphp
        @if($page != 1)
            <li>
                <a href="/characters/?{{$link}}"
                   class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">First</a>
            </li>
            <li>
                <a href="/characters/?page={{$page-1}}&{{$link}}"
                   class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">&laquo; Previous</a>
            </li>
        @endif
        <li>
            <a href="/characters/?page={{$page+1}}&{{$link}}"
               class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next &raquo; </a>
        </li>
    </ul>
</div>
<x-footer />

