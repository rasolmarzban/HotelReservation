document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("images");
    const previewContainer = document.getElementById("image-preview");
    const form = document.querySelector("form");

    if (imageInput) {
        imageInput.addEventListener("change", function (e) {
            previewContainer.innerHTML = "";

            [...e.target.files].forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement("div");
                    div.className = "relative";

                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.className = "w-full h-32 object-cover rounded-lg";

                    const label = document.createElement("div");
                    label.className =
                        "absolute top-2 left-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded text-sm";
                    label.textContent = `Image ${index + 1}`;

                    div.appendChild(img);
                    div.appendChild(label);
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    }

    if (form) {
        form.addEventListener("submit", function (e) {
            console.log("Form submitted");
            const formData = new FormData(this);
            console.log("Form data:");
            for (let pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }
        });
    }
});
