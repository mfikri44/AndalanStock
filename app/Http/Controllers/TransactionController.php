<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use App\Services\Response;

class TransactionController extends Controller
{
    public function index()
    {
        $data   = Transaction::paginate(10);
        return view('transaction.index', compact('data'));
    }

    public function store(Request $request)
    {
        $post = $request->all();
        $return = array();

        $data = Product::find($post['product_id']);

        $payment_amount = $data['price'] * $post['quantity'];
        $update['stock'] = $data['stock'] - $post['quantity'];
        if($update['stock'] < 0){
            return Response::badRequestError('Out of stock', $data);
        }

        $headers = [
            'X-API-KEY' => 'DATAUTAMA',
        ];

        $form_params = [
            "quantity" => $post['quantity'],
            "price" => $data['price'],
            "payment_amount" => $payment_amount,
        ];

        //panggil url api
        $url = 'https://pay.saebo.id/test-dau/api/v1/transactions';
        $response = Http::withHeaders($headers)->post($url, $form_params);
        $responseBody = json_decode($response->getBody(), true);
        
        //isi data transaksi
        $create['product_id'] = $data['id'];
        $create['reference_no'] = $responseBody['data']['reference_no'];
        $create['price'] = $responseBody['data']['price'];
        $create['qty'] = $responseBody['data']['quantity'];
        $create['payment_amount'] = $responseBody['data']['payment_amount'];
        // dd($create);

        //create and update
        $update_product = $data->update($update);
        $create_transaction = Transaction::create($create);

        //get data product
        $data_update = Product::find($post['product_id']);
        $data_product = json_decode(json_encode($data_update), true);

        //get data transaction
        $data_create = Transaction::find($create_transaction['id']);
        $data_transaction = json_decode(json_encode($data_create), true);

        //show response
        $return['get_api'] = $responseBody;
        $return['update_product'] = $data_product;
        $return['create_transaction'] = $data_transaction;
        // dd($return);
        return Response::success('Success Create Data', $return);
    }


    public function delete($id)
    {
        $data = Transaction::find($id);
        if ($data == null) {
            return redirect('transaction')->with('status', 'Data not found !');
        }
        
        $delete = $data->delete();
        if ($delete) {
            return redirect('transaction')->with('status', 'Done delete data !');
        }
        return redirect('transaction')->with('status', 'False delete data !');
    }

}
