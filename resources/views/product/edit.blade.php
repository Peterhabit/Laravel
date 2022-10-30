@extends('main')
@section('content')





<br>		
 <div class="alert mycolor1" role="alert">제품</div>
 
	<form name="form1" method="post" action="{{ route('product.update', $row->id) }}{{ $tmp }}"
	enctype="multipart/form-data">
	@csrf
	@method('PATCH')
	
	<form name="form1" method="post" action="">
		<table class="table table-bordered table-sm mymargin5">
			<tr>
				<td width="20%" class="mycolor2"> 번호</td>
				<td width="80%" align="left">{{$row->id}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"><font color="red">*</font> 구분명</td>
				<td width="80%" align="left">
					<div class="fd-inline-flex">
					<select name="gubuns_id" class="form-control form-control-sm">
						<option value="" selected>선택하세요.</option>
						@foreach ($list as $row1)
							@if ( $row->gubuns_id30 == $row1->id )
								<option value="{{ $row1->id }}" selected>{{ $row1->name30 }}</option>
							@else
								<option value="{{ $row1->id }}">{{ $row1->name30 }}</option>
							@endif
						@endforeach
								</select>

						</div>
						@error("gubuns_id") {{ $message }} @enderror
				</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"><font color="red">*</font> 제품명</td>
				<td width="80%" align="left">
					<div class="fd-inline-flex">
						<input  type="text" name="name" size="30" value="{{$row->name30}}"
								 class="form-control form-control-sm">
					</div>
					@error("name") {{ $message }} @enderror
				</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"><font color="red">*</font> 단가</td>
				<td width="80%" align="left">
					<div class="fd-inline-flex">
						<input  type="text" name="price" size="20" value="{{$row->price30}}"
								 class="form-control form-control-sm">
					</div>
					@error("price") {{ $message }} @enderror
				</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 재고</td>
				<td width="80%" align="left">
					<div class="fd-inline-flex">
						<input  type="text" name="jaego" size="20" value="{{$row->jaego30}}"
								 class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 사진</td>
				<td width="80%" align="left">
					<div class="fd-inline-flex">
						<input  type="file" name="pic" value=""
								 class="form-control form-control-sm">
					</div>
					<br><br>
					<b>파일이름</b> : <?=$row->pic30; ?> <br>
				</div><br>
				
					@if($row->pic30)      <!--이미지가 있는 경우-->
					   <img src="{{ asset('stroage/product_img/'.$row->pic30) }}"
					   width="200" class="img-fluid img-thumbnail margin5">
					@else                  <!-- 이미지가 없는 경우-->
						<img src=" " width="200" height="150" class="img-fluid img-thumbnail margin5">
						
					@endif
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
