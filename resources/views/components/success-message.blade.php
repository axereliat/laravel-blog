<div>
    @if (session()->has('success_message'))
        <div class="alert alert-success" id="messageLabel">
            {{ session('success_message') }}
        </div>
    @endif
</div>