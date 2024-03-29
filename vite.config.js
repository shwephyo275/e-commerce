import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/Test.jsx",
                "resources/js/Product/ProductDetail.jsx",
                "resources/js/Profile.jsx",
            ],
            refresh: true,
        }),
    ],
});
