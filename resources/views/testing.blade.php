<div id="testing-api" class="our-videos section">
    <div class="videos-left-dec">
        <img src="assets/images/videos-left-dec.png" alt="">
    </div>
    <div class="videos-right-dec">
        <img src="assets/images/videos-right-dec.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="naccs">
                    <div class="grid">
                        <div class="row">
                            <!-- KIRI - Form Dinamis -->
                            <div class="col-lg-8">
                                <ul class="nacc">
                                    <div>
                                        <div class="thumb">
                                            <form id="apiForm">
                                                <div class="mb-3">
                                                    <label for="api-token" class="form-label">Token</label>
                                                    <div class="input-group">
                                                        <input type="text" id="api-token" name="token"
                                                            class="form-control"
                                                            placeholder="(otomatis terisi setelah login)">
                                                        <button type="button" id="clear-token"
                                                            class="btn btn-outline-secondary">Clear</button>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="api-url" class="form-label">URL</label>
                                                        <input type="text" id="api-url" name="url"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div id="paramContainer"></div>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                            </form>
                                            <hr>
                                            <div>
                                                <strong>Response:</strong>
                                                <pre id="apiResponse" class="p-2 bg-light border rounded" style="white-space: pre-wrap;"></pre>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>

                            <div class="col-lg-4">
                                <div class="menu" id="apiMenu">
                                    @foreach (getApi() as $api)
                                        <div class="api-option" data-url="{{ $api['url'] }}"
                                            data-method="{{ $api['method'] }}"
                                            data-params='@json($api['parameter'])'>
                                            <div class="thumb">
                                                <img style="border-radius: 25px;" src="assets/images/video-thumb-05.png" alt="">
                                                <div class="inner-content">
                                                    <h4>{{ $api['name'] }}</h4>
                                                    <span>{{ $api['method'] }} API</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('scriptTesting')
                </div>
            </div>
        </div>
    </div>
</div>
