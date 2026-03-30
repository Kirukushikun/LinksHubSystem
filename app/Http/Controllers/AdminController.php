<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // ── Auth ──────────────────────────────────────────
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (
            $request->username === config('admin.username') &&
            $request->password === config('admin.password')
        ) {
            Session::put('admin_authenticated', true);
            return redirect()->route('admin.index');
        }

        return back()->withErrors(['credentials' => 'Invalid username or password.']);
    }

    public function logout()
    {
        Session::forget('admin_authenticated');
        return redirect()->route('admin.login');
    }

    // ── Dashboard ─────────────────────────────────────
    public function index()
    {
        $categories = Category::with('links')->orderBy('order')->get();
        return view('admin.index', compact('categories'));
    }

    // ── Categories ────────────────────────────────────
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'color' => 'required|string',
            'icon'  => 'required|string',
        ]);

        $maxOrder = Category::max('order') ?? 0;

        Category::create([
            'name'  => $request->name,
            'color' => $request->color,
            'icon'  => $request->icon,
            'order' => $maxOrder + 1,
        ]);

        return back()->with('success', 'Category added.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'color' => 'required|string',
            'icon'  => 'required|string',
        ]);

        $category->update($request->only('name', 'color', 'icon'));

        return back()->with('success', 'Category updated.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete(); // cascades to links
        return back()->with('success', 'Category deleted.');
    }

    // ── Links ─────────────────────────────────────────
    public function storeLink(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:100',
            'url'         => 'required|url',
            'description' => 'nullable|string|max:200',
            'icon'        => 'required|string',
        ]);

        $maxOrder = Link::where('category_id', $request->category_id)->max('order') ?? 0;

        Link::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'url'         => $request->url,
            'description' => $request->description,
            'icon'        => $request->icon,
            'order'       => $maxOrder + 1,
        ]);

        return back()->with('success', 'Link added.');
    }

    public function updateLink(Request $request, Link $link)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:100',
            'url'         => 'required|url',
            'description' => 'nullable|string|max:200',
            'icon'        => 'required|string',
        ]);

        $link->update($request->only('category_id', 'name', 'url', 'description', 'icon'));

        return back()->with('success', 'Link updated.');
    }

    public function destroyLink(Link $link)
    {
        $link->delete();
        return back()->with('success', 'Link deleted.');
    }

    // ── Reorder ───────────────────────────────────────
    public function reorderLinks(Request $request)
    {
        foreach ($request->order as $i => $id) {
            Link::where('id', $id)->update(['order' => $i]);
        }
        return response()->json(['ok' => true]);
    }

    public function reorderCategories(Request $request)
    {
        foreach ($request->order as $i => $id) {
            Category::where('id', $id)->update(['order' => $i]);
        }
        return response()->json(['ok' => true]);
    }
}