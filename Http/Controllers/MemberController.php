<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Member;	      // Eloquent ORM


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(session()->get("rank")!=1) return redirect("/");
		$data['tmp'] = $this->qstring();
		
		$text1 = request('text1');		// text1값 알아냄 
		$data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);		// 자료 읽기
		
		return view( 'member.index', $data );	// $data에 넣어서 한번에 보낼 수 있다

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['tmp'] = $this->qstring();
        return view('member.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$tmp = $this->qstring();

		$row = new Member; 		// member 모델변수 row 선언
		
		$this->save_row($request, $row); 
		
		return redirect('member'.$tmp);	
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
	{
		
		$data['tmp'] = $this->qstring();
		$data['row'] = Member::find($id);                      // Eloquent ORM
		return view('member.show', $data );
	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data['tmp'] = $this->qstring();
		
		$data['row'] = Member::find( $id );	// 자료 찾기
		return view('member.edit', $data );	// 수정화면 호출
	}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tmp = $this->qstring();
		
		$row = Member::find( $id );	// 자료 찾기
		
		$this->save_row($request, $row); 
		
		return redirect('member'.$tmp);	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
	{
		$tmp = $this->qstring();
		
		Member::find( $id )->delete();
		return redirect('member'.$tmp);
	}

	public function getlist($text1)
	{
		//$sql = 'select * from members order by name';                    // Raw Query
			//$result = DB::select($sql);
		//$result = DB::table('member')->orderby('name')->get();      // Query Builder
		//$result = Member::orderby('name30')->get();                            // Eloquent ORM
		
		$result = Member::where('name30', 'like', '%' . $text1 . '%')
		->orderby('name30','asc')->paginate(5);
		//->appends(['text1'=>$text1]); <- index에 있는 appends함수와 둘 중 하나만 사용

		return $result;


		
	}
	
	public function save_row(Request $request, $row)
	{
		$request->validate( 
		[
			'uid' => 'required|max:20',
			'pwd' => 'required|max:20',
			'name' => 'required|max:20',
		] ,
		[
			'uid.required'  => '아이디는 필수입력입니다.',
			'pwd.required' => '암호는 필수입력입니다.',
			'name.required' => '이름은 필수입력입니다.',
			'uid.max'  => '20자 이내입니다.',
			'pwd.max' => '20자 이내입니다.',
			'name.max' => '20자 이내입니다.',
		] );

        $tel1= $request->input('tel1');
		$tel2= $request->input('tel2');
		$tel3= $request->input('tel3');
		$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);	// 전화번호 합치기

		$row->uid30 = $request->input('uid');	// 값 입력 
		$row->pwd30 = $request->input('pwd');
		$row->name30 = $request->input('name');
		$row->tel30 = $tel;
		$row->rank30 = $request->input('rank');
		$row->save();			// 저장
		
	}
	
	public function qstring()
	{
		$text1 = request("text1") ? request('text1') : "";
		$page = request('page') ? request('page') : "1";
		$tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";
		return $tmp;
	}

}