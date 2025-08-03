<script>
    function buildQueryString(data) {
        const params = new URLSearchParams();
        Object.entries(data).forEach(([k, v]) => {
            if (v !== undefined && v !== null && v !== "") {
                params.append(k, v);
            }
        });
        const str = params.toString();
        return str ? `?${str}` : "";
    }

    document.addEventListener("DOMContentLoaded", function() {
        const menuItems = document.querySelectorAll(".api-option");
        const paramContainer = document.getElementById("paramContainer");
        const apiUrlInput = document.getElementById("api-url");
        const apiResponse = document.getElementById("apiResponse");
        const apiForm = document.getElementById("apiForm");
        const tokenInput = document.getElementById("api-token");
        const clearTokenBtn = document.getElementById("clear-token");

        // Load token dari localStorage kalau ada
        const savedToken = localStorage.getItem("api_token");
        if (savedToken) {
            tokenInput.value = savedToken;
        }

        clearTokenBtn.addEventListener("click", () => {
            localStorage.removeItem("api_token");
            tokenInput.value = "";
        });

        menuItems.forEach(item => {
            item.addEventListener("click", function() {
                const url = this.dataset.url;
                const method = this.dataset.method;
                const params = JSON.parse(this.dataset.params);

                apiUrlInput.value = url;
                apiForm.dataset.method = method;

                // Buat parameter input berdasarkan object
                paramContainer.innerHTML = "";
                params.forEach(param => {
                    const isRequired = param.required ? 'required' : '';
                    const bindingAttr = param.binding ?
                        `data-binding="${param.binding}"` : '';
                    if (param.type === 'file') {
                        paramContainer.innerHTML += `
<div class="mb-3">
    <label for="${param.name}" class="form-label">${param.name}${param.required ? ' *' : ''}</label>
    <input type="file" class="form-control" name="${param.name}" id="${param.name}" ${isRequired} ${bindingAttr}>
</div>
`;
                    } else {
                        paramContainer.innerHTML += `
<div class="mb-3">
    <label for="${param.name}" class="form-label">${param.name}${param.required ? ' *' : ''}</label>
    <input type="text" class="form-control" name="${param.name}" id="${param.name}" placeholder="${param.name}" ${isRequired} ${bindingAttr}>
</div>
`;
                    }
                });

            });
        });

        apiForm.addEventListener("submit", async function(e) {
            e.preventDefault();
            apiResponse.textContent = "";
            apiResponse.style.color = "black";
            const url = apiUrlInput.value;
            const method = apiForm.dataset.method || 'GET';
            const token = tokenInput.value.trim();

            // Kumpulkan input berdasarkan type; jika ada file gunakan FormData
            const inputs = paramContainer.querySelectorAll("input");
            let hasFile = false;
            inputs.forEach(i => {
                if (i.type === 'file' && i.files.length > 0) hasFile = true;
            });

            let fetchOptions = {
                method: method,
                headers: {
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
            };

            if (token) {
                fetchOptions.headers["Authorization"] = `Bearer ${token}`;
            }

            let fetchUrl = url;
            const bindingInputs = paramContainer.querySelectorAll("input");
            bindingInputs.forEach(input => {
                const bindingParam = input.dataset.binding;
                if (bindingParam) {
                    fetchUrl = fetchUrl.replace(`{${bindingParam}}`, encodeURIComponent(
                        input.value));
                }
            });
            if (hasFile) {
                // pakai FormData untuk file + field lain
                const formData = new FormData();
                inputs.forEach(input => {
                    if (input.type === 'file') {
                        if (input.files.length > 0) {
                            formData.append(input.name, input.files[0]);
                        }
                    } else if (input.value !== '') {
                        formData.append(input.name, input.value);
                    }
                });
                fetchOptions.body = formData;
                // jangan set Content-Type, browser akan atur boundary otomatis
            } else {
                // tidak ada file
                const data = {};
                inputs.forEach(input => {
                    if (input.value !== '') {
                        data[input.name] = input.value;
                    }
                });

                if (method.toUpperCase() === "GET") {
                    fetchUrl += buildQueryString(data);
                } else {
                    fetchOptions.headers["Content-Type"] = "application/json";
                    fetchOptions.body = JSON.stringify(data);
                }
            }

            try {
                const res = await fetch(fetchUrl, fetchOptions);
                let responseBody;
                try {
                    responseBody = await res.json();
                } catch {
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

                // Simpan token otomatis kalau ini login sukses
                if (url.endsWith("/login") && res.ok) {
                    const tokenFromServer = responseBody.token || responseBody.data?.token || null;
                    if (tokenFromServer) {
                        localStorage.setItem("api_token", tokenFromServer);
                        tokenInput.value = tokenFromServer;
                    }
                }

                apiResponse.textContent = JSON.stringify(output, null, 2);
                apiResponse.style.color = res.ok ? "green" : "red";
            } catch (err) {
                apiResponse.textContent = "Network error: " + err.message;
                apiResponse.style.color = "red";
                console.error("Network error:", err);
            }
        });

        // Trigger klik pertama kalau ada
        if (menuItems.length > 0) menuItems[0].click();
    });
</script>
