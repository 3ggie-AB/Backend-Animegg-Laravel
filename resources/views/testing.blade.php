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
                                                <img src="assets/images/video-thumb-01.png" alt="">
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

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const menuItems = document.querySelectorAll(".api-option");
                            const paramContainer = document.getElementById("paramContainer");
                            const apiUrlInput = document.getElementById("api-url");
                            const apiResponse = document.getElementById("apiResponse");
                            const apiForm = document.getElementById("apiForm");

                            menuItems.forEach(item => {
                                item.addEventListener("click", function() {
                                    const url = this.dataset.url;
                                    const method = this.dataset.method;
                                    const params = JSON.parse(this.dataset.params);

                                    apiUrlInput.value = url;
                                    apiForm.dataset.method = method;

                                    // Buat parameter input
                                    paramContainer.innerHTML = "";
                                    params.forEach(param => {
                                        paramContainer.innerHTML += `
                    <div class="mb-3">
                        <label for="${param}">${param}</label>
                        <input type="text" class="form-control" name="${param}" placeholder="${param}">
                    </div>
                `;
                                    });
                                });
                            });

                            apiForm.addEventListener("submit", async function(e) {
                                e.preventDefault();
                                const url = apiUrlInput.value;
                                const method = apiForm.dataset.method;
                                const inputs = paramContainer.querySelectorAll("input");
                                const data = {};
                                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                inputs.forEach(input => {
                                    data[input.name] = input.value;
                                });
                                try {
                                    const res = await fetch(url, {
                                        method: method,
                                        headers: {
                                            "Content-Type": "application/json",
                                            "Accept": "application/json",
                                            "X-Requested-With": "XMLHttpRequest",
                                            "X-CSRF-TOKEN": csrfToken
                                        },
                                        body: JSON.stringify(data)
                                    });

                                    let responseBody = {};
                                    try {
                                        responseBody = await res.json();
                                    } catch (jsonErr) {
                                        responseBody = {
                                            error: "Respon bukan JSON yang valid"
                                        };
                                    }

                                    const output = {
                                        status: res.status,
                                        ok: res.ok,
                                        response: responseBody
                                    };

                                    console.log("API Response:", output);

                                    // Tampilkan di UI
                                    apiResponse.textContent = JSON.stringify(output, null, 2);
                                    apiResponse.style.color = res.ok ? "green" : "red";

                                } catch (err) {
                                    apiResponse.textContent = "Network error: " + err.message;
                                    apiResponse.style.color = "red";
                                    console.error("Network error:", err);
                                }
                            });

                            // Trigger klik pertama
                            if (menuItems.length > 0) menuItems[0].click();
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
