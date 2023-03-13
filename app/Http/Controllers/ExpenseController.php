<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('expense.index')->with('expenses',Expense::orderBy('id','desc')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenseTypes = ExpenseType::all();
        return view('expense.create')->with('expenseTypes',$expenseTypes);
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
            'expense_type_id' => 'required',
            'amount' => 'required'
        ]);

        $expense = Expense::create([
            'expense_type_id' => $request->expense_type_id,
            'amount' => $request->amount
        ]);
        
        

        if($expense){
            return redirect()->route('expense.index')->with('success','تم حفظ المنصرف بنجاح');
        }else {
            return redirect()->route('expense.index')->with('erorr','حصل خطاء حاول مرة اخري');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $expenseTypes = ExpenseType::all();
        return view('expense.edit')->with([
            'expenseTypes' => $expenseTypes,
            'expense' => $expense
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $this->validate($request,[
            'expense_type_id' => 'required',
            'amount' => 'required'
        ]);

        $success = $expense->update([
            'expense_type_id' => $request->expense_type_id,
            'amount' => $request->amount
        ]);
        
        
        $expense->movements()->update([
            'amount' => $request->amount,
        ]);

        if($success){
            return redirect()->route('expense.index')->with('success','تم حفظ المنصرف بنجاح');
        }else {
            return redirect()->route('expense.index')->with('erorr','حصل خطاء حاول مرة اخري');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        
    }
}
