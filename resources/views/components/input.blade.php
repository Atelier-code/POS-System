<div class="w-full flex flex-col">
    <label class="text-slate-600 font-medium capitalize mb-2">{{$label}} @if($required) <span class="text-red-500">*</span> @endif</label>
    <input
        name="{{$name}}"
        type="{{$type}}"
        placeholder="{{$placeholder}}"
        class="ring-1 ring-gray-300 focus:ring-gray-500 focus:ring-2 transition-shadow shadow-sm p-2 rounded-lg focus:outline-none text-gray-800"
        @if($required) required @endif
        value="{{$value}}"
        step="{{$step}}"
        {{$attributes}}
    />

    @error($name)
    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
    @enderror
</div>
