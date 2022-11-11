@extends('main')
@section('content')

<br>		
 <div class="alert mycolor1" role="alert">매입</div>

	<form name="form1" method="post" action="">
	@csrf

		<table class="table table-bordered table-sm mymargin5">
			<tr>
				<td width="20%" class="mycolor2"> <font color="red">*</font> 날짜</td>
				<td width="80%" align="left">{{$row->writeday30}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> <font color="red">*</font> 제품명</td>
				<td width="80%" align="left">{{$row->product_name30}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 단가</td>
				<td width="80%" align="left">{{ number_format($row->price30)}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 수량</td>
				<td width="80%" align="left">{{ number_format($row->numi30)}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 금액</td>
				<td width="80%" align="left">{{ number_format($row->prices30)}}</td>
			</tr>
			<tr>
				<td width="20%" class="mycolor2"> 비고</td>
				<td width="80%" align="left">{{ $row->bigo30}}</td>
			</tr>
			
		</table>
		
		<div align="center">
			<a href="{{ route( 'jangbui.edit', $row->id ) }}{{$tmp}}" class="btn btn-sm mycolor1"> 수정</a>
			<form action="{{ route('jangbui.destroy', $row->id) }}">
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
