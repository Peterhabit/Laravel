
@extends('main')
@section('content')
	
		 <div class="alert mycolor1" role="alert">매입장</div>
			  
			  <table class="table  table-bordered  table-sm  table-hover mymargin5">
				<tr class="mycolor2">
					<td width="15%">날짜</td>
					<td width="30%">제품명</td>
					<td width="10%">단가</td>
					<td width="10%">수량</td>
					<td width="15%">금액</td>
					<td width="20%">비고</td>

				</tr>
				@foreach ($list as $row) {{--연관배열 list를 row를 통해 출력., list:50자료 row: 1자료--}}

				<tr>
					<td>{{$row->writeday30}}</td>
					<td align="left">
						<a href="{{ route('jangbui.show', $row->id) }}{{ $tmp }}">{{$row->products_name30}}</a></td>
					<td align="right">{{number_format($row->price30)}}</td>
					<td align="right">{{number_format($row->numi30)}}</td>
					<td align="right">{{number_format($row->prices30)}}</td>
					<td align="left">{{$row->bigo30}}</td>
				</tr>
				@endforeach
				<script>
					function find_text()
					{
						  form1.action="{{ route('jangbui.index') }}";
						  form1.submit();
					}
					
					$(function() {
						$("#text1").datetimepicker({
							locale: "ko",
							format: "YYYY-MM-DD",
							defaultDate: moment()
						});
						
						$("#text1").on("dp.change",function(e) {
							find_text();
						});
					});

				</script>
				
				 <form name="form1" method="get" action="" >
					<div class="row">
						<div class="col-3" align="left">  

						<div class="d-inline-flex">
							<div class="input-group input-group-sm date"id="text1"> 
								<span class="input-group-text">날짜</span> 
								<input type="text" name="text1" size="10" value="{{ $text1 }}" class="form-control" onKeydown="if (event.keyCode == 13) { find_text(); }" >
								<span class="input-group-text">
									<div class="input-group-addon">
										<i class="far fa-calendar-alt fa-lg"> </i>
									</div>
								</span>
							</div>
						</div>
						</div>
						<div class="col-9" align="right">           
							<a href="{{ route('jangbui.create') }}{{ $tmp }}" class="btn btn-sm mycolor1">추가</a>
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