<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response as InertiaResponse;

class Edit extends Controller
{
    /**
     *  Display the user's profile forms.
     *
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request): InertiaResponse
    {
        $model = config('auth.providers.users.model');

        $user = $request->is('my/*')
            ? $request->user()
            : $model::findOrFail($request->user);

        return inertia('profile/Edit', [
            'allowSecondaryCredential' => config('enraiged.auth.allow_secondary_credential') === true,
            'allowSelfDelete' => config('enraiged.auth.allow_self_delete') === true,
            'allowUsernameLogin' => config('enraiged.auth.allow_username_login') === true,
            'isProtectedUser' => $user->is_protected === true,
            'mustVerifyEmail' => $user->mustVerifyEmail === true,
            'mustVerifySecondary' => $user->mustVerifySecondary === true,
            'status' => session('status'),
        ]);
    }
}
