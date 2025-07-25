<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    
        public function index()
        {
            return response()->json(Order::with('user')->latest()->paginate(10));
        }

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'item_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'status' => 'required|in:pending,paid,cancelled',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors()
                ], 422);
            }

            $order = Order::create($validator->validated());

            return response()->json([
                'success' => true,
                'order' => $order,
                'message' => 'Order created successfully.'
            ]);
        }

        public function updateStatus(Request $request, $id)
        {
            $order = Order::findOrFail($id);
            $order->update(['status' => $request->status]);
            return response()->json(['success' => true]);
        }
}
