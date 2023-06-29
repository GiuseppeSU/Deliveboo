{{-- TEXTAREA --}}

@if ($data['type'] == 'textarea')
    <div class="mb-3">
        <label for="{{ $data['field'] }}" class="form-label">{{ $data['label'] }}:</label>
        <textarea class="form-control @error($data['field']) is-invalid @enderror" id="{{ $data['field'] }}"
            name="{{ $data['field'] }}">{{ old($data['field'], $data['default']) }}</textarea>
        @include('partials.forms.validation.error_alert', ['field' => $data['field']])
    </div>
    {{-- SELECT (options array associativo) --}}
@elseif ($data['type'] == 'selectArray')
    <div class="mb-3">

        <label for="{{ $data['field'] }}" class="form-label">{{ $data['label'] }}:</label>
        <select class="form-select @error($data['field']) is-invalid border-2 border-danger border @enderror"
            aria-label="Default select example" id="{{ $data['field'] }}" name="{{ $data['field'] }}">
            <option @selected(old($data['type'], $data['default']) == '') value=''>{{ old($data['type'], $data['default']) }}</option>
            @foreach ($data['options'] as $option)
                <option @selected(old($data['field'], $data['default']) == $option['id']) value="{{ $option['id'] }}">{{ $option['name'] }}</option>
            @endforeach
        </select>

        @include('partials.forms.validation.error_alert', ['field' => $data['field']])
    </div>
    {{-- SELECT (options prese da DB) --}}
@elseif ($data['type'] == 'select')
    <div class="mb-3">

        <label for="{{ $data['field'] }}" class="form-label">{{ $data['label'] }}:</label>
        <select class="form-select @error($data['field']) is-invalid border-2 border-danger border @enderror"
            aria-label="Default select example" id="{{ $data['field'] }}" name="{{ $data['field'] }}">
            <option @selected(old($data['type'], $data['default']) == '') value=''>No types selected</option>
            @foreach ($data['options'] as $option)
                <option @selected(old($data['field'], $data['default']) == $option->id) value="{{ $option->id }}">{{ $option->name }}</option>
            @endforeach
        </select>

        @include('partials.forms.validation.error_alert', ['field' => $data['field']])
    </div>
    {{-- CHECKBOX SINGOLA --}}
@elseif ($data['type'] == 'checkbox')
    <div class="mb-3">

        <input class="form-check-input me-1" type="checkbox" name="{{ $data['field'] }}" id="{{ $data['field'] }}"
            value="{{ $data['default'] }}"
            @if ($errors->any()) @checked(old($data['field']))
            @else @checked($data['default']) @endif>
        <label class="form-check-label" for="{{ $data['field'] }}">{{ $data['label'] }}</label>

        @include('partials.forms.validation.error_alert', ['field' => $data['field']])
    </div>
    {{-- CHECKBOX MULTIPLA --}}
@elseif ($data['type'] == 'checkboxes')
    <div class="mb-3">
        <p>{{ $data['label'] }}</p>
        <ul class="list-group">
            @foreach ($data['options'] as $index => $option)
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" name="{{ $data['field'] . '[]' }}"
                        id="{{ $data['field'] }}_{{ $index }}" value="{{ $option->id }}"
                        @if ($errors->any()) @checked(in_array($option->id, old($data['field'],[])))
                        @else
                            @checked($data['default']->contains($option->id)) @endif>
                    <label class="form-check-label"
                        for="{{ $data['field'] }}_{{ $index }}">{{ $option->name }}</label>
                </li>
            @endforeach
            @include('partials.forms.validation.error_alert', ['field' => $data['field']])
        </ul>
    </div>
    {{-- FILE IMMAGINE --}}
@elseif ($data['type'] == 'file')
    <div class="mb-3 d-flex edit_component align-items-center">
        <div class="flex-grow-1">
            <label for="{{ $data['field'] }}" class="form-label">{{ $data['label'] }}:</label>
            <input type="{{ $data['type'] }}" accept="{{ $data['accepted'] }}"
                class="form-control @error($data['field']) is-invalid border-2 border-danger border @enderror"
                id="{{ $data['field'] }}" name="{{ $data['field'] }}">
            @include('partials.forms.validation.error_alert', ['field' => $data['field']])
        </div>
        @if ($data['default'])
            <div class="container w-50 ">
                <p class="text-center">Last cover preview</p>
                <div class="img-container position-relative">
                    <span class="position-absolute m-2 btn btn-danger mydelete {{ $data['field'] }}"> X
                    </span>
                    <img class="img-fluid" src="{{ asset('storage/' . $data['default']) }}"
                        alt="immagine non disponibile">
                </div>
            </div>
        @endif
    </div>
@elseif ($data['type'] == 'delete-form')
    <div class="delete-form-container {{ $data['field'] }}">
        <form action="{{ route($data['delete-file-route'], $data['delete-file-object']) }}" method="POST">
            @csrf
            @method('DELETE')
        </form>

    </div>
    {{-- NUMERO DECIMALE --}}
@elseif ($data['type'] == 'number')
    <div class="mb-3">
        <label for="{{ $data['field'] }}" class="form-label">{{ $data['label'] }}:</label>
        <input type="{{ $data['type'] }}" step=".01"
            class="form-control @error($data['field']) is-invalid border-2 border-danger border @enderror"
            id="{{ $data['field'] }}" name="{{ $data['field'] }}"
            value="{{ old($data['field'], $data['default']) }}">

        @include('partials.forms.validation.error_alert', ['field' => $data['field']])
    </div>
@else
    {{-- INPUT DI DEFAULT --}}
    <div class="mb-3">
        <label for="{{ $data['field'] }}" class="form-label">{{ $data['label'] }}:</label>
        <input type="{{ $data['type'] }}"
            class="form-control @error($data['field']) is-invalid border-2 border-danger border @enderror"
            id="{{ $data['field'] }}" name="{{ $data['field'] }}"
            value="{{ old($data['field'], $data['default']) }}">

        @include('partials.forms.validation.error_alert', ['field' => $data['field']])
    </div>


@endif
