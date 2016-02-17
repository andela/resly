
{{csrf_field()}}
<div class = "form-group">
    <label for = "label" class = "control-label"> Table Label</label>
    <input type = "text" value="{{old('label')}}" class = "form-control" name="label" placeholder = "Eg. Rose Petals">
</div>

<!--Seats Number per table -->
<div class = "form-group">
    <label for = "seats" class = "control-label"> Number of seats</label>
    <input value="{{old('seats_number')}}" type = "text" class = "form-control" id = "seats" placeholder = "Eg. 4" name="seats_number">
</div>

<div class = "form-group">
    <label for = "cost" class = "control-label"> Cost of table</label>
    <input type = "text"  value="{{old('cost')}}" class = "form-control" id = "cost" placeholder = "Eg. $100.00" name="cost">
</div>


