<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Gubun;	      // Eloquent ORM


class GubunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['tmp'] = $this->qstring();
		
		$text1 = request('text1');		// text1값 알아냄 
		$data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);		// 자료 읽기
		
		return view( 'gubun.index', $data );	// 자료 표시(view/gubun폴더의 index.blade.php)

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['tmp'] = $this->qstring();
        return view('gubun.create', $data);
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

		$row = new Gubun; 		// gubun 모델변수 row 선언
		
		$this->save_row($request, $row); 
		
		return redirect('gubun'. $tmp);	
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
		$data['row'] = Gubun::find($id);                      // Eloquent ORM
		return view('gubun.show', $data );
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
		$data['row'] = Gubun::find( $id );	// 자료 찾기
		return view('gubun.edit', $data );	// 수정화면 호출
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
		
		$row = Gubun::find( $id );	// 자료 찾기
		
		$this->save_row($request, $row); 
		
		return redirect('gubun'. $tmp);	
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
		
		Gubun::find( $id )->delete();
		return redirect('gubun'. $tmp);
	}

	public function getlist($text1)
	{
		//$sql = 'select * from gubuns order by name';                    // Raw Query
			//$result = DB::select($sql);
		//$result = DB::table('gubun')->orderby('name')->get();      // Query Builder
		//$result = Gubun::orderby('name30')->get();                            // Eloquent ORM
		
		$result = Gubun::where('name30', 'like', '%' . $text1 . '%')
		->orderby('name30','asc')->paginate(15)->appends(['text1'=>$text1]);

		return $result;


		
	}
	
	public function save_row(Request $request, $row)
	{
		$request->validate( 
		[
			'name' => 'required|max:20',
		] ,
		[
			'name.required' => '이름은 필수입력입니다.',
			'name.max' => '20자 이내입니다.',
		] );

		$row->name30 = $request->input('name');

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