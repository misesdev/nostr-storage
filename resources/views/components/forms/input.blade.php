@php

    $properties = [
        'label' => isset($label) ? $label : 'label',
        'name' => isset($name) ? $name : 'name',
        'type' => isset($type) ? $type : 'text',
        'value' => isset($value) ? $value : '',
        'required' => isset($required) ? 'required' : '',
        'maxlength' => isset($maxlength) ? $maxlength : null,
        'login' => isset($login) ? true : false
    ];

@endphp

    <div>
        @if($properties['login'])
            <div class="flex items-center justify-between">
                <label for="{{ $properties['name'] }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $properties['label'] }}</label>
                <div class="text-sm">
                    <a href="/forgot" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                </div>
            </div>
        @else
            <label for="{{ $properties['name'] }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $properties['label'] }}</label>
        @endif

        <div class="mt-2">
            <input id="{{ $properties['name'] }}"
                name="{{ $properties['name'] }}"
                type="{{ $properties['type'] }}"
                autocomplete="{{ $properties['name'] }}"
                @isset($properties['maxlength'])
                    maxlength="{{ $properties['maxlength'] }}"
                @endisset
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                {{ $properties['required'] }}
            >
        </div>
        @error($properties['name'])
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
        @enderror
    </div>



