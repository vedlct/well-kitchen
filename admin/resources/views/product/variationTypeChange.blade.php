    <label>Variation Value</label>
    <select name="variationValue1" id="variationValue1" class="variationValue1 form-control">
        <option value="" disabled selected>Select Value</option>
        @foreach($variations as $variation)
            <option style="background: {{ $variation->variationValue }}" value="{{ $variation->variationId }}">{{ $variation->variationValue }}</option>
        @endforeach
    </select>
    @if(count($variations) > 0)
    <input type="hidden" id="variationRelationId1" value="{{ $variationRelationId1 }}" name="variationRelationId1">
    @endif




