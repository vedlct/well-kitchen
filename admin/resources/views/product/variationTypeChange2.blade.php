
        <label>Variation Value</label>
        <select name="variationValue2" id="variationValue2" class="variationValue2 form-control">
            <option value="" disabled selected>Select Value</option>
            @foreach($variations as $variation)
                <option style="background: {{ $variation->variationValue }}"  value="{{ $variation->variationId }}">{{ $variation->variationValue }}</option>
            @endforeach
        </select>
        @if(count($variations) > 0)
        <input type="hidden" id="variationRelationId2" value="{{ $variationRelationId2 }}" name="variationRelationId2">
        @endif





