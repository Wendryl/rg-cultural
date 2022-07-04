_setFormData();

function _setFormData() {
    const user = JSON.parse(sessionStorage.getItem("user_data"));
    const fields = document.querySelectorAll("input");

    fields.forEach((f) => {
        if (user.hasOwnProperty(f.name)) f.value = user[f.name];
    });
}

window.openFileInput = () => {
    const fileField = document.querySelector('input[type="file"]');
    fileField.click();
};

window.setPicPreview = (e) => {
    const img = document.querySelector("#pic-preview");
    const [file] = e.target.files;

    if (file) img.src = URL.createObjectURL(file);
};
