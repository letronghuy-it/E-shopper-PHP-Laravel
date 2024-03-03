<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComent;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    // Show Blog Admin
    public function indexBlog()
    {
        $blogs = Blog::paginate(5);
        return view('user.Blog.blog', compact('blogs'));
    }
    // Create Blog
    public function store(Request $request)
    {
        $data = $request->all();
        $file  = $request->image;

        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        }

        if (Blog::create($data)) {
            if (!empty($file)) {
                $file->move('upload/blog/image', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', _('Thêm Mới Thành Công'));
        } else {
            return redirect()->back()->withErrors('success', _('Thêm Mới Thất bại'));
        }
    }
    // Delete Blog
    public function destroy(Request $request)
    {
        $blog = Blog::find($request->id);
        if ($blog) {
            $blog->delete();
            return redirect()->back()->with('success', _('Xoá Thành Công Blog!'));
        } else {
            return redirect()->back()->withErrors('success', _('Không Tìm Thầy Blog Cần Xoá'));
        }
    }
    // Edit Blog
    public function edit(Request $request)
    {
        $blog = Blog::find($request->id);
        if ($blog) {
            return view('user.Blog.edit', compact('blog'));
        } else {
            return redirect()->back()->withErrors('success', _('Không Tìm Thầy Blog'));
        }
    }
    // Update Blog
    public function update(Request $request)
    {
        $blog = Blog::where('id', $request->id)->first();
        $data = $request->all();
        $file = $request->image;
        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        }
        if ($blog->update($data)) {
            if (!empty($file)) {
                $file->move('upload/blog/image', $file->getClientOriginalName());
            }
            return redirect('/admin/blog')->with('success', _('Cập Nhật Thành Công'));
        } else {
            return redirect('/admin/blog-update')->withErrors('success', _('Cập Nhật thất bại'));
        }
    }
    /////////////////////////////////////////////-BLOG------FONTEND-/////////////////////////////////////

    public function indexFE()
    {
        $blog = Blog::orderby('created_at', 'desc')->paginate(3);
        return view('Fontend.page.Blog.indexBlogFE', compact('blog'));
    }
    public function ShowBlogDetail(Request $request)
    {

        $blog = Blog::find($request->id);
        if ($blog) {
            $comments = Blog::join('blog_comments', 'blogs.id', 'blog_comments.id_blog')
                ->select('blogs.*', 'blog_comments.*')
                ->get()->toArray();
            // dd($comments);
            $next = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();
            $prev = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();

            return view('Fontend.page.Blog.indexBlogDetailFE', compact('blog', 'next', 'prev', 'comments'));
        } else {
            return redirect()->back()->withErrors('success', _('Không Tìm Thấy Blog'));
        }
    }
    public function rateBlog(Request $request)
    {
        $rate = Rate::updateOrCreate(
            // Thay đổi rate nếu đã user đã đánh giá kiều kiện là id_user và blog hiện tại
            [
                'id_blog' => $request->id_blog,
                'id_user' => Auth::user()->id,
            ],
            [
                'rate'    => $request->rate
            ]
        );
        if ($rate) {
            $averageRate = Rate::where('id_blog', $request->id_blog)->avg('rate');
            $averageRate = round($averageRate, 1);
            return response()->json([
                'status'      => true,
                'message'     => 'Đã đánh giá thành công',
                'rate'        => $rate,
                'averageRate' => $averageRate,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Đánh Giá thất bại',
            ]);
        }
    }
    public function getrateBlog(Request $request)
    {
        $id = $request->id_blog;
        $averageRate = Rate::where('id_blog', $id)->avg('rate');
        $averageRate = round($averageRate, 1);
        return response()->json([
            'status' => true,
            'averageRate' => $averageRate,
        ]);
    }

    public function CommentBlog(Request $request)
    {
        $id = $request->id_comment;
        $level = 0;
        if (isset($id)) {
            $level =$id;
        }
        $data = [
            'comment' =>  $request->comment,
            'id_blog' =>  $request->id_blog,
            'id_user' =>  Auth::user()->id,
            'name'    =>  Auth::user()->name,
            'avatar'  =>  Auth::user()->avatar,
            'level'   =>  $level,
        ];
        if (BlogComent::create($data)) {
            return response()->json([
                'status'    => true,
                'message'   => 'Bình luận thành công',
                'data'      => $data
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Bình luận thất bại',
            ]);
        }

    }

    public function getcmtblog(){
        $data =  BlogComent::all();
        return response()->json([
            'data' => $data
        ]);
    }



    // private function getAverageRate($id_blog)
    // {
    //     $rates = Rate::where('id_blog',$id_blog)->get();
    //     $totalRate = 0;
    //     // Đếm số điểm Rate có trong blog đó
    //     $countRate = count($rates);
    //     // Total Rate
    //     foreach ($rates as $rate) {
    //         $totalRate += $rate->rate;
    //     }
    //     // Nếu đếm lớn hơn 0 thì dính trung bình ngược lại = 0
    //     return $countRate > 0 ? (float)($totalRate / $countRate) : 0.0;
    // }
}
