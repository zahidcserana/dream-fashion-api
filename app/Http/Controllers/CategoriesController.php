<?php

namespace App\Http\Controllers;

use App\Model\SubCategory;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Model\Category;

class CategoriesController extends Controller
{
    // Category
    public function index($id = null)
    {
        $categories = DB::table('categories')->get();
        $category = null;
        if ($id != null) {
            $category = DB::table('categories')->where('id', $id)->first();
        }
        $data['categories'] = $categories;
        $data['category'] = $category;

        return view('categories.category', $data);
    }

    public function add(Request $request)
    {
        $data = $request->except('_token');

        $rules = [
            'name' => 'required|string|max:100',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }

        $input = array(
            'name' => $data['name']
        );
        if ($data['id'] != null) {
            DB::table('categories')->where('id', $data['id'])->update($input);
        } else {
            DB::table('categories')->insertGetid($input);
        }

        return redirect()->route('category');
    }

    public function delete($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect('category')->with('status', 'Successfully Deleted.');
    }

    // Sub Category
    public function getSubCatByCat(Request $request)
    {
        $categoryId = $request->query('category');
        $subCategories = DB::table('sub_categories')->where('category_id', $categoryId)->get();

        $data['sub_categories'] = $subCategories;
        return view('categories.sub_cat_list', $data);
        //echo json_encode(array('respons' => true, 'data' => $subCategories));
    }
    // Sub Sub Category
    public function getSubSubCatBySubCat(Request $request)
    {
        $subCategoryId = $request->query('sub_category');
        $subSubCategories = DB::table('sub_sub_categories')->where('sub_category_id', $subCategoryId)->get();

        $data['sub_sub_categories'] = $subSubCategories;
        return view('categories.sub_sub_cat_list', $data);
        //echo json_encode(array('respons' => true, 'data' => $subCategories));
    }

    public function indexSub($id = null)
    {
        $categories = DB::table('categories')->get();
        $subCategories = DB::table('sub_categories')->get();
        //$subCategoryObj = new SubCategory();
        //$subCategories = $subCategories->category();
        //$country = Country::with('states.city.location')->where('id',1)->first();
        //$subCategories = DB::table('sub_categories')->get();
        //dd($subCategories);
        $subCategory = null;
        if ($id != null) {
            $subCategory = DB::table('sub_categories')->where('id', $id)->first();
        }
        $data['categories'] = $categories;
        $data['sub_categories'] = $subCategories;
        $data['sub_category'] = $subCategory;

        return view('categories.sub_category', $data);
    }

    public function addSub(Request $request)
    {
        $data = $request->except('_token');

        $rules = [
            'name' => 'required|string|max:100',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }

//       $input = array(
//           'name' => $data['name'],
//           'name' => $data['name']
//       );
        if ($data['id'] != null) {
            DB::table('sub_categories')->where('id', $data['id'])->update($data);
        } else {
            DB::table('sub_categories')->insertGetid($data);
        }

        return redirect()->route('sub-category');
    }

    public function deleteSub($id)
    {
        DB::table('sub_categories')->where('id', $id)->delete();
        return redirect('sub-category')->with('status', 'Successfully Deleted.');
    }

    // Sub Sub Category
    public function indexSubSub($id = null)
    {
        $categories = DB::table('categories')->get();
        $subCategories = DB::table('sub_categories')->get();
        $subSubCategories = DB::table('sub_sub_categories')->get();
        $subSubCategory = null;
        $sub_sub_category_id = 0;
        if ($id != null) {
            $subSubCategory = DB::table('sub_sub_categories')->where('id', $id)->first();
            $sub_sub_category_id = $subSubCategory->id;
        }
        $data['categories'] = $categories;
        $data['sub_categories'] = $subCategories;
        $data['sub_sub_category'] = $subSubCategory;
        $data['sub_sub_category_id'] = $sub_sub_category_id;
        $data['sub_sub_categories'] = $subSubCategories;

        return view('categories.sub_sub_category', $data);
    }

    public function addSubSub(Request $request)
    {
        $data = $request->except('_token');

        $rules = [
            'name' => 'required|string|max:100',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->input());
        }

//       $input = array(
//           'name' => $data['name'],
//           'name' => $data['name']
//       );
        if ($data['id'] != null) {
            DB::table('sub_sub_categories')->where('id', $data['id'])->update($data);
        } else {
            DB::table('sub_sub_categories')->insertGetid($data);
        }

        return redirect()->route('sub-sub-category');
    }

    public function deleteSubSub($id)
    {
        DB::table('sub_sub_categories')->where('id', $id)->delete();
        return redirect('sub-sub-category')->with('status', 'Successfully Deleted.');
    }
}
