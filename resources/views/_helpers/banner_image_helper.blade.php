<script>
    $(document).ready(function () {
        document.getElementById("banner_image_input").addEventListener("change", function () {
            previewBannerImage(this, 'banner_image');
        });

        document.getElementById("resetBannerBtn").addEventListener("click", resetBannerImage);

        function previewBannerImage(el, _target_el) {
            const target_el = document.getElementById(_target_el);
            const img_url = URL.createObjectURL(el.files[0]);
            target_el.children[0].setAttribute("src", img_url);
            target_el.style.display = "block";
        }

        function resetBannerImage() {
            const input_el = document.getElementById('banner_image_input');
            const target_el = document.getElementById("banner_image");

            if (target_el.style.display === "block") {
                const markerInput = document.createElement('input');
                markerInput.type = 'hidden';
                markerInput.name = 'image_removed';
                markerInput.value = 'true';
                input_el.form.appendChild(markerInput);
            }

            input_el.value = "";
            target_el.style.display = "none";
        }
    })
</script>
