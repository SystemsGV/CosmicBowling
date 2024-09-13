document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        fullDomain = window.location.origin + "/";

    function setLoadingState(button, text) {
        button.innerHTML = `
      <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
    ${text}...
      `;
        button.disabled = true;
    }

    function resetButtonState(button, originalText) {
        button.innerHTML = originalText;
        button.disabled = false;
    }

    function clearErrorMessage(form) {
        const alert = form.querySelector(".alert-danger");
        if (alert) {
            alert.remove();
        }
    }

    const form = document.getElementById("form-register");

    if (form) {
        form.addEventListener("submit", async (event) => {
            event.preventDefault();

            registerButton = document.getElementById("register-button");

            const alertContainer = document.getElementById("alert-container");

            alertContainer.innerHTML = "";

            if (!form.checkValidity()) {
                form.classList.add("was-validated");
                return;
            }
            setLoadingState(registerButton, "Registrando");

            const formData = new FormData(form);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch(
                    `${fullDomain}api/client/register`,
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: JSON.stringify(data),
                    }
                );

                const responseText = await response.text();
                const result = JSON.parse(responseText);

                if (!response.ok) {
                    const errors = result.errors || {};
                    let errorList = "";

                    // Recorre los errores y acumula los mensajes en una lista
                    for (const [field, messages] of Object.entries(errors)) {
                        const errorItems = messages
                            .map((message) => `<li>${message}</li>`)
                            .join("");
                        errorList += errorItems;
                    }

                    // Solo muestra una alerta si hay errores
                    if (errorList) {
                        const alertContainer =
                            document.getElementById("alert-container");
                        if (alertContainer) {
                            // Limpia el contenedor de alertas
                            alertContainer.innerHTML = `
                              <div class="alert d-flex alert-danger" role="alert">
                                  <i class="ai-circle-x fs-xl pe-1 me-2"></i>
                                  <div>
                                      <strong>Corregir los siguientes campos :</strong>
                                      <ul>${errorList}</ul>
                                  </div>
                              </div>
                          `;
                        }
                    }

                    resetButtonState(registerButton, "Registrarse");

                    return;
                }

                // Mostrar el alert de éxito
                const alertContainer =
                    document.getElementById("alert-container");
                if (alertContainer) {
                    alertContainer.innerHTML = `
                      <div class="alert d-flex alert-success" role="alert">
                          <i class="ai-circle-check fs-xl pe-1 me-2"></i>
                          <div>Registro exitoso. Se ha enviado un código de validación a su correo. Dirigirse a inicio de session.</div>
                      </div>
                  `;
                }

                resetButtonState(registerButton, "Registrarse");
                registerButton.disabled = true;

                setTimeout(() => {}, 5000);
            } catch (error) {
                // Mostrar el alert de error
                const alertContainer =
                    document.getElementById("alert-container");
                if (alertContainer) {
                    alertContainer.innerHTML = `
                      <div class="alert d-flex alert-danger" role="alert">
                          <i class="ai-circle-x fs-xl pe-1 me-2"></i>
                          <div>Error: ${error.message}</div>
                      </div>
                  `;
                }
            }
        });
    }
});
