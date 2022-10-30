@extends('main')
@section('content')

<br>		
 <div class="alert mycolor1" role="alert">제품</div>

	<form name="form1" method="post" action="">
	@csrf

		<table class="table table-bordered table-sm mymargin5">
			<tr>
				<td width="20%" class="mycolor2"> 번호</td>
				<td width="80%" align="left">{{$row->id}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> <font color="red">*</font> 구분명</td>
				<td width="80%" align="left">{{$row->gubun_name30}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> <font color="red">*</font> 제품명</td>
				<td width="80%" align="left">{{$row->name30}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> <font color="red">*</font> 단가</td>
				<td width="80%" align="left">{{$row->price30}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 재고</td>
				<td width="80%" align="left">{{$row->jaego30}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 사진</td>
				<td width="80%" align="left">
				<div class="d-inline-flex">
					<b>파일이름</b> : <?=$row->pic30; ?> <br>
				</div><br>
				
					@if($row->pic30)      <!--이미지가 있는 경우-->
					   <img src="{{ asset('storage/product_img/'.$row->pic30) }}"
					   width="200" class="img-fluid img-thumbnail margin5">
					@else                  <!-- 이미지가 없는 경우-->
						<img src=" " width="200" height="150" class="img-fluid img-thumbnail margin5">
						
					@endif

				
				</td>
			</tr>
			
		</table>
		
		<div align="center">
			<a href="{{ route( 'product.edit', $row->id ) }}{{$tmp}}" class="btn btn-sm mycolor1"> 수정</a>
			<form action="{{ route('product.destroy', $row->id) }}">
				@csrf
				@method('DELETE')

			<button class="btn btn-sm mycolor1"
				onClick="return confirm('삭제할까요?');">삭제</button>  &nbsp;
			</form>
			
			<input type="button" value="이전화면으로" class="btn btn-sm mycolor1"
				onClick="history.back();">
		</div>
	</form>


		
</div>
	
	
</body>
</html>
@endsection
