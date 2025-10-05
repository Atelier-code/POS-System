<a href="{{$url}}" class="group flex items-center px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ $active ? 'bg-slate-700 text-white shadow-md' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
    <div class="flex-shrink-0 {{ $active ? 'text-gray-200' : 'text-gray-400 group-hover:text-gray-200' }}">
        {{$slot}}
    </div>
    <span class="ml-3 flex-1">{{ $name }}</span>
    @if($active)
        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
    @endif
</a>
