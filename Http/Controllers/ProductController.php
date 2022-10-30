<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;    // DB 클래스 사용
use App\Models\Product;	      // Eloquent ORM
use App\Models\Gubun;


class ProductController extends Controller
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
		
		return view( 'product.index', $data );	// 자료 표시(view/product폴더의 index.blade.php)

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['list'] = $this->getlist_gubun();

		$data['tmp'] = $this->qstring();
        return view('product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function getlist_gubun()
	{
	  $result=Gubun::orderby('name30')->get();
	  return $result;
	}

	 
    public function store(Request $request)
    {
		$tmp = $this->qstring();

		$row = new Product; 		// product 모델변수 row 선언
		
		$this->save_row($request, $row); 
		
		return redirect('product'. $tmp);	
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
		$data['row'] = Product::leftjoin('gubuns', 'products.gubuns_id30', '=', 'gubuns.id')->
		select('products.*', 'gubuns.name30 as gubun_name30')->
			where('products.id', '=', $id)->first();
		return view('product.show', $data);

	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$data['list'] = $this->getlist_gubun();

		$data['tmp'] = $this->qstring();
		$data['row'] = Product::find( $id );	// 자료 찾기
		return view('product.edit', $data );	// 수정화면 호출
	}
	
	public function jaego()
	{
		DB::statement('drop table if exists temps;');
		DB::statement('create table temps (
			id int not null auto_increment,
			products_id int,
			jaego int default 0,
			primary key(id) );');
		
		DB::statement('update products set jaego30=0;');
		DB::statement('insert into temps (products_id, jaego)
			select products_id30, sum(numi30)-sum(numo30) as jaeo30
				from jangbus
				group by products_id30;');
				
		DB::statement(' update products join temps
			on products.id= temps.products_id
			set products.jaego30= temps.jaego;');
			
		return redirect('product');
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
       
		
		$row = Product::find( $id );	// 자료 찾기
		
		$this->save_row($request, $row); 
		$tmp = $this->qstring();
		return redirect('product'. $tmp);	
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
		
		Product::find( $id )->delete();
		return redirect('product'. $tmp);
	}

	public function getlist($text1)
	{
		
		$result = Product::leftjoin('gubuns', 'products.gubuns_id30','=','gubuns.id')->
		select('products.*','gubuns.name30 as gubun_name30')->
		where('products.name30','like','%'.$text1.'%')->
		orderby('products.name30','asc')-> paginate(5)->appends(['text1'=>$text1]);

		return $result;


		
	}
	
	public function save_row(Request $request, $row)
	{
		$request->validate( 
		[
			'gubuns_id' => 'required|numeric',
			'name' => 'required|max:50',
			'price' => 'required|numeric'
		] ,
		[
			'gubuns_id.required' => '구분명은 필수입력입니다.',
			'name.required' => '이름은 필수입력입니다.',
			'price.required' => '단가는 필수입력입니다.',
			'name.max' => '50자 이내입니다.'
		] );

		$row->gubuns_id30 = $request->input('gubuns_id');
		$row->name30 = $request->input('name');
		$row->price30 = $request->input('price');
		$row->jaego30 = $request->input('jaego');
		
		if ($request->hasFile('pic'))	         // upload할 파일이 있는 경우
		{
			$pic = $request->file('pic');
			$pic_name = $pic->getClientOriginalName();             // 파일이름
			$pic->storeAs('public/product_img', $pic_name);        // 파일저장
			$row->pic30 = $pic_name;                     // pic 필드에 파일이름 저장
		}


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