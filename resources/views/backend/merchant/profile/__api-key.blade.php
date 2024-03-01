<div class="tab-pane animated zoomIn" id="api-key">
    <section>
        <?php
        $userId = auth()->id();
        $merchant = \App\Models\MerchantDetail::where('user_id', $userId)->first();
        $services = \App\Models\Service::all();
        $apiResponse = $merchant ? \App\Models\ApiKey::where('merchant_id', $merchant->id)->get() : null;
        ?>

        @if ($apiResponse)
            <table class="table table-bordered">
                <thead class="thead-light">
                    <th scope="col"><label for="api-key" class="form-label">{{ __('API Key') }}</label></th>
                    <th scope="col"><label for="private-key" class="form-label">{{ __('Private Key') }}</label></th>
                    <th scope="col"><label for="public-key" class="form-label">{{ __('Public Key') }}</label></th>
                    <th scope="col"><label for="public-key" class="form-label">{{ __('Action') }}</label></th>
                </thead>
                @foreach ($apiResponse as $res)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="input-group">
                                    <input type="password" id="api-keys_{{ $loop->index }}" class="form-control"
                                        value="{{ $res->api_key }}" readonly>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="copyToClipboard('api-keys_{{ $loop->index }}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                @foreach ($res->service as $element)
                                    @php
                                        $serviceId = json_decode($element);
                                        $serviceName = $services->where('id', $serviceId)->first()->name ?? '';
                                        $icon = '';
                                        if ($element == '1') {
                                            $icon = '<i class="fas fa-check"></i>';
                                        } elseif ($element == '2') {
                                            $icon = '<i class="fas fa-dollar-sign"></i>';
                                        } elseif ($element == '3') {
                                            $icon = '<i class="fas fa-qrcode"></i>';
                                        } elseif ($element == '4') {
                                            $icon = '<i class="fas fa-qrcode"></i>';
                                        }
                                        $tooltipText = "$serviceName";
                                    @endphp
                                    <span data-toggle="tooltip" data-placement="top" title="{{ $tooltipText }}">
                                        {!! $icon !!}
                                    </span>
                                @endforeach
                            </div>
                        </td>

                        <td>
                            <div class="row">
                                <div class="input-group">
                                    <input type="password" id="private-key_{{ $loop->index }}" class="form-control"
                                        value="{{ $res->private_key }}" readonly>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="copyToClipboard('private-key_{{ $loop->index }}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="input-group">
                                    <input type="text" id="public-key_{{ $loop->index }}" class="form-control"
                                        value="{{ $res->public_key }}" readonly>
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="copyToClipboard('public-key_{{ $loop->index }}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Key Actions">
                                @if ($res->is_enabled)
                                    <form method="post"
                                        action="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE . 'desable.api-key', ['id' => $res->id]) }}">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger">Deactivate</button>
                                    </form>
                                @else
                                    <form method="post"
                                        action="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE . 'enable.api-key', ['id' => $res->id]) }}">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-success">Activate</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>{{ __('API Key not found.') }}</p>
        @endif
        <form method="post" action="{{ route(\App\Helpers\IUserRole::MERCHANT_ROLE . '.merchant.key.service') }}"
            class="mt-4">
            @csrf
            @method('post')

            <div class="mb-3">
                <label class="mr-3">
                    <input type="radio" name="action" value="attach" onclick="showExpiryDate()"> Attach existing
                    Key
                </label>
                <label>
                    <input type="radio" name="action" value="generate" onclick="hideExpiryDate()"> Generate New Key
                </label>
            </div>

            <div id="api_key_visible" style="display:none;">
                <label for="api_key" class="form-label">API KEY:</label>
                <input type="text" name="api_key" class="form-control" placeholder="Enter API key">
            </div>

            <div class="mb-3">
                <label for="service" class="form-label">Select Services:</label>
                <select name="services[]" class="form-select">
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                @error('services')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="expiryDateDiv" style="">
                <label for="expiry_date" class="form-label">Expiry Date:</label>
                <input type="date" name="expiry_date" class="form-control">
                @error('expiry_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Generate/Attach Key</button>
        </form>

        @if (session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <!-- Include Bootstrap's JavaScript library -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Initialize tooltips -->
        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script>
            function showExpiryDate() {
                document.getElementById('api_key_visible').style.display = 'block';
                document.getElementById('expiryDateDiv').style.display = 'block';
            }

            function hideExpiryDate() {
                document.getElementById('api_key_visible').style.display = 'none';
            }

            function copyToClipboard(elementId) {
                // Create a temporary text input
                var tempInput = document.createElement('input');

                // Set its type to text and value to the password field's value
                tempInput.type = 'text';
                tempInput.value = document.getElementById(elementId).value;

                // Append the temporary input to the document
                document.body.appendChild(tempInput);

                // Select the text in the temporary input
                tempInput.select();

                // Copy the selected text
                document.execCommand('copy');

                // Remove the temporary input from the document
                document.body.removeChild(tempInput);

                // Display the copy message
                var copyMessage = document.getElementById('copyMessage_' + elementId.split('_')[1]);
                copyMessage.textContent = 'Copied!';

                // Clear the message after a certain duration (e.g., 2000 milliseconds)
                setTimeout(function() {
                    copyMessage.textContent = '';
                }, 2000);
            }
        </script>
    </section>
</div>
