<?php

namespace App\Policies;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class QuotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Quote $quote): bool
    {
        // ポリシーのロジックをここに記述
        // 例: 特定の条件に基づいてユーザーにアクセスを許可または拒否
        // return $user->id === $quote->customer_id; // 例: ユーザーIDが見積のcustomer_idと一致する場合のみ許可

        //対象customer_idは閲覧可能
        if ($user->id == $quote->customer_id) {
            return true;
        }
        //管理者は全て閲覧可能
        foreach ($user->roles as $role) {
            if ($role->name == 'admin') {
                return true;
            }
        }
        //その他の場合、閲覧不可
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Quote $quote): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Quote $quote): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Quote $quote): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Quote $quote): bool
    {
        //
    }
}
