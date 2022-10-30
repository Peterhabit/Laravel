@extends('main')
@section('content')





<br>		
 <div class="alert mycolor1" role="alert">사용자</div>
 
	<form name="form1" method="post" action="{{ route('member.update', $row->id) }}{{ $tmp }}">
	@csrf
	@method('PATCH')
	
	<form name="form1" method="post" action="">
		<table class="table table-bordered table-sm mymargin5">
			<tr>
				<td width="20%" class="mycolor2"> 번호</td>
				<td width="80%" align="left">{{$row->id}}</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 이름</td>
				<td align="left">
					<div class="fd-inline-flex">
						<input  type="text" name="name" size="20" maxlength="20" value="{{$row->name30}}"
								 class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 아이디</td>
				<td align="left">
					<div class="fd-inline-flex">
						<input  type="text" name="uid" size="20" maxlength="20" value="{{$row->uid30}}"
								 class="form-control form-control-sm">
					</div>
				</td>
			</tr>
			<tr>
				<td class="mycolor2"><font color="red">*</font> 암호</td>
				<td align="left">
					<div class="fd-inline-flex">
						<input  type="text" name="pwd" size="20" maxlength="20" value="{{$row->pwd30}}"
								 class="form-control form-control-sm">
					</div>
				</td>
			</tr>
		<?
			$tel1 = trim(substr($row->tel30,0,3));
			$tel2 = trim(substr($row->tel30,3,4));
			$tel3 = trim(substr($row->tel30,7,4));
		?>
			
			<tr>
				<td class="mycolor2"> 전화</td>
				<td align="left">
				<div class="d-inline-flex">
					<input type="text" name="tel1" size="3" maxlength="3" value="{{ $tel1 }}"
						class="form-control form-control-sm">-
					<input type="text" name="tel2" size="4" maxlength="4" value="{{ $tel2 }}"
						class="form-control form-control-sm">-
					<input type="text" name="tel3" size="4" maxlength="4" value="{{ $tel3 }}"
						class="form-control form-control-sm">
				</div>
			</tr>
			<tr>
				<td class="mycolor2"> 등급</td>
				<td width="80%" align="left">
				<div class="d-inline-flex">
			@if($row->rank30==0)
				<input type="radio" name="rank" value="0" checked>&nbsp;직원&nbsp;&nbsp;
				<input type="radio" name="rank" value="1" >&nbsp;관리자
					
			@else
				<input type="radio" name="rank" value="0" >&nbsp;직원&nbsp;&nbsp;
				<input type="radio" name="rank" value="1" checked>&nbsp;관리자				
			
			@endif
					
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
