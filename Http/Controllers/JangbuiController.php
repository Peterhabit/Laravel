<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Jangbui;	      // Eloquent ORM
use App\Models\Gubun;
use App\Models\Jangbu;
use App\Models\Product;	 


class JangbuiController extends Controller
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
		if(!$text1) $text1=date("Y-m-d");   // text1이 null이면 오늘 날짜로 초기화
		
		$data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);		// 자료 읽기
		
		return view( 'jangbui.index', $data );	// 자료 표시(view/Jangbui폴더의 index.blade.php)

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['list'] = $this->getlist_product();

		$data['tmp'] = $this->qstring();
        return view('jangbui.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getlist_product()
	{
	  $result=Product::orderby('name30')->get();
	  return $result;
	}

	 
    public function store(Request $request)
    {
		

		$row = new Jangbu; 		// Jangbui 모델변수 row 선언
		
		$this->save_row($request, $row); 
		
		$tmp = $this->qstring();
		
		return redirect('jangbui'. $tmp);	
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
		$data['row'] = Jangbu::leftjoin('products', 'jangbus.products_id30', '=', 'products.id')->
		select('jangbus.*', 'products.name30 as product_name30')->
			where('jangbus.id', '=', $id)->first();
		return view('jangbui.show', $data);

	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data['list'] = $this->getlist_product();

		$data['tmp'] = $this->qstring();
		$data['row'] = Jangbu::find( $id );	// 자료 찾기
		return view('jangbui.edit', $data );	// 수정화면 호출
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
    
		
		$row = Jangbu::find( $id );	// 자료 찾기
		
		$this->save_row($request, $row); 
		$tmp = $this->qstring();
		
		return redirect('jangbui'. $tmp);	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
	{
		Jangbu::find( $id )->delete();
		
		$tmp = $this->qstring();
		return redirect('jangbui'. $tmp);
	}

	public function getlist($text1)
	{
		
		$result = Jangbu::leftjoin('products', 'jangbus.products_id30','=','products.id')->
		select('jangbus.*','products.name30 as products_name30')->
		where('jangbus.io30','=',0)->
		where('jangbus.writeday30','=',$text1)->
		orderby('jangbus.id','desc')-> paginate(5)->appends(['text1',$text1]);

		return $result;


		
	}
	
	public function save_row(Request $request, $row)
	{
		$request->validate( 
		[
			'writeday' => 'required|date',
			'products_id' => 'required'
	
		] ,
		[
			'writeday.required' => '날짜는 필수입력입니다.',
			'products_id.required' => '제품명은 필수입력입니다.',
			'writeday.date' => '날짜형식이 잘못되었습니다.',
		] );

		$row->io30 = 0;
		$row->writeday30 = $request->input('writeday');
		$row->products_id30 = $request->input('products_id');
		$row->price30 = $request->input('price');
		$row->numi30 = $request->input('numi');
		$row->numo30 = 0;
		$row->prices30 = $request-> input('prices');
		$row->bigo30 = $request->input('bigo');
		
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