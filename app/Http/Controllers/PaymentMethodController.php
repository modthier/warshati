<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paymentMethod.index')->with('payments',PaymentMethod::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paymentMethod.create')->with('types',PaymentType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'method' => 'required',
            'payment_type' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $payment = PaymentMethod::create([
                'method' => $request->method
            ]);
            
            foreach ($request->payment_type as $item) {
                $payment->PaymentType()->attach(['payment_type_id' => $item]);
            }

            DB::commit();
            return redirect()->route('payment.index')->with('success','تم حفظ طريقة الدفع بنجاح');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error','حصل خطاء حاول مرة اخري');
        }
       
       

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        //
    }


    public function getMethod(Request $request)
    {
       $payment = PaymentType::find($request->type);

       $output = "<option value=''> </option>";
       foreach ($payment->paymentMethod as $item) {
            $output .= <<<EOT
                <option value="$item->id">$item->method</option>
            EOT;
       }

       echo $output;
    }
}
