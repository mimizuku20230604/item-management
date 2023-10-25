

<div class="mt-5">
  <h4 class="mb-3">役割付与・削除</h4>
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
            <button class="
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
            <button class="@if(!$user->roles->contains($role))
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

<div class="mt-5">
  <h4 class="mb-3">役割付与・削除</h4>
  <table class="text-left w-full border-collapse mt-8"> 
    <tr class="bg-green-600 text-center">
      <th>役割</th>
      <th>操作</th>
    </tr>
    @foreach ($roles as $role)
      <tr class="bg-white text-center">
        <td class="p-3">
          {{$role->name}}
        </td>
        <td class="p-3">
          <form method="post" action="{{ route('role.attach', $user) }}">
            @csrf
            @method('patch')
            <div class="flex items-center">
              <input type="radio" name="role" value="{{$role->id}}"
                @if ($user->roles->contains($role))
                  checked
                @endif
              >
              <label for="role" class="ml-2">{{$role->name}}</label>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-full ml-4">
              更新
            </button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
</div>


<div class="mt-5">
    <h4 class="mb-3">役割付与・削除</h4>
    <table class="text-left w-full border-collapse mt-8">
        <tr class="bg-green-600 text-center">
            <th>役割</th>
            <th>操作</th>
        </tr>
        @foreach ($roles as $role)
            <tr class="bg-white text-center">
                <td class="p-3">
                    {{ $role->name }}
                </td>
                <td class="p-3">
                    <form method="post" action="{{ route('role.attach', $user) }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="role" value="{{ $role->id }}">
                        <div class="flex items-center">
                            <input type="radio" name="role" value="{{ $role->id }}" @if ($user->roles->contains($role)) checked @endif>
                            <label for="role">{{ $role->name }}</label>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded @if ($user->roles->contains($role)) bg-gray-300 cursor-not-allowed @endif">
                            役割{{ $user->roles->contains($role) ? '付与済' : '付与' }}
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

