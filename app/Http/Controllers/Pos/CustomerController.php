<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class CustomerController extends Controller
{
    public function customer_all()
    {
        $customers = Customer::latest()->get();
        return view('backend.customer.customer_all', compact('customers'));
    } // end method

    public function customer_add()
    {
        return view('backend.customer.customer_add');
    } // end method
    public function customer_edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_edit', compact('customer'));
    } // end method

    public function customer_store(Request $request)
    {

        $image = $request->file('customer_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(200, 200)->save('upload/customer/' . $name_gen);
        $save_url = 'upload/customer/' . $name_gen;

        if ($request->id) {
            Customer::findOrFail($request->id)->update([
                'name' => $request->name,
                'customer_image' => $save_url,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Customer Updated Successfully', 'alert-type' => 'success',
            );

        } else {
            Customer::Insert([
                'name' => $request->name,
                'customer_image' => $save_url,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'address' => $request->address,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Customer Inserted Successfully', 'alert-type' => 'success',
            );

        }
        return redirect()->route('customer.all')->with($notification);
    } // end method

    public function customer_delete($id)
    {
        $customer = Customer::findOrFail($id)->delete();
        $img = $customer->customer_image;
        unlink($img);
        $notification = array(
            'message' => 'Customer Deleted Successfully', 'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } // end method

    public function CreditCustomer()
    {

        $allData = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        return view('backend.customer.customer_credit', compact('allData'));

    } // End Method

    public function CreditCustomerPrintPdf()
    {

        $allData = Payment::whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        return view('backend.pdf.customer_credit_pdf', compact('allData'));

    } // End Method

    public function CustomerEditInvoice($invoice_id)
    {

        $payment = Payment::where('invoice_id', $invoice_id)->first();
        return view('backend.customer.edit_customer_invoice', compact('payment'));

    } // End Method

    public function CustomerUpdateInvoice(Request $request, $invoice_id)
    {

        if ($request->new_paid_amount < $request->paid_amount) {

            $notification = array(
                'message' => 'Sorry You Paid Maximum Value',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        } else {

            $payment = Payment::where('invoice_id', $invoice_id)->first();
            $payment_details = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if ($request->paid_status == 'full_paid') {
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->new_paid_amount;
                $payment->due_amount = '0';
                $payment_details->current_paid_amount = $request->new_paid_amount;

            } elseif ($request->paid_status == 'partial_paid') {
                $payment->paid_amount = Payment::where('invoice_id', $invoice_id)->first()['paid_amount'] + $request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id', $invoice_id)->first()['due_amount'] - $request->paid_amount;
                $payment_details->current_paid_amount = $request->paid_amount;

            }

            $payment->save();
            $payment_details->invoice_id = $invoice_id;
            $payment_details->date = date('Y-m-d', strtotime($request->date));
            $payment_details->updated_by = Auth::user()->id;
            $payment_details->save();

            $notification = array(
                'message' => 'Invoice Update Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('credit.customer')->with($notification);
        }
    } // End Method

    public function CustomerInvoiceDetails($invoice_id)
    {

        $payment = Payment::where('invoice_id', $invoice_id)->first();
        return view('backend.pdf.invoice_details_pdf', compact('payment'));

    } // End Method
    public function PaidCustomer()
    {
        $allData = Payment::where('paid_status', '!=', 'full_due')->get();
        return view('backend.customer.customer_paid', compact('allData'));
    } // End Method
    public function PaidCustomerPrintPdf()
    {
        $allData = Payment::where('paid_status', '!=', 'full_due')->get();
        return view('backend.pdf.customer_paid_pdf', compact('allData'));
    } // End Method
    public function CustomerWiseReport()
    {
        $customers = Customer::all();
        return view('backend.customer.customer_wise_report', compact('customers'));
    } // End Method

    public function CustomerWiseCreditReport(Request $request)
    {

        $allData = Payment::where('customer_id', $request->customer_id)->whereIn('paid_status', ['full_due', 'partial_paid'])->get();
        return view('backend.pdf.customer_wise_credit_pdf', compact('allData'));
    } // End Method

    public function CustomerWisePaidReport(Request $request)
    {

        $allData = Payment::where('customer_id', $request->customer_id)->where('paid_status', '!=', 'full_due')->get();
        return view('backend.pdf.customer_wise_paid_pdf', compact('allData'));
    } // End Method

}
