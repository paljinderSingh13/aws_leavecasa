<label class="control-label">City</label>
{{-- {!! Form::select('cities_id[]',$city,null,['class'=>'form-control cities_id']) !!} --}}
<select  class="form-control cities_id"  name="cities_id[{{ $country_id }}][]">
	       @foreach($city as $key => $value)
	         <option value="{{$key}}">{{$value}}</option>
	       
            @endforeach
  </select>