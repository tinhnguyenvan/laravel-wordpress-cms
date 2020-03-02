<?php

namespace App\Http\Controllers\Site;

use App\Jobs\ShoppingCartJob;
use App\Models\Product;
use App\Models\SaleOrder;
use App\Models\SaleStore;
use App\Services\SaleOrderLineService;
use App\Services\SaleOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class CartController.
 *
 * @property SaleOrderService     $saleOrderService
 * @property SaleOrderLineService $saleOrderLineService
 */
final class CartController extends SiteController
{
    public function __construct(SaleOrderService $saleOrderService, SaleOrderLineService $saleOrderLineService)
    {
        parent::__construct();
        $this->saleOrderService = $saleOrderService;
        $this->saleOrderLineService = $saleOrderLineService;
    }

    public function index(Request $request)
    {
        $userAgent = $request->header('user-agent');

        $items = \Cart::getContent();
        $data = [
            'token_checkout' => md5($userAgent),
            'items' => $items,
            'title' => trans('common.cart.title'),
        ];

        return view('site/cart.index', $this->render($data));
    }

    public function checkout(Request $request, $token_checkout = '')
    {
        $userAgent = $request->header('user-agent');
        $items = \Cart::getContent();

        if (md5($userAgent) != $token_checkout || 0 == $items->count()) {
            return redirect(base_url('cart'));
        }

        $data = [
            'token_checkout' => $token_checkout,
            'items' => $items,
            'title' => trans('common.cart.checkout'),
        ];

        return view('site/cart.checkout', $this->render($data));
    }

    public function checkoutSuccess(Request $request)
    {
        $data = [
            'title' => trans('common.cart.checkout.success'),
        ];

        return view('site/cart.success', $this->render($data));
    }

    public function checkoutSave(Request $request)
    {
        $request->validate([
            'billing_fullname' => 'bail|required',
            'billing_email' => 'required|email',
        ]);

        $params = $request->all();

        try {
            DB::beginTransaction();
            $items = \Cart::getContent();
            $mySaleOrder = new SaleOrder($params);
            if ($items->count() > 0) {
                $mySaleOrder->code = SaleOrder::generateCode();
                $mySaleOrder->status = SaleOrder::STATUS_NEW;
                $mySaleOrder->price_sell = \Cart::getSubTotal();
                $mySaleOrder->price_final = \Cart::getTotal();
                $mySaleOrder->save($params);

                $mySaleStore = SaleStore::query()->first();
                foreach ($items as $item) {
                    $product = $item->associatedModel;

                    $this->saleOrderLineService->create([
                        'organization_id' => 0,
                        'customer_id' => 0,
                        'order_id' => $mySaleOrder->id,
                        'sale_store_id' => $mySaleStore->id,
                        'order_code' => $mySaleOrder->code,
                        'product_id' => $product->id,
                        'product_sku' => $product->sku,
                        'product_name' => $product->title,
                        'product_category_id' => $product->product_category_id,
                        'quantity' => $item->quantity,
                        'item_price_cost' => $item->price,
                        'item_price_sell' => $item->price,
                        'cost_total' => $item->quantity * $item->price,
                        'sub_total' => $item->quantity * $item->price,
                        'status' => $mySaleOrder->status,
                        'report_year' => date('Y'),
                        'report_month' => date('m'),
                        'report_date' => date('d'),
                    ]);
                }

                // clear cart
                \Cart::clear();
            }

            DB::commit();

            // push queue send mail
            ShoppingCartJob::dispatch(['action' => ShoppingCartJob::ACTION_SEND_MAIL_CUSTOMER, 'id' => $mySaleOrder->id])->onQueue('admin');

            return redirect(base_url('cart/checkout-success/'.md5($mySaleOrder->id)));
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function add(Request $request)
    {
        $params = $request->only(['product_id', 'quantity']);
        $product = Product::query()->where('id', $params['product_id'])->first();

        if ($product->id > 0) {
            $price = $product->price_promotion > 0 ? $product->price_promotion : $product->price;
            \Cart::add([
                'id' => uniqid(),
                'name' => $product->title,
                'price' => $price,
                'quantity' => $params['quantity'],
                'attributes' => [],
                'associatedModel' => $product,
            ]);
        }

        return redirect(base_url('cart'));
    }

    public function delete($rowId)
    {
        \Cart::remove($rowId);

        return redirect(base_url('cart'));
    }
}
