@extends('main')
@section('content')





<br>		
 <div class="alert mycolor1" role="alert">제품</div>


	
	<form name="form1" method="post" action="{{ route('product.store')}}{{ $tmp }}"
	enctype="multipart/form-data">
		@csrf
		<table class="table table-bordered table-sm mymargin5">
			<tr>
				<td width="20%" class="mycolor2"> 번호</td>
				<td width="80%" align="left"></td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 구분명</td>
				<td align="left">
					<div class="fd-inline-flex">
				<select name="gubuns_id" class="form-control form-control-sm">
						<option value="" selected>선택하세요.</option>
						@foreach ($list as $row)
							@if ( $row->id == old('gubuns_id') )
								<option value="{{ $row->id }}" selected>{{ $row->name30 }}</option>
							@else
								<option value="{{ $row->id }}">{{ $row->name30 }}</option>
							@endif
						@endforeach
				</select>

					</div>
						@error("name") {{ $message }} @enderror
				</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"><font color="red">*</font> 제품명</td>
				<td width="80%" align="left">
					<div class="fd-inline-flex">
						<input  type="text" name="name" size="30" maxlength="50" value="{{old('name')}}"
								 class="form-control form-control-sm">
					</div>
						@error("name") {{ $message }} @enderror
				</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"><font color="red">*</font> 단가</td>
				<td width="80%" align="left">
					<div class="fd-inline-flex">
						<input  type="text" name="price" size="20" maxlength="20" value="{{old('price')}}"
								 class="form-control form-control-sm">
					</div>
						@error("price") {{ $message }} @enderror
				</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 재고</td>
				<td width="80%" align="left">
					<div class="fd-inline-flex">
						<input  type="text" name="jaego" size="20" value=""
								 class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 사진</td>
				<td width="80%" align="left">
					<div class="fd-inline-flex">
						<input  type="file" name="pic" value="" class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			
		</table>
		
		<div align="center">
		
			<input type="submit" value="저장" class="btn btn-sm mycolor1"> &nbsp;
			<input type="button" value="이전화면으로" class="btn btn-sm mycolor1"
				onClick="history.back();">
		</div>
	</form>


		

	
	
</body>
</html>
@endsection
