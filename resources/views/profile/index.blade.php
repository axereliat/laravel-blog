@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile</div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Name') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           class="form-control
                                           @error('name') is-invalid @enderror"
                                           value="{{ $user->name }}"
                                           required
                                    />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Avatar') }}
                                </label>
                                <div class="col-md-6">
                                    <input type="file"
                                           id="avatar"
                                           name="avatar"
                                           class="form-control-file"
                                    />
                                </div>
                            </div>

                            @if(null !== $user->avatar)
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <a href="{{ asset($user->avatar) }}" class="mr-3" target="_blank" title="{{ $user->name }}">
                                            <img src="{{ asset($user->avatar) }}"
                                                 style="height: 120px;"
                                                 class="img-thumbnail"
                                                 alt="{{ $user->name }}"
                                            />
                                        </a>
                                        <a href="javascript: void(0)"
                                           onclick="
                                            if (confirm('Are you sure?')) {
                                              document.getElementById('deleteAvatarForm').submit();
                                            }
                                           "
                                           class="btn btn-outline-danger btn-sm">Remove</a>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <form id="deleteAvatarForm"
                              action="{{ route('profile.delete-avatar') }}"
                              method="post"
                              style="display: none">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection