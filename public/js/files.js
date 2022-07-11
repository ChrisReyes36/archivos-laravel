const form = document.querySelector("#form_files");
const _token = document.querySelector("#_token");
const btn_subir = document.querySelector("#btn_subir");
const tbody_files = document.querySelector("#tbody_files");
const files = document.querySelector("#files");
const url = window.location;

const listarArchivos = async () => {
    const respuesta = await fetch(`${url}/list`);
    const data = await respuesta.json();
    tbody_files.innerHTML = "";
    data.forEach((archivo) => {
        tbody_files.innerHTML += `
            <tr>
                <td>${archivo.name}</td>
                <td>
                    <a href="${url}/${archivo.name}" target="_blank" class="btn btn-success">Ver</a>
                    <a href="${url}/delete/${archivo.id}" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        `;
    });
};

const subirArchivos = async () => {
    const data = new FormData(form);

    const response = await fetch(url, {
        method: "POST",
        body: data,
        headers: {
            "X-CSRF-TOKEN": _token.value,
        },
    });

    const json = await response.json();

    if (json.status) {
        Swal.fire({
            title: "Correcto",
            text: json.message,
            icon: "success",
        });
        listarArchivos();
        form.reset();
    } else {
        Swal.fire({
            title: "Error",
            text: json.message,
            icon: "error",
        });
    }
};

document.addEventListener("DOMContentLoaded", () => {
    listarArchivos();
});

btn_subir.addEventListener("click", subirArchivos);

files.addEventListener("change", (e) => {
    const file = e.target.files;
    const types = ["png", "jpeg", "jpg", "pdf"];

    for (let i = 0; i < file.length; i++) {
        const name = file[i].name.split(".");
        const type = name[name.length - 1];
        if (!types.includes(type)) {
            Swal.fire({
                title: "Error",
                text: "Solo se permiten archivos de tipo: " + types.join(", "),
                icon: "error",
            });
            files.value = "";
            btn_subir.disabled = true;
        }else{
            btn_subir.disabled = false;
        }
    }
});
