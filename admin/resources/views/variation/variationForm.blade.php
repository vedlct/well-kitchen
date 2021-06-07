<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form id="variationForm">
            @csrf
            <input type="hidden" name="type" id="variationType" value="{{$data->first()->variationType}}">
            <div class="modal-header">
                <h4 class="modal-title float-left">Edit variation type {{$data->first()->variationType}}</h4>

                <div class="float-right">
                    <button type="button" class="btn btn-success btn-sm" id="add_variation_values">+ New</button>
                </div>
            </div>
            <div class="modal-body from-body">
                <div class="form-group row" id="sel" >
                    <label class="col-sm-2" >Selection Type : <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select name="selectionType" class="form-control">
                            <option value="">Select</option>
                            <option value="checkbox" @if(isset($data) && $data->first()->selectionType == 'checkbox') selected @endif>Checkbox</option>
                            <option value="dropdown" @if(isset($data) && $data->first()->selectionType == 'dropdown') selected @endif>Dropdown</option>
                        </select>
                    </div>
                </div>
                @if(count($data)>0)
                    @if(!is_null($data->first()->variationValue))
                        @foreach($data as $valueData)
                            <div class="form-group row">
                                <div class="col-sm-2 col-form-label">
                                    <label class="control-label">Value :</label>
                                </div>
                                <div class="col-sm-10">
                                    @if($data->first()->variationType == 'Color' )
                                        <input type="text" class="form-control demo minicolors-input" data-position="bottom left" value="{{$valueData->variationValue}}" disabled>
                                    @else
                                        <input type="text" class="form-control input-sm" value="{{$valueData->variationValue}}" readonly>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="variationSubmit()">Save</button>
            </div>
        </form>
    </div>
</div>
<script src={{url('public/app-assets/js/scripts/jquery.minicolors.min.js')}}></script>
<script>
    colorPicker();
    function colorPicker() {
        $('.demo').each(function () {
            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                format: $(this).attr('data-format') || 'hex',
                keywords: $(this).attr('data-keywords') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom left',
                swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
                change: function (value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                },
                theme: 'bootstrap'
            });

        });
    }
    $("#add_variation_values").click(function() {
        if($('#variationType').val() == 'Color'){
            var html = '<div class="form-group row">' +
                '<div class="col-sm-2 col-form-label"><label class="control-label">Value :</label></div>' +
                '<div class="col-sm-9">' +
                '<select class="form-control" name="variationValue[]">' +
                '<option value="">Select</option>' +
                @foreach(unserialize(COLOR_CODE) as $colorKey => $code)
                '<option value="{{$colorKey}}" style="background: {{$colorKey}}">{{$code}}</option>' +
                @endforeach
                '</select>' +
                '</div>' +
                '<div class="col-sm-1">' +
                '<button type="button" class="btn btn-danger btn-sm" id="remove_variation_values" onclick="remove(this)">-</button>' +
                '</div>' +
                '</div>';
        }else{
            var html = '<div class="form-group row">' +
                '<div class="col-sm-2 col-form-label"><label class="control-label">Value :</label></div>' +
                '<div class="col-sm-9">' +
                '<input type="text" class="form-control input-sm" name="variationValue[]" placeholder="Variation value">' +
                '</div>' +
                '<div class="col-sm-1">' +
                '<button type="button" class="btn btn-danger btn-sm" id="remove_variation_values" onclick="remove(this)">-</button>' +
                '</div>' +
                '</div>';
        }
        $("#sel").after(html);
        colorPicker();
    });

    function remove(el){
        $(el).parent('div').parent('div').remove();
    }
</script>
