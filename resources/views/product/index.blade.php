
@extends('main')
@section('content')
	
		 <div class="alert mycolor1" role="alert">제품</div>
			  
			  <table class="table  table-bordered  table-sm  table-hover mymargin5">
				<tr class="mycolor2">
					<td width="10%">번호</td>
					<td width="20%">구분명</td>
					<td width="30%">제품명</td>
					<td width="20%">단가</td>
					<td width="20%">재고</td>

				</tr>
				@foreach ($list as $row) {{--연관배열 list를 row를 통해 출력., list:50자료 row: 1자료--}}

				<tr>
					<td>{{$row->id}}</td>
					<td>{{$row->gubun_name30}}</td>
					<td><a href="{{ route('product.show', $row->id) }}{{ $tmp }}">{{$row->name30}}</a></td>
					<td>{{$row->price30}}</td>
					<td>{{$row->jaego30}}</td>
				</tr>
				@endforeach
				<script>
					function find_text()
					{
						  form1.action="{{ route('product.index') }}";
						  form1.submit();
					}

				</script>
				
				 <form name="form1" method="get" action="" >
					<div class="row">
						<div class="col-3" align="left">            
							<div class="input-group  input-group-sm"> 
								<span class="input-group-text">이름</span> 
								<input type="text" name="text1" value="{{ $text1 }}" class="form-control" onKeydown="if (event.keyCode == 13) { find_text(); }" >
								<button class="btn btn-sm mycolor1" type="button" onClick="find_text();">검색</button>
							</div>

						</div>
						<div class="col-9" align="right">           
							<a href="{{ route('product.create') }}{{ $tmp }}" class="btn btn-sm mycolor1">추가</a>
							<a href="{{ url('product/jaego') }}" class="btn btn-sm mycolor1">재고계산</a>
						</div>
					</div>
				</form>
				
				</table>
				
			<div vlass="row">
				<div class="col">
					{{ $list->appends(['text1'=>$text1])->links('mypagination') }}
				</div>
			</div>

	@endsection()