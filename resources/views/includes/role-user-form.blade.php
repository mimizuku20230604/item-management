<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">

<div class="mt-5">
  <h4 class="mb-3">役割付与・削除（アドミンユーザーにのみ表示）</h4>
  <table class="text-left w-full border-collapse mt-8"> 
    <tr class="bg-green-600 text-center">
      <th>役割</th>
      <th>付与</th>
      <th>削除</th>
    </tr>
    @foreach ($roles as $role)
      <tr class="bg-white text-center">
        <td class="p-3">
          {{$role->name}}
        </td>
        <td class="p-3">
          <form method="post" action="{{route('role.attach', $user)}}">
            @csrf
            @method('patch')
            <input type="hidden" name="role" value="{{$role->id}}">
            <button class="inline-flex items-center px-2 py-1  text-blue-500 border border-blue-500 rounded-md font-bold text-base uppercase tracking-widest hover:bg-blue-200 focus:bg-blue-300 active:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 
            @if($user->roles->contains($role))
                        bg-gray-300
                        @endif
                        "
                        @if($user->roles->contains($role))
                            disabled
                        @endif
                        >
              役割付与
            </button>
          </form>
        </td>
        <td class="p-3">
          <form method="post" action="{{route('role.detach', $user)}}">
            @csrf
            @method('patch')
            <input type="hidden" name="role" value="{{$role->id}}">
            <button class="inline-flex items-center px-2 py-1  text-red-500 border border-red-500 rounded-md font-bold text-base uppercase tracking-widest hover:bg-red-200 focus:bg-red-300 active:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 @if(!$user->roles->contains($role))
                        bg-gray-300
                        @endif
                        "
                        @if(!$user->roles->contains($role))
                            disabled
                        @endif>
              役割削除
            </button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
</div>