<?php

namespace App\Http\Controllers\Site;

use App\Models\ContactForm;
use App\Models\Nav;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Region;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

final class HomeController extends SiteController
{
    public function index(Request $request)
    {
        $data = $this->{$this->theme}();
        if (View::exists($this->layout . 'home.index')) {
            return view($this->layout . 'home.index', $this->render($data));
        } else {
            return redirect(admin_url())->withErrors('Please login admin select template');
        }
    }

    /**
     * template default.
     *
     * @return array
     */
    private function default()
    {
        return [];
    }

    private function school()
    {
        return [];
    }

    /**
     * template classified.
     *
     * @return array
     */
    private function classified()
    {
        return [
        ];
    }

    /**
     * template furniture.
     *
     * @return array
     */
    private function furniture()
    {
        $itemProductHome = Product::query()
            ->where(['is_home' => Product::IS_HOME, 'status' => Product::STATUS_ACTIVE])
            ->orderByDesc('id')
            ->paginate($this->page_number);

        $itemProductCategory = ProductCategory::query()->where(['parent_id' => 0])->get();

        return [
            'itemProductHome' => $itemProductHome,
            'itemProductCategory' => $itemProductCategory,
        ];
    }

    /**
     * template default.
     *
     * @return array
     */
    private function product()
    {
        $itemProductHome = Product::query()->where(
            ['is_home' => Product::IS_HOME, 'status' => Product::STATUS_ACTIVE]
        )->orderByDesc('id')->paginate(8);

        return [
            'showMenuHome' => 1,
            'itemProductHome' => $itemProductHome
        ];
    }

    /**
     * template default.
     *
     * @return array
     */
    private function service()
    {
        return [];
    }

    /**
     * template service.
     *
     * @return array
     */
    private function service1()
    {
        $form = [];
        $contactForm = ContactForm::query()->first();

        if (!empty($contactForm->content)) {
            $form = json_decode($contactForm->content);
        }

        return [
            'form' => $form,
        ];
    }

    /**
     * template sale.
     *
     * @return array
     */
    private function product1()
    {
        $itemPost = Post::query()->where(['status' => Post::STATUS_ACTIVE])->orderByDesc('id')->get()->take(9);
        $itemProductHome = Product::query()->where(
            ['is_home' => Product::IS_HOME, 'status' => Product::STATUS_ACTIVE]
        )->orderByDesc('id')->paginate($this->page_number);
        $itemProductCategory = ProductCategory::query()->where(['parent_id' => 0])->get();

        return [
            'itemPost' => $itemPost,
            'itemProductCategory' => $itemProductCategory,
            'itemProductHome' => $itemProductHome,
            'menuLeft' => Nav::query()->where(['position' => 'menu-left', 'parent_id' => 0])->get(),
        ];
    }

    /**
     * template sale.
     *
     * @return array
     */
    private function product2()
    {
        return [
        ];
    }
}
