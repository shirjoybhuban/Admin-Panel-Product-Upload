@if(count($combinations[0]) > 0)
	<table class="table table-bordered">
		<thead>
			<tr>
				<td class="text-center">
					<label for="" class="control-label">Variant</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">Variant Price</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">SKU</label>
				</td>
				<td class="text-center">
					<label for="" class="control-label">Quantity</label>
				</td>
			</tr>
		</thead>
		<tbody>


@foreach ($combinations as $key => $combination)
	@php
		$sku = '';
		foreach (explode(' ', $product_name) as $key => $value) {
			$sku .= substr($value, 0, 1);
		}

		$str = '';
		foreach ($combination as $key => $item){
			if($key > 0 ){
				$str .= '-'.str_replace(' ', '', $item);
				$sku .='-'.str_replace(' ', '', $item);
			}
			else{
				if($colors_active == 1){
					$color_name = \App\Model\Color::where('code', $item)->first()->name;
					$str .= $color_name;
					$sku .='-'.$color_name;
				}
				else{
					$str .= str_replace(' ', '', $item);
					$sku .='-'.str_replace(' ', '', $item);
				}
			}
		}
	@endphp
	@if(strlen($str) > 0)
			<tr>
				<td>
					<label for="" class="control-label">{{ $str }}</label>
				</td>
				<td>
					<input type="number" name="price_{{ $str }}" value="{{ $unit_price }}" min="0" step="0.01" class="form-control" required>
				</td>
				<td>
					<input type="text" name="sku_{{ $str }}" value="{{ $sku }}" class="form-control" required>
				</td>
				<td>
					<input type="number" name="qty_{{ $str }}" value="1000000" min="0" step="1" class="form-control" required readonly>
				</td>
			</tr>
	@endif
@endforeach
	</tbody>
</table>
@endif
