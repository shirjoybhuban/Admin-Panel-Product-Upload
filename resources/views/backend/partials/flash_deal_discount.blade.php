@if(count($product_ids) > 0)
    <label class="col-sm-3 control-label">Discounts</label>
    <div class="col-sm-12">
        <table class="table table-bordered">
    		<thead>
    			<tr>
    				<td class="text-center" width="40%">
    					<label for="" class="control-label">Product</label>
    				</td>
                    <td class="text-center">
    					<label for="" class="control-label">Base Price</label>
    				</td>
    				<td class="text-center">
    					<label for="" class="control-label">Discount</label>
    				</td>
                    <td>
                        <label for="" class="control-label">Discount Type</label>
                    </td>
    			</tr>
    		</thead>
    		<tbody>
                @foreach ($product_ids as $key => $id)
                	@php
                		$product = \App\Model\Product::findOrFail($id);
                	@endphp
                		<tr>
                			<td>
                                <div class="col-sm-3">
                                <img loading="lazy"  class="img-md" src="{{ asset($product->thumbnail_img)}}" alt="Image">
                                </div>
                                <div class="col-sm-9">
                				<label for="" class="control-label">{{ $product->name }}</label>
                                </div>
                			</td>
                            <td>
                				<label for="" class="control-label">{{ $product->unit_price }}</label>
                			</td>
                			<td>
                				<input type="number" name="discount_{{ $id }}" value="{{ $product->discount }}" min="0" step="1" class="form-control" required>
                			</td>
                            <td>
                                <select class="form-control" name="discount_type_{{ $id }}">
                                    <option value="amount">৳</option>
                                    <option value="percent">%</option>
                                </select>
                            </td>
                		</tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
