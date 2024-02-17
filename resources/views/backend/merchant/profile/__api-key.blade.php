<div class="d-box flex-mode content-center">
    <section>
        <div class="text-center">
            <label>Secret Key</label>

        </div>
        <div class="flex-mode gap-2 content-center">
            <label>Private Key</label>
            {{ auth()->user()->private_key }}</p>
        </div>
        <div class="flex-mode my-2 gap-2 content-center">
            <label>Public Key</label>
            {{ auth()->user()->public_key }}
        </div>

    </section>
</div>
