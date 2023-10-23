<?php

namespace App\Http\Controllers;

// ここから、ProfileUpdateRequestは、app/Http/Requestsの中にあることが分かります。
// ProfileUpdateRequest  $request とあり、ProfileUpdateRequestでバリデーションを行った後の値が指定されています。
use App\Http\Requests\ProfileUpdateRequest;

// アバターを更新する場合、古いアバター画像を削除するには、まず、ファイルの先頭に、下記のuse宣言を入れます。
use Illuminate\Support\Facades\Storage;

// 
use Illuminate\Validation\Rule;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;
use App\Models\Role;

// use Illuminate\Support\Facades\Gate; //不要。ミドルウェアで設定済み。Route::middleware


class ProfileController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('profiles.index', compact('users'));
    }

    /**
     * Display the user's profile form.
     */
    // 引数の横に : View とありますが、こちらは戻り値（return部分で返す値）の型を指定しています。
    // viewと指定した場合には、return 部分は viewを使って書く必要があります。
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // アカウント編集画面に入力されたアバターを保存する機能
    // 引数が ProfileUpdateRequest $request になっている。
    // フォームリクエストを使ってバリデーションが行われている場合には、このような書き方
    // フォームリクエストを使うと、バリデーションルールを別のファイルに書けるんだ。
    // バリデーションは、コントローラに書けばいいんじゃないかと思うんだけど。
    // 複雑なバリデーションをつけたりする場合には、別にしておいたほうが分かりやすいよね。
    // ProfileUpdateRequest  $request とあり、ProfileUpdateRequestでバリデーションを行った後の値が指定されています。
    // その後、updateメソッドの最初に : RedirectResponse とついていますが、こちらは戻り値の型を指定しています。
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // コードを保存する部分には、$request->user()->fill($request->validated()) とあります。
        // fillメソッドを使って、一括でバリデーション済みの値をセットしています。
        $request->user()->fill($request->validated());

        // 次にif構文を使い、メールアドレスが更新されていれば、usersテーブルのemail_verified_atをnullにする、と書かれています。
        // isDirty メソッドによって、データベースに保存した内容と、フォームから送信された内容が同じかどうかをチェックできます。
        // もしメールアドレスが変更されていれば、usersテーブルのemail_verified_atがnullになり、再度、メール認証用のメールが送信されます。
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // アバター保存用のコード追加「アバター画像の保存」
        // アバター画像がもしあった場合に、保存するためのコードを入れています。
        if ($request->validated('avatar')) {
            // 古いアバター削除用コード
            // $user=User::find(auth()->user()->id);: ログインしているユーザーのIDを使用して、ユーザーモデル (User モデル) をデータベースから取得します。
            $user = User::find(auth()->user()->id);
            // if ($user->avatar !== 'user_default.jpg') {: ユーザーのアバター（プロフィール画像）が 'user_default.jpg' でない場合
            if ($user->avatar !== 'user_default.jpg') {
                // $oldavatar='public/avatar/'.$user->avatar;: 以前のアバターのパスを生成します。
                $oldavatar = 'public/avatar/' . $user->avatar;
                // Storage::delete($oldavatar);: Laravel のファイルストレージシステムを使用して、以前のアバターファイルを削除します。
                // Storage::delete() メソッドは、指定されたファイルをストレージから削除します。
                // Storage::deleteのカッコの中（引数）には、削除したい画像のパスとファイル名を入れます。
                // なんで、こんなパスになるの？storage/app/public/avatarじゃないの？
                // LaravelのStorageファサードやstoreAsなどのメソッドでは、public にアクセスすると、storage/app/public 以下にアクセスすることになります。
                // そのため、 'public/avatar/'  といれると、  'storage/app/public/avatar' にアクセスします。
                Storage::delete($oldavatar);
            }
            // 
            $name = request()->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His') . '_' . $name;
            request()->file('avatar')->storeAs('public/avatar', $avatar);
            $request->user()->avatar = $avatar;
        }

        // この後は、ユーザー情報を保存して、profile.editにリダイレクトするためのコードが記載されています。
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // アカウント管理画面の表示用コード
    // メソッドの引数として $user を定義。引数が User モデルのインスタンスであることを示しています。ルートモデルバインディングと連携して、ユーザーのIDに基づいて該当するユーザーを取得するのに使用されます。
    public function adedit(User $user) {
        // $admin=true は、この$adminを定義しています。
        // こうしておけば、ビューファイルで「もし$adminがあれば、これを実行する」ってコードが書ける。
        $admin=true;
        // $roles=Role::all(); で、Roleのデータを$rolesに代入。
        // この$rolesを他の変数と共に、ビュー画面に受け渡します。
        $roles=Role::all();

        // ユーザーのプロフィール編集ページを表示し、ビューにユーザー情報と管理者情報を渡す
        return view('profile.edit', [
            'user' => $user,
            'admin' => $admin,
            'roles' => $roles
        ]);
    }

    // アカウント更新用のコード
    // User モデルのインスタンス $user と、HTTPリクエストを受け取るための $request オブジェクトを受け取り、
    // リダイレクトレスポンス（RedirectResponse）を返すことを宣言しています。
    // つまり、ユーザープロフィール情報を更新し、特定のページにリダイレクトします。
    public function adupdate(User $user, Request $request): RedirectResponse
    {
        $inputs = $request->validate([
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($user)],
            'avatar' => ['image', 'max:1024'],
        ]);

        if (request()->hasFile('avatar')) {
            // 古いアバター削除コード
            if ($user->avatar !== 'user_default.jpg') {
                $oldavatar = 'public/avatar/' . $user->avatar;
                Storage::delete($oldavatar);
            }

            // 新しいアバター画像のファイル名は、日付と元のファイル名を組み合わせて一意になるように生成されます。
            $name = request()->file('avatar')->getClientOriginalName();
            $avatar = date('Ymd_His') . '_' . $name;
            // storeAs メソッドは、Laravel のファイルシステムを使用してファイルを指定したディスクに保存するためのメソッドです。
            request()->file('avatar')->storeAs('public/avatar', $avatar);
            $user->avatar = $avatar;
        }

        // $user->name = $inputs['name']; と $user->email = $inputs['email'];：バリデーションに合格したユーザー名とメールアドレスを、ユーザーモデルのインスタンス $user に設定します。
        $user->name = $inputs['name'];
        $user->email = $inputs['email'];
        // $user->save();：ユーザーモデルのインスタンス $user をデータベースに保存し、プロフィール情報を更新します。
        $user->save();

        // 最後に、プロフィール情報が更新された後、特定のルート（'profile.adedit'）にリダイレクトします。
        // また、リダイレクト時に 'status' セッションメッセージを渡します。このメッセージは通常、プロフィール情報が正常に更新されたことをユーザーに通知するのに使用されます。
        // compact('user') は、$user 変数をリダイレクト先のルートに渡します。これにより、profile.adedit ルートには $user 変数が利用可能になります。
        // with メソッドは、リダイレクト時にセッションにデータをフラッシュデータとして保存するために使用されます。
        // 'status' はセッション内でのデータのキーです。
        // 'profile-updated' はフラッシュデータとして保存される値です。この値は、リダイレクト後のビューで利用できます。
        // プロフィールの更新が成功したことを示すメッセージをセッションに保存し、特定のルートにリダイレクトする。
        // リダイレクト先のルートで、$user 変数としてユーザー情報にアクセスでき、'profile-updated' メッセージが表示される。
        return Redirect::route('profile.adedit', compact('user'))->with('status', 'profile-updated');
    }
    

    // 
    public function addestroy(User $user) {
        if($user->avatar!=='user_default.jpg') {
            $oldavatar='public/avatar/'.$user->avatar;
            Storage::delete($oldavatar);
        }
        $user->roles()->detach();
        $user->delete();
        return back()->with('message', 'ユーザーを削除しました');
    }
}