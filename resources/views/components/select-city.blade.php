<div class="form-group">
    <label for="city">Pilih Kota</label>
    <select name="city" class="form-control select2" id="city" required>
        <option selected disabled>--Pilih Kota--</option>
        @foreach ($city as $item)
        <option 
            @isset($selectedCity)
                @if ($item === $selectedCity) selected @endif
            @endisset
            value="{{ $item }}">{{ $item }}</option>
        @endforeach
    </select>
    @error('city')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@push('css_script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js_script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#city').select2();
        });
    </script>
@endpush