<?php

namespace App\Modules\Pms\Http\Controllers\Expense;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

//Models
use App\Models\Pms\Expense\Pmsexpense;
use App\Models\Pms\Expense\PmsExpensesPayment;
use App\Models\Pms\PmsPayslip;
use App\Models\Pms\PmsPayslipsPayment;
use Auth;
use DB;

class PaymentController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)
    {
        $expense_due_amount = Pmsexpense::find($id)->due;

        if(is_null($expense_due_amount)){
            $expense_due_amount = 0;
        }

        return view('pms::Expense.Payment.create',compact('id','expense_due_amount'));
    }

    public function store(Request $request)
    {
        $inputdata =[
            'date' => 'required',
            'amount' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        try{

            DB::beginTransaction();

            $input = $request->all();

            $user = Auth::id();

            $insert = new PmsExpensesPayment;

            $insert->date                       = $input['date'];
            $insert->pms_expenses_id            = $input['pms_expenses_id'];
            $insert->amount                     = $input['amount'];
            $insert->note                       = $input['note'];
            $insert->created_by                 = $user;
            $insert->updated_by                 = $user;

            if($insert->save()){
                $expense = Pmsexpense::find($input['pms_expenses_id']);

                $expense->due -= $input['amount'];
                $expense->update();
            }

            DB::commit();
            return Redirect::route('pms_expense_index')->withInput()->with('alert.status', 'success')
                    ->with('alert.message', 'Expense Payment Inserted Successfully!');

        }
        catch (\Exception $exception){
            DB::rollBack();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
    }

    public function show($id)
    {
        $payment = PmsExpensesPayment::where('pms_expenses_id' , $id)->get();

        if(count($payment)==0){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'No payment history');
        }

        return view('pms::Expense.Payment.show',compact('payment','id'));
    }

    public function edit($id)
    {
        $payment = PmsExpensesPayment::find($id);

        return view('pms::Expense.Payment.edit',compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $inputdata =[
            'date' => 'required',
            'amount' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        try{

            DB::beginTransaction();

            $input = $request->all();

            $user = Auth::id();

            $insert = PmsExpensesPayment::find($id);

            $pre_due = $insert->amount;

            $insert->date                       = $input['date'];
            $insert->amount                     = $input['amount'];
            $insert->note                       = $input['note'];
            $insert->updated_by                 = $user;

            if($insert->update()){
                $expense = Pmsexpense::find($insert->pms_expenses_id);

                $expense->due = ($expense->due+$pre_due-$input['amount']);
                $expense->update();
            }

            DB::commit();
            return Redirect::route('pms_expense_payment_show',$insert->pms_expenses_id)->withInput()->with('alert.status', 'success')
                    ->with('alert.message', 'Expense Payment Updated Successfully!');

        }
        catch (\Exception $exception){
            DB::rollBack();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
    }

    public function destroy($id)
    {
        try{
            DB::beginTransaction();

            $delete = PmsExpensesPayment::find($id);

            $pms_expenses_id = $delete->pms_expenses_id;
            $amount = $delete->amount;

            if($delete->delete()){

                $payslip = Pmsexpense::find($pms_expenses_id);

                $payslip->due += $amount;
                $payslip->update();

                $data = PmsExpensesPayment::where('pms_expenses_id',$pms_expenses_id)->get();

                if(count($data)==0){
                    DB::commit();
                    return Redirect::route('pms_expense_index')->with(['alert.status' => 'danger','alert.message' => 'Payslip payment are not found!']);
                }
                DB::commit();
                return back()->with(['alert.status' => 'danger','alert.message' => 'Payslip Payment Deleted Successfully!']);
            }
            else{
                DB::rollBack();
                return back()->with(['alert.status' => 'danger','alert.message' => 'Payslip Payment Deleted Fail!']);
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
    }
}
