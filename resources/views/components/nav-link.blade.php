<a href="{{$url}}" class="{{ $active ? 'text-left w-full bg-gray-700 p-2 flex items-center font-semibold rounded-md' : 'text-left w-full hover:bg-gray-700 p-2 flex items-center font-semibold rounded-md' }}">
    {{$slot}}
    <div class="ml-2">
        {{ $name }}
    </div>
</a>
