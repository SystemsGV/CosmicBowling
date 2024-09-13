document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
        subjectToast = document.getElementById("subjectToast"),
        fullDomain = window.location.origin + "/";

    const f = document.getElementById("liveToast");
    const loginForm = document.getElementById("form-login");
    const loginButton = document.getElementById("login-button");

    function setLoadingState(button, text) {
        button.innerHTML = `
      <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
    ${text}...
      `;
        button.disabled = true;
    }

    var a = new bootstrap.Toast(f, { delay: 3000 });

    function resetButtonState(button, originalText) {
        button.innerHTML = originalText;
        button.disabled = false;
    }

    function handleServerResponse(response, form, button, originalText) {
        if (!response.ok) {
            throw new Error(response.error);
        }
    }

    function displayErrorMessage(form, message) {
        const existingErrorDiv = form.querySelector(".alert-danger");
        if (existingErrorDiv) {
            existingErrorDiv.remove();
        }

        const errorDiv = document.createElement("div");
        errorDiv.classList.add("alert", "alert-danger");
        errorDiv.textContent = message;
        form.prepend(errorDiv);

        setTimeout(() => {
            errorDiv.remove();
        }, 4000);
    }

    function clearErrorMessage(form) {
        const alert = form.querySelector(".alert-danger");
        if (alert) {
            alert.remove();
        }
    }

    async function handleFormSubmit(event) {
        event.preventDefault();

        clearErrorMessage(loginForm);

        if (!loginForm.checkValidity()) {
            loginForm.classList.add("was-validated");
            return;
        }

        setLoadingState(loginButton, "Validando");

        const formData = new FormData(loginForm);
        const data = {
            number: formData.get("number_login"),
            password: formData.get("password_login"),
        };

        try {
            const response = await fetch(`${fullDomain}api/client/login`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();
            if (response.ok && result.user) {
                subjectToast.innerHTML =
                    "Bienvenido, " + result.user.name + ". Te llevare a inicio";
                resetButtonState(loginButton, "Ingresar");
                a.show();
                setTimeout(() => {
                    document.getElementById("back-home").click();
                }, 2200);
            } else {
                handleServerResponse(
                    result,
                    loginForm,
                    loginButton,
                    "Ingresar"
                );
            }
        } catch (error) {
            displayErrorMessage(loginForm, error.message);
            resetButtonState(loginButton, "Ingresar");
        }
    }

    function handleServerResponse(result, loginForm, loginButton, buttonText) {
        if (result.error) {
            displayErrorMessage(loginForm, result.error);
        } else {
            // Si no hay error, limpiar cualquier alerta de error existente
            clearErrorMessage(loginForm);
        }
        resetButtonState(loginButton, buttonText);
    }

    if (loginForm) {
        loginForm.addEventListener("submit", handleFormSubmit);
    }
});
