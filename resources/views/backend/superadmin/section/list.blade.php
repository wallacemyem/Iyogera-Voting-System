<label for="position_id"></label>
<select class="form-control" name="position_id" id="position_id" onchange="onChangeSection(this.value)" required>
    @if (count($sections) == 0)
        <option value="">{{ translate('no_position_available') }}</option>
    @else
        <option value="">{{ translate('select_a_position') }}</option>
        @foreach ($sections as $section)
            <option value="{{ $section->id }}">{{ $section->name }}</option>
        @endforeach
    @endif
</select>
