<div class="w-full flex flex-col">
    <label class="text-slate-400 capitalize">{{$label}} @if($required) <span class="text-red-500">*</span> @endif </label>
    <input
        name="{{$name}}"
        type="{{$type}}"
        placeholder="{{$placeholder}}"
        class="ring-1 ring-slate-200 p-1 rounded-md focus:outline-none"
{{--        @if($required) required @endif--}}
        value="{{$value}}"
        step="{{$step}}"
        {{$attributes}}
    />

    @error($name)
    <div class="text-sm text-red-500">{{ $message }}</div>
    @enderror
</div>
